<?php

namespace Icebearsoft\Kitukizuri\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table      = "sucursales";
	protected $primaryKey = "sucursalid";
	protected $guarded    = ['sucursalid'];
}
