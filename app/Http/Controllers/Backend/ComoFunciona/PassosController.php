<?php

namespace App\Http\Controllers\Backend\ComoFunciona;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\ComoFunciona\Passos;
use Validator;

class PassosController extends Controller
{
  public function Index(){
    return view('backend.comofunciona.passos');
  }

  public function GetPassos(){
    $data['data'] = Passos::all('id', 'nome');
    foreach( $data['data'] as $d ){
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.como.passos.passo", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.como.passos.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    
    if ($validator->fails()) {
      $this->geraErros($validator);
    } else {
      Passos::create($request->all());
      echo 'OK';
    }
  }

  public function Editar(Passos $passo){
    return response()->json($passo);
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        $this->geraErros($validator);
      } else {
        $passo = Passos::find($request->id);
        $passo->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Passos $passo){
    $passo->delete();
    echo 'OK';
  }

  protected function regras(){
    return $rules = array(
      'nome' => 'required|string|min:3',
      'subtitulo_menu' => 'required|string|min:3',
      'conteudo' => 'required|string|min:20',
    );
  }
}
