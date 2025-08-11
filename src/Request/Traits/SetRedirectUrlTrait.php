<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request\Traits;

use Monobank\Acquiring\Exception\InvalidRedirectUrlException;

/**
 * @method setPayloadValue(string $key, $value): void
 */
trait SetRedirectUrlTrait
{
    /**
     * redirectUrl
     *
     * Return URL (GET) - This is the address the user will be redirected
     * to after completing the payment (whether successful or in case of an error).
     *
     * @throws InvalidRedirectUrlException
     */
    public function setRedirectUrl(string $url): self
    {
        $url = trim(strip_tags($url));

        if (empty($url)) {
            throw InvalidRedirectUrlException::blankValue();
        }

        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw InvalidRedirectUrlException::invalidURL($url);
        }

        $this->setPayloadValue('redirectUrl', $url);

        return $this;
    }
}
