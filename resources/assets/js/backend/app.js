
$(document).ready(function () {
  var tabela;
  var tabelaA;

  $('body').find('[data-toggle="tooltip"]').tooltip();
  $('body').find('[data-toggle="popover"]').popover();
  $('.select2').select2({
    placeholder: "Selecione uma opção"
  });

  $('[data-mask]').inputmask();
  $('.valor').mask('000.000.000ZZZ', {reverse: true, translation:  {'Z': {pattern: /[0-9,]/, optional: true}}});
  $('.cpf').mask('999.999.999-99');
  $('.cnpj').mask('99.999.999/9999-99');


  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });

  $('.btn-novo').click(function () {
    $('.modal-novo').modal('show');
    makeEditor($('.modal-novo .editor'));
    makeEditor($('.modal-novo .editor-opicional'));
  })

  $('.form-cadastro').on('submit', function () {
    gravaDados($(this));
    return false;
  });

  $('.form-vender').on('submit', function () {
    venda($(this));
    return false;
  });
  
  $('.form-infos').on('submit', function () {
    salvaInfos($(this));
    return false;
  });
  
  $('body').on('click', '.btn-editar', function () {
    editaDados($(this));
  });

  $('body').on('click', '.btn-vender', function () {
    venderCota($(this));
  });

  $('body').on('click', '.btn-infos', function () {
    makeEditor($('.modal-infos .editor'));
    infosCota($(this));
  });

  $('body').on('click', '.btn-apagar', function () {
    apagaDados($(this));
  });

  $('body').on('click', '.btn-destaque', function () {
    fazDestaque($(this));
  });

  $('.form-editar').on('submit', function () {
    salvaDados($(this));
    return false;
  });

  $('.table.normal').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
      "decimal": ",",
      "thousands": "."
    },
    'paging': false,
    'lengthChange': false,
    'searching': true,
    'ordering': false,
    'info': false,
    'autoWidth': true,
    dom: 'lfrtip',
    "pageLength": 100,
  });

  $('.modal').on('hide.bs.modal', function () {
    $(this).find('.editor').froalaEditor('destroy');
    $(this).find('.editor-opicional').froalaEditor('destroy');
    $(this).find('form').trigger("reset");
    $(this).find('input[type="radio"]').each(function () {
      $(this).iCheck('uncheck');
    })
  });

  $('.modal-novo').on('shown.bs.modal', function() {
    $(this).find('input').eq(0).focus();
  });

  $('img.img-editor').on('froalaEditor.image.replaced', function (e, editor, $img, response) {
    $(this).parent().find('.url-imagem').val($img.attr('src'));
  });

});

function validaEditor($this){
  $retorno = true;
  if( $this.parents('.modal').find('.editor').length > 0 ){
    $this.parents('.modal').find('.editor').each(function(){
      if( $(this).froalaEditor('core.isEmpty') ){
        $retorno = false;
        $nome = $(this).attr('name');
        toastr.error(
          'O ' + $nome + ' é obrigatório! Por favor, adicione algum conteúdo.',
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
        );
        return false;
      }
    });
  }
  return $retorno;
}

