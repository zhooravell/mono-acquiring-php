<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

interface ClientInterface extends
    InvoiceManagementInterface,
    MerchantDataProviderInterface,
    ReceiptProviderInterface,
    PublicKeyProviderInterface,
    QRTerminalManagementInterface,
    WalletManagementInterface,
    StatementProviderInterface,
    PaymentManagementInterface
{
}
