<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Response;

use Monobank\Acquiring\Enum\FinalizeStatus;
use Monobank\Acquiring\Response\FinalizeHoldResponse;
use PHPUnit\Framework\TestCase;

class FinalizeHoldResponseTest extends TestCase
{
    public function testWithoutData(): void
    {
        $response = new FinalizeHoldResponse([]);

        self::assertEquals(FinalizeStatus::UNKNOWN, $response->getStatus());
    }

    public function testWithData(): void
    {
        $response = new FinalizeHoldResponse(['status' => 'success']);

        self::assertEquals(FinalizeStatus::SUCCESS, $response->getStatus());
    }
}
