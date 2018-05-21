<?php

namespace Icebearsoft\Kitukizuri\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table      = 'modulos';
    protected $primaryKey = 'moduloid';
    protected $guarded    = ['moduloid'];

    public function modulopermiso()
    {
        return $this->hasMany(ModuloPermiso::class, 'moduloid', 'moduloid');
    }
}