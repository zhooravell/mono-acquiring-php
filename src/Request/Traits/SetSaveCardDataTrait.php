<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request\Traits;

/**
 * @property array $payload
 */
trait SetSaveCardDataTrait
{
    /**
     * This section details the data required for saving (tokenizing) a card.
     * To enable this feature, please contact Monobank's customer support.
     * Tokenization is not available by default.
     *
     * - saveCard: This flag indicates whether the card should be stored (tokenized) after payment.
     * - walletId: This is the user's wallet identifier.
     */
    public function setSaveCardData(bool $saveCard, ?string $walletId = null): self
    {
        if (!array_key_exists('saveCardData', $this->payload)) {
            $this->payload['saveCardData'] = [];
        }

        $this->payload['saveCardData']['saveCard'] = $saveCard;

        if ($walletId) {
            $this->payload['saveCardData']['walletId'] = $walletId;
        }

        return $this;
    }
}
