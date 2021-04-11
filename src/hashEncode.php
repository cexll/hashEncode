<?php

namespace Cexll\Encode;

use Seffeng\Cryptlib\Crypt;

class hashEncode
{
    public static $private_key_path = '';
    public static $public_key_path = '';
    public const BITS = 1024;

    public static function setPrivateKeyPath(string $path): void
    {
        self::$private_key_path = $path;
    }

    public static function setPublicKeyPath(string $path): void
    {
        self::$public_key_path = $path;
    }

    public static function rsa_encode(string $data): ?string
    {
        $crypt = new Crypt();
        # 1、生成 KEY，保存秘钥对
        $keys = $crypt->createKey(self::BITS);
        if (!is_file(self::$private_key_path) || !is_file(self::$public_key_path)) {
            $crypt->createKey(self::BITS);
            $privateKey = $keys['privateKey'] ?? null;
            $publicKey = $keys['publicKey'] ?? null;
            file_put_contents(self::$private_key_path, $privateKey);
            file_put_contents(self::$public_key_path, $publicKey);
        } else {
            $privateKey = file_get_contents(self::$private_key_path);
            $publicKey = file_get_contents(self::$public_key_path);
            $crypt->setPrivateKey($privateKey);
            $crypt->setPublicKey($publicKey);
        }
        $crypt->setEncryptionMode(1);
        $entext = $crypt->loadKey($privateKey)->encryptByPrivateKey($data);
        return base64_encode($entext);
    }

    public static function aes_encode(string $data, string $key): string
    {
        return base64_encode(openssl_encrypt($data, "AES-128-ECB", $key, OPENSSL_RAW_DATA));
    }

    public static function hash_encode(string $data): array
    {
        $key = self::grandest(9);
        $rsa_txt = self::rsa_encode($key);
        $aes_txt = self::aes_encode($data, $key);
        return [
            'body' => $aes_txt,
            'key' => $rsa_txt
        ];
    }

    private static function grandest(int $length = 9): ?string
    {
        $str = '#ABCDEFGHIJKLMNOPQRSTUVWXY#abcdefghilkmnopqrstuvwxyz1234567890';
        $randStr = str_shuffle($str);
        return substr($randStr, 0, $length);
    }
}
