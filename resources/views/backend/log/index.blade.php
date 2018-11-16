@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Log de Eventos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
        <li class="active">Log de Eventos</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listagem de Log de Eventos</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="logs-table table table-responsive table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data / Hora</th>
                                <th>Usuário</th>
                                <th>Módulo</th>
                                <th>Ação</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Data / Hora</th>
                                <th>Usuário</th>
                                <th>Módulo</th>
                                <th>Ação</th>
                                <th>Descrição</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
  $(document).ready(function(){
    tabela = $('.table').not('.normal').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
        "url": "{{route('backend.log.getlog')}}",
        "type": "GET"
      },
      "columns": [
        { "data": "id" },
        { "data": "data" },
        { "data": "usuario" },
        { "data": "modulo" },
        { "data": "acao" },
        { "data": "descricao" },
      ],
      'paging': true,
      "pageLength": 100,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      'order' : [],
      dom: 'lBfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  })
</script>
@endsection