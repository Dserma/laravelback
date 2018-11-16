@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Listagem de categorias</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dicas - Listagem de categorias</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Confira abaixo todos as categorias cadastradas!</h3>
                    <button class="btn btn-success pull-right btn-novo" data-titulo="nova categoria"><i class="fa fa-plus"></i> Nova Categoria</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="categorias-table table table-responsive table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade modal-novo" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cadastro de nova categoria</h4>
        </div>
        <form action="#" role="form" class="form-cadastro" data-url="{{route('backend.dicas.categorias.adicionar')}}">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" class="form-control" placeholder="Nome..." name="nome" required="">
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

<div class="modal fade modal-editar" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Edição de Categoria</b></h4>
        </div>
        <form action="#" role="form" class="form-editar" data-url="{{route('backend.dicas.categorias.salvar')}}">
          <input type="hidden" id="id" name="id">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome..." name="nome" required="">
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

<script>
  $(document).ready(function(){
    tabela = $('.table').not('.normal').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
        "url": "{{route('backend.dicas.categorias.getcategorias')}}",
        "type": "GET"
      },
      "columns": [
        { "data": "id" },
        { "data": "nome" },
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