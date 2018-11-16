<?php

namespace App\Http\Controllers\Backend\Usuarios;

use Validator;
use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{ 
  public function Index(){
    return view('backend.usuarios.index');
  }

  public function GetUsuarios(){
    $data['data'] = User::where('id', '<>', 3)->get(['id', 'nome', 'usuario', 'email']);
    foreach( $data['data'] as $d ){
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.usuarios.usuario", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.usuario.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      $senha = Hash::make($request->senha);
      $request['senha'] = $senha;
      User::create($request->all());
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = User::find($request->id);
        $item->nome = $request->nome;
        $item->usuario = $request->usuario;
        $item->email = $request->email;
        if( $request->senha ){
          $senha = Hash::make($request->senha);
          $item->senha = $senha;
        }
        $item->update();
        echo 'OK';
      }
    }
  }

  public function Apagar(User $usuario){
    $usuario->delete();
    echo 'OK';
  }

  public function Editar(User $usuario){
    return response()->json($usuario);
  }

  protected function regras(){
    return $rules = array(
      'nome' => 'required|string|min:3',
      'usuario' => 'required|string|min:3',
      'email' => 'required|email',
      'senha' => 'required_without:id|string|min:6|nullable',
      'confirmacao_senha' => 'required_without:id|string|min:6|same:senha|nullable',
    );
  }
}