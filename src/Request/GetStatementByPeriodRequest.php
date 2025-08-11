<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Request;

use DateTimeInterface;
use Monobank\Acquiring\Exception\InvalidTerminalCodeException;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/vypyska/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--statement
 */
class GetStatementByPeriodRequest extends AbstractRequest
{
    public function __construct(DateTimeInterface $from)
    {
        $this->setPayloadValue('from', $from->getTimestamp());
    }

    public function setToDate(DateTimeInterface $from): self
    {
        $this->setPayloadValue('to', $from->getTimestamp());

        return $this;
    }

    /**
     * @throws InvalidTerminalCodeException
     */
    public function setTerminalCode(string $code): self
    {
        $code = trim($code);

        if (empty($code)) {
            throw InvalidTerminalCodeException::blankValue();
        }

        $this->setPayloadValue('code', $code);

        return $this;
    }
}
