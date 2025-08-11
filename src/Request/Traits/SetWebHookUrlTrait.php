<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request\Traits;

use Monobank\Acquiring\Exception\InvalidWebHookUrlException;

/**
 * @method setPayloadValue(string $key, $value): void
 */
trait SetWebHookUrlTrait
{
    /**
     * webHookUrl
     *
     * Callback URL (POST) – This is the address where payment status data will be sent when the status changes,
     * with the exception of the "expired" status. The content of the request body is identical to the
     * response of the "Invoice Status" request. We don't guarantee that messages will be delivered in order.
     * This means a webhook for a successful payment (status=success) might arrive before a webhook indicating
     * that the payment is being processed (status=processing). It's better to rely on the modifiedDate
     * field when analyzing the current invoice status. The webhook with the larger modifiedDate will be
     * the most current.
     *
     * In addition to webhooks for invoice status changes, webhooks will also be sent when the status
     * of a tokenized card changes, provided the saveCardData object was specified when the invoice was created.
     *
     * @throws InvalidWebHookUrlException
     */
    public function setWebHookUrl(string $url): self
    {
        $url = trim(strip_tags($url));

        if (empty($url)) {
            throw InvalidWebHookUrlException::blankValue();
        }

        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw InvalidWebHookUrlException::invalidURL($url);
        }

        $this->setPayloadValue('webHookUrl', $url);

        return $this;
    }
}
