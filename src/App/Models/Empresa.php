<?php

namespace Icebearsoft\Krud\App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table      = "empresas";
	protected $primaryKey = "empresaid";
	protected $guarded    = ['empresaid'];
}
