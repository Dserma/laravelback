<?php

namespace App\Http\Controllers\Backend\Dicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Dicas\Categoria;
use Validator;

class CategoriaController extends Controller
{ 
  public function Index(){
    return view('backend.dicas.categorias');
  }

  public function GetCategorias(){
    $data['data'] = Categoria::all('id', 'nome');
    foreach( $data['data'] as $d ){
      $d->nome = $d->nome . ' ('.$d->dicas()->count().')';
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.dicas.categorias.categoria", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.dicas.categoria.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      $this->geraErros($validator);
    } else {
      Categoria::create($request->all());
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        $this->geraErros();
      } else {
        $item = Categoria::find($request->id);
        $item->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Categoria $categoria){
    $categoria->delete();
    echo 'OK';
  }

  public function Editar(Categoria $categoria){
    return response()->json($categoria);
  }

  protected function regras(){
    return $rules = array(
      'nome' => 'required|string|min:3',
    );
  }

}
