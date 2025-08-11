<?php

declare(strict_types=1);

namespace Monobank\Acquiring\ValueObject;

use Monobank\Acquiring\Enum\MerchantInitiatedTransactionIndicator;
use Monobank\Acquiring\Enum\SyncPaymentCardType;
use Monobank\Acquiring\Exception\InvalidCardException;
use Monobank\Acquiring\ValueObject\Traits\ValidExpiryDateTrait;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--sync-payment
 */
final class SyncPaymentCard
{
    use ValidExpiryDateTrait;

    private string $pan;
    private string $exp;
    private string $eciIndicator;
    private SyncPaymentCardType $type;
    private ?string $cvv = null;
    private ?string $cavv = null; // Cardholder Authentication Verification Value
    private ?string $tavv = null; // Token authentication verification value
    private ?string $dsTranId = null; // XID (DSTranID)
    private ?string $tReqID = null; // Token requestor ID
    private ?MerchantInitiatedTransactionIndicator $mit = null;
    private ?string $sst = null; // Subsequent Transaction
    private ?string $tid = null; // Trace Id (ID first operation)

    /**
     * @throws InvalidCardException
     */
    public function __construct(string $pan, string $exp, SyncPaymentCardType $type, string $eciIndicator)
    {
        $pan = trim(preg_replace('/[^0-9]/', '', $pan));
        $exp = trim(strip_tags($exp));
        $eciIndicator = trim(strip_tags($eciIndicator));

        if (empty($pan)) {
            throw InvalidCardException::blankCardNumber();
        }

        if (empty($exp)) {
            throw InvalidCardException::blankExpirationDate();
        }

        if (empty($eciIndicator)) {
            throw InvalidCardException::invalidElectronicCommerceIndicator();
        }

        if (!self::isValidExpiryDate($exp)) {
            throw InvalidCardException::invalidExpirationDate();
        }

        $this->pan = $pan;
        $this->exp = $exp;
        $this->type = $type;
        $this->eciIndicator = $eciIndicator;
    }

    public function setCvv(string $cvv): self
    {
        $cvv = trim(strip_tags($cvv));

        if (!empty($cvv)) {
            $this->cvv = $cvv;
        }

        return $this;
    }

    public function setMerchantInitiatedTransactionIndicator(MerchantInitiatedTransactionIndicator $indicator): self
    {
        $this->mit = $indicator;

        return $this;
    }

    public function setTid(string $tid): self
    {
        $tid = trim(strip_tags($tid));

        if (!empty($tid)) {
            $this->tid = $tid;
        }

        return $this;
    }

    public function setSst(string $sst): self
    {
        $sst = trim(strip_tags($sst));

        if (!empty($sst)) {
            $this->sst = $sst;
        }

        return $this;
    }

    public function setTReqID(string $tReqID): self
    {
        $tReqID = trim(strip_tags($tReqID));

        if (!empty($tReqID)) {
            $this->tReqID = $tReqID;
        }

        return $this;
    }

    public function setDsTranId(string $dsTranId): self
    {
        $dsTranId = trim(strip_tags($dsTranId));

        if (!empty($dsTranId)) {
            $this->dsTranId = $dsTranId;
        }

        return $this;
    }

    public function setTavv(string $tavv): self
    {
        $tavv = trim(strip_tags($tavv));

        if (!empty($tavv)) {
            $this->tavv = $tavv;
        }

        return $this;
    }

    public function setCavv(string $cavv): self
    {
        $cavv = trim(strip_tags($cavv));

        if (!empty($cavv)) {
            $this->cavv = $cavv;
        }

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'pan' => $this->pan,
            'type' => $this->type->value,
            'exp' => $this->exp,
            'eciIndicator' => $this->eciIndicator,
        ];

        if (!empty($this->cvv)) {
            $data['cvv'] = $this->cvv;
        }

        if (!empty($this->cavv)) {
            $data['cavv'] = $this->cavv;
        }

        if (!empty($this->tavv)) {
            $data['tavv'] = $this->tavv;
        }

        if (!empty($this->dsTranId)) {
            $data['dsTranId'] = $this->dsTranId;
        }

        if (!empty($this->tReqID)) {
            $data['tReqID'] = $this->tReqID;
        }

        if (!empty($this->mit)) {
            $data['mit'] = $this->mit->value;
        }

        if (!empty($this->sst)) {
            $data['sst'] = $this->sst;
        }

        if (!empty($this->tid)) {
            $data['tid'] = $this->tid;
        }

        return $data;
    }
}
