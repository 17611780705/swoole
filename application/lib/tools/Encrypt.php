<?php
    /**
     * Created by PhpStorm.
     * User: simengphp
     * Date: 2018/9/14
     * Time: 14:17
     */

namespace app\lib\tools;

class Encrypt
{
    public $key = "byte[] bytesForJnGx = { 0x31, 0x12, 0x4F, 0x58, (byte) 0x88, 0x09, 0x40, 0x38, 0x74,
            0x25, (byte) 0x99, 0x21, (byte) 0xCB, (byte) 0xDD, 0x57, 0x66, 0x57, 0x22, 0x64,
            (byte) 0x98, 0x10, 0x41, 0x36, (byte) 0xE2 }";//这个根据实际情况写

    public function crypt3Des($key)
    {
        $this->key=$key;
    }

    public function encrypt($input)
    {
        $size = mcrypt_get_block_size(MCRYPT_3DES, 'ecb');
        $input = $this->pkcs5Pad($input, $size);
        $key = str_pad($this->key, 24, '0');
        $td = mcrypt_module_open(MCRYPT_3DES, '', 'ecb', '');
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        @mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        //$data = base64_encode($this->PaddingPKCS7($data));
        $data = base64_encode($data);
        return $data;
    }
    //数据解密
    public function decrypt($encrypted)
    {
        $encrypted = base64_decode($encrypted);
        $key = str_pad($this->key, 24, '0');
        $td = mcrypt_module_open(MCRYPT_3DES, '', 'ecb', '');
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y=$this->pkcs5Unpad($decrypted);
        return $y;
    }

    public function pkcs5Pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function pkcs5Unpad($text)
    {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    public function paddingPKCS7($data)
    {
        $block_size = mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC);
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char), $padding_char);
        return $data;
    }
}
