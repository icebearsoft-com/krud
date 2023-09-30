<?php

namespace Icebearsoft\Krud\App\Http\Controllers;

use Krud;

//Models
use Icebearsoft\Krud\App\Models\Empresa;

class EmpresasController extends Krud
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->setModel(new Empresa);
        $this->setTitulo('Empresas');
        $this->setCampo(['nombre'=>'Nombre',    'campo'=>'nombre']);
        $this->setCampo(['nombre'=>'NIT',       'campo'=>'nit']);
        $this->setCampo(['nombre'=>'Telefono',  'campo'=>'telefono']);
        $this->setCampo(['nombre'=>'Correo',    'campo'=>'correo']);
        $this->setCampo(['nombre'=>'Direccion', 'campo'=>'direccion',   'tipo'=>'textarea', 'columnClass'=> 'col-md-12']);
        $this->setCampo(['nombre'=>'Logo',      'campo'=>'logo',        'tipo'=>'image',    'columnClass'=> 'col-md-12', 'show' => false]);
        $this->setCampo(['nombre'=>'Activa',    'campo'=>'activo',      'tipo'=>'bool']);
        $this->setBoton(['nombre'=>'Sucursales', 'url'=>route('sucursales.index').'?parent={id}', 'class'=>'outline-primary', 'icon'=>'mdi mdi-storefront']);
        $this->setBoton([
            'nombre' => 'Modulos',
            'url'    => route('moduloempresas.index').'?parent={id}',
            'class'  => 'outline-success',
            'icon'   => 'mdi mdi-group'
        ]);
        $this->setLayout('krud::layout');
    }
}
