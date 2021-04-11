<?php


namespace Cexll\encode\Tests;


use Cexll\Encode\hashEncode;

class run
{
    public function main()
    {
        $priPath = __DIR__ . '/../crt/rsa-private.key';
        $pubPath = __DIR__ . '/../crt/rsa-public.key';
        hashEncode::setPrivateKeyPath($priPath);
        hashEncode::setPublicKeyPath($pubPath);
        $txt = hashEncode::hash_encode('123456789');
        print_r($txt);
//        exec("ls {$pwd}", $output, $resultCode);
    }
}

$run = new run();
$run->main();