<?php

use BuildEmpire\Apartment\Helpers\ApartmentHelpers;
use PHPUnit\Framework\TestCase;

class ApartmentHelpersTest extends TestCase
{
    /** @test */
    public function checkTheModelTableIsSetToTest()
    {
        $schemaAndTable = ApartmentHelpers::getSchemaTableFormat('testschema', 'table');
        $this->assertTrue($schemaAndTable == 'testschema.table');
    }

    /** @test */
    public function checkThatSchemaNameStopsInvalidSchemaNames()
    {
        $this->assertFalse(ApartmentHelpers::isSchemaNameValid('TEST'));
        $this->assertFalse(ApartmentHelpers::isSchemaNameValid('pg_'));
        $this->assertFalse(ApartmentHelpers::isApartmentSchemaNameValid('public'));
    }

}
