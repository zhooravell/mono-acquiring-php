<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use Monobank\Acquiring\ValueObject\TipsInfo;

trait GetTipsInfoTrait
{
    public function getTipsInfo(): TipsInfo
    {
        $value = $this->getArray('tipsInfo');

        return new TipsInfo(
            self::stringOrNull($value, 'employeeId'),
            self::intOrNull($value, 'amount'),
        );
    }
}
