<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\ValueObject\SubMerchant;
use PHPUnit\Framework\TestCase;

class SubMerchantTest extends TestCase
{
    public function test(): void
    {
        $code = '0a8637b3bccb42aa93fdeb791b8b58e9';
        $edrpou = '4242424242';
        $iban = 'UA213996220000026007233566001';
        $owner = 'ТОВ Ворона';
        $subMerchant = new SubMerchant($code, $edrpou, $iban, $owner);

        self::assertEquals($code, $subMerchant->getCode());
        self::assertEquals($edrpou, $subMerchant->getEdrpou());
        self::assertEquals($iban, $subMerchant->getIban());
        self::assertEquals($owner, $subMerchant->getOwner());
    }
}
