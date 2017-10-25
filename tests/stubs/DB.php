<?php

namespace BuildEmpire\Apartment\Tests\stubs;

class DB
{
    public function table()
    {
        return $this;
    }

    public function where()
    {
        return $this;
    }

    public function select()
    {
        return $this;
    }

    public function distinct()
    {
        return $this;
    }

    public function orderBy()
    {
        return $this;
    }

    public function count()
    {
        return 0;
    }

    public function transaction()
    {
        return $this;
    }

    public function get()
    {
        return [];
    }
}
