<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Response\GetQrTerminalInfoResponse;
use PHPUnit\Framework\TestCase;

class GetQrTerminalInfoResponseTest extends TestCase
{
    public function testWithData()
    {
        $qrId = 'OBJE';
        $invoiceId = '4EwIUTA12JIZ';
        $amount = 4200;
        $response = new GetQrTerminalInfoResponse([
            'shortQrId' => $qrId,
            'invoiceId' => $invoiceId,
            'amount' => $amount,
            'ccy' => 980,
        ]);

        self::assertEquals($qrId, $response->getShortQrId());
        self::assertEquals($invoiceId, $response->getInvoiceId());
        self::assertEquals($amount, $response->getAmount());
        self::assertEquals(Currency::UAH, $response->getCurrency());
    }

    public function testNoData()
    {
        $response = new GetQrTerminalInfoResponse([]);

        self::assertNull($response->getShortQrId());
        self::assertNull($response->getInvoiceId());
        self::assertEquals(Currency::UNKNOWN, $response->getCurrency());
    }
}
