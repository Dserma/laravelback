<?php

namespace App\Http\Controllers\Backend\Cotas;

use Validator;
use Illuminate\Http\Request;
use App\Models\Backend\Cotas\Cota;
use App\Http\Controllers\Controller;
use App\Models\Backend\Clientes\Cliente;
use App\Models\Backend\Cotas\ItemAgrupado;
use App\Models\Backend\Cotas\ParcelasCota;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Backend\Investidores\Investidor;
use App\Models\Backend\Administradoras\Administradora;

class CotasController extends Controller
{

  protected $tipo;
  protected $parcelas = array();

  public function Index(Request $request){
    $nomeTipo = $this->getTipoCota(\Route::current()->getName());
    $administradoras = Administradora::all()->pluck('nome', 'id')->toArray();
    $investidores = Investidor::all()->pluck('nome', 'id')->toArray();
    $clientes = Cliente::all()->pluck('nome', 'id')->toArray();
    return view('backend.cotas.index')
      ->with('administradoras', $administradoras)
      ->with('investidores', $investidores)
      ->with('clientes', $clientes)
      ->with('tipo', $this->tipo)
      ->with('nomeTipo', $nomeTipo);
  }

  public function GetCotas(Request $request){
    $destaque = Cota::where('tipo', $request->tipo)->where('destaque', 1)->first();
    $data['data'] = Cota::where('tipo', $request->tipo)->where('agrupada', '<>', '1')->where('status','<>', '3')->get();
    foreach( $data['data'] as $d ){
      $devedor = $this->calculaDevedor($d);
      $d->credito = currencyToApp($d->credito);
      $d->entrada = currencyToApp($d->entrada);
      $d->devedor = currencyToApp($devedor);
      $d->par     = $this->getParcelas($d->parcelas);
      $d->juros   = currencyToAppOnlyNumbers($d->juros);
      $d->admin   = $d->administradora->nome;
      unset($inv);
      $inv = array();
      foreach( $d->investidores as $i ){
        $inv[] = $i->nome;
      }
      $d->invest = implode(',', $inv);
      $d->sts     = $this->checkStatus($d->status) .$this->checkAgrupamento($d->agrupada);
        $d->acoes   = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.cotas.cota", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar Cota"><i class="fa fa-pencil-square-o"></i></button>
                      <button class="btn btn-warning btn-infos btn-sm" data-url="'.route("backend.cota.infos", $d->id).'" data-toggle="tooltip" title="Informações Adicionais"><i class="fa fa-info-circle"></i></button>              
                      <button class="btn btn-success btn-vender btn-sm" data-url="'.route("backend.cota.vender", $d->id).'" data-toggle="tooltip" title="Vender Cota"><i class="fa fa-usd"></i></button>              
                      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.cota.apagar", $d->id).'" data-toggle="tooltip" title="Apagar Cota"><i class="fa fa-trash"></i></button> ';
        if( !$destaque || $destaque->id != $d->id ){
          $d->acoes .= '<button class="btn btn-info btn-destaque btn-sm" data-url="'.route("backend.cotas.destaque", $d->id).'" data-toggle="tooltip" title="Fazer Destaque"><i class="fa fa-star"></i></button>';
        }
    }
    return response()->json($data);
  }

