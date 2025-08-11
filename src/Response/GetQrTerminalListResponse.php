<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Enum\QrTerminalAmountType;
use Monobank\Acquiring\ValueObject\QrTerminal;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--qr--list
 */
class GetQrTerminalListResponse extends AbstractResponse
{
    /**
     * @return QrTerminal[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('list') as $value) {
            $amountType = array_key_exists('amountType', $value)
                ? QrTerminalAmountType::tryFrom($value['amountType']) ?: QrTerminalAmountType::UNKNOWN
                : QrTerminalAmountType::UNKNOWN;

            $result[] = new QrTerminal(
                self::stringOrNull($value, 'shortQrId'),
                self::stringOrNull($value, 'qrId'),
                $amountType,
                self::stringOrNull($value, 'pageUrl'),
            );
        }

        return $result;
    }
}
