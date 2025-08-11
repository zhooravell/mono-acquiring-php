<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\GetEmployeeListResponse;
use Monobank\Acquiring\Response\GetMerchantDataResponse;
use Monobank\Acquiring\Response\GetSplitPaymentReceiverListResponse;
use Monobank\Acquiring\Response\SubMerchantListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--details
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--details
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/get--api--merchant--details
 */
interface MerchantDataProviderInterface
{
    public function getMerchantData(): GetMerchantDataResponse;
    public function getSubMerchantList(): SubMerchantListResponse;
    public function getSplitPaymentReceiverList(): GetSplitPaymentReceiverListResponse;
    public function getEmployeeList(): GetEmployeeListResponse;
}
