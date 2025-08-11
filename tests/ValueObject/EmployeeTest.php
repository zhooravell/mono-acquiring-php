<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Tests\ValueObject;

use Monobank\Acquiring\ValueObject\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function testWithData(): void
    {
        $id = '1';
        $name = '2';
        $ref = '3';
        $employee = new Employee($id, $name, $ref);

        self::assertEquals($id, $employee->getId());
        self::assertEquals($name, $employee->getName());
        self::assertEquals($ref, $employee->getExtRef());
    }

    public function testWithoutData(): void
    {
        $employee = new Employee(null, null, null);

        self::assertNull($employee->getId());
        self::assertNull($employee->getName());
        self::assertNull($employee->getExtRef());
    }
}
