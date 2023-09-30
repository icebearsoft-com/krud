<?php

namespace Icebearsoft\Krud\App\Models;

use Icebearsoft\Krud\App\Database\TrinoConnection;

class Trino
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new TrinoConnection();
    }

    public function select($sql)
    {
        return $this->connection->execute($sql);
    }
}
