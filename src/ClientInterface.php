<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

interface ClientInterface extends
    InvoiceCreatorInterface,
    InvoiceInvalidatorInterface,
    InvoiceStatusProviderInterface,
    PaymentCancellerInterface,
    TokenizedCardRemoverInterface,
    MerchantDataProviderInterface,
    ReceiptProviderInterface,
    PublicKeyProviderInterface,
    EmployeeProviderInterface,
    SubMerchantListProviderInterface,
    QrTerminalInfoProviderInterface,
    QrTerminalListProviderInterface,
    WalletCardsFetcherInterface,
    QrPaymentAmountRemoverInterface,
    FiscalReceiptFetcherInterface,
    HoldFinalizerInterface,
    StatementFetcherInterface,
    SplitPaymentRecipientsProviderInterface,
    CardTokenPaymentInterface,
    CardPaymentCreatorInterface,
    SyncPaymentInterface
{
}
