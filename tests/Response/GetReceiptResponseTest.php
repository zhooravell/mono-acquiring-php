<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\GetReceiptResponse;
use PHPUnit\Framework\TestCase;

class GetReceiptResponseTest extends TestCase
{
    public function testWithData()
    {
        $file = 'qwerty';
        $response = new GetReceiptResponse([
            'file' => $file,
        ]);

        self::assertEquals($file, $response->getFileContent());
    }

    public function testNoData()
    {
        $response = new GetReceiptResponse([]);

        self::assertNull($response->getFileContent());
    }
}
