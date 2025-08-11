<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Response;

use Monobank\Acquiring\ValueObject\Employee;

/**
 * @see https://monobank.ua/api-docs/acquiring/metody/qr-ekvairynh/get--api--merchant--employee--list
 */
class GetEmployeeListResponse extends AbstractResponse
{
    /**
     * @return Employee[]
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->getArray('list') as $value) {
            $result[] = new Employee(
                self::stringOrNull($value, 'id'),
                self::stringOrNull($value, 'name'),
                self::stringOrNull($value, 'extRef'),
            );
        }

        return $result;
    }
}
