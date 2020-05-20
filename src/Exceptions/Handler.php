<?php

namespace WGT\Exceptions;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\App;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use WGT\Exceptions\GuzzleClientHandler;
use WGT\Exceptions\ModelNotFoundHandler;

class Handler extends ExceptionHandler
{
    /**
     * @var array
     */
    private $handlers = [
        ClientException::class => GuzzleClientHandler::class,
        ModelNotFoundException::class => ModelNotFoundHandler::class,
    ];

    /**
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
    ];

    /**
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     */
    public function render($request, Throwable $exception)
    {
        if ($this->hasHandler($exception)) {
            $exception = $this->handlers[get_class($exception)]::handle($exception);
        }

        if (App::environment('local')) {
            // return parent::render($request, $exception);
        }

        $code = $this->getCode($exception);
        $response = $this->responseRender($exception, $code);

        return response()->json($response, $code)->withException($exception);

    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function hasHandler(Throwable $exception): bool
    {
        foreach (array_keys($this->handlers) as $type) {
            if ($exception instanceof $type) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Throwable $exception
     * @return int
     */
    private function getCode(Throwable $exception): int
    {
        $code = $exception->getCode() ?: 0;

        if (empty($code) && method_exists($exception, 'statusCode')) {
            $code = $exception->statusCode() ?: 0;
        }

        if (empty($code) && method_exists($exception, 'getStatusCode')) {
            $code = $exception->getStatusCode() ?: 0;
        }

        if (empty($code) && property_exists($exception, 'status')) {
            $code = $exception->status ?: 0;
        }

        if (empty($code) && $exception instanceof AuthenticationException) {
            $code = 401;
        }

        return ($code < 100 || $code >= 600) ? 500 : $code;
    }

    /**
     * @param Throwable $exception
     * @param int $code
     * @return array
     */
    private function responseRender(Throwable $exception, int $code): array
    {
        $response = ['status' => 'error', 'code' => $code];

        if (method_exists($exception, 'getMessage')) {
            $response['message'] = $exception->getMessage() ?: class_basename($exception);
        }

        if (method_exists($exception, 'errors')) {
            $response['errors'] = $exception->errors();
        }

        if (config('app.debug')) {
            $response['exception']['trace'] = explode("\n", $exception->getTraceAsString());
        }

        return $response;
    }

}
