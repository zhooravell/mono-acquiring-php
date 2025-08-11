<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\Enum\Country;
use Monobank\Acquiring\ValueObject\TokenizedCard;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/get--api--merchant--wallet
 */
class GetCardsResponse extends AbstractResponse
{
    /**
     * @return TokenizedCard[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('wallet') as $value) {
            $country = array_key_exists('country', $value)
                ? Country::tryFrom((int)$value['country']) ?: Country::UNKNOWN
                : Country::UNKNOWN;

            $result[] = new TokenizedCard(
                self::stringOrNull($value, 'cardToken'),
                self::stringOrNull($value, 'maskedPan'),
                $country,
            );
        }

        return $result;
    }
}
