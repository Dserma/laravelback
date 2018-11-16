<?php

namespace App\Http\Controllers\Backend\Dicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Dicas\Dica;
use App\Models\Backend\Dicas\Categoria;
Use Validator;

class DicaController extends Controller
{
  public function Index(){
    $categorias = Categoria::all()->pluck('nome','id')->toArray();
    return view('backend.dicas.dicas')
      ->with('categorias', $categorias);
  }

  public function GetDicas(){
    $data['data'] = Dica::all('id', 'imagem', 'titulo');
    foreach( $data['data'] as $d ){
      $d->imagem = '<img src="'.$d->imagem.'">';
      unset($cats);
      foreach( $d->categorias as $c ){
        $cats[] = $c->nome;
      }
      $d->cats = implode(',', $cats);
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.dicas.dica", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.dicas.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      $dica = Dica::create($request->all());
      $dica->categorias()->attach($request->categorias);
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = Dica::find($request->id);
        $item->update($request->all());
        $item->categorias()->sync($request->categorias);
        echo 'OK';
      }
    }
  }

  public function Apagar(Dica $dica){
    $dica->categorias()->detach();
    $dica->delete();
    echo 'OK';
  }

  public function Editar(Dica $dica){
    foreach( $dica->categorias as $c ){
      $cats[] = $c->id;
    }
    $dica->cats = $cats;
    return response()->json($dica);
  }

  protected function regras(){
    return $rules = array(
      'titulo' => 'required|string|min:3',
      'categorias.*' => 'required|integer|exists:categorias,id',
      'resumo' => 'required|string|min:20',
      'conteudo' => 'required|string|min:20',
      'imagem' => 'required|string|min:10',
    );
  }

}
