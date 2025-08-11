<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\ValueObject\SplitReceiver;
use PHPUnit\Framework\TestCase;

class SplitReceiverTest extends TestCase
{
    public function testWithData(): void
    {
        $id = '123';
        $name = 'name';
        $splitReceiver = new SplitReceiver($id, $name);

        self::assertEquals($id, $splitReceiver->getId());
        self::assertEquals($name, $splitReceiver->getName());
    }

    public function testWithoutData(): void
    {
        $splitReceiver = new SplitReceiver(null, null);

        self::assertNull($splitReceiver->getId());
        self::assertNull($splitReceiver->getName());
    }
}
