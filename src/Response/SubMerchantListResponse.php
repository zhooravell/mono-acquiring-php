<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\ValueObject\SubMerchant;

/**
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--submerchant--list
 */
class SubMerchantListResponse extends AbstractResponse
{
    /**
     * @return SubMerchant[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('list') as $value) {
            $result[] = new SubMerchant(
                self::stringOrNull($value, 'code'),
                self::stringOrNull($value, 'edrpou'),
                self::stringOrNull($value, 'iban'),
                self::stringOrNull($value, 'owner'),
            );
        }

        return $result;
    }
}
