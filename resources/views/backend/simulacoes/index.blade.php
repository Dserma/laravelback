@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Listagem de Simulações</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
        <li class="active">Listagem de Simulações</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Confira abaixo todos as <b>simulações</b> cadastradas!</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="simulacoes-table table table-responsive table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefones</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefones</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade modal-editar" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Visualização de Simulação</b></h4>
        </div>
          <div class="modal-body">
              <div class="box-body">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" readonly >
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" readonly >
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" readonly>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" readonly >
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <div class="tipo" id="tipo"></div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="credito">Crédito</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control" id="credito" name="credito" readonly>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="entrada">Entrada</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control" id="entrada" name="entrada" readonly>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="valor_parcela">Valor da Parcela</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">R$</span>
                      <input type="text" class="form-control" id="valor_parcela" name="valor_parcela" readonly>
                    </div>
                  </div>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="button" class="btn btn-primary btn-imprimir"><i class="fa fa-print"></i> Imprimir </button>
            </div>
          </div>
      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $(document).ready(function(){
    makeImgEditor($('.modal-novo').find('.img-editor'));
    tabela = $('.table').not('.normal').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
        "url": "{{route('backend.simulacoes.getsimulacoes')}}",
        "type": "GET"
      },
      "columns": [
        { "data": "id" },
        { "data": "tipo" },
        { "data": "nome" },
        { "data": "email" },
        { "data": "telefones" },
        { "data": "date" },
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
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $( document ).ajaxComplete(function() {
      $('[data-toggle="tooltip"]').tooltip();
    })
    
  })
</script>
@endsection