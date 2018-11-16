<?php

namespace App\Http\Controllers\Backend\FaleConosco;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\FaleConosco\FaleConosco;
use Validator;
use App\Rules\Mapa;

class FaleConoscoController extends Controller {
  
  function Index(){
    $item = FaleConosco::find(1);
    if( !$item ){
      $item = new FaleConosco();
      $item->id = 1;
      $item->legenda = '';
      $item->icone_atendimento = assets('images/sem-imagem.png');
      $item->atendimento = '';
      $item->icone_email = assets('images/sem-imagem.png');
      $item->email = '';
      $item->icone_parceiro = assets('images/sem-imagem.png');
      $item->parceiro = '';
    }
    return view('backend.faleconosco.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = FaleConosco::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        FaleConosco::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'atendimento' => 'required|string|min:20',
      'email' => 'required|string|min:20',
      'parceiro' => 'required|string|min:20',
    );
  }

 
}