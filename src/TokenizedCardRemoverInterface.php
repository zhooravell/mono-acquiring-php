<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\RemoveTokenizedCardRequest;

/**
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/tokenizatsiia/delete--api--merchant--wallet--card
 */
interface TokenizedCardRemoverInterface
{
    public function removeTokenizedCard(RemoveTokenizedCardRequest $request): void;
}
