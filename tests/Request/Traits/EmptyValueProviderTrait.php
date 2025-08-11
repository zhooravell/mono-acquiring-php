<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\Request\Traits;

trait EmptyValueProviderTrait
{
    public static function emptyStringProvider(): array
    {
        return [
            [''],
            ['   '],
            ["\n"],
            ["\t"],
            ["\t\n\t"],
        ];
    }
}
