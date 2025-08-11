<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\GetPublicKeyResponse;
use PHPUnit\Framework\TestCase;

class GetPublicKeyResponseTest extends TestCase
{
    public function testWithData()
    {
        $key = 'qwerty';
        $response = new GetPublicKeyResponse([
            'key' => $key,
        ]);

        self::assertEquals($key, $response->getKey());
    }

    public function testNoData()
    {
        $response = new GetPublicKeyResponse([]);

        self::assertNull($response->getKey());
    }
}
