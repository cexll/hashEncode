<?php
declare(strict_types=1);

namespace Cexll\encode\Tests;

use Cexll\Encode\hashEncode;
use PHPUnit\Framework\TestCase;

class hashEncodeTest extends TestCase
{
    public function testHash()
    {
        try {
            var_dump(__DIR__);
//        hashEncode::setPrivateKeyPath(__DIR__);
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
        }
    }
}