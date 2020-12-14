<?php

namespace App\Facades;

class FileLib
{
    /**
     * @param $name
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function resolveFacade($name)
    {
        return app()->make($name);
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function __callStatic($method, $args)
    {
        return (self::resolveFacade('filterFile'))->$method(...$args); /*TODO I dont like `filterFile` that name */
    }
}
