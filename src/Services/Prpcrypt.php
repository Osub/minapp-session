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

use Osub\LaravelMinappSession\Services\ErrorCode;
use Osub\LaravelMinappSession\Services\PKCS7Encoder;

class Prpcrypt
{
    public $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function decrypt( $aesCipher, $aesIV )
    {
        try {
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
            mcrypt_generic_init($module, $this->key, $aesIV);
            $decrypted = mdecrypt_generic($module, $aesCipher);
            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
        } catch (Exception $e) {
            return array(ErrorCode::$illegalBuffer, null);
        }

        try {
            $result = PKCS7Encoder::decode($decrypted);
        } catch (Exception $e) {
            return array(ErrorCode::$illegalBuffer, null);
        }
        return array(0, $result);
    }
}