<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\ValueObject\Cms;
use PHPUnit\Framework\TestCase;

class CmsTest extends TestCase
{
    public function testDefaultCms(): void
    {
        $cms = new Cms();

        self::assertEquals('PHP SDK', $cms->getName());
        self::assertEquals('dev-main', $cms->getVersion());
    }

    public function testCustomCms(): void
    {
        $name = 'My PHP SDK';
        $version = '0.0.0';
        $cms = new Cms($name, $version);

        self::assertEquals($name, $cms->getName());
        self::assertEquals($version, $cms->getVersion());
    }
}
