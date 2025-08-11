<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetCardsRequest;
use Monobank\Acquiring\Request\RemoveTokenizedCardRequest;
use Monobank\Acquiring\Response\GetCardsResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/get--api--merchant--wallet
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/delete--api--merchant--wallet--card
 */
interface WalletManagementInterface
{
    public function getCards(GetCardsRequest $request): GetCardsResponse;
    public function removeTokenizedCard(RemoveTokenizedCardRequest $request): void;
}
