<?php

namespace App\Http\Controllers\Backend\Simulacao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Simulacao\Simulacao;

class SimulacaoController extends Controller
{
  public function Index(){
    return view('backend.simulacoes.index');
  }

  public function GetSimulacoes(){
    $data['data'] = Simulacao::all('id', 'tipo', 'nome', 'email', 'telefone', 'celular', 'created_at');
    foreach( $data['data'] as $d ){
      $d->tipo = $this->checkTipo($d->tipo);
      $d->telefones = $d->telefone . ' / ' .$d->celular;
      $d->date = dateTimeBdToApp($d->created_at);
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.simulacoes.simulacao", $d->id).'" data-toggle="tooltip" title="Visualizar Simulação"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.simulacoes.apagar", $d->id).'" data-toggle="tooltip" title="Apagar Simulação"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Apagar(Simulacao $simulacao){
    $simulacao->delete();
    echo 'OK';
  }

  public function Editar(Simulacao $simulacao){
    $simulacao->tipo = $this->checkTipo($simulacao->tipo);
    $simulacao->credito = currencyToAppOnlyNumbers($simulacao->credito);
    $simulacao->entrada = currencyToAppOnlyNumbers($simulacao->entrada);
    $simulacao->valor_parcela = currencyToAppOnlyNumbers($simulacao->valor_parcela);
    return response()->json($simulacao);
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

}
