<?php

namespace Icebearsoft\Krud\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table      = 'permisos';
    protected $primaryKey = 'permisoid';
    protected $guarded    = ['permisoid'];
}
