<?php

use BuildEmpire\Apartment\Exceptions\SchemaNameNotValidException;
use BuildEmpire\Apartment\Schema;
use PHPUnit\Framework\TestCase;

class ApartmentMiddlewareTest extends TestCase
{
    public $schema;

    public function setUp()
    {
        parent::setUp();
        $this->schema = new BuildEmpire\Apartment\Schema;
    }

    /** @test */
    public function checkSchemaWontAcceptUppserCaseSchemaName()
    {
        $this->expectException(SchemaNameNotValidException::class);
        $this->schema->setSchemaName('iamNOTSHOUTING');
    }

    /** @test */
    public function checkSchemaWillAcceptALowerCaseSchemaName()
    {
        $this->assertFalse($this->schema->isSchemaSet());
        $this->schema->setSchemaName('buildempire');
        $this->assertTrue($this->schema->isSchemaSet());
    }

}
