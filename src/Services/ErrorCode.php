<?php

/*
 * This file is part of the osub/laravel-minapp-session.
 *
 * (c) webstar <webstarchina@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Osub\LaravelMinappSession\Services;

class ErrorCode
{
    /**
     * The is ok.
     */
    public static $OK = 0;
    
    /**
     * EncodingAesKey is illegal.
     */
    public static $illegalAesKey = -41001;
    
    /**
     * Iv is illegal.
     */
    public static $illegalIv = -41002;
    
    /**
     * Decrypted after the resulting buffer is illegal.
     */
    public static $illegalBuffer = -41003;
    
    /**
     * Base64 decode failed.
     */
    public static $decodeBase64Error = -41004;
}