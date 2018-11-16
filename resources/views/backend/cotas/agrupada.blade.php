@extends('backend.layouts.default')
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Cota Agrupada de {{$nomeTipo}}</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Painel Inicial</a>
    </li>
    <li class="active">Edição de Cota Agrupada de {{$nomeTipo}}</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Confira abaixo os dados da Cota Agrupada</h3>
    </div>
    <div class="box-body">
      <form action="#" role="form" class="form-editar-agrupada" data-url="{{route('backend.cotas.salvar')}}">
        <input type="hidden" id="id" name="id" value="{{$cota->id}}">
        <input type="hidden" name="agrupada" value="1">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Administradora</label>
                {!! Form::select('administradora_id', [null => 'Selecione uma opção'] + $administradoras,
                $cota->administradora->id, ['class' => 'form-control
                select2 administradoras', 'id' => 'administradora_id', 'disabled' => 'disabled', 'required' => true])
                !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Investidor(es)</label>
                <input type="text" class="form-control investidores" disabled value="-- Agrupada" name="invest" id="investidores">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Crédito</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor credito" disabled name="credito" value="{{currencyToAppOnlyNumbers($cota->credito)}}"
                    name="credito" id="credito" placeholder="0,00" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Valor do Investidor</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor valor_investidor" disabled value="{{currencyToApp($cota->valor_investidor)}}"
                    name="valor_investidor" id="valor_investidor" placeholder="0,00" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Entrada</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor entrada" disabled name="entrada" value="{{currencyToApp($cota->entrada)}}"
                    id="entrada" placeholder="0,00" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Entrada Opcional</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor opicional" name="entrada_opicional" value="{{currencyToApp($cota->entrada_opicional)}}"
                    id="entrada_opicional" placeholder="0,00">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nome">Juros </label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">%</span>
                  <input type="text" class="form-control valor" value="{{$cota->juros}}" disabled value="{{$cota->juros}}"
                    id="juros" name="juros">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="row">
                  <label for="nome"> Status </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <input type="radio" id="status_1" name="status" value="1" required />
                  <label for="status_1" class="label label-success">DISPONÍVEL</label>
                  <input type="radio" id="status_2" name="status" value="2" />
                  <label for="status_2" class="label label-default">RESERVADO</label>
                  <input type="radio" id="status_0" name="status" value="0" />
                  <label for="status_0" class="label label-danger">INDISPONÍVEL</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <hr>
            </div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Parcelas</h3>
                </div>
                <div class="box-body">
                  <table class="parcelas-table table table-responsive table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $cota->parcelas as $p )
                      <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->parcelas }}</td>
                        <td>{{ currencyToApp($p->valor_parcela) }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <div class="box-footer">
          <div class="col-md-6">
              <a type="button" href="#" onclick="javscript:history.back(1);" class="btn btn-danger">
                  <i class="fa fa-arrow-left"></i> Voltar</a>
          </div>
          <div class="col-md-6 horizontal-right">
              <button type="submit" class="btn btn-success">
                  <i class="fa fa-check"></i> Salvar</button>
          </div>
        </div>
      </form>
    </div>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Cotas Agrupadas</h3>
          <button class="btn btn-primary pull-right btn-novo" data-titulo="nova categoria">
            <i class="fa fa-plus"></i> Adicionar Cota ao Agrupamento </button>
        </div>
        <div class="box-body table-responsive">
          <table class="cotas-table table table-responsive table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Administradora</th>
                <th>Investidor(es)</th>
                <th>Crédito</th>
                <th>Entrada</th>
                <th>Parcelas</th>
                <th>Juros(%)</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $cotas as $c )
              <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->administradora->nome }}</td>
                <td>
                  @php
                  $invs = array();
                  foreach( $c->investidores as $i ){
                  $invs[] = $i->nome;
                  }
                  @endphp
                  {{implode(', ',$invs)}}( {{currencyToApp($c->valor_investidor)}}) </td>
                </td>
                <td>{{ currencyToApp($c->credito) }}</td>
                <td>{{ currencyToApp($c->entrada) }}</td>
                <td>
                  @foreach( $c->parcelas as $p )
                  {{ $p->parcelas }} - {{ currencyToApp($p->valor_parcela) }} <br>
                  @endforeach
                </td>
                <td>{{ $c->juros }}</td>
                <td>
                  <button class="btn btn-danger btn-remove-cota btn-sm" data-id="{{$c->id}}" data-cota="{{$cota->id}}"
                    data-url="{{route('backend.cota.agrupada.remover')}}" data-toggle="tooltip" title="Remover Cota do Agrupamento"><i
                      class="fa fa-trash"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Administradora</th>
                <th>Investidor</th>
                <th>Crédito</th>
                <th>Entrada</th>
                <th>Parcelas</th>
                <th>Juros(%)</th>
                <th>Ações</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
  </section>

<div class="modal fade modal-novo" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">
            <b>Seleção de Cotas de {{$nomeTipo}} para o Agrupamento</b>
          </h4>
        </div>
        <form action="#" role="form" class="form-cadastro-agrupar" data-url="{{route('backend.cotas.agrupamento.adicionar')}}">
          <input type="hidden" name="tipo" value="{{$cota->tipo}}">
          <input type="hidden" name="cota_pai_id" value="{{$cota->id}}">
          <div class="modal-body">
            <div class="box-body">
              <table class="normal  table table-responsive table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Administradora</th>
                    <th>Investidor</th>
                    <th>Crédito</th>
                    <th>Entrada</th>
                    <th>Parcelas</th>
                    <th>Juros(%)</th>
                    <th>Adicionar?</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $disponiveis as $cd )
                  <tr>
                    <td>{{ $cd->id }}</td>
                    <td>{{ $cd->administradora->nome }}</td>
                    <td>
                      @php
                      $invs = array();
                      foreach( $cd->investidores as $i ){
                      $invs[] = $i->id;
                      }
                      @endphp
                      {{implode(', ',$invs)}}( {{currencyToApp($cd->valor_investidor)}}) </td>
                    <td>{{ currencyToApp($cd->credito) }}</td>
                    <td>{{ currencyToApp($cd->entrada) }}</td>
                    <td>
                      @foreach( $cd->parcelas as $p )
                      {{ $p->parcelas }} - {{ currencyToApp($p->valor_parcela) }} <br>
                      @endforeach
                    </td>
                    <td>{{ $cd->juros }}</td>
                    <td>
                      <input type="checkbox" value='{{$cd->id}}' name='cota_id[]' class="">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Administradora</th>
                    <th>Investidor</th>
                    <th>Crédito</th>
                    <th>Entrada</th>
                    <th>Parcelas</th>
                    <th>Juros(%)</th>
                    <th>Adicionar?</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fa fa-times"></i> Fechar</button>
            <button type="submit" class="btn btn-success">
              <i class="fa fa-check"></i> Salvar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{{assets('js/backend/agrupadas.js')}}" type="text/javascript"></script>
<script>
  $(document).ready(function () {
    $(document).ajaxComplete(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
    $('#status_' + {{$cota->status}}).iCheck('check');
    tabelaCotas();
  })

  function tabelaCotas() {
    tabela = $('.cotas-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
        select: {
          rows: {
            _: "%d linhas selecionadas",
            0: "Clique no campo '#' para selecioar uma linha",
            1: "Somente 1 linha selecionada"
          }
        }
      },
      'paging': true,
      "pageLength": 100,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      dom: 'lfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf',
      ],
    });
  }
</script>
@endsection