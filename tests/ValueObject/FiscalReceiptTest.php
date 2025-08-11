<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\FiscalizationSource;
use Monobank\Acquiring\Enum\FiscalReceiptStatus;
use Monobank\Acquiring\Enum\FiscalReceiptType;
use Monobank\Acquiring\ValueObject\FiscalReceipt;
use PHPUnit\Framework\TestCase;

class FiscalReceiptTest extends TestCase
{
    public function test(): void
    {
        $id = 'a2fd4aef-cdb8-4e25-9b36-b6d4672c554d';
        $type = FiscalReceiptType::SALE;
        $status = FiscalReceiptStatus::DONE;
        $statusDescription = '';
        $taxUrl = 'https://cabinet.tax.gov.ua/cashregs/check';
        $file = 'CJFVBERi0xLj4QKJaqrrK0KMSAw123I4G9ia3go38PAovQ43JlYXRvciAoQXBhY2hl5IEZPUCBWZXJzaW9uIfDIuMykKL';
        $fiscalizationSource = FiscalizationSource::MONOPAY;

        $fiscalReceipt = new FiscalReceipt(
            $id,
            $type,
            $status,
            $statusDescription,
            $taxUrl,
            $file,
            $fiscalizationSource
        );

        self::assertSame($id, $fiscalReceipt->getId());
        self::assertSame($type, $fiscalReceipt->getType());
        self::assertSame($status, $fiscalReceipt->getStatus());
        self::assertSame($statusDescription, $fiscalReceipt->getStatusDescription());
        self::assertSame($taxUrl, $fiscalReceipt->getTaxUrl());
        self::assertSame($file, $fiscalReceipt->getFile());
        self::assertSame($fiscalizationSource, $fiscalReceipt->getFiscalizationSource());
    }
}
