<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentScheme;
use Monobank\Acquiring\Response\GetStatementByPeriodResponse;
use Monobank\Acquiring\ValueObject\CancelOperation;
use PHPUnit\Framework\TestCase;

class GetStatementByPeriodResponseTest extends TestCase
{
    public function test(): void
    {
        $json = <<<'JSON'
{
  "list": [
    {
      "invoiceId": "2205175v4MfatvmUL2oR",
      "status": "success",
      "maskedPan": "444403******1902",
      "date": "2025-07-25 13:30:00",
      "paymentScheme": "full",
      "amount": 4200,
      "profitAmount": 4100,
      "ccy": 980,
      "approvalCode": "662476",
      "rrn": "060189181768",
      "reference": "84d0070ee4e44667b31371d8f8813947",
      "shortQrId": "OBJE",
      "destination": "Покупка щастя",
      "cancelList": [
        {
          "amount": 4200,
          "ccy": 980,
          "date": "2025-07-25 13:45:00",
          "approvalCode": "662476",
          "rrn": "060189181768",
          "maskedPan": "444403******1902"
        }
      ]
    },
    {"cancelList": [{"date": "test"}]},
    {"date": "test"}
  ]
}
JSON;

        $response = new GetStatementByPeriodResponse(json_decode($json, true, flags: JSON_THROW_ON_ERROR));

        self::assertCount(3, $response->getList());

        $statement = $response->getList()[0];

        self::assertEquals('2205175v4MfatvmUL2oR', $statement->getInvoiceId());
        self::assertEquals(InvoiceStatus::SUCCESS, $statement->getStatus());
        self::assertEquals(PaymentScheme::FULL, $statement->getPaymentScheme());
        self::assertEquals("444403******1902", $statement->getMaskedPan());
        self::assertEquals("2025-07-25 13:30:00", $statement->getDate()->format('Y-m-d H:i:s'));
        self::assertEquals(4200, $statement->getAmount());
        self::assertEquals(4100, $statement->getProfitAmount());
        self::assertEquals(Currency::UAH, $statement->getCurrency());
        self::assertEquals('662476', $statement->getApprovalCode());
        self::assertEquals('060189181768', $statement->getRRN());
        self::assertEquals('84d0070ee4e44667b31371d8f8813947', $statement->getReference());
        self::assertEquals('OBJE', $statement->getShortQrId());
        self::assertEquals('Покупка щастя', $statement->getDestination());
        self::assertCount(1, $statement->getCancelList());
        self::assertContainsOnlyInstancesOf(CancelOperation::class, $statement->getCancelList());

        $cancelOperation = $statement->getCancelList()[0];

        self::assertEquals(4200, $cancelOperation->getAmount());
        self::assertEquals(Currency::UAH, $cancelOperation->getCurrency());
        self::assertEquals("2025-07-25 13:45:00", $cancelOperation->getDate()->format('Y-m-d H:i:s'));
        self::assertEquals("662476", $cancelOperation->getApprovalCode());
        self::assertEquals("060189181768", $cancelOperation->getRRN());
        self::assertEquals("444403******1902", $cancelOperation->getMaskedPan());
    }
}
