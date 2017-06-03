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

class PKCS7Encoder
{
    public static $blockSize = 16;

    /**
     * Fill the plaintext that needs to be encrypted.
     *
     * @param $text    Need to fill the filling operation of the plaintext.
     *
     * @return string  Fill the plain text string.
     */
    public function encode( $text )
    {
        $blockSize = self::$blockSize;
        $textLength = strlen( $text );

        $amountToPad = $blockSize - ( $textLength % $blockSize );
        if ( $amountToPad == 0 ) {
            $amountToPad = $blockSize;
        }

        $padChr = chr( $amountToPad );
        $tmp = "";
        for ( $index = 0; $index < $amountToPad; $index++ ) {
            $tmp .= $padChr;
        }
        return $text . $tmp;
    }

    /**
     * After the decryption of the clear text to fill the deletion.
     * 
     * @param $text     Decrypted after the plaintext.
     *
     * @return string   Remove the plaintext after filling the fill.
     */
    public function decode( $text )
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }
}