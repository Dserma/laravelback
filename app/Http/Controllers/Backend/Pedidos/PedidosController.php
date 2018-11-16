<?php

namespace App\Http\Controllers\Backend\Pedidos;

use Illuminate\Http\Request;
use App\Models\Backend\Cotas\Cota;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pedidos\Pedido;
use App\Models\Backend\Clientes\Cliente;
use Illuminate\Database\Eloquent\Collection;

class PedidosController extends Controller
{
  public function Index(){
    return view('backend.pedidos.index');
  }

  public function GetPedidos(){
    $data['data'] = Pedido::where('status', 0)->get();
    foreach( $data['data'] as $d ){
      $d->tipo = $this->checkTipo($d->tipo);
      $d->telefones = $d->telefone . ' / ' .$d->celular;
      $d->data  = dateTimeBdToApp($d->created_at);
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.pedidos.pedido", $d->id).'" data-toggle="tooltip" title="Ver Pedido"><i class="fa fa-eye"></i></button>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.pedido.apagar", $d->id).'" data-toggle="tooltip" title="Excluir Pedido"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function GetPedidosAprovados(){
    $data['data'] = Pedido::where('status', 1)->get();
    foreach( $data['data'] as $d ){
      $d->tipo = $this->checkTipo($d->tipo);
      if( $d->cliente ){
        if( $d->cliente->pessoa == 0 ){
          $d->nome = $d->cliente->nome;
        }else{
          $d->nome = $d->cliente->razao;
        }
        $d->email = $d->cliente->email;
        $d->telefones = $d->cliente->telefones;
      }else{
        $d->nome = 'SEM CLIENTE';
        $d->email = 'SEM CLIENTE';
        $d->telefones = 'SEM CLIENTE';
      }
      $d->data  = dateTimeBdToApp($d->data_aprovacao);
      $d->acoes = '<a href="'.route("backend.pedidos.pedido.aprovado", $d->id).'" class="btn btn-primary btn-ver btn-sm" data-toggle="tooltip" title="Ver Pedido"><i class="fa fa-eye"></i></a>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.pedido.apagar", $d->id).'" data-toggle="tooltip" title="Excluir Pedido"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function GetPedidosRecusados(){
    $data['data'] = Pedido::where('status', 2)->get();
    foreach( $data['data'] as $d ){
      $d->tipo = $this->checkTipo($d->tipo);
      $d->telefones = $d->telefone . ' / ' .$d->celular;
      $d->data  = dateTimeBdToApp($d->data_rejeicao);
      $d->acoes = '<button class="btn btn-danger btn-recusa btn-sm" data-toggle="popover" data-placement="top"  title="Motivo da Rejeição" data-content="'.$d->motivo_rejeicao.'" data-toggle="tooltip" title="Ver Motivo da Rejeição"><i class="fa fa-book"></i></button>';
      $d->acoes .= ' <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.pedido.apagar", $d->id).'" data-toggle="tooltip" title="Excluir Pedido"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function CriaPedido(Request $request){
    $cota = Cota::find($request->cota_id);
    $cliente = Cliente::find($request->cliente_id);
    $tipo = $cota->tipo;
    $request['tipo'] = $tipo;
    $request['cota_id'] = $cota->id;
    $request['status'] = 0;
    $request['nome'] = $cliente->nome;
    $request['email'] = $cliente->email;
    $request['celular'] = '';
    $pedido = Pedido::create($request->all())->id;
    $request->i = $pedido;
    $this->Aprovar($request);
  }

  public function Recusar(Request $request){
    $pedido = Pedido::find($request->pedido_id);
    $pedido->status = 2;
    $pedido->data_rejeicao = time();
    $pedido->motivo_rejeicao = $request->motivo_recusa;
    $pedido->update();
    echo 'OK';
  }

  public function Editar(Pedido $pedido){
    $pedido->tipo = $this->checkTipo($pedido->tipo);
    $pedido->pedido_id = $pedido->id;
    $pedido->cota = $pedido->cota;
    $pedido->cota->adm = $pedido->cota->administradora->nome;
    unset($inv);
    $inv = array();
    foreach( $pedido->cota->investidores as $i ){
      $inv[] = $i->nome;
    }
    $pedido->cota->inv = implode(',', $inv);
    $pedido->cota->credito = currencyToApp($pedido->cota->credito);
    $pedido->cota->entrada = currencyToApp($pedido->cota->entrada);
    $pedido->cota->entrada_opicional = currencyToApp($pedido->cota->entrada_opicional);
    foreach( $pedido->cota->parcelas as $p ){
      $p->valor_parcela = currencyToApp($p->valor_parcela);
    }
    if( $pedido->cota->cotas->count() > 0 ){
      $cotas = $this->pegaComposicao($pedido);
      $pedido->cotas = $cotas;
    }
    return response()->json($pedido);
  }

  public function EditarAprovado(Pedido $pedido){
    $pedido->cota->devedor = $this->calculaDevedor($pedido->cota);
    if( $pedido->cota->cotas->count() > 0 ){
      $cotas = $this->pegaComposicao($pedido);
      $pedido->cota->cotas = $cotas;
    }
    return view('backend.pedidos.aprovado')
      ->with('pedido', $pedido);
  }

  public function Aprovar(Request $request){
    $pedido = Pedido::find($request->i);
    if($pedido){
      if(!$this->checkCota($pedido->cota)){
        return response()->json(['Esta cota já foi vendida em outro pedido!'], 200);
      }
      $this->aprovaPedido($pedido);
      $this->aprovaPedidoCota($pedido);
      if( $pedido->cota->agrupada == 1 ){
        $this->aprovaCotasFilhas($pedido);
      }
      $cliente = Cliente::where('email', $pedido->email)->first();
      if($cliente){
        $pedido->cliente_id = $cliente->id;
        $pedido->update();
      }else{
        $cliente = $this->criaCliente($pedido);
        $this->atrelaCliente($pedido, $cliente);
      }
      echo 'OK';
    }else{
      return response()->json(['Pedido não encontrado!'], 200);
    }
  }

  public function Apagar(Pedido $pedido){
    $pedido->delete();
    echo 'OK';
  }

  public function SalvarAprovado(Pedido $pedido, Request $request){
    $req = $this->formataRequest($request->all());
    foreach( $req as $k => $v ){
      $pedido->$k = $v;
    }
    // pre($pedido);
    $pedido->update();
    echo 'OK';
  }

  protected function checkCota(Cota $cota) : bool{
    $pedidos = $cota->pedidos;
    foreach( $pedidos as $p ){
      if( $p->status == 1 ){
        return false;
      }
    }
    return true;
  }

  protected function aprovaPedido(Pedido $pedido){
      $pedido->status = 1;
      $pedido->data_aprovacao = time();
      $pedido->update();
  }

  protected function aprovaPedidoCota(Pedido $pedido){
    $cota = $pedido->cota;
    $cota->status = '3';
    $cota->update();
  }

  protected function aprovaCotasFilhas(Pedido $pedido){
    $cotas = $pedido->cota->cotas;
    foreach( $cotas as $c ){
      $cota = Cota::find($c->cota_id);
      $cota->status = '3';
      $cota->update();
    }
  }
  
  protected function criaCliente(Pedido $pedido) : Cliente{
    $cliente = new Cliente();
    $cliente->pessoa = 0;
    $cliente->nome = $pedido->nome;
    $cliente->email = $pedido->email;
    $cliente->telefones = $pedido->telefone . ' / ' .$pedido->celular;
    $cliente->save();
    $cliente->refresh();
    return $cliente;
  }

  protected function atrelaCliente(Pedido $pedido, Cliente $cliente){
    $pedido->cliente_id = $cliente->id;
    $pedido->update();
  }

  protected function checkTipo($tipo){
    switch ($tipo){
      case '1':
        return '<label class="label label-warning">IMÓVEL</label>';
        break;
      case '2': 
        return '<label class="label label-primary">AUTOMÓVEL</label>';
        break;
    }
  }

  protected function pegaComposicao(Pedido $pedido){
    $cotas = new Collection();
    foreach( $pedido->cota->cotas as $c ){
      $cota = Cota::find($c->cota_id);
      $cota->adm = $cota->administradora->nome;
      $cota->devedor = $this->calculaDevedor($cota);
      $cota->credito = currencyToApp($cota->credito);
      $cota->entrada = currencyToApp($cota->entrada);
      unset($inv);
      $inv = array();
      foreach( $cota->investidores as $i ){
        $inv[] = $i->nome;
      }
      $cota->inv = implode(',', $inv);
      foreach( $cota->parcelas as $p ){
        $p->valor_parcela = currencyToApp($p->valor_parcela);
      }
      $cotas[] = $cota;
    }
    return $cotas;
  }

  protected function formataRequest(Array $request){
    $campos = [
      'entrada_negociada',
      'valor_sinal',
      'valor_pagamento_final',
      'valor_comissao',
    ];
    foreach( $request as $k => $v ){
      if( in_array( $k, $campos ) ){
        $request[$k] = currencyToBd($v);
      }
    }
    return $request;
  }

}
