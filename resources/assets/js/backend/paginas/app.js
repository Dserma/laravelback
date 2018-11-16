$(document).ready(function () {
  makeEditor($('.editor'));
  $('.form-conteudo').on('submit', function(){
    gravaConteudo($(this));
    return false;
  })
});

function validaEditorPagina($this){
  $retorno = true;
  if( $this.find('.editor').length > 0 ){
    $this.find('.editor').each(function(){
      if( $(this).froalaEditor('core.isEmpty') ){
        $retorno = false;
        $nome = $(this).attr('name');
        $(this).focus();
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

function gravaConteudo($this) {
  $valida = validaEditorPagina($this);
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
        toastr.clear();
        $this.find('.box').find('.overlay').remove();
        if (data == 'OK') {
          $('body').find('.modal-novo form').trigger('reset');
          toastr.success(
            'Item salvo com sucesso!',
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
        $this.find('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
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
      complete: function () {
      }
    });
  }
}

function makeEditor($this){
  $this.froalaEditor({
    heightMin: 400,
    language: 'pt_br',
    imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove', '|', 'imageLink', 'linkOpen', 'linkEdit', 'linkRemove', '-', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize', 'aviary'],
    imageInsertButtons: ['imageBack', '|', 'imageUpload', 'imageByURL', 'imageManager', 'aviary'],
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
