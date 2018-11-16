<?php

namespace App\Http\Controllers\Backend\Dicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Dicas\PaginaDica;
use Validator;

class PaginaController extends Controller
{
  function Index(){
    $item = PaginaDica::find(1);
    if( !$item ){
      $item = new PaginaDica();
      $item->id = 1;
      $item->legenda = '';
    }
    return view('backend.dicas.pagina')
      ->with('item', $item);
  }
  
  function Salvar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()){
      $this->geraErros($validator);
    }else{
      $item = PaginaDica::find($request->id);
      if( $item ){
        $item->update($request->all());
        echo 'OK';
      }else{
        PaginaDica::create($request->all());
        echo 'OK';
      }
    }
  }

  protected function regras(){
    return $rules = array(
      'legenda' => 'required|string|min:20',
    );
  }

}
