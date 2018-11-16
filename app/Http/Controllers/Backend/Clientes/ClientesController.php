<?php

namespace App\Http\Controllers\Backend\Clientes;

use Illuminate\Http\Request;
use App\Models\Backend\Cotas\Cota;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pedidos\Pedido;
use App\Models\Backend\Clientes\Cliente;
use Validator;

class ClientesController extends Controller
{
  public function Index(){
    return view('backend.clientes.index');
  }

  public function GetClientes(){
    $data['data'] = Cliente::all();
    foreach( $data['data'] as $d ){
      $d->pessoa = $this->checkPessoa($d->pessoa);
      $d->telefones = $d->telefones;
      $d->cotas  = $d->pedidos->count();
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.clientes.cliente", $d->id).'" data-toggle="tooltip" title="Ver / Editar Cliente"><i class="fa fa-pencil-square-o"></i></button>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.cliente.apagar", $d->id).'" data-toggle="tooltip" title="Excluir Cliente"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {  
      return $this->geraErros($validator);
    } else {
      Cliente::create($request->all());
      echo 'OK';
    }
  }

  public function Editar(Cliente $cliente){
    return response()->json($cliente);
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $cliente = Cliente::find($request->id);
        $cliente->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Cliente $cliente){
    $cliente->delete();
    echo 'OK';
  }

  protected function checkPessoa($pessoa){
    switch ($pessoa){
      case '0':
        return '<label class="label label-success">FÍSICA</label>';
        break;
      case '1': 
        return '<label class="label label-primary">JURÍDICA</label>';
        break;
    }
  }

  protected function regras(){
    return $rules = array(
      'pessoa' => 'int|between:0,1',
      'nome' => 'required_if:pessoa,0',
      'razao' => 'required_if:pessoa,1',
      'cpf' => 'nullable|regex:/^[\d.-]+$/|min:14|max:14',
      'cnpj' => 'nullable|regex:/^[\d.-\/]+$/|min:18|max:18',
      'telefones' => 'required|string',
      'email' => 'required|email',
      'cep' => 'nullable|regex:/^[\d]+$/|min:8|max:9',
      'uf' => 'nullable|alpha|min:2|max:2',
    );
  }

}
