@extends('backend.layouts.default')
@section('content')
<section class="cotas">

  <section class="content-header">
    <h1>
      Administrativo
      <small>Listagem de Cotas de {{$nomeTipo}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
      <li class="active">Listagem de Cotas de {{$nomeTipo}}</li>
    </ol>
  </section>
  <section class="content">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class=""><a href="#individuais" aria-controls="individuais" role="tab" data-toggle="tab">Individuais</a></li>
          <li role="presentation"><a href="#agrupadas" aria-controls="agrupadas" role="tab" data-toggle="tab">Agrupadas</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade" id="individuais">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Confira abaixo todos as <b>Cotas de {{$nomeTipo}} INDIVIDUAIS</b> cadastradas!</h3>
                <button class="btn btn-success pull-right btn-novo" data-titulo="nova categoria"><i class="fa fa-plus"></i> Nova Cota</button>
              </div>
              <div class="box-body table-responsive relative">
                <div class="box box-primary box-solid calculos">
                  <div class="box-header with-border">
                    <h3 class="box-title">Prévia do Agrupamento</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body"></div>
                </div>
                <table class="individuais-table table table-responsive table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Administradora</th>
                      <th>Investidor(es)</th>
                      <th>Crédito</th>
                      <th>Entrada</th>
                      <th>Parcelas</th>
                      <th>Saldo Devedor</th>
                      <th>Juros(%)</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Administradora</th>
                      <th>Investidor(es)</th>
                      <th>Crédito</th>
                      <th>Entrada</th>
                      <th>Parcelas</th>
                      <th>Saldo Devedor</th>
                      <th>Juros(%)</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="agrupadas">
              <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Confira abaixo todos as <b>Cotas de {{$nomeTipo}} AGRUPADAS</b> cadastradas!</h3>
                  </div>
                  <div class="box-body table-responsive">
                    <table class="agrupadas-table table table-responsive table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Administradora</th>
                          <th>Investidor</th>
                          <th>Crédito</th>
                          <th>Entrada</th>
                          <th>Parcelas</th>
                          <th>Saldo Devedor</th>
                          <th>Status</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Administradora</th>
                          <th>Investidor</th>
                          <th>Crédito</th>
                          <th>Entrada</th>
                          <th>Parcelas</th>
                          <th>Saldo Devedor</th>
                          <th>Status</th>
                          <th>Ações</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
          </div>
        </div>
      </div>
  </section>

  <div class="modal fade modal-novo" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="box box-info">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Cadastro de nova Cota de {{$nomeTipo}}</b></h4>
          </div>
          <form action="#" role="form" class="form-cadastro" data-url="{{route('backend.cotas.adicionar')}}">
            <input type="hidden" name="tipo" value="{{$tipo}}">
            <div class="modal-body">
              <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <div class="row">
                        <label for="nome"> Status </label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <input type="radio" id="status_n_1" name="status" checked value="1" required />
                        <label for="status_n_1" class="label label-success">DISPONÍVEL</label>
                        <input type="radio" id="status_n_2" name="status" value="2" />
                        <label for="status_n_2" class="label label-default">RESERVADO</label>
                        <input type="radio" id="status_n_0" name="status" value="0" />
                        <label for="status_n_0" class="label label-danger">INDISPONÍVEL</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nome">Investidor(es)</label>
                      {!! Form::select('investidores[]', $investidores, '', ['class' => 'form-control select2 investidores', 'required' => false, 'multiple' => '']) !!}
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Administradora</label>
                    {!! Form::select('administradora_id', [null => 'Selecione uma opção'] + $administradoras, null, ['class' => 'form-control select2 administradoras', 'required' => true]) !!}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Crédito</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor credito" name="credito" placeholder="0,00" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Valor do Investidor</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor valor_investidor" name="valor_investidor" placeholder="0,00">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Entrada</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor entrada" name="entrada" placeholder="0,00" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Juros </label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">%</span>
                      <input type="text" class="form-control valor" value="0,00" name="juros">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (1)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" name="parcelas[]" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (1)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" name="valor_parcela[]" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (2)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" name="parcelas[]">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (2)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (3)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" name="parcelas[]">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (3)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (4)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" name="parcelas[]">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (4)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (5)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" name="parcelas[]">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (5)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Grupo</label>
                        <input type="text" class="form-control grupo" id="grupo" name="grupo">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Cota</label>
                        <input type="text" class="form-control cota" id="cota" name="cota">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <div class="modal fade modal-editar" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="box box-info">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Edição de Cota de {{$nomeTipo}}</b></h4>
          </div>
          <form action="#" role="form" class="form-editar" data-url="{{route('backend.cotas.salvar')}}">
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
              <div class="box-body">
                <div class="col-md-12">
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
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nome">Investidor(es)</label>
                      {!! Form::select('investidores[]', [null => 'Selecione uma opção'] + $investidores, null, ['class' => 'form-control select2 investidores', 'id' => 'inves', 'multiple' => 'multiple', 'required' => false]) !!}
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Administradora</label>
                    {!! Form::select('administradora_id', [null => 'Selecione uma opção'] + $administradoras, null, ['class' => 'form-control select2 administradoras', 'id' => 'administradora_id', 'required' => true]) !!}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Crédito</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor credito" name="credito" id="credito" placeholder="0,00" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Valor do Investidor</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor valor_investidor" name="valor_investidor" id="valor_investidor" placeholder="0,00">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Entrada</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control valor entrada" name="entrada" id="entrada" placeholder="0,00" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Juros </label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">%</span>
                      <input type="text" class="form-control valor" value="0,00" id="juros" name="juros">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (1)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" id="parcela_1" name="parcelas[]" required>
                        <input type="hidden" name="idparcela[]" id="idparcela_1" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (1)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" id="valor_parcela_1" name="valor_parcela[]" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (2)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" id="parcela_2" name="parcelas[]">
                        <input type="hidden" name="idparcela[]" id="idparcela_2" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (2)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" id="valor_parcela_2" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (3)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" id="parcela_3" name="parcelas[]">
                        <input type="hidden" name="idparcela[]" id="idparcela_3" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (3)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" id="valor_parcela_3" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (4)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" id="parcela_4" name="parcelas[]">
                        <input type="hidden" name="idparcela[]" id="idparcela_4" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (4)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" id="valor_parcela_4" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Número de Parcelas (5)</label>
                        <input type="number" class="form-control parcelas" min="1" step="1" id="parcela_5" name="parcelas[]">
                        <input type="hidden" name="idparcela[]" id="idparcela_5" value="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Valor das Parcelas (5)</label>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">R$</span>
                          <input type="text" class="form-control valor valor_parcela" id="valor_parcela_5" name="valor_parcela[]">
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Grupo</label>
                        <input type="text" class="form-control grupo" id="grupo" name="grupo">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nome">Cota</label>
                        <input type="text" class="form-control cota" id="cota" name="cota">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade modal-vender" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="box box-info">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Vender Cota <span id="cota_numero"></span></b></h4>
          </div>
          <form action="#" role="form" class="form-vender" data-url="{{route('backend.cota.venda')}}">
            <input type="hidden" id="cota_id" name="cota_id">
            <div class="modal-body">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Cliente</label>
                    {!! Form::select('cliente_id', [null => 'Selecione uma opção'] + $clientes, null, ['class' => 'form-control select2 clientes', 'id' => 'cliente_id', 'required' => true]) !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Vender </button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade modal-infos" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
      <div class="box box-info">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Informações Adicionais da cota <span id="cota_numero"></span></b></h4>
          </div>
          <form action="#" role="form" class="form-infos" data-url="{{route('backend.cota.infos.salvar')}}">
            <input type="hidden" id="cota_id" name="cota_id">
            <div class="modal-body">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Informações</label>
                    <textarea name="infos" id="infos" cols="30" rows="10" class="editor-opicional form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar </button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</section>  
<script>
  $(document).ready(function(){
    $('a[href="#individuais"]').tab('show');
    $( document ).ajaxComplete(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    $('.modal-novo').on('show.bs.modal', function () {
      $('#status_n_1').iCheck('check');
    });
  });

  function excluiLote(){
    $can = true;
    $rows = tabela.rows( { selected: true } ).count();
    $data = tabela.rows( { selected: true } ).data().toArray();
    $data.forEach(element => {
      if(element.status == 0){
        $can = false;
      }
    });
    if( $can == false ){
      swal({
        title: 'Ops...',
        text: 'Você não pode deletar uma cota ainda agrupada! Por favor, remova a cota do agrupamento antes de esxcluí-la.',
        type: 'error',
      });
      return false;
    }
    if( $rows > 0 ){
      swal({
        title: 'Opa!',
        text: 'Confirma a exclusão dos itens selecionados?',
        type: 'question',
        confirmButtonText: "Sim",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if( result.value ){
          deletaLote();
        }
      });
    }else{
      swal({
        title: 'Ops...',
        text: 'Selecione ao menos uma cota para ser excluída!',
        type: 'error',
      });
    }
  }

  function excluiLoteA(){
    $can = true;
    $rows = tabelaA.rows( { selected: true } ).count();
    $data = tabelaA.rows( { selected: true } ).data().toArray();
    $data.forEach(element => {
      if(element.status == 0){
        $can = false;
      }
    });
    if( $can == false ){
      swal({
        title: 'Ops...',
        text: 'Você não pode deletar uma cota ainda agrupada! Por favor, remova a cota do agrupamento antes de esxcluí-la.',
        type: 'error',
      });
      return false;
    }
    if( $rows > 0 ){
      swal({
        title: 'Opa!',
        text: 'Confirma a exclusão dos itens selecionados?',
        type: 'question',
        confirmButtonText: "Sim",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if( result.value ){
          deletaLote('a');
        }
      });
    }else{
      swal({
        title: 'Ops...',
        text: 'Selecione ao menos uma cota para ser excluída!',
        type: 'error',
      });
    }
  }

  function deletaLote($t = null){
    $rows = tabela.rows( { selected: true } ).data().toArray();
    if( $t == 'a'){
      $rows = tabelaA.rows( { selected: true } ).data().toArray();
    }
    $cotas = new Array();
    $rows.forEach(element => {
      $cotas.push(element.id);
    });
    $.ajax({
      url: '{{route('backend.cotas.apagalote')}}',
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      async: true,
      method: 'DELETE',
      data: {cid: Math.random, c: $cotas},
      success: function (data) {
        tabela.ajax.reload();
        if( $t == 'a'){
          tabelaA.ajax.reload();
        }
        toastr.clear();
        if (data == 'OK') {
          toastr.success(
            'Itens apagados com sucesso!',
            'Tudo certo!', {
              timeOut: 2000,
              showEasing: 'linear',
              showMethod: 'slideDown',
              closeMethod: 'fadeOut',
              closeDuration: 300,
              closeEasing: 'swing',
              closeButton: false,
              progressBar: true,
            }
          );
        }
      },
      beforeSend: function () {
        toastr.info(
          'Estamos processando seu pedido...',
          'Aguarde!', {
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 30,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
          }
        );
      },
      complete: function () {}
    });
  }

  function agrupaCotas(){
    $can = true;
    $rows = tabela.rows( { selected: true } ).count();
    $data = tabela.rows( { selected: true } ).data().toArray();
    $data.forEach(element => {
      if(element.agrupada == 2){
        $can = false;
      }
    });
    if( $can == false ){
      /*swal({
        title: 'Ops...',
        text: 'Você não pode agrupar uma cota já agrupada! Por favor, remova esta cota do agrupamento atual para reagrupá-la.',
        type: 'error',
      });
      return false;*/
    }
    if( $rows > 1 ){
      swal({
        title: 'Opa!',
        text: 'Confirma o agrupamento das cotas selecionadas?',
        type: 'question',
        confirmButtonText: "Sim",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((result) => {
        if( result.value ){
          fazAgrupamento();
        }
      });
    }else{
      swal({
        title: 'Ops...',
        text: 'Selecione ao menos duas cotas para serem agrupadas!',
        type: 'error',
      });
    }
  }

  function fazAgrupamento(){
    $rows = tabela.rows( { selected: true, search: 'applied' } ).data().toArray();
    $cotas = new Array();
    $rows.forEach(element => {
      $cotas.push(element.id);
    });
    $.ajax({
      url: '{{route('backend.cotas.agrupar')}}',
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      async: true,
      method: 'POST',
      data: {cid: Math.random, c: $cotas},
      success: function (data) {
        $('.calculos').hide();
        tabela.ajax.reload();
        toastr.clear();
        if (data == 'OK') {
          toastr.success(
            'Cotas agrupadas com sucesso!',
            'Tudo certo!', {
              timeOut: 2000,
              showEasing: 'linear',
              showMethod: 'slideDown',
              closeMethod: 'fadeOut',
              closeDuration: 300,
              closeEasing: 'swing',
              closeButton: false,
              progressBar: true,
              onHidden: function () {
                $('a[href="#agrupadas"]').tab('show');
              }
            }
          );
        }
      },
      beforeSend: function () {
        toastr.info(
          'Estamos processando seu pedido...',
          'Aguarde!', {
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 30,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
          }
        );
      },
      complete: function () {}
    });
  }

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $target = e.target.hash.replace('#', '');
    if( $target == 'individuais' ){
      if( $.fn.DataTable.isDataTable( '.individuais-table' ) ){
        tabela.destroy();
        tabelaIndividuais();
      }else{
        tabelaIndividuais();
      }
    }
    if( $target == 'agrupadas' ){
      if( $.fn.DataTable.isDataTable( '.agrupadas-table' ) ){
        tabelaA.destroy();
        tabelaAgrupadas();
      }else{
        tabelaAgrupadas();
      }
    }
  })

function tabelaAgrupadas(){
  tabelaA = $('.agrupadas-table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
      "decimal": ",",
      "thousands": ".",
      select: {
        rows: {
            _: "%d linhas selecionadas",
            0: "Clique no campo '#' para selecioar uma linha",
            1: "Somente 1 linha selecionada"
        }
      }
    },
    "ajax": {
      "url": "{{route('backend.cotas.getcotasagrupadas')}}",
      "data": {
        "tipo": {{$tipo}}
      },
      "type": "GET"
    },
    "order": [
        [3, "desc"]
      ],
    "columns": [
    { "data": "id" },
    { "data": "admin" },
    { "data": "invest" },
    { "data": "credito" },
    { "data": "entrada" },
    { "data": "par" },
    { "data": "devedor" },
    { "data": "sts" },
    { "data": "acoes" },
    ],
    'paging': true,
    "pageLength": 100,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    dom: 'lBfrtip',
    "pageLength": 100,
    buttons: [
        'copy', 'csv', 'excel', 'pdf',
        /*{
          extend: 'print',
          text: 'Imprimir',
          exportOptions: {
            stripHtml: false,
          },
          customize: function (win) {
            $(win.document.body).find('tr>th:last-child, tr>td:last-child').each(function(){
              $(this).css('display', 'none');
            });
          }
        },*/
        {
          text: 'Excluir Selecionados',
          action: excluiLoteA
        }
      ],
    select: {
      style: 'multi',
      blurable: true,
      selector: 'td:first-child'
    }
  });
}

function tabelaIndividuais(){
  tabela = $('.individuais-table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
      "decimal": ",",
      "thousands": ".",
      select: {
        rows: {
            _: "%d linhas selecionadas",
            0: "Clique no campo '#' para selecioar uma linha",
            1: "Somente 1 linha selecionada"
        }
      }
    },
    "ajax": {
      "url": "{{route('backend.cotas.getcotas')}}",
      "data": {
        "tipo": {{$tipo}}
      },
      "type": "GET"
    },
    "order": [
        [3, "desc"]
      ],
    "columns": [
    { "data": "id" },
    { "data": "admin" },
    { "data": "invest" },
    { "data": "credito" },
    { "data": "entrada" },
    { "data": "par" },
    { "data": "devedor" },
    { "data": "juros" },
    { "data": "sts" },
    { "data": "acoes" },
    ],
    'paging': true,
    "pageLength": 100,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': false,
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf',
        {
          extend: 'selectAll',
          text: 'Selecionar Todas',
        },
        {
          extend: 'selectNone',
          text: 'Deselecionar Todas',
        },
        {
          text: 'Excluir Selecionados',
          action: excluiLote
        },
        {
          text: 'Agrupar Cotas',
          action: agrupaCotas
        }
      ],
    select: {
      style: 'multi',
      blurable: false,
      selector: 'td:first-child'
    }
  });

  tabela.on( 'select', function ( e, dt, type, indexes ) {
    $cotas = tabela.rows( { selected: true, search: 'applied' } ).data().toArray();
    fazCalculo($cotas);
  }).on( 'deselect', function ( e, dt, type, indexes ) {
    $cotas = tabela.rows( { selected: true, search: 'applied' } ).data().toArray();
    fazCalculo($cotas);
  });
}

