<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetCardsRequest;
use Monobank\Acquiring\Response\GetCardsResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/get--api--merchant--wallet
 */
interface WalletCardsFetcherInterface
{
    public function getCards(GetCardsRequest $request): GetCardsResponse;
}
