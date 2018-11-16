<?php

namespace App\Http\Controllers\Backend\Index;

use Validator;
use App\Rules\Mapa;
use App\Rules\SemImagem;
use Illuminate\Http\Request;
use App\Models\Backend\Index\Index;
use App\Http\Controllers\Controller;

class IndexController extends Controller {
  
  function Index(){
    $item = Index::find(1);
    if( !$item ){
      $item = new Index();
      $item->id = 1;
      $item->conteudo = '';
      $item->imagem = assets('images/sem-imagem.png');
      $item->icone_oferecemos = assets('images/sem-imagem.png');
      $item->oferecemos = '';
    }
    return view('backend.index.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = Index::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        Index::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'imagem' => new SemImagem(),
      'conteudo' => 'required|string|min:20',
      'icone_oferecemos' => new SemImagem(),
      'oferecemos' => 'required|string|min:20',
    );
  }

}