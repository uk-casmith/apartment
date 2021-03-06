<?php

namespace BuildEmpire\Apartment;

use BuildEmpire\Apartment\Exceptions\NoSchemaSetException;
use BuildEmpire\Apartment\Exceptions\NoSchemaFoundException;
use BuildEmpire\Apartment\Exceptions\SchemaNameNotValidException;
use BuildEmpire\Apartment\Helpers\ApartmentHelpers;

class Schema
{
    protected $schemaName = false;

    /**
     * Set the schema name.
     *
     * @param $schemaName
     * @throws SchemaNameNotValidException
     */
    public function setSchemaName($schemaName)
    {
        if (!ApartmentHelpers::isSchemaNameValid($schemaName)) {
            throw new SchemaNameNotValidException('The apartment ' . $schemaName . ' is not valid. It must be all lowercase and only contain letters, numbers, or underscores.');
        }
        $this->schemaName = $schemaName;
    }

    /**
     * Get the current schema. If no schema is set false will be returned.
     *
     * @return bool
     */
    public function getSchemaName()
    {
        return $this->schemaName;
    }

    /**
     * Is the schema currently set?
     *
     * @return bool
     */
    public function isSchemaSet()
    {
        return !($this->schemaName === false);
    }

    /**
     * Does the schema exist?
     *
     * @param $schemaName
     * @return bool
     */
    public function doesSchemaExist($schemaName)
    {
        return (boolean)$this->getSchemaObjectSet()->where('schemaname', '=', $schemaName)->count();
    }

    /**
     * Get all schemas excluding public from the database.
     *
     * @return mixed
     */
    public function getAllSchemas()
    {
        return $this->getSchemaObjectSet()->orderBy('name')->get();
    }

    /**
     * Return a chain db object to allow you append additional parameters to object.
     *
     * Note: PostgreSQL does not use standard tables to store schema data, but you can still access it via a select.
     *
     * @return schema object
     */
    protected function getSchemaObjectSet()
    {
        return app('db')
            ->table('pg_catalog.pg_tables')
            ->select('schemaname as name')
            ->distinct('schemaname')
            ->where('schemaname', '!=', 'pg_catalog')
            ->where('schemaname', '!=', 'information_schema')
            ->where('schemaname', '!=', 'public');
    }

}