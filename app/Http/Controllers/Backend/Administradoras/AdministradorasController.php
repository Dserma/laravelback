<?php

namespace App\Http\Controllers\Backend\Administradoras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Administradoras\Administradora;
use Validator;

class AdministradorasController extends Controller
{ 
  public function Index(){
    return view('backend.administradoras.index');
  }

  public function GetAdministradoras(){
    $data['data'] = Administradora::all('id', 'imagem', 'nome');
    foreach( $data['data'] as $d ){
      $d->imagem = '<img src="'.$d->imagem.'">';
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.administradoras.administradora", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.administradora.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      Administradora::create($request->all());
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = Administradora::find($request->id);
        $item->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Administradora $administradora){
    $administradora->delete();
    echo 'OK';
  }

  public function Editar(Administradora $administradora){
    return response()->json($administradora);
  }

  protected function regras(){
    return $rules = array(
      'nome' => 'required|string|min:3',
      'imagem' => 'required|string|min:10',
    );
  }
}
