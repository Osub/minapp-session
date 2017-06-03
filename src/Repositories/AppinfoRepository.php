<?php

/*
 * This file is part of the osub/laravel-minapp-session.
 *
 * (c) webstar <webstarchina@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Osub\LaravelMinappSession\Repositories;

use Osub\LaravelMinappSession\Appinfos;

class AppinfoRepository
{
    public function getAppinfo($appid)
    {
        return Appinfos::where('appid',$appid)->first()->toArray();
    }
}