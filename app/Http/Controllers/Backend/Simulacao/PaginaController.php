<?php

namespace App\Http\Controllers\Backend\Simulacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Simulacao\PaginaSimulacao;
use Validator;

class PaginaController extends Controller
{
  function Index(){
    $item = PaginaSimulacao::find(1);
    if( !$item ){
      $item = new PaginaSimulacao();
      $item->id = 1;
      $item->legenda = '';
      $item->titulo = '';
      $item->subtitulo = '';
    }
    return view('backend.simulacao.pagina')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = PaginaSimulacao::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        PaginaSimulacao::create($request->all());
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'titulo' => 'required|string|min:20',
      'subtitulo' => 'required|string|min:20',
    );
  }
}
