<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\ValueObject\SplitReceiver;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--split-receiver--list
 */
class GetSplitPaymentRecipientListResponse extends AbstractResponse
{
    /**
     * @return SplitReceiver[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('list') as $value) {
            $result[] = new SplitReceiver(
                self::stringOrNull($value, 'splitReceiverId'),
                self::stringOrNull($value, 'name'),
            );
        }

        return $result;
    }
}
