<?php

declare(strict_types=1);

namespace Monobank\Acquiring;

use Monobank\Acquiring\Response\GetEmployeeListResponse;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--employee--list
 */
interface EmployeeProviderInterface
{
    public function getEmployeeList(): GetEmployeeListResponse;
}
