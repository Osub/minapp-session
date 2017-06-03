<?php

/*
 * This file is part of the osub/laravel-minapp-session.
 *
 * (c) webstar <webstarchina@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Osub\LaravelMinappSession;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    /**
     * default server.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'minapp';
    }

    public static function __callStatic($name, $args)
    {
        $app = static::getFacadeRoot();
        
        if (method_exists($app, $name)) {
            return call_user_func_array([$app, $name], $args);
        }

        return $app->$name;
    }
}