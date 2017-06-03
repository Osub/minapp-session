<?php

/*
 * This file is part of the osub/laravel-minapp-session.
 *
 * (c) webstar <webstarchina@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Osub\LaravelMinappSession\Auth;

use Osub\LaravelMinappSession\Repositories\AppinfoRepository;
use Illuminate\Http\Request;

class Auth
{
    public function __construct()
    {

    }

    public function getIdAndSkey(Request $request, AppinfoRepository $appinfo)
    {
        $code = $request->input('code');
        $encrypt_data = $request->input('encrypt_data');
        $iv = $request->input('iv');
        $appid = $request->input('appid');
        $appinfo->getAppinfo($appid);
        //Get Appinfos information

        //Get user data and decrypt it
    }

    public function checkLoginStatus(Request $request)
    {
        $id = $request->input('id');
        $skey = $request->input('skey');
    }

    public function decryptUserData(Request $request)
    {
        $id = $request->input('id');
        $skey = $request->input('skey');
        $encrypt_data = $request->input('encrypt_data');
    }
}