  public function GetCotasAgrupadas(Request $request){
    $destaque = Cota::where('tipo', $request->tipo)->where('destaque', 1)->first();
    $data['data'] = Cota::where('tipo', $request->tipo)->where('agrupada',1)->where('status','<>', '3')->get();
    foreach( $data['data'] as $d ){
      $devedor = $this->calculaDevedor($d);
      $d->credito = currencyToApp($d->credito);
      if( (float)$d->entrada_opicional > 0 ){
        $d->entrada = currencyToApp($d->entrada_opicional);  
      }else{
        $d->entrada = currencyToApp($d->entrada);
      }
      $d->devedor = currencyToApp($devedor);
      $d->par     = $this->getParcelas($d->parcelas);
      $d->admin   = $d->administradora->nome;
      unset($inv);
      $inv = array();
      if( $d->investidores->count() > 0 ){
        foreach( $d->investidores as $i ){
          $inv[] = $i->nome;
        }
      }else{
        $inv[] = '-- Agrupada';
      }
      $d->invest = implode(',', $inv);
      $d->sts     = $this->checkStatus($d->status);
      $d->acoes   = '<a class="btn btn-primary btn-sm" href="'.route("backend.cotas.cota.agrupada", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar Cota"><i class="fa fa-pencil-square-o"></i></a>
                    <button class="btn btn-warning btn-infos btn-sm" data-url="'.route("backend.cota.infos", $d->id).'" data-toggle="tooltip" title="Informações Adicionais"><i class="fa fa-info-circle"></i></button>              
                    <button class="btn btn-success btn-vender btn-sm" data-url="'.route("backend.cota.vender", $d->id).'" data-toggle="tooltip" title="Vender Cota"><i class="fa fa-usd"></i></button>              
                    <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.cota.agrupada.apagar", $d->id).'" data-toggle="tooltip" title="Apagar Cota"><i class="fa fa-trash"></i></button>'; 
      if( !$destaque || $destaque->id != $d->id ){
        $d->acoes .= '<button class="btn btn-info btn-destaque btn-sm" data-url="'.route("backend.cotas.destaque", $d->id).'" data-toggle="tooltip" title="Fazer Destaque"><i class="fa fa-star"></i></button>';
      }
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {  
      return $this->geraErros($validator);
    } else {
      $req  = $this->formatRequest($request->all());
      $cota = Cota::create($req);
      $cota->investidores()->attach($request->investidores); 
      $this->insereParcela($cota, $request);
      echo 'OK';
    }
  }

  public function AdicionarAgrupamento(Request $request){
    $validator = Validator::make($request->all(), $this->regrasAgrupamento());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      $cota = Cota::find($request->cota_pai_id);
      $cotas = Cota::whereIn('id', $request->cota_id)->get();
      $this->criaAgrupamento($cota, $cotas);
      $this->recalculaAgrupamento($cota);
    }
  }

  public function Editar(Cota $cota){
    $cota->credito = currencyToAppOnlyNumbers($cota->credito);
    $cota->entrada = currencyToAppOnlyNumbers($cota->entrada);
    foreach($cota->parcelas as $parcela){
      $parcela->valor_parcela = currencyToAppOnlyNumbers($parcela->valor_parcela);
    }
    $cota->valor_investidor = currencyToAppOnlyNumbers($cota->valor_investidor);
    $cota->juros = currencyToAppOnlyNumbers($cota->juros);
    if( $cota->agrupada == 1 ){
      session(['cotaAgrupada' => true]);
    }else{
      session(['cotaAgrupada' => false]);
    }
    $invs = array();
    foreach( $cota->investidores as $i ){
      $invs[] = $i->id;
    }
    $cota->inves = $invs;
    return response()->json($cota);
  }

  public function EditarAgrupada(Cota $cota){
    $nomeTipo = $this->getTipoCota(\Route::current()->getName());
    $administradoras = Administradora::all()->pluck('nome', 'id')->toArray();
    $investidores = Investidor::all()->pluck('nome', 'id')->toArray();
    $disponiveis = Cota::where('tipo', $cota->tipo)->where('agrupada', '=', '0')->where('status', '1')->get();
    $cotas = new Collection();
    foreach( $cota->cotas as $c ){
      $c = Cota::find($c->cota_id);
      $cotas[] = $c;
    }
    $invs = array();
    foreach( $cota->investidores as $i ){
      $invs[] = $i->id;
    }
    $cota->investidores = $invs;
    return view('backend.cotas.agrupada')
      ->with('cota', $cota)
      ->with('administradoras', $administradoras)
      ->with('investidores', $investidores)
      ->with('tipo', $this->tipo)
      ->with('cotas', $cotas)
      ->with('disponiveis', $disponiveis)
      ->with('nomeTipo', $nomeTipo);
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $cota = Cota::find($request->id);
        if(!$request->agrupada){
          $req  = $this->formatRequest($request->all());
          $cota->update($req);
          $cota->investidores()->sync($request->investidores); 
          $this->alteraParcelas($cota, $request);
          if( $cota->agrupada == 2 ){
            $cotas_pais = Cota::whereIn('id',ItemAgrupado::where('cota_id', $cota->id)->get(['cota_pai_id']))->get();
            foreach( $cotas_pais as $pai ){
              $this->recalculaAgrupamento($pai,'N');
            }
            echo 'OK';
          }else{
            echo 'OK';
          }
        }else{
          $req  = $this->formatRequest($request->all());
          $cota->update($req);
          echo 'OK';
        }
      }
    }
  }

  public function Apagar(Cota $cota){
    if( $cota->agrupada == 2 ){
      $cotas_pais = Cota::whereIn('id',ItemAgrupado::where('cota_id', $cota->id)->get(['cota_pai_id']))->get();
      $cota->delete();
      foreach( $cotas_pais as $pai ){
        $this->recalculaAgrupamento($pai);
      }
    }else{
      $cota->delete();
      echo 'OK';
    }
  }

  public function ApagarLote(Request $request){
    foreach( $request->c as $c ){
      $cota = Cota::find($c);
      if( $cota->agrupada == 2 ){
        $cotas_pais = Cota::whereIn('id',ItemAgrupado::where('cota_id', $cota->id)->get(['cota_pai_id']))->get();
        $cota->delete();
        foreach( $cotas_pais as $pai ){
          $this->recalculaAgrupamento($pai);
        }
      }else{
        $cota = Cota::find($c)->delete();
        echo 'OK';
      }
    }
  }

  public function Agrupar(Request $request){
    $cotas = Cota::whereIn('id', $request->c)->get();
    $credito = $this->somaCredito($cotas);
    $entrada = $this->somaEntrada($cotas);
    $valor_investidor = $this->somaInvestidor($cotas);
    $juros = $this->somaJuros($cotas);
    $parcelas = $this->geraParcelas($cotas);
    $investidor = $cotas[0]->investidor;
    $administradora = $cotas[0]->administradora;
    $tipo = $cotas[0]->tipo;
    $agrupada = new Cota();
    $agrupada->tipo = $tipo;
    $agrupada->administradora_id = $administradora->id;
    $agrupada->credito = $credito;
    $agrupada->entrada = $entrada;
    $agrupada->juros = $juros;
    $agrupada->status = '1';
    $agrupada->investidor_id = 0;
    $agrupada->valor_investidor = $valor_investidor;
    $agrupada->agrupada = 1;
    $agrupada->save();
    $this->insereParcelasAgrupada($agrupada, $parcelas);
    $this->criaAgrupamento($agrupada, $cotas);
    echo 'OK';
  }

  public function ApagarAgrupada(Cota $cota){
    foreach( $cota->cotas as $c ){
      $cf = Cota::find($c->cota_id);
      $cf->status = '1';
      $cf->agrupada = 0;
      $cf->save();
    }
    $cota->delete();
    echo 'OK';
  }

  public function removeAgrupada(request $request){
    $cotaAgrupada = ItemAgrupado::where('cota_pai_id', $request->c)->where('cota_id', $request->i)->first();
    $cotaAgrupada->delete();
    $cota = Cota::find($request->i);
    $cota->status = '1';
    $cota->agrupada = 0;
    $cota->update();
    $cotaPai = Cota::find($request->c);
    $this->recalculaAgrupamento($cotaPai);
  }


  public function ImprimirImoveis(){
    $cotas = Cota::where('tipo', '1')->whereIn('status', ['1','2'])->orderBy('credito','desc')->get();
    return view('backend.cotas.imprimir')
      ->with('cotas', $cotas)
      ->with('titulo', ' - Imóveis');
  }

  public function ImprimirAutomoveis(){
    $cotas = Cota::where('tipo', '2')->whereIn('status', ['1','2'])->orderBy('credito','desc')->get();
    return view('backend.cotas.imprimir')
      ->with('cotas', $cotas)
      ->with('titulo', ' - Automóveis');
  }

  public function Vender(Cota $cota){
    $data['cota_id'] = $cota->id;
    $data['cota_numero'] = '#'.$cota->id;
    return response()->json($data, 200);
  }

  public function Infos(Cota $cota){
    $data['cota_id'] = $cota->id;
    $data['cota_numero'] = '#'.$cota->id;
    $data['infos'] = $cota->infos;
    return response()->json($data, 200);
  }

  public function SalvarInfos(Request $request){
    $cota = Cota::find($request->cota_id);
    $cota->infos = $request->infos;
    $cota->update();
    echo 'OK';
  }

  public function Destaque(Cota $cota){
    Cota::where('tipo', $cota->tipo)->update(['destaque' => 0]);
    $cota->destaque = 1;
    $cota->update();
    echo 'OK';
  }

  public function CotaGrupo(Cota $cota){
    return response()->json($cota);
  }

  public function SalvaCotaGrupo(request $request){
    $cota = Cota::find($request->id);
    $cota->grupo = $request->grupo;
    $cota->cota = $request->cota;
    $cota->update();
    echo 'OK';
  }

  /** PROTECTEDS */

  protected function regras(){
    return $rules = array(
      'administradora_id' => 'required_without:agrupada|int|exists:administradoras,id',
      'investidores.0' => 'int|exists:investidores,id',
      'credito' => 'required_without:agrupada|regex:/^[\d.,]+$/',
      'entrada' => 'required_without:agrupada|regex:/^[\d.,]+$/',
      'entrada_opicional' => 'sometimes|regex:/^[\d.,]+$/',
      'parcelas.0' => 'required_without:agrupada|integer|min:1',
      'valor_parcela.0' => 'required_without:agrupada|regex:/^[\d.,]+$/',
      'juros' => 'required_without:agrupada|regex:/^[\d,]+$/',
      'status' => 'required|integer|max:2',
    );
  }

  protected function regrasAgrupamento(){
    return $rules = array(
      'cota_pai_id' => 'required|int|exists:cotas,id',
      'cota_id.0' => 'required|int|exists:cotas,id',
      'tipo' => 'required|integer|min:1|max:2',
    );
  }

  protected function getTipoCota($rota){
    $tipo = @end(explode('.', $rota));
    $this->tipo = $tipo == 'imoveis' ? 1 : 2;
    $nome = $tipo == 'imoveis' ? 'Imóveis' : 'Automóveis';
    return $nome;
  }

  protected function checkStatus($status){
    switch ($status){
      case '0':
        return '<label class="label label-danger">INDISPONÍVEL</label>';
        break;
      case '1':
        return '<label class="label label-success">DISPONÍVEL</label>';
        break;
      case '2': 
        return '<label class="label label-default">RESERVADA</label>';
        break;
      case '3': 
        return '<label class="label label-info">VENDIDA</label>';
        break;
    }
  }

  protected function checkAgrupamento($agrupamento){
    switch ($agrupamento){
      case '0':
        return '';
        break;
      case '1':
        return '';
        break;
      case '2': 
        return ' / <label class="label label-warning">AGRUPADA</label>';
        break;
    }
  }

  protected function getParcelas(Collection $parcelas){
    $valores = '';
    foreach($parcelas as $p){
      $valores .= $p->parcelas. ' - ' .currencyToApp($p->valor_parcela) .'<br>';
    }
    return $valores;
  }

  protected function insereParcela(Cota $cota, request $request){
    $x = 0;
    foreach($request->parcelas as $p ){
      if( !empty($p) && $p > 0 ){
        $parcela  = new ParcelasCota();
        $array = [
          'cota_id' => $cota->id,
          'parcelas' => $p,
          'valor_parcela' => currencyToBd($request->valor_parcela[$x])
        ];
        ParcelasCota::create($array);
        $x++;
      }
    }
  }

  protected function limpaParcelasAgrupadas(Cota $cota){
    foreach( $cota->parcelas as $p ){
      $p->delete();
    }
  }

  protected function insereParcelasAgrupada(Cota $cota, array $parcelas){
    $x = 0;
    foreach( $parcelas as $p ){
      $parcela  = new ParcelasCota();
      $array = [
        'cota_id' => $cota->id,
        'parcelas' => array_keys($p)[0],
        'valor_parcela' => currencyToBd(array_values($p)[0])
      ];
      ParcelasCota::create($array);
      $x++;
    }
  }

  protected function alteraParcelas(Cota $cota, request $request){
    $x = 0;
    foreach($request->idparcela as $p ){
      if( !empty($p) && $p > 0 ){
        $parcela  = ParcelasCota::find($p);
        if( $parcela ){
          if( $request->parcelas[$x] > 0 ){
            $array = [
              'parcelas' => $request->parcelas[$x],
              'valor_parcela' => currencyToBd($request->valor_parcela[$x])
            ];
            $parcela->update($array);
          }else{
            $parcela->delete();
          }
        }
      }else{
        if( $request->parcelas[$x] > 0 ){
          $array = [
            'cota_id' => $cota->id,
            'parcelas' => $request->parcelas[$x],
            'valor_parcela' => currencyToBd($request->valor_parcela[$x])
          ];
          ParcelasCota::create($array);
        }
      }
      $x++;
    }
  }

  protected function formatRequest(Array $request){
    if( isset( $request['credito'] ) ){
      $request['credito'] = currencyToBd($request['credito']);
    }
    if( isset( $request['entrada'] ) ){
      $request['entrada'] = currencyToBd($request['entrada']);
    }
    if( isset( $request['valor_parcela'] ) ){
      foreach($request['valor_parcela'] as $v){
        $vParcelas[] = currencyToBd($v);
      }
      $request['valor_parcela'] = $vParcelas;
    }
    if( isset( $request['valor_investidor'] ) ){
      $request['valor_investidor'] = currencyToBd($request['valor_investidor']);
    }
    if( isset( $request['juros'] ) ){
      $request['juros'] = currencyToBd($request['juros']);
    }
    if( isset( $request['entrada_opicional'] ) ){
      $request['entrada_opicional'] = currencyToBd($request['entrada_opicional']);
    }
    return $request;
  }

  protected function recalculaAgrupamento(Cota $cota, $imprime = 'S'){
    foreach( $cota->cotas as $ca ){
      $ag[] = $ca->cota_id;
    }
    $cotas = Cota::whereIn('id', $ag)->get();
    $credito = $this->somaCredito($cotas);
    $entrada = $this->somaEntrada($cotas);
    $valor_investidor = $this->somaInvestidor($cotas);
    $juros = $this->somaJuros($cotas);
    $parcelas = $this->geraParcelas($cotas);
    $investidor = $cotas[0]->investidor;
    $administradora = $cotas[0]->administradora;
    $tipo = $cotas[0]->tipo;
    $agrupada = $cota;
    $agrupada->credito = $credito;
    $agrupada->valor_investidor = $valor_investidor;
    $agrupada->entrada = $entrada;
    $agrupada->juros = $juros;
    $agrupada->save();
    $this->limpaParcelasAgrupadas($agrupada);
    $this->insereParcelasAgrupada($agrupada, $parcelas);
    if( $imprime == 'S'){
      echo 'OK';
    }
  }

  protected function somaCredito(Collection $cotas){
    $credito = 0;
    foreach( $cotas as $c ){
      $credito += $c->credito;
    }
    return $credito;
  }
  
  protected function somaEntrada(Collection $cotas){
    $entrada = 0;
    foreach( $cotas as $c ){
      $entrada += $c->entrada;
    }
    return $entrada;
  }

  protected function somaInvestidor(Collection $cotas){
    $investidor = 0;
    foreach( $cotas as $c ){
      $investidor += $c->valor_investidor;
    }
    return $investidor;
  }

  protected function somaJuros(Collection $cotas){
    $juros = 0;
    $x = 0;
    foreach( $cotas as $c ){
      $juros += $c->juros;
      $x++;
    }
    return ( $juros / $x );
  }

  protected function geraParcelas(Collection $cotas){
    
    $pc = array();
    foreach( $cotas as $c ){
      $p = array();
      $p1 = $c->parcelas[0]->parcelas;
      for( $y = 0; $y < (int)$p1; $y++){
        array_push($p,(string)$c->parcelas[0]->valor_parcela);
      }
      if( isset($c->parcelas[1]->parcelas) ){
        $p2 = $c->parcelas[1]->parcelas;
        for( $y = 0; $y < (int)$p2; $y++){
          array_push($p,(string)$c->parcelas[1]->valor_parcela);
        }
      }
      if( isset($c->parcelas[2]->parcelas) ){
        $p3 = $c->parcelas[2]->parcelas;
        for( $y = 0; $y < (int)$p3; $y++){
          array_push($p,(string)$c->parcelas[2]->valor_parcela);
        }
      }
      if( isset($c->parcelas[3]->parcelas) ){
        $p4 = $c->parcelas[3]->parcelas;
        for( $y = 0; $y < (int)$p4; $y++){
          array_push($p,(string)$c->parcelas[3]->valor_parcela);
        }
      }
      if( isset($c->parcelas[4]->parcelas) ){
        $p5 = $c->parcelas[4]->parcelas;
        for( $y = 0; $y < (int)$p5; $y++){
          array_push($p,(string)$c->parcelas[4]->valor_parcela);
        }
      }
      array_push($pc,$p);  
    }
    $parcelas = $this->calculaParcelas($pc);
    return $parcelas;
  }

  protected function calculaParcelas(array $parcelas){
    $sumArray = array();
    foreach( $parcelas as $sub ){
      $x = 0;
      foreach( $sub as $v ){
        if( isset($sumArray[$x])){
          $sumArray[$x] += limpaNumeros($v);
        }else{
          $sumArray[$x] = limpaNumeros($v);
        }
        $x++;
      }
    }
    
    $nsum = array_count_values($sumArray);
    $parcelas = array();
    foreach( $nsum as $k => $v ){
      $parcelas[][$v] = $k;
    }
    return $parcelas;
  }

  protected function criaAgrupamento(Cota $cota, Collection $cotas){
    foreach( $cotas as $c ){
      $c->agrupada = 2;
      $c->save();
      ItemAgrupado::create(['cota_pai_id' => $cota->id, 'cota_id' => $c->id]);
    }
  }

  protected function calculaDevedor($cota){
    $total = 0;
    foreach( $cota->parcelas as $p ){
      $total +=  ($p->parcelas * $p->valor_parcela);
    }
    return $total;
  }

}