<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Request\GetStatementByPeriodRequest;
use Monobank\Acquiring\Response\GetStatementByPeriodResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/rozshcheplennia/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/dodatkova-funktsionalnist/vypyska/get--api--merchant--statement
 * @see https://monobank.ua/api-docs/acquiring/intehratory/marketpleisy-ta-ahenstka-skhema/get--api--merchant--statement
 */
interface StatementFetcherInterface
{
    public function getStatementByPeriod(GetStatementByPeriodRequest $request): GetStatementByPeriodResponse;
}
