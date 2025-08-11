<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\QrTerminalAmountType;
use Monobank\Acquiring\ValueObject\QrTerminal;
use PHPUnit\Framework\TestCase;

class QrTerminalTest extends TestCase
{
    public function test(): void
    {
        $shortQrId = 'OBJE';
        $qrId = 'XJ_DiM4rTd5V';
        $amountType = QrTerminalAmountType::FIX;
        $pageUrl = 'https://pay.mbnk.biz/XJ_DiM4rTd5V';

        $qrTerminal = new QrTerminal(
            $shortQrId,
            $qrId,
            $amountType,
            $pageUrl,
        );

        self::assertSame($shortQrId, $qrTerminal->getShortQrId());
        self::assertSame($qrId, $qrTerminal->getQrId());
        self::assertSame($amountType, $qrTerminal->getAmountType());
        self::assertSame($pageUrl, $qrTerminal->getPageUrl());
    }
}
