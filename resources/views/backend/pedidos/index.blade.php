@extends('backend.layouts.default') @section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Listagem de Pedidos</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Painel Inicial</a>
    </li>
    <li class="active">Listagem de Pedidos</li>
  </ol>
</section>
<section class="content">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class=""><a href="#novos" aria-controls="novos" role="tab" data-toggle="tab">Pedidos Novos</a></li>
      <li role="presentation"><a href="#aprovados" aria-controls="aprovados" role="tab" data-toggle="tab">Pedidos Aprovados</a></li>
      <li role="presentation"><a href="#recusados" aria-controls="recusados" role="tab" data-toggle="tab">Pedidos Recusados</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade" id="novos">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo todos os
              <b>novos pedidos!</b></h3>
          </div>
          <div class="box-body table-responsive">
            <table class="novos-table table table-responsive table-bordered table-striped table-hover">
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
      <div role="tabpanel" class="tab-pane fade" id="aprovados">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo todos os
              <b>pedidos aprovados!</b> </h3>
          </div>
          <div class="box-body table-responsive">
            <table class="aprovados-table table table-responsive table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tipo</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Telefones</th>
                  <th>Data Aprovação</th>
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
      <div role="tabpanel" class="tab-pane fade" id="recusados">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo todos os
              <b>pedidos reprovados!</b></h3>
          </div>
          <div class="box-body table-responsive">
            <table class="recusados-table table table-responsive table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tipo</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Telefones</th>
                  <th>Data Reprovação</th>
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
  </div>
</section>

<div class="modal fade modal-editar" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">
            <b>Visualização de Pedido</b>
          </h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" readonly>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" readonly>
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
                <input type="text" class="form-control" id="email" name="email" readonly>
              </div>
            </div>
            <div class="col-xs-12">
              <hr>
            </div>
            <div class="col-xs-12">
              <label for="" id="titulo-cota"></label>
            </div>
            <div class="col-xs-12 table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Administradora</th>
                    <th>Investidor</th>
                    <th>Crédito</th>
                    <th>Entrada</th>
                    <th>Parcelas</th>
                  </tr>
                </thead>
                <tbody id="cota-body">

                </tbody>
              </table>
            </div>
            <div class="col-xs-12 agrupada">
              <label for="email">Composição da Cota</label>
            </div>
            <div class="col-xs-12 table-responsive agrupada">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Administradora</th>
                    <th>Investidor</th>
                    <th>Crédito</th>
                    <th>Entrada</th>
                    <th>Parcelas</th>
                  </tr>
                </thead>
                <tbody id="composicao-body">

                </tbody>
              </table>
            </div>
            <div class="col-xs-12 recusa not-show">
              <form action="#" class="form-recusa" data-url="{{route('backend.pedidos.recusar')}}">
                <input type="hidden" name="pedido_id" id="pedido_id">
                <div class="form-group">
                  <label for="">Motivo da recusa</label>
                  <textarea name="motivo_recusa" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-danger btn-recusar"><i class="fa fa-check"></i>&nbsp;Salvar Recusa</button>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col-md-6 text-left">
              <button type="button" class="btn btn-danger btn-recusa">
                <i class="fa fa-ban"></i> Recusar
              </button>
              <button type="button" class="btn btn-success btn-aprova">
                <i class="fa fa-check"></i> Aprovar
              </button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times"></i> Fechar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{{assets('js/backend/pedidos.js')}}"></script>
<script>
    var routes = {
      backend:{
        pedidos:{
          getpedidos: '{{route('backend.pedidos.getpedidos')}}',
          getpedidosaprovados: '{{route('backend.pedidos.getpedidosaprovados')}}',
          getpedidosrecusados: '{{route('backend.pedidos.getpedidosrecusados')}}',
          aprova: '{{route('backend.pedidos.aprova')}}',
        }
      }
    };
  $(document).ready(function () {
    $('a[href="#novos"]').tab('show');
    $(document).ajaxComplete(function () {
      $('[data-toggle="tooltip"]').tooltip();
      $('[data-toggle="popover"]').popover()
    })

  })
</script>
@endsection