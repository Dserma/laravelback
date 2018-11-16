<?php

namespace App\Http\Controllers\Backend\Localizacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Localizacao\Localizacao;
use Validator;
use App\Rules\Mapa;

class LocalizacaoController extends Controller {
  
  function Index(){
    $item = Localizacao::find(1);
    if( !$item ){
      $item = new Localizacao();
      $item->id = 1;
      $item->legenda = '';
      $item->mapa = '';
      $item->latitude = '';
      $item->longitude = '';
      $item->endereco = '';
    }
    return view('backend.localizacao.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = Localizacao::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        Localizacao::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'endereco' => [new Mapa]
    );
  }

}