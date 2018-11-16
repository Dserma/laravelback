@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small><b>Imprimir Cotas Ativas {{$titulo}}</b></small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Imprimir Cotas Ativas {{$titulo}}</li>
  </ol>
</section>
<section class="content">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Impressão de Cotas Ativas {{$titulo}}</h3>
    </div>
    <div class="box-body table-responsive">
      <table class="imprimir-table table table-bordered table-striped text-10-pt text-center">
        <thead>
          <tr>
            <th>CRÉDITO</th>
            <th>ADMINISTRADORA</th>
            <th>ENTRADA</th>
            <th>SALDO</th>
            <th>INVEST</th>
            <th>CUSTO</th>
          </tr>
        </thead>
        <tbody>
          @foreach( $cotas as $cota )
            <tr>
              <td>{{currencyToApp($cota->credito)}}</td>
              <td>{{$cota->administradora->nome}}</td>
              @if( $cota->entrada_opicional == '' )
                <td>{{currencyToApp($cota->entrada)}}</td>
              @else
                <td>{{currencyToApp($cota->entrada_opicional)}}</td>
              @endif
              <td class="">
                @foreach( $cota->parcelas->slice(0,1) as $p )
                  {{$p->parcelas}} X {{currencyToApp($p->valor_parcela)}} <br>
                @endforeach
                @php
                  if( $cota->parcelas->count() > 1 ){
                    echo '<strong>mais parcelas</strong>';
                  }
                @endphp
              </td>
              @if( $cota->agrupada == 0 || $cota->agrupada == 2 )
                <td>
                  @php
                  $inv = array();
                  if( $cota->investidores->count() > 0 ){
                    foreach( $cota->investidores as $i ){
                      $inv[] = $i->codigo;
                    }
                  }  
                  echo implode(', ', $inv);
                  @endphp
                </td>
              @endif
              @if( $cota->agrupada == 1 )
                <td>A</td>
              @endif
              <td>{{currencyToApp($cota->valor_investidor)}}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>CRÉDITO</th>
            <th>ADMINISTRADORA</th>
            <th>ENTRADA</th>
            <th>SALDO</th>
            <th>INVESTIDOR</th>
            <th>VALOR INVESTIDOR</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="box-footer">
    </div>
  </div>
</section>
<script>
  $(document).ready(function(){
    $('.imprimir-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
        "decimal": ",",
        "thousands": "."
      },
      "order": [
        [0, "desc"]
      ],
      'paging': false,
      "pageLength": 100,
      'lengthChange': true,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      dom: 'lBfrtip',
      buttons: [
        'copy', 'csv', 'excel', {
          extend: 'print',
          text: 'Imprimir',
          exportOptions: {
            stripHtml: false,
          },
          customize: function (win) {
            $(win.document.body).find('tr>th:last-child, tr>td:last-child').each(function(){
              //$(this).css('display', 'none');
            });
          }
        }
      ]
    });
  })
</script>
@endsection