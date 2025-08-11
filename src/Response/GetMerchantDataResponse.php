<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/get--api--merchant--details
 */
class GetMerchantDataResponse extends AbstractResponse
{
    public function getMerchantId(): ?string
    {
        return $this->getString('merchantId');
    }

    public function getMerchantName(): ?string
    {
        return $this->getString('merchantName');
    }

    public function getEDRPOU(): ?string
    {
        return $this->getString('edrpou');
    }
}
