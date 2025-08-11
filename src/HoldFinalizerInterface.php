<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\FinalizeHoldRequest;
use Monobank\Acquiring\Response\FinalizeHoldResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/internet-ekvairynh/post--api--merchant--invoice--finalize
 * @see https://monobank.ua/api-docs/acquiring/metody/oplata-v-zastosunku/post--api--merchant--invoice--finalize
 */
interface HoldFinalizerInterface
{
    public function finalizeHold(FinalizeHoldRequest $request): FinalizeHoldResponse;
}
