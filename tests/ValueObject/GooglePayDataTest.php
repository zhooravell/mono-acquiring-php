<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\Exception\InvalidGooglePayDataException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\ValueObject\GooglePayData;
use PHPUnit\Framework\TestCase;

class GooglePayDataTest extends TestCase
{
    public function testRequiredData(): void
    {
        $token = 'token-1';
        $exp = '1235';
        $eciIndicator = 'eciIndicator-1';

        $data = new GooglePayData($token, $exp, $eciIndicator);

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

        $data = new GooglePayData($token, $exp, $eciIndicator);
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
        $this->expectException(InvalidGooglePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_GOOGLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Google Pay token should not be blank.');

        new GooglePayData('', '0923', 'test');
    }

    public function testInvalidExpiration(): void
    {
        $this->expectException(InvalidGooglePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_GOOGLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Google Pay expiration date should follow the "MMYY" format.');

        new GooglePayData('test', 'test', 'test');
    }

    public function testBlankElectronicCommerceIndicator(): void
    {
        $this->expectException(InvalidGooglePayDataException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_GOOGLE_PAY_DATA_CODE);
        $this->expectExceptionMessage('Google Pay eciIndicator should not be blank.');

        new GooglePayData('test', 'test', '');
    }
}
