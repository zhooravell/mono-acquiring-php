<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\CancellationStatus;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\ValueObject\CancelListItem;
use Throwable;

trait GetCancelListTrait
{
    /**
     * @return CancelListItem[]
     */
    public function getCancelList(): array
    {
        $result = [];

        foreach ($this->getArray('cancelList') as $value) {
            $status = array_key_exists('status', $value)
                ? CancellationStatus::tryFrom((string)$value['status']) ?: CancellationStatus::UNKNOWN
                : CancellationStatus::UNKNOWN;

            $currency = array_key_exists('ccy', $value)
                ? Currency::tryFrom((int)$value['ccy']) ?: Currency::UNKNOWN
                : Currency::UNKNOWN;

            $createdDate = null;

            if (array_key_exists('createdDate', $value) && $value['createdDate'] !== null) {
                try {
                    $createdDate = new DateTimeImmutable($value['createdDate']);
                } catch (Throwable) {
                }
            }

            $modifiedDate = null;

            if (array_key_exists('modifiedDate', $value) && $value['modifiedDate'] !== null) {
                try {
                    $modifiedDate = new DateTimeImmutable($value['modifiedDate']);
                } catch (Throwable) {
                }
            }

            $result[] = new CancelListItem(
                $status,
                self::intOrNull($value, 'amount'),
                $currency,
                $createdDate,
                $modifiedDate,
                self::stringOrNull($value, 'approvalCode'),
                self::stringOrNull($value, 'rrn'),
                self::stringOrNull($value, 'extRef'),
            );
        }

        return $result;
    }
}
