<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use DateTimeImmutable;
use Monobank\Acquiring\Enum\Currency;
use Monobank\Acquiring\Enum\InvoiceStatus;
use Monobank\Acquiring\Enum\PaymentScheme;
use Monobank\Acquiring\ValueObject\CancelOperation;
use Monobank\Acquiring\ValueObject\Statement;
use Throwable;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/vypyska/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--statement
 */
class GetStatementByPeriodResponse extends AbstractResponse
{
    /**
     * @return Statement[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('list') as $value) {
            $status = array_key_exists('status', $value)
                ? InvoiceStatus::tryFrom($value['status']) ?: InvoiceStatus::UNKNOWN
                : InvoiceStatus::UNKNOWN;

            $date = null;

            if (array_key_exists('date', $value) && $value['date'] !== null) {
                try {
                    $date = new DateTimeImmutable($value['date']);
                } catch (Throwable) {
                }
            }

            $paymentScheme = array_key_exists('paymentScheme', $value)
                ? PaymentScheme::tryFrom($value['paymentScheme']) ?: PaymentScheme::UNKNOWN
                : PaymentScheme::UNKNOWN;

            $currency = array_key_exists('ccy', $value)
                ? Currency::tryFrom($value['ccy']) ?: Currency::UNKNOWN
                : Currency::UNKNOWN;

            $result[] = new Statement(
                self::stringOrNull($value, 'invoiceId'),
                $status,
                self::stringOrNull($value, 'maskedPan'),
                $date,
                $paymentScheme,
                self::intOrNull($value, 'amount'),
                self::intOrNull($value, 'profitAmount'),
                $currency,
                self::stringOrNull($value, 'approvalCode'),
                self::stringOrNull($value, 'rrn'),
                self::stringOrNull($value, 'reference'),
                self::stringOrNull($value, 'shortQrId'),
                self::stringOrNull($value, 'destination'),
                self::prepareCancelList(
                    array_key_exists('cancelList', $value) && $value['cancelList'] !== null
                        ? (array)$value['cancelList'] : []
                )
            );
        }

        return $result;
    }

    /**
     * @return CancelOperation[]
     */
    private static function prepareCancelList(array $cancelList): array
    {
        $list = [];

        foreach ($cancelList as $value) {
            $currency = array_key_exists('ccy', $value)
                ? Currency::tryFrom($value['ccy']) ?: Currency::UNKNOWN
                : Currency::UNKNOWN;

            $date = null;

            if (array_key_exists('date', $value) && $value['date'] !== null) {
                try {
                    $date = new DateTimeImmutable($value['date']);
                } catch (Throwable) {
                }
            }

            $list[] = new CancelOperation(
                self::intOrNull($value, 'amount'),
                $currency,
                $date,
                self::stringOrNull($value, 'approvalCode'),
                self::stringOrNull($value, 'rrn'),
                self::stringOrNull($value, 'maskedPan'),
            );
        }

        return $list;
    }
}
