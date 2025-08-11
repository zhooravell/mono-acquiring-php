<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\GetMerchantDataResponse;
use PHPUnit\Framework\TestCase;

class GetMerchantDataResponseTest extends TestCase
{
    public function testWithData()
    {
        $merchantId = '12o4Vv7EWy';
        $merchantName = 'Your Favourite Company';
        $edrpou = '4242424242';

        $response = new GetMerchantDataResponse([
            'merchantId' => $merchantId,
            'merchantName' => $merchantName,
            'edrpou' => $edrpou,
        ]);

        self::assertEquals($merchantId, $response->getMerchantId());
        self::assertEquals($merchantName, $response->getMerchantName());
        self::assertEquals($edrpou, $response->getEDRPOU());
    }

    public function testNoData()
    {
        $response = new GetMerchantDataResponse([]);

        self::assertNull($response->getMerchantId());
        self::assertNull($response->getMerchantName());
        self::assertNull($response->getEDRPOU());
    }
}
