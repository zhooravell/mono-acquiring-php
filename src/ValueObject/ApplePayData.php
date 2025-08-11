<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidApplePayDataException;
use Monobank\Acquiring\ValueObject\Traits\ValidExpiryDateTrait;

final class ApplePayData
{
    use ValidExpiryDateTrait;

    private readonly string $token;
    private readonly string $exp;
    private readonly string $eciIndicator;
    private ?string $cryptogram = null;

    /**
     * @throws InvalidApplePayDataException
     */
    public function __construct(string $token, string $exp, string $eciIndicator)
    {
        $token = trim(strip_tags($token));
        $exp = trim(strip_tags($exp));
        $eciIndicator = trim(strip_tags($eciIndicator));

        if (empty($token)) {
            throw InvalidApplePayDataException::blankToken();
        }

        if (empty($eciIndicator)) {
            throw InvalidApplePayDataException::blankElectronicCommerceIndicator();
        }

        if (!self::isValidExpiryDate($exp)) {
            throw InvalidApplePayDataException::invalidExpirationDate();
        }

        $this->token = $token;
        $this->exp = $exp;
        $this->eciIndicator = $eciIndicator;
    }

    public function setCryptogram(string $cryptogram): void
    {
        $this->cryptogram = trim(strip_tags($cryptogram));
    }

    public function toArray(): array
    {
        $data = [
            'token' => $this->token,
            'exp' => $this->exp,
            'eciIndicator' => $this->eciIndicator,
        ];

        if (!empty($this->cryptogram)) {
            $data['cryptogram'] = $this->cryptogram;
        }

        return $data;
    }
}
