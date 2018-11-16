<?php

namespace App\Http\Controllers\Backend\Depoimentos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Depoimentos\Depoimento;
use Validator, Mail;

class DepoimentosController extends Controller
{ 
  public function Index(){
    return view('backend.depoimentos.index');
  }
  
  public function GetDepoimentos(){
    $data['data'] = Depoimento::all();
    foreach( $data['data'] as $d ){
      $d->conteudo = break_text($d->conteudo,100);
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.depoimentos.depoimento", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar Depoimento"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.depoimento.apagar", $d->id).'" data-toggle="tooltip" title="Apagar Depoimento"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }
  
  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      Depoimento::create($request->all());
      echo 'OK';
    }
  }
  
  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = Depoimento::find($request->id);
        $item->update($request->all());
        echo 'OK';
      }
    }
  }
  
  public function Apagar(Depoimento $depoimento){
    $depoimento->delete();
    echo 'OK';
  }
  
  public function Editar(Depoimento $depoimento){
    return response()->json($depoimento);
  }
  
  protected function regras(){
    return $rules = array(
      'autor' => 'required|string|min:3',
      'conteudo' => 'required|string|min:10',
    );
  }
}