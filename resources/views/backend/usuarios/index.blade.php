@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Listagem de Usuários</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
        <li class="active">Listagem de Usuários</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Confira abaixo todos os <b>usuários</b> cadastrados!</h3>
                    <button class="btn btn-success pull-right btn-novo"><i class="fa fa-plus"></i> Novo Usuário</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="investidores-table table table-responsive table-borderbed table-striped tableohover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
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
          <h4 class="modal-title"><b>Cadastro de Novo Usuário</b></h4>
        </div>
        <form action="#" role="form" class="form-cadastro" data-url="{{route('backend.usuarios.adicionar')}}">
          <div class="modal-body">
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" placeholder="Nome..." name="nome" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Usuário</label>
                  <input type="text" class="form-control" placeholder="Usuário..." name="usuario" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">E-mail</label>
                  <input type="email" class="form-control" placeholder="E-mail..." name="email" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Senha</label>
                  <input type="password" class="form-control" placeholder="Senha..." name="senha" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">Confirmação de Senha</label>
                  <input type="password" class="form-control" placeholder="Confirmação de senha..." name="confirmacao_senha" required="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
            </div>
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
          <h4 class="modal-title"><b>Edição de Investidor</b></h4>
        </div>
        <form action="#" role="form" class="form-editar" data-url="{{route('backend.usuarios.salvar')}}">
          <input type="hidden" id="id" name="id">
          <div class="modal-body">
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" placeholder="Nome..." name="nome" required="" id="nome">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Usuário</label>
                    <input type="text" class="form-control" placeholder="Usuário..." name="usuario" required="" id="usuario">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">E-mail</label>
                    <input type="email" class="form-control" placeholder="E-mail..." name="email" required="" id="email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Senha</label>
                    <input type="password" class="form-control" placeholder="Senha..." name="senha">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Confirmação de Senha</label>
                    <input type="password" class="form-control" placeholder="Confirmação de senha..." name="confirmacao_senha">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
              </div>
            </div>
        </form>
      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $(document).ready(function(){
    tabela = $('.table').not('.normal').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
        "url": "{{route('backend.usuarios.getusuarios')}}",
        "type": "GET"
      },
      "columns": [
        { "data": "id" },
        { "data": "nome" },
        { "data": "usuario" },
        { "data": "email" },
        { "data": "acoes" },
      ],
      "order": [
        [2, "asc"]
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