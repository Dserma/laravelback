<?php

namespace App\Http\Controllers\Backend\Investidores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Investidores\Investidor;
use Validator;

class InvestidoresController extends Controller
{ 
  public function Index(){
    return view('backend.investidores.index');
  }

  public function GetInvestidores(){
    $data['data'] = Investidor::all('id', 'nome', 'codigo');
    foreach( $data['data'] as $d ){
      $d->cot   = $d->cotas->count();
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.investidores.investidor", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->nome.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.investidor.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->nome.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      Investidor::create($request->all());
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = Investidor::find($request->id);
        $item->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Investidor $investidor){
    $investidor->delete();
    echo 'OK';
  }

  public function Editar(Investidor $investidor){
    return response()->json($investidor);
  }

  protected function regras(){
    return $rules = array(
      'nome' => 'required|string|min:3',
    );
  }
}