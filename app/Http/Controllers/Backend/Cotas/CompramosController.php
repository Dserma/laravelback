<?php

namespace App\Http\Controllers\Backend\Cotas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Cotas\PaginaCompramosCota;
use Validator;

class CompramosController extends Controller {
  
  function Index(){
    $item = PaginaCompramosCota::find(1);
    if( !$item ){
      $item = new PaginaCompramosCota();
      $item->id = 1;
      $item->legenda = '';
      $item->conteudo = '';
    }
    return view('backend.cotas.compramos')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = PaginaCompramosCota::find($request->id);
      if( $item ){
        $item->update($request->all());
      }else{
        PaginaCompramosCota::create($request->except('id'));
      }
      echo 'OK';
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'conteudo' => 'required|string|min:20',
    );
  }

}