<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request\Traits;

use Monobank\Acquiring\Exception\InvalidCommentException;
use Monobank\Acquiring\Exception\InvalidDestinationException;
use Monobank\Acquiring\Exception\InvalidEmailException;
use Monobank\Acquiring\ValueObject\BasketItem;
use Monobank\Acquiring\ValueObject\Discount;

/**
 * @property array $payload
 */
trait SetMerchantPaymInfoTrait
{
    /**
     * Receipt, Order, etc. Number; determined by the merchant.
     */
    public function setReference(string $reference): self
    {
        $reference = trim(strip_tags($reference));

        $this->setMerchantPaymentInfoValue('reference', $reference);

        return $this;
    }

    /**
     * Payment Description
     *
     * @throws InvalidDestinationException
     */
    public function setDestination(string $destination): self
    {
        $destination = trim(strip_tags($destination));
        $maxLength = 280;

        if (mb_strlen($destination) > $maxLength) {
            throw InvalidDestinationException::maxLength($maxLength);
        }

        $this->setMerchantPaymentInfoValue('destination', $destination);

        return $this;
    }

    /**
     * Comment
     *
     * @throws InvalidCommentException
     */
    public function setComment(string $comment): self
    {
        $comment = trim(strip_tags($comment));
        $maxLength = 280;

        if (mb_strlen($comment) > $maxLength) {
            throw InvalidCommentException::maxLength($maxLength);
        }

        $this->setMerchantPaymentInfoValue('comment', $comment);

        return $this;
    }

    /**
     * Customer Email
     *
     * @throws InvalidEmailException
     */
    public function addEmail(string $email): self
    {
        $email = trim($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::invalidEmail($email);
        }

        $this->addMerchantPaymentInfoValue('customerEmails', $email);

        return $this;
    }

    /**
     * An array of discounts or surcharges for the entire cart,
     * which will be passed to the fiscal checkbox for finalization if the connection to the checkbox is active.
     */
    public function addDiscount(Discount $discount): self
    {
        $this->addMerchantPaymentInfoValue('discounts', $discount->toArray());

        return $this;
    }

    /**
     * Order composition, used to display the order cart.
     */
    public function addBasketItem(BasketItem $item): self
    {
        $this->addMerchantPaymentInfoValue('basketOrder', $item->toArray());

        return $this;
    }

    private function setMerchantPaymentInfoValue(string $key, $value): self
    {
        if (!array_key_exists('merchantPaymInfo', $this->payload)) {
            $this->payload['merchantPaymInfo'] = [];
        }

        $this->payload['merchantPaymInfo'][$key] = $value;

        return $this;
    }

    private function addMerchantPaymentInfoValue(string $key, $value): self
    {
        if (!array_key_exists('merchantPaymInfo', $this->payload)) {
            $this->payload['merchantPaymInfo'] = [];
        }

        $this->payload['merchantPaymInfo'][$key][] = $value;

        return $this;
    }
}
