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
use Osub\LaravelMinappSession\Services\Prpcrypt;

trait WXBizDataCrypt
{
    /**
     * Appid of minapp
     * 
     * @var string
     */
    private $appid;

    /**
     * The session key that the user gets after the applet logs on.
     * 
     * @var string
     */
    private $sessionKey;

    public function __construct( $appid, $sessionKey )
    {
        $this->sessionKey = $sessionKey;
        $this->appid = $appid;
    }

    /**
     * Test the authenticity of the data, and obtain the decrypted plaintext.
     * 
     * @param $encryptedData string     Encrypted data of data.
     * @param $iv string                The initial vector returned with the user data.
     * @param $data string              Decrypted the original.
     *
     * @return mixed
     */
    public function decryptData( $encryptedData, $iv, &$data )
    {
        if (strlen($this->sessionKey) != 24)
        {
            return ErrorCode::$illegalAesKey;
        }
        $aesKey = base64_decode($this->sessionKey);

        if (strlen($iv) != 24) {
            return ErrorCode::$illegalIv;
        }
        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($encryptedData);

        $pc = new Prpcrypt($aesKey);
        $result = $pc->decrypt($aesCipher,$aesIV);

        if ($result[0] != 0) {
            return $result[0];
        }

        $dataObj=json_decode( $result[1] );
        if( $dataObj  == NULL )
        {
            return ErrorCode::$illegalBuffer;
        }
        if( $dataObj->watermark->appid != $this->appid )
        {
            return ErrorCode::$illegalBuffer;
        }
        $data = $result[1];
        return ErrorCode::$OK;
    }
}