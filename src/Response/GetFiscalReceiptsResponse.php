<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Enum\FiscalizationSource;
use Monobank\Acquiring\Enum\FiscalReceiptStatus;
use Monobank\Acquiring\Enum\FiscalReceiptType;
use Monobank\Acquiring\ValueObject\FiscalReceipt;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/prro/get--api--merchant--invoice--fiscal-checks
 */
class GetFiscalReceiptsResponse extends AbstractResponse
{
    /**
     * @return FiscalReceipt[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('checks') as $value) {
            $type = array_key_exists('type', $value)
                ? FiscalReceiptType::tryFrom((string)$value['type']) ?: FiscalReceiptType::UNKNOWN
                : FiscalReceiptType::UNKNOWN;

            $status = array_key_exists('status', $value)
                ? FiscalReceiptStatus::tryFrom((string)$value['status']) ?: FiscalReceiptStatus::UNKNOWN
                : FiscalReceiptStatus::UNKNOWN;

            $fiscalizationSource = array_key_exists('fiscalizationSource', $value)
                ? FiscalizationSource::tryFrom((string)$value['fiscalizationSource']) ?: FiscalizationSource::UNKNOWN
                : FiscalizationSource::UNKNOWN;

            $result[] = new FiscalReceipt(
                self::stringOrNull($value, 'id'),
                $type,
                $status,
                self::stringOrNull($value, 'statusDescription'),
                self::stringOrNull($value, 'taxUrl'),
                self::stringOrNull($value, 'file'),
                $fiscalizationSource,
            );
        }

        return $result;
    }
}
