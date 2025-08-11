<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Response\CreateInvoiceResponse;
use PHPUnit\Framework\TestCase;

class CreateInvoiceResponseTest extends TestCase
{
    public function testWithData()
    {
        $invoiceId = 'invoice_id';
        $pageUrl = 'page_url';

        $response = new CreateInvoiceResponse([
            'invoiceId' => $invoiceId,
            'pageUrl' => $pageUrl,
        ]);

        self::assertEquals($invoiceId, $response->getInvoiceId());
        self::assertEquals($pageUrl, $response->getPageUrl());
    }

    public function testNoData()
    {
        $response = new CreateInvoiceResponse([]);

        self::assertNull($response->getInvoiceId());
        self::assertNull($response->getPageUrl());
    }
}
