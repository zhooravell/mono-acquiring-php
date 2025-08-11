<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request;

use Monobank\Acquiring\Exception\InvalidQRIdException;
use Monobank\Acquiring\Exception\MonobankAcquiringException;
use Monobank\Acquiring\Request\GetQrTerminalInfoRequest;
use Monobank\Acquiring\Tests\Request\Traits\EmptyValueProviderTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GetQrTerminalInfoRequestTest extends TestCase
{
    use EmptyValueProviderTrait;

    #[DataProvider('emptyStringProvider')]
    public function testEmptyQrId($value): void
    {
        $this->expectException(InvalidQRIdException::class);
        $this->expectException(MonobankAcquiringException::class);
        $this->expectExceptionCode(MonobankAcquiringException::INVALID_QR_ID_CODE);
        $this->expectExceptionMessage('QR Id should not be blank.');

        new GetQrTerminalInfoRequest($value);
    }

    public function testValidQrId(): void
    {
        $id = '123456789';
        $request = new GetQrTerminalInfoRequest($id);

        self::assertEquals(
            [
                'qrId' => $id,
            ],
            $request->getPayload(),
        );
    }
}
