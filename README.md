Monobank Acquiring PHP SDK
==========================
> A simple and lightweight PHP library for working with the Monobank Acquiring API.
> It allows you to easily create payment links, track transaction statuses, and retrieve financial reports.

## Installing

``` sh
$ composer require monobank/acquiring
```

## Supported API Methods

| Description                             | HTTP Method | Endpoint                                                    | Function                             |
|-----------------------------------------|-------------|-------------------------------------------------------------|--------------------------------------|
| Створення рахунку                       | POST        | `/api/merchant/invoice/create`                              | [createInvoice()]()                  |
| Статус рахунку                          | GET         | `/api/merchant/invoice/status?invoiceId={invoiceId}`        | [getInvoiceStatus()]()               |
| Скасування оплати                       | POST        | `/api/merchant/invoice/cancel`                              | [cancelPayment()]()                  |
| Інвалідація рахунку                     | POST        | `/api/merchant/invoice/remove`                              | [invalidateInvoice()]()              |
| Відкритий ключ                          | GET         | `/api/merchant/pubkey`                                      | [getPublicKey()]()                   |
| Фіналізація суми холду                  | POST        | `/api/merchant/invoice/finalize`                            | [finalizeHold()]()                   |
| Інформація про QR-касу                  | GET         | `/api/merchant/qr/details?qrId={qrId}`                      | [getQrTerminalInfo()]()              |
| Видалення суми оплати QR                | POST        | `/api/merchant/qr/reset-amount`                             | [removeQrPaymentAmount()]()          |
| Список QR-кас                           | GET         | `/api/merchant/qr/list`                                     | [getQrTerminalList]()                | 
| Дані мерчанта                           | GET         | `/api/merchant/details`                                     | [getMerchantData()]()                |
| Виписка за період                       | GET         | `/api/merchant/statement`                                   | [getStatementByPeriod()]()           |
| Видалення токенізованої картки          | DELETE      | `/api/merchant/wallet/card`                                 | [removeTokenizedCard()]()            |
| Список карток у гаманці                 | GET         | `/api/merchant/wallet`                                      | [getCards()]()                       |
| Оплата по токену                        | POST        | `/api/merchant/wallet/payment`                              | [createTokenPayment()]()             |
| Оплата за реквізитами                   | POST        | `/api/merchant/invoice/payment-direct`                      | [createPaymentByCardCredentials()]() |
| Список субмерчантів                     | GET         | `/api/merchant/submerchant/list`                            | [getSubMerchantList()]()             |
| Квитанція                               | GET         | `/api/merchant/invoice/receipt?invoiceId={invoiceId}`       | [getReceipt()]()                     |
| Фіскальні чеки                          | GET         | `/api/merchant/invoice/fiscal-checks?invoiceId={invoiceId}` | [getFiscalReceipts()]()              |
| Синхронна оплата                        | POST        | `/api/merchant/invoice/sync-payment`                        | [createSyncPayment()]()              |
| Список співробітників                   | GET         | `/api/merchant/employee/list`                               | [getEmployeeList()]()                |
| Список отримувачів розщеплених платежів | GET         | `/api/merchant/split-receiver/list`                         | [getSplitPaymentRecipientList()]()   |

# Examples

* [How to work SDK](./docs/example.md)
* [How to work with exceptions](./docs/exception.md)

# Tests

```shell
XDEBUG_MODE=coverage  ./vendor/bin/phpunit --coverage-html=coverage

phpcbf --standard=PSR12 src/ tests/
phpcs --standard=PSR12 src/ tests/
```

## Source(s)

* [Monobank Acquiring](https://monobank.ua/api-docs)
* [ISO 4217](https://www.iso.org/iso-4217-currency-codes.html)
* [ISO 3166-1](https://www.iso.org/iso-3166-country-codes.html)

