<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\user;

class UsuarioController extends Controller {

    function index() {
        $usuarios = User::all();
        return view('usuarios/index')
            ->with('usuarios', $usuarios);
    }
    
    function editar(Request $request, User $usuario) {
        return view('usuarios/editar')
            ->with('usuario', $usuario);
    }

}
