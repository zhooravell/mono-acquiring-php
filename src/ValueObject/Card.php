<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidCardException;
use Monobank\Acquiring\ValueObject\Traits\ValidExpiryDateTrait;

final class Card
{
    use ValidExpiryDateTrait;

    private string $pan;
    private string $exp;
    private string $cvv;

    /**
     * @throws InvalidCardException
     */
    public function __construct(string $pan, string $exp, string $cvv)
    {
        $pan = trim(preg_replace('/[^0-9]/', '', $pan));
        $exp = trim(strip_tags($exp));
        $cvv = trim(strip_tags($cvv));

        if (empty($pan)) {
            throw InvalidCardException::blankCardNumber();
        }

        if (empty($exp)) {
            throw InvalidCardException::blankExpirationDate();
        }

        if (!self::isValidExpiryDate($exp)) {
            throw InvalidCardException::invalidExpirationDate();
        }

        if (empty($cvv)) {
            throw InvalidCardException::blankCVV();
        }

        if (!is_numeric($cvv)) {
            throw InvalidCardException::invalidCVV();
        }

        $this->pan = $pan;
        $this->exp = $exp;
        $this->cvv = $cvv;
    }

    public function toArray(): array
    {
        return [
            'pan' => $this->pan,
            'exp' => $this->exp,
            'cvv' => $this->cvv,
        ];
    }
}
