<?php

namespace App\Http\Controllers\Backend\SobreNos;

use Validator;
use App\Rules\Mapa;
use App\Rules\SemImagem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\SobreNos\SobreNos;

class SobreNosController extends Controller {
  
  function Index(){
    $item = SobreNos::find(1);
    if( !$item ){
      $item = new SobreNos();
      $item->id = 1;
      $item->legenda = '';
      $item->conteudo = '';
      $item->imagem = assets('images/sem-imagem.png');
      $item->icone_missao = assets('images/sem-imagem.png');
      $item->missao = '';
      $item->icone_visao = assets('images/sem-imagem.png');
      $item->visao = '';
      $item->icone_valores = assets('images/sem-imagem.png');
      $item->valores = '';
    }
    return view('backend.sobrenos.index')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      return $this->geraErros($validator);
    }else{
      $item = SobreNos::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        SobreNos::create($request->except('id'));
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
      'imagem' => new SemImagem(),
      'conteudo' => 'required|string|min:20',
      'icone_missao' => new SemImagem(),
      'missao' => 'required|string|min:20',
      'icone_visao' => new SemImagem(),
      'visao' => 'required|string|min:20',
      'icone_valores' => new SemImagem(),
      'valores' => 'required|string|min:20',
    );
  }

}