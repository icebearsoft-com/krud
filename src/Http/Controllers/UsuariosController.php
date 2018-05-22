<?php 

namespace App\Http\Controllers\KituKizuri;

use Krud;

use Auth;

use Icebearsoft\Kitukizuri\Models\Usuario;

class UsuariosController extends Krud
{
    protected $empresaid;

    public function __construct()
    {
        $this->setModel(new Usuario);
        $this->setTitulo('Usuarios');
        $this->setCampo(['nombre'=>'Email', 'campo'=>'email']);
        $this->setCampo(['nombre'=>'Nombre', 'campo'=>'name']);
        $this->setCampo(['nombre'=>'Constraseña', 'campo'=>'password', 'tipo'=>'password', 'show'=>false]);
        $this->setBoton(['nombre'=>'Asignar Permiso', 'url'=>'/asignarpermiso?parent={id}', 'class'=>'success', 'icon'=>'lock']);
        
        $this->middleware(function ($request, $next) {
            if (!empty(Auth::user()->empresaid)) {
                $empresaid = Auth::user()->empresaid;
                $this->setCampo(['nombre'=>'empresaid', 'campo'=>'empresaid', 'tipo' => 'hidden', 'value'=>$empresaid,  'show' => false]);
                $this->setWhere('empresaid', '=', $empresaid);
            }
            return $next($request);
        });
    }
}
