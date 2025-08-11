<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Exception\InvalidGooglePayDataException;
use Monobank\Acquiring\ValueObject\Traits\ValidExpiryDateTrait;

final class GooglePayData
{
    use ValidExpiryDateTrait;

    private readonly string $token;
    private readonly string $exp;
    private readonly string $eciIndicator;
    private ?string $cryptogram = null;

    /**
     * @throws InvalidGooglePayDataException
     */
    public function __construct(string $token, string $exp, string $eciIndicator)
    {
        $token = trim(strip_tags($token));
        $exp = trim(strip_tags($exp));
        $eciIndicator = trim(strip_tags($eciIndicator));

        if (empty($token)) {
            throw InvalidGooglePayDataException::blankToken();
        }

        if (empty($eciIndicator)) {
            throw InvalidGooglePayDataException::blankElectronicCommerceIndicator();
        }

        if (!self::isValidExpiryDate($exp)) {
            throw InvalidGooglePayDataException::invalidExpirationDate();
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
