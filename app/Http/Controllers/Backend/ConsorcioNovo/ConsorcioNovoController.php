<?php

namespace App\Http\Controllers\Backend\ConsorcioNovo;

use Validator;
use App\Rules\Mapa;
use App\Rules\SemImagem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\ConsorcioNovo\ConsorcioNovo;

class ConsorcioNovoController extends Controller {
  
  function Index(){
    $item = ConsorcioNovo::find(1);
    if( !$item ){
      $item = new ConsorcioNovo();
      $item->id = 1;
      $item->legenda = '';
      $item->conteudo = '';
      $item->imagem = assets('images/sem-imagem.png');
      $item->icone_vantagem = assets('images/sem-imagem.png');
      $item->vantagem = '';
    }
    return view('backend.consorcionovo.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = ConsorcioNovo::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        ConsorcioNovo::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'imagem' => new SemImagem(),
      'conteudo' => 'required|string|min:20',
      'icone_vantagem' => new SemImagem(),
      'vantagem' => 'required|string|min:20',
    );
  }

}