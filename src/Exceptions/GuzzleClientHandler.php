<?php

namespace WGT\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;

class GuzzleClientHandler
{
    /**
     * @param ClientException $exception
     * @return Exception
     */
    public static function handle(ClientException $exception): Exception
    {
        $response = json_decode($exception->getResponse()->getBody()->getContents(), true);
        $error = collect($response['errors'])->flatten()->first();

        return new Exception($error ?? '', $response['code'] ?? 400, $exception);
    }
}
