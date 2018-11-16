<?php

namespace App\Http\Controllers\Backend\Cotas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Cotas\PaginaCotas;
use Validator;

class PaginaController extends Controller {
  
  function IndexImoveis(){
    $item = PaginaCotas::find(1);
    if( !$item ){
      $item = new PaginaCotas();
      $item->id = 1;
      $item->titulo = '';
      $item->subtitulo = '';
    }
    $tipo = 'Imóveis';
    return view('backend.cotas.pagina')
      ->with('tipo', $tipo)
      ->with('item', $item);
  }

  function IndexAutomoveis(){
    $item = PaginaCotas::find(2);
    if( !$item ){
      $item = new PaginaCotas();
      $item->id = 2;
      $item->titulo = '';
      $item->subtitulo = '';
    }
    $tipo = 'Automóveis';
    return view('backend.cotas.pagina')
      ->with('tipo', $tipo)
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = PaginaCotas::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        PaginaCotas::create($request->all());
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'titulo' => 'required|string|min:20',
      'subtitulo' => 'required|string|min:20',
    );
  }

}