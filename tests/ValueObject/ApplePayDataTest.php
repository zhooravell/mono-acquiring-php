<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Exception\InvalidApplePayDataException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\ApplePayData;
use PHPUnit\Framework\TestCase;

class ApplePayDataTest extends TestCase
{
    public function testRequiredData(): void
    {
        $token = 'token-1';
        $exp = '1235';
        $eciIndicator = 'eciIndicator-1';

        $data = new ApplePayData($token, $exp, $eciIndicator);

        self::assertEquals(
            [
                'token' => 'token-1',
                'exp' => '1235',
                'eciIndicator' => 'eciIndicator-1',
            ],
            $data->toArray(),
        );
    }

    public function testFullData(): void
    {
        $token = 'token-1';
        $exp = '1235';
        $eciIndicator = 'eciIndicator-1';

        $data = new ApplePayData($token, $exp, $eciIndicator);
        $data->setCryptogram('cryptogram-1');

        self::assertEquals(
            [
                'token' => 'token-1',
                'exp' => '1235',
                'eciIndicator' => 'eciIndicator-1',
                'cryptogram' => 'cryptogram-1',
            ],
            $data->toArray(),
        );
    }

    public function testBlankToken(): void
    {
        $this->expectException(InvalidApplePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_APPLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Apple Pay token should not be blank.');

        new ApplePayData('', '0923', 'test');
    }

    public function testInvalidExpiration(): void
    {
        $this->expectException(InvalidApplePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_APPLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Apple Pay expiration date should follow the "MMYY" format.');

        new ApplePayData('test', 'test', 'test');
    }

    public function testBlankElectronicCommerceIndicator(): void
    {
        $this->expectException(InvalidApplePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_APPLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Apple Pay eciIndicator should not be blank.');

        new ApplePayData('test', 'test', '');
    }
}
