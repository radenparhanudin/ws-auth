<?php

namespace Radenparhanudin\WsAuth\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseJson extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'response-json';
    }
}
