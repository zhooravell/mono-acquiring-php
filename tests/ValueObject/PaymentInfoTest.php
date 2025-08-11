<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\Enum\PaymentMethod;
use Monobank\Acquiring\Enum\PaymentSystem;
use Monobank\Acquiring\ValueObject\PaymentInfo;
use PHPUnit\Framework\TestCase;

class PaymentInfoTest extends TestCase
{
    public function testWithoutData(): void
    {
        $paymentInfo = new PaymentInfo(
            null,
            null,
            null,
            null,
            null,
            null,
            PaymentSystem::UNKNOWN,
            PaymentMethod::UNKNOWN,
            null,
            Country::UNKNOWN,
            null,
        );

        self::assertNull($paymentInfo->getMaskedPan());
        self::assertNull($paymentInfo->getApprovalCode());
        self::assertNull($paymentInfo->getRrn());
        self::assertNull($paymentInfo->getTransactionId());
        self::assertNull($paymentInfo->getTerminal());
        self::assertNull($paymentInfo->getBank());
        self::assertNull($paymentInfo->getFee());
        self::assertNull($paymentInfo->getAgentFee());
        self::assertEquals(PaymentSystem::UNKNOWN, $paymentInfo->getPaymentSystem());
        self::assertEquals(PaymentMethod::UNKNOWN, $paymentInfo->getPaymentMethod());
        self::assertEquals(Country::UNKNOWN, $paymentInfo->getCountry());
    }

    public function testWithData(): void
    {
        $maskedPan = 'maskedPan';
        $approvalCode = 'approvalCode';
        $rrn = 'rrn';
        $transactionId = 'transactionId';
        $terminal = 'terminal';
        $bank = 'bank';
        $fee = 10;
        $agentFee = 20;

        $paymentInfo = new PaymentInfo(
            $maskedPan,
            $approvalCode,
            $rrn,
            $transactionId,
            $terminal,
            $bank,
            PaymentSystem::VISA,
            PaymentMethod::APPLE,
            $fee,
            Country::UKRAINE,
            $agentFee,
        );

        self::assertEquals($maskedPan, $paymentInfo->getMaskedPan());
        self::assertEquals($approvalCode, $paymentInfo->getApprovalCode());
        self::assertEquals($rrn, $paymentInfo->getRrn());
        self::assertEquals($transactionId, $paymentInfo->getTransactionId());
        self::assertEquals($terminal, $paymentInfo->getTerminal());
        self::assertEquals($bank, $paymentInfo->getBank());
        self::assertEquals($fee, $paymentInfo->getFee());
        self::assertEquals($agentFee, $paymentInfo->getAgentFee());

        self::assertEquals(PaymentSystem::VISA, $paymentInfo->getPaymentSystem());
        self::assertEquals(PaymentMethod::APPLE, $paymentInfo->getPaymentMethod());
        self::assertEquals(Country::UKRAINE, $paymentInfo->getCountry());
    }
}
