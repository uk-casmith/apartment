<?php

use BuildEmpire\Apartment\Exceptions\SchemaNameNotValidException;
use PHPUnit\Framework\TestCase;

class ArtisanApartmentCommandsTest extends TestCase
{
    public $command;

    public function setUp()
    {
        parent::setUp();
        $schema        = new BuildEmpire\Apartment\Schema;
        $this->command = new BuildEmpire\Apartment\ArtisanApartmentCommands($schema);
    }

    protected function mockDatabase($mock)
    {
        app()->singleton('db', function () use ($mock) {
            return $mock;
        });
    }

    /** @test */
    public function checkYouCannotCreatePublicSchema()
    {
        $this->expectException(SchemaNameNotValidException::class);
        $this->command->makeSchema('public');
    }

    /** @test */
    public function checkYouCanMakeASchema()
    {
        $mock = Mockery::mock('BuildEmpire\Apartment\Tests\stubs\DB')
            ->makePartial();

        $mock->shouldReceive('transaction')->once()->andReturn(true);

        $this->mockDatabase($mock);
        $this->assertTrue($this->command->makeSchema('test'));
    }

    /** @test */
    public function checkWeCanDropASchema()
    {
        $mock = Mockery::mock('BuildEmpire\Apartment\Tests\stubs\DB')
            ->makePartial();

        $mock->shouldReceive('count')->once()->andReturn(1);
        $this->mockDatabase($mock);

        $this->assertTrue($this->command->dropSchema('test'));
    }

    public function tearDown()
    {
        Mockery::close();
    }

}
