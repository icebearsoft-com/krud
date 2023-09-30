<?php

namespace Icebearsoft\Krud\App\Models;

use Icebearsoft\Krud\App\Database\TrinoConnection;

class TrinoModel
{
    protected $connection = null;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->connection = new TrinoConnection();
    }

    /**
     * select
     *
     * @param  mixed $sql
     * @return void
     */
    public function select($sql)
    {
        return $this->connection->execute($sql);
    }
}