function gravaDados($this) {
  $valida = validaEditor($this);
  if( $valida ){
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
          $('body').find('.modal-novo form').trigger('reset');
          $('.modal-novo').find('input').eq(0).focus();
          $('.select2').val(null).trigger('change');
          $('.img-editor').attr('src', '../resources/assets/images/sem-imagem.png');
          toastr.success(
            'Item Cadastrado com sucesso!',
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

function editaDados($this) {
  $('.modal-editar').modal('show');
  $this.parents('body').find('.modal-editar .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
            if( $('#' + k).is('textarea') ){
              $('#' + k).html(data[k]);
              makeEditor($('#' + k));
            }
            if( $('#' + k).is('div') ){
              $('#' + k).html(data[k]);
            }
            $('.modal-editar').find('#' + k).val(data[k]);
            if( k == 'imagem' ){
              $('.modal-editar').find('.img-editor').attr('src', data[k]);
              makeImgEditor($('.modal-editar').find('.img-editor'));
            }
            if( $('#' + k).hasClass('select2') ){
              $('#' + k ).trigger('change');
            }
          }else{
            if (k == 'status') {
              $('#status_' + data[k]).iCheck('check');
            }
            if (k == 'pessoa') {
              $('#pessoa_' + data[k]).iCheck('check');
            }
            if (k == 'parcelas') {
              $x = 1;
              data[k].forEach(function (obj) {
                $('#idparcela_' + $x).val(obj.id);
                $('#parcela_' + $x).val(obj.parcelas);
                $('#valor_parcela_' + $x).val(obj.valor_parcela);
                $x++;
              });
            }
            if (k == 'cota' && data[k] != null ) {
              $obj = data[k];
              console.log($obj);
              if ($obj.agrupada == 1) {
                $('#titulo-cota').html('Cota Agrupada');
              } else {
                $('#titulo-cota').html('Cota');
              }
              $div = '<tr>';
              $div += '<td> ' + $obj.id + ' </td>';
              $div += '<td> ' + $obj.adm + ' </td>';
              $div += '<td> ' + $obj.inv + ' </td>';
              $div += '<td> ' + $obj.credito + ' </td>';
              $div += '<td> ' + $obj.entrada + ' </td>';
              $div += '<td>';
              $obj.parcelas.forEach(function (obj) {
                $div += obj.parcelas + ' - ' + obj.valor_parcela + '<br>';
              });
              $div += '</td>';
              $div += '</tr>';
              $('#cota-body').html($div);
            }
            if (k == 'cotas') {
              $div1 = '';
              data[k].forEach(function (objC) {
                $div1 += '<tr>';
                $div1 += '<td> ' + objC.id + ' </td>';
                $div1 += '<td> ' + objC.adm + ' </td>';
                $div1 += '<td> ' + objC.inv + ' </td>';
                $div1 += '<td> ' + objC.credito + ' </td>';
                $div1 += '<td> ' + objC.entrada + ' </td>';
                $div1 += '<td>';
                objC.parcelas.forEach(function (obj1) {
                  $div1 += obj1.parcelas + ' - ' + obj1.valor_parcela + '<br>';
                });
                $div1 += '</td>';
                $div1 += '</tr>';
              });
              $('#composicao-body').html($div1);
              $('.agrupada').show();
            } else {
              $('.agrupada').hide();
              $('#composicao-body').html('');
            }
          }
        });
        $this.parents('body').find('.modal-editar .box').find('.overlay').remove();
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

function salvaDados($this) {
  $valida = validaEditor($this);
  if( $valida ){
    $this.parents('body').find('.modal-editar .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
        if (data == 'BC') {
          history.back(1);
        }
        if (data == 'OK') {
          if( $.fn.DataTable.isDataTable( '.individuais-table' ) ){
            tabela.ajax.reload();
          }
          if( $.fn.DataTable.isDataTable( '.agrupadas-table' ) ){
            tabelaA.ajax.reload();
          }
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
          $this.parents('body').find('.modal-editar .box').find('.overlay').remove();
          $this.parents('body').find('.modal-editar').modal('hide');
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
}

function apagaDados($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a exclusão deste item?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if( result.value ){
      deletaDados($this);
    }
  });
}

function deletaDados($this){
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'DELETE',
    data: $this.serialize(),
    success: function (data) {
      toastr.clear();
      if( typeof tabela !== 'undefined' ) {
        tabela.ajax.reload();
      }
      if( typeof tabelaA !== 'undefined' ) {
        tabelaA.ajax.reload();
      }
      if (data == 'OK') {
        toastr.success(
          'Item apagado com sucesso!',
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

function venderCota($this) {
  $('.modal-vender').modal('show');
  $this.parents('body').find('.modal-vender .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
          if ($('#' + k).length > 0) {
            $('.modal-vender').find('#' + k).val(data[k]);
            $('.modal-vender').find('#' + k).html(data[k]);
          }
        });
        $this.parents('body').find('.modal-vender .box').find('.overlay').remove();
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

function venda($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a venda desta cota?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if( result.value ){
      fazVenda($this);
    }
  });
}

function fazVenda($this) {
  $this.parents('body').find('.modal-vender .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      if( $.fn.DataTable.isDataTable( '.individuais-table' ) ){
        tabela.ajax.reload();
      }
      if( $.fn.DataTable.isDataTable( '.agrupadas-table' ) ){
        tabelaA.ajax.reload();
      }
      toastr.clear();
      if (data == 'OK') {
        toastr.success(
          'Cota vendida com sucesso!',
          'Tudo certo!', {
            timeOut: 5000,
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
      $('.modal-vender').modal('hide');
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

function infosCota($this) {
  $('.modal-infos').modal('show');
  $this.parents('body').find('.modal-infos .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
          if ($('#' + k).length > 0) {
            $('.modal-infos').find('#' + k).val(data[k]);
            if( $('#' + k).is('textarea') ){
              $('#' + k).html(data[k]);
              makeEditor($('#' + k));
            }
          }
        });
        $this.parents('body').find('.modal-infos .box').find('.overlay').remove();
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

function salvaInfos($this) {
  $this.parents('body').find('.modal-infos .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      tabela.ajax.reload();
      toastr.clear();
      if (data == 'OK') {
        toastr.success(
          'Informações salvas com sucesso!',
          'Tudo certo!', {
            timeOut: 5000,
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
      $('.modal-infos').modal('hide');
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

function fazDestaque($this) {
  swal({
    title: 'Opa!',
    text: 'Confirma a inclusão desta cota como destaque?',
    type: 'question',
    confirmButtonText: "Sim",
    showCancelButton: true,
    cancelButtonText: "Não",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if( result.value ){
      destaque($this);
    }
  });
}

function destaque($this){
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      if( $.fn.DataTable.isDataTable( '.individuais-table' ) ){
        tabela.ajax.reload();
      }
      if( $.fn.DataTable.isDataTable( '.agrupadas-table' ) ){
        tabelaA.ajax.reload();
      }
      toastr.clear();
      if (data == 'OK') {
        toastr.success(
          'Destaque adicionado com sucesso',
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


function makeEditor($this) {
  $this.froalaEditor({
    heightMin: 400,
    language: 'pt_br',
    imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove', '|', 'imageLink', 'linkOpen', 'linkEdit', 'linkRemove', '-', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize', 'aviary'],
    imageInsertButtons: ['imageBack', '|', 'imageUpload', 'imageByURL', 'imageManager'],
    imageUploadURL: routes.backend.ajax.upload,
    aviaryKey: '',
    aviaryOptions: {
      displayImageSize: true,
      theme: 'dark'
    },
    imageManagerDeleteMethod: 'DELETE',
    imageManagerDeleteURL: routes.backend.ajax.delete,
    imageManagerLoadMethod: 'POST',
    imageManagerLoadURL: routes.backend.ajax.load,
    imageManagerPageSize: 20,
    imageManagerScrollOffset: 10,
    imageDefaultWidth : 0,
  });
}

function makeImgEditor($this){
  $.FroalaEditor.DefineIcon('imageReplace', {NAME: 'image'});
  $this.froalaEditor({
    language: 'pt_br',
    imageEditButtons: ['imageManager', 'aviary'],
    imageInsertButtons: ['imageUpload', 'imageManager', 'aviary'],
    imageUploadURL: routes.backend.ajax.upload,
    aviaryKey: '',
    aviaryOptions: {
      displayImageSize: true,
      theme: 'dark'
    },
    imageManagerDeleteMethod: 'DELETE',
    imageManagerDeleteURL: routes.backend.ajax.delete,
    imageManagerLoadMethod: 'POST',
    imageManagerLoadURL: routes.backend.ajax.load,
    imageManagerPageSize: 5,
    imageManagerScrollOffset: 5
  });
  $this.on('click',function(){
    $this.data('froala.editor').commands.exec('imageReplace');
  });
}

function breakEditor($this){
  $('.editor').each(function(){
    $(this).val('');
    $(this).text('');
    $(this).html('');
    $(this).froalaEditor('destroy');
  })
}