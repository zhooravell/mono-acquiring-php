<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Response\CreatePaymentByCardCredentialsResponse;
use PHPUnit\Framework\TestCase;

class CreatePaymentByCardCredentialsResponseTest extends TestCase
{
    public function testWithData()
    {
        $invoiceId = 'invoice_id';
        $tdsUrl = 'tds_url';
        $status = 'processing';
        $failureReason = 'failureReason';
        $amount = 100;
        $currency = 980;
        $createdDate = '2025-08-04 12:33:00';
        $modifiedDate = '2025-08-04 15:00:00';

        $response = new CreatePaymentByCardCredentialsResponse([
            'invoiceId' => $invoiceId,
            'tdsUrl' => $tdsUrl,
            'status' => $status,
            'failureReason' => $failureReason,
            'amount' => $amount,
            'ccy' => $currency,
            'createdDate' => $createdDate,
            'modifiedDate' => $modifiedDate,
        ]);

        self::assertEquals($invoiceId, $response->getInvoiceId());
        self::assertEquals($tdsUrl, $response->getTdsUrl());
        self::assertEquals(InvoiceStatus::PROCESSING, $response->getStatus());
        self::assertEquals(Currency::UAH, $response->getCurrency());
        self::assertEquals($failureReason, $response->getFailureReason());
        self::assertEquals($createdDate, $response->getCreatedDate()->format('Y-m-d H:i:s'));
        self::assertEquals($modifiedDate, $response->getModifiedDate()->format('Y-m-d H:i:s'));
    }

    public function testNoData()
    {
        $response = new CreatePaymentByCardCredentialsResponse([]);

        self::assertNull($response->getInvoiceId());
        self::assertNull($response->getTdsUrl());
        self::assertNull($response->getFailureReason());
        self::assertNull($response->getAmount());
        self::assertNull($response->getCreatedDate());
        self::assertNull($response->getModifiedDate());
        self::assertEquals(Currency::UNKNOWN, $response->getCurrency());
        self::assertEquals(InvoiceStatus::UNKNOWN, $response->getStatus());
    }
}
