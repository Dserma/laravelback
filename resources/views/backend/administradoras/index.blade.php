@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Listagem de Administradoras</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
        <li class="active">Listagem de Administradoras</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Confira abaixo todos as administradoras cadastradas!</h3>
                    <button class="btn btn-success pull-right btn-novo" data-titulo="nova categoria"><i class="fa fa-plus"></i> Nova Administradora</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="administradoras-table table table-responsive table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Imagem</th>
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

<div class="modal fade modal-novo" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Cadastro de nova Administradora</b></h4>
        </div>
        <form action="#" role="form" class="form-cadastro" data-url="{{route('backend.administradoras.adicionar')}}">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" placeholder="Nome..." name="nome" required="">
              </div>
              <div class="form-group">
                <label for="nome">Imagem</label>
                <img id="imagem-img" class="img-responsive img-editor" class="fr-fil fr-dib" src="{{assets('images/sem-imagem.png')}}" alt="Imagem de imagem"/>
                <input type="hidden" name="imagem" value="" class="url-imagem" id="imagem">
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
          <h4 class="modal-title"><b>Edição de Administradora</b></h4>
        </div>
        <form action="#" role="form" class="form-editar" data-url="{{route('backend.administradoras.salvar')}}">
          <input type="hidden" id="id" name="id">
          <div class="modal-body">
              <div class="box-body">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" id="nome" placeholder="Nome..." name="nome" required="">
                </div>
                <div class="form-group">
                  <label for="nome">Imagem (clique para editar)</label>
                  <img id="imagem-img" class="img-responsive img-editor" class="fr-fil fr-dib" src="{{assets('images/sem-imagem.png')}}" alt="Imagem de imagem"/>
                  <input type="hidden" name="imagem" value="" class="url-imagem" id="imagem">
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
    makeImgEditor($('.modal-novo').find('.img-editor'));
    tabela = $('.table').not('.normal').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
        "url": "{{route('backend.administradoras.getadministradoras')}}",
        "type": "GET"
      },
      "columns": [
        { "data": "id" },
        { "data": "imagem" },
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