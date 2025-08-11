<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response\Traits;

use Monobank\Acquiring\Enum\TokenizedCardStatus;
use Monobank\Acquiring\ValueObject\WalletData;

trait GetWalletDataTrait
{
    public function getWalletData(): WalletData
    {
        $value = $this->getArray('walletData');
        $status = array_key_exists('status', $value)
            ? TokenizedCardStatus::tryFrom((string)$value['status']) ?: TokenizedCardStatus::UNKNOWN
            : TokenizedCardStatus::UNKNOWN;

        return new WalletData(
            self::stringOrNull($value, 'cardToken'),
            self::stringOrNull($value, 'walletId'),
            $status,
        );
    }
}
