<?php

namespace WGT\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ModelNotFoundHandler
{
    /**
     * @var int
     */
    const CODE = 404;

    /**
     * @param ModelNotFoundException $exception
     * @return ModelNotFoundException
     */
    public static function handle(ModelNotFoundException $exception): ModelNotFoundException
    {
        $name = ucfirst(Str::snake(class_basename($exception->getModel())));

        return new ModelNotFoundException("{$name} not found", self::CODE, $exception);
    }
}
