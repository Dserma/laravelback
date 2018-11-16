$(document).ready(function () {
  var tabela;

  $('.form-editar-agrupada').on('submit', function () {
    salvaAgrupada($(this));
    return false;
  });

  $('body').on('click', '.btn-remove-cota', function () {
    removeCota($(this));
  });

  $('.form-cadastro-agrupar').on('submit', function () {
    salvaDadosAgrupamento($(this));
    return false;
  });

  $('.modal').on('hide.bs.modal', function() {
    $(this).find('.editor').froalaEditor('destroy');
    $(this).find('form').trigger("reset");
  });

  $('.modal-novo').on('shown.bs.modal', function() {
    $(this).find('input').eq(0).focus();
  });

});


function salvaDadosAgrupamento($this) {
  $valida = validaEditor($this);
  if( $valida ){
    $this.parents('body').find('.modal-novo .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.ajax({
      url: $this.data('url'),
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      },
      async: true,
      method: 'POST',
      data: $this.serialize(),
      success: function (data) {
        toastr.clear();
        if (data == 'OK') {
          toastr.success(
            'Cotas incluídas com sucesso!',
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
                window.location.reload();
              }
            }
          );
          $this.parents('body').find('.modal-novo .box').find('.overlay').remove();
          $this.parents('body').find('.modal-novo').modal('hide');
        }else{
          $this.parents('body').find('.modal-novo .box').find('.overlay').remove();
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
}

function removeCota($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a remoção desta cota?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if( result.value ){
      removeCotaAgrupada($this);
    }
  });
}

function removeCotaAgrupada($this){
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'DELETE',
    data: { i: $this.data('id'), c: $this.data('cota') },
    success: function (data) {
      toastr.clear();
      if (data == 'OK') {
        toastr.success(
          'Item removido com sucesso!',
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
              window.location.reload();
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

function salvaAgrupada($this) {
    $this.parents('body').find('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
          $this.parents('body').find('.box').find('.overlay').remove();
        }else{
          $this.parents('body').find('.box').find('.overlay').remove();
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
