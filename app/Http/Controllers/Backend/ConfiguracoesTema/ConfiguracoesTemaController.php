<?php

namespace App\Http\Controllers\Backend\ConfiguracoesTema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\ConfiguracoesTema\ConfiguracaoTema;
use Validator;
use App\Rules\Mapa;

class ConfiguracoesTemaController extends Controller {
  
  function Index(){
    $item = ConfiguracaoTema::find(1);
    if( !$item ){
      $item = new ConfiguracaoTema();
      $item->id = 1;
      $item->legenda = '';
      $item->telefone_topo = '';
      $item->telefone_rodape = '';
      $item->endereco_rodape = '';
    }
    return view('backend.configuracoestema.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = ConfiguracaoTema::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        ConfiguracaoTema::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'telefone_topo' => 'required|string|min:20',
      'telefone_rodape' => 'required|string|min:20',
      'endereco_rodape' => 'required|string|min:20',
    );
  }

}