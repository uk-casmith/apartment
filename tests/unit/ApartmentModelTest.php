<?php

use PHPUnit\Framework\TestCase;

class ApartmentModelTest extends TestCase
{
    public $command;

    public function setUp()
    {
        parent::setUp();
        $schema        = new BuildEmpire\Apartment\Schema;
        $this->command = new BuildEmpire\Apartment\ArtisanApartmentCommands($schema);

        app()->singleton('BuildEmpire\Apartment\Schema', function () {
            $schema = new BuildEmpire\Apartment\Schema;
            $schema->setSchemaName('test');
            return $schema;
        });
    }

    protected function mockDatabase($mock)
    {
        app()->singleton('db', function () use ($mock) {
            return $mock;
        });
    }

    /** @test */
    public function checkTheModelTableIsSetToTest()
    {
        $mock = Mockery::mock('BuildEmpire\Apartment\Tests\stubs\DB')
            ->makePartial();

        $mock->shouldReceive('count')->once()->andReturn(1);

        $this->mockDatabase($mock);
        $model = new BuildEmpire\Apartment\ApartmentModel;

        $this->assertTrue($model->getTable() == 'test.apartment_models');
    }

    public function tearDown()
    {
        Mockery::close();
    }

}
