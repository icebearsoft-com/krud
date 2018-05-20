<?php

namespace Icebearsoft\Kitukizuri\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloPermiso extends Model
{
    protected $table            = 'moduloPermiso';
    protected $primaryKey = 'modulopermisoid';
    protected $guarded      = ['modulopermisoid'];

    public function permisos()
    {
        return $this->hasOne(Permiso::class, 'permisoid', 'permisoid');
    }
}