function fazCalculo($cotas){
  var calculos = $('.calculos');
  if( $cotas.length < 2 ){
    calculos.find('.box-body').html('');
    calculos.hide();
    return false;
  }
  let $credito = parseFloat(0);
  let $entrada = parseFloat(0);
  let $devedor = parseFloat(0);
  let $parcela = parseFloat(0);
  let $investidor = parseFloat(0);
  $cotas.forEach(element => {
    $credito += parseFloat(limpaNumeros(element.credito));  
    $entrada += parseFloat(limpaNumeros(element.entrada));  
    $investidor += parseFloat(element.valor_investidor);  
    $devedor += parseFloat(limpaNumeros(element.devedor));  
    $parcela += parseFloat(element.parcelas[0].valor_parcela);
  });
  $lucro = $entrada - $investidor;
  calculos.show();
  calculos.find('.box-body').html('');
  calculos.find('.box-body').append("<b>Cŕedito:</b>\t\t" + $credito.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br>');
  calculos.find('.box-body').append('<b>Entrada:            </b>' + $entrada.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br>');
  calculos.find('.box-body').append('<b>Valor do Investidor:            </b>' + $investidor.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br>');
  calculos.find('.box-body').append('<b>Saldo Devedor:      </b>' + $devedor.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br>');
  calculos.find('.box-body').append('<b>Primeira Parcela:   </b>' + $parcela.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br><br>');
  calculos.find('.box-body').append('<b style="color: #FF0000">Lucro:   </b>' + $lucro.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '<br><br>');
}

function limpaNumeros($str){
  var numberPattern = /\d+/g;
  $value = ( $str.match( numberPattern ).join([]) / 100 );
  return $value;
}

</script>
@endsection