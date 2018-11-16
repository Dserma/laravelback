$(document).ready(function () {

  $('.btn-recusa').on('click', function () {
    $('.recusa').toggle();
  })

  $('.btn-aprova').on('click', function () {
    aprova($(this));
    return false;
  });

  $('.btn-altera').on('click', function () {
    pegaCota($(this));
    return false;
  })

  $('.form-recusa').on('submit', function () {
    recusa($(this));
    return false;
  });
  
  $('.form-editar-cota').on('submit', function () {
    salvaCotaqGrupo($(this));
    return false;
  });

  $('.form-editar-aprovado').on('submit', function () {
    salvaAprovado($(this));
    return false;
  })

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $target = e.target.hash.replace('#', '');
    if ($target == 'novos') {
      if ($.fn.DataTable.isDataTable('.novos-table')) {
        tabela.destroy();
        tabelaNovos();
      } else {
        tabelaNovos();
      }
    }
    if ($target == 'aprovados') {
      if ($.fn.DataTable.isDataTable('.aprovados-table')) {
        tabelaA.destroy();
        tabelaAprovados();
      } else {
        tabelaAprovados();
      }
    }
    if ($target == 'recusados') {
      if ($.fn.DataTable.isDataTable('.recusados-table')) {
        tabelaR.destroy();
        tabelaRecusados();
      } else {
        tabelaRecusados();
      }
    }
  })
})

function salvaRecusa($this) {
  $valida = validaEditor($this);
  if ($valida) {
    $.ajax({
      url: $this.data('url'),
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      async: true,
      method: 'POST',
      data: $this.serialize(),
      success: function (data) {
        $this.parents('.box').find('.overlay').remove();
        toastr.clear();
        $('body').removeClass('load');
        if (data == 'OK') {
          tabela.ajax.reload();
          toastr.success(
            'Pedido RECUSADO com sucesso!',
            'Tudo certo!', {
              timeOut: 2000,
              showEasing: 'linear',
              showMethod: 'slideDown',
              closeMethod: 'fadeOut',
              closeDuration: 300,
              closeEasing: 'swing',
              closeButton: false,
              progressBar: true,
              onHidden: function () {}
            }
          );
          $('.modal-editar').modal('hidden');
        } else {
          Object.keys(data).forEach(function (k) {
            toastr.error(
              data[k],
              'Oops!', {
                timeOut: 3000,
                showEasing: 'linear',
                showMethod: 'slideDown',
                closeMethod: 'fadeOut',
                closeDuration: 300,
                closeEasing: 'swing',
                closeButton: false,
                progressBar: true,
              }
            )
          });
        }
      },
      beforeSend: function () {
        toastr.info(
          'Estamos salvando suas alterações...',
          'Aguarde!', {
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 300,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
          }
        );
        $this.parents('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      complete: function () {}
    });
  }
}

function recusa($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a rejeição deste pedido?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.value) {
      salvaRecusa($this);
    }
  });
}

function aprova($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a aprovação deste pedido?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.value) {
      aprovaPedido($this);
    }
  });
}

function aprovaPedido($this) {
  $.ajax({
    url: routes.backend.pedidos.aprova,
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: {i: $('#pedido_id').val()},
    success: function (data) {
      $this.parents('.box').find('.overlay').remove();
      toastr.clear();
      $('body').removeClass('load');
      if (data == 'OK') {
        tabela.ajax.reload();
        toastr.success(
          'Pedido APROVADO com sucesso!',
          'Tudo certo!', {
            timeOut: 2000,
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 300,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
            onHidden: function () {}
          }
        );
        $('body').find('.modal-editar').modal('hide');
      } else {
        Object.keys(data).forEach(function (k) {
          toastr.error(
            data[k],
            'Oops!', {
              timeOut: 3000,
              showEasing: 'linear',
              showMethod: 'slideDown',
              closeMethod: 'fadeOut',
              closeDuration: 300,
              closeEasing: 'swing',
              closeButton: false,
              progressBar: true,
            }
          )
        });
      }
    },
    beforeSend: function () {
      toastr.info(
        'Estamos processando as informações ...',
        'Aguarde!', {
          showEasing: 'linear',
          showMethod: 'slideDown',
          closeMethod: 'fadeOut',
          closeDuration: 300,
          closeEasing: 'swing',
          closeButton: false,
          progressBar: true,
        }
      );
      $this.parents('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    },
    complete: function () {}
  });
}

function salvaAprovado($this) {
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      $this.parents('.box').find('.overlay').remove();
      toastr.clear();
      $('body').removeClass('load');
      if (data == 'OK') {
        if( $.fn.DataTable.isDataTable( '.individuais-table' ) ){
          tabela.ajax.reload();
        }
        toastr.success(
          'Pedido salvo com sucesso!',
          'Tudo certo!', {
            timeOut: 2000,
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 300,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
            onHidden: function () {}
          }
        );
        $('body').find('.modal-editar').modal('hide');
      } else {
        Object.keys(data).forEach(function (k) {
          toastr.error(
            data[k],
            'Oops!', {
              timeOut: 3000,
              showEasing: 'linear',
              showMethod: 'slideDown',
              closeMethod: 'fadeOut',
              closeDuration: 300,
              closeEasing: 'swing',
              closeButton: false,
              progressBar: true,
            }
          )
        });
      }
    },
    beforeSend: function () {
      toastr.info(
        'Estamos processando as informações ...',
        'Aguarde!', {
          showEasing: 'linear',
          showMethod: 'slideDown',
          closeMethod: 'fadeOut',
          closeDuration: 300,
          closeEasing: 'swing',
          closeButton: false,
          progressBar: true,
        }
      );
      $this.parents('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    },
    complete: function () {}
  });
}

function pegaCota($this) {
  $('.modal-editar-cota').modal('show');
  $this.parents('body').find('.modal-editar-cota .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  $.ajax({
    url: $this.data('url'),
    async: true,
    method: 'GET',
    data: $this.serialize(),
    success: function (data) {
      toastr.clear();
      if (typeof data == 'object') {
        toastr.success(
          'Dados carregados com sucesso!',
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
        Object.keys(data).forEach(function (k) {
          if( $('#' + k).length > 0 ){
            if( $('#' + k).is('div') ){
              $('#' + k).html(data[k]);
            }
            $('.modal-editar-cota').find('#' + k).val(data[k]);
          }else{
          }
        });
        $this.parents('body').find('.modal-editar-cota .box').find('.overlay').remove();
      }
    },
    beforeSend: function () {
      toastr.info(
        'Estamos buscando o item solicitado...',
        'Aguarde!', {
          showEasing: 'linear',
          showMethod: 'slideDown',
          closeMethod: 'fadeOut',
          closeDuration: 300,
          closeEasing: 'swing',
          closeButton: false,
          progressBar: true,
        }
      );
    },
    complete: function () {}
  });
}

function salvaCotaqGrupo($this) {
    $this.parents('body').find('.modal-editar-cota .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.ajax({
      url: $this.data('url'),
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      async: true,
      method: 'PUT',
      data: $this.serialize(),
      success: function (data) {
        toastr.clear();
        if (data == 'OK') {
          toastr.success(
            'Alterações salvas com sucesso!',
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
              }
            }
          );
          window.location.reload();
        }else{
          $this.parents('body').find('.modal-editar .box').find('.overlay').remove();
          Object.keys(data).forEach(function (k) {
            toastr.error(
              data[k],
              'Oops!', {
                timeOut: 3000,
                showEasing: 'linear',
                showMethod: 'slideDown',
                closeMethod: 'fadeOut',
                closeDuration: 300,
                closeEasing: 'swing',
                closeButton: false,
                progressBar: true,
              }
            )
          });
        }
      },
      beforeSend: function () {
        toastr.info(
          'Estamos salvando suas alterações...',
          'Aguarde!', {
            showEasing: 'linear',
            showMethod: 'slideDown',
            closeMethod: 'fadeOut',
            closeDuration: 300,
            closeEasing: 'swing',
            closeButton: false,
            progressBar: true,
          }
        );
      },
      complete: function () {}
    });
}

function tabelaNovos() {
  tabela = $('.novos-table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
    },
    "ajax": {
      "url": routes.backend.pedidos.getpedidos,
      "type": "GET",
      "data": {
        "status": 0
      },
    },
    "columns": [{
        "data": "id"
      },
      {
        "data": "tipo"
      },
      {
        "data": "nome"
      },
      {
        "data": "email"
      },
      {
        "data": "telefones"
      },
      {
        "data": "data"
      },
      {
        "data": "acoes"
      },
    ],
    "order": [
      [0, "desc"]
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
}

function tabelaAprovados() {
  tabelaA = $('.aprovados-table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
    },
    "ajax": {
      "url": routes.backend.pedidos.getpedidosaprovados,
      "type": "GET",
      "data": {
        "status": 1
      },
    },
    "columns": [{
        "data": "id"
      },
      {
        "data": "tipo"
      },
      {
        "data": "nome"
      },
      {
        "data": "email"
      },
      {
        "data": "telefones"
      },
      {
        "data": "data"
      },
      {
        "data": "acoes"
      },
    ],
    "order": [
      [0, "desc"]
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
}

function tabelaRecusados() {
  tabelaR = $('.recusados-table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json"
    },
    "ajax": {
      "url": routes.backend.pedidos.getpedidosrecusados,
      "type": "GET",
      "data": {
        "status": 2
      },
    },
    "columns": [{
        "data": "id"
      },
      {
        "data": "tipo"
      },
      {
        "data": "nome"
      },
      {
        "data": "email"
      },
      {
        "data": "telefones"
      },
      {
        "data": "data"
      },
      {
        "data": "acoes"
      },
    ],
    "order": [
      [0, "desc"]
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
}