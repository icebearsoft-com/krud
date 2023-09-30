<?php

namespace Icebearsoft\Krud\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Icebearsoft\Krud\App\Models\LaravelLogReader;
class LogController extends Controller
{
    public function index()
    {
        $log = new LaravelLogReader;
        $log->get(); 

        return view('kitukizuri::log', [
            'log'    => $log,
            'titulo' => 'Logs',
            'kmenu'  => true,
            'layout' => 'krud::layout'
        ]);
    }
}