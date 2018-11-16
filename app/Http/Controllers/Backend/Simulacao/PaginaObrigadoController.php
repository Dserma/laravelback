<?php

namespace App\Http\Controllers\Backend\Simulacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Simulacao\PaginaObrigado;
use Validator;

class PaginaObrigadoController extends Controller
{
  function Index(){
    $item = PaginaObrigado::find(1);
    if( !$item ){
      $item = new PaginaObrigado();
      $item->id = 1;
      $item->legenda = '';
      $item->titulo = '';
      $item->subtitulo = '';
    }
    return view('backend.simulacao.obrigado')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = PaginaObrigado::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        PaginaObrigado::create($request->all());
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
