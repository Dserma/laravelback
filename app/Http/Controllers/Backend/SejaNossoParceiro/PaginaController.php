<?php

namespace App\Http\Controllers\Backend\SejaNossoParceiro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\SejaNossoParceiro\SejaNossoParceiro;
use Validator;

class PaginaController extends Controller {
  
  function Index(){
    $item = SejaNossoParceiro::find(1);
    if( !$item ){
      $item = new SejaNossoParceiro();
      $item->id = 1;
      $item->legenda = '';
      $item->conteudo = '';
    }
    return view('backend.sejanossoparceiro.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = SejaNossoParceiro::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        SejaNossoParceiro::create($request->all());
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'conteudo' => 'required|string|min:20',
      'oferecemos_imoveis' => 'required|string|min:20',
      'oferecemos_veiculos' => 'required|string|min:20',
    );
  }

}