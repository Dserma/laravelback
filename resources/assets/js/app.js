$(document).ready(function () {

  $('.valor').mask('000.000.000.000.000,00', { reverse: true });
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    },
  };

  $('.btn-menu').on('click', function(){
    $('.menu-mobile').toggleClass('show');
  });

  $('.validate-as-tel').mask(SPMaskBehavior, spOptions);

  $('.lista-banners').slick({
    arrows: false,
    dots: true,
    rows: 1,
    slidesPerRow: 1,
    speed: 2000,
    autoplay: true,
    autoplaySpeed: 5000,
  });

  $('.lista-bancos').slick({
    arrows: false,
    dots: true,
    rows: 1,
    slidesPerRow: 6,
    speed: 2000,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive:[
      {
         breakpoint: 768,
          settings: {
            rows: 1,
            slidesPerRow: 1
          }
      }]
  });

  $('.lista-depoimentos').slick({
    arrows: false,
    dots: true,
    rows: 1,
    slidesPerRow: 1,
    reponsive: [{
      breakpoint: 768,
      settings: {
        adaptiveHeight: true
      }
    }]
  });

  $('.lista-dicas').slick({
    arrows: true,
    dots: false,
    rows: 1,
    slidesPerRow: 1,
    speed: 1000
  });

  $('[data-toggle="tooltip"]').tooltip();
  
  $('a.iframe').fancybox( { 'overlayShow': true, 'type' : 'iframe', 'width' : '470', 'height' : 'auto', 'titleShow' : false, 'titlePosition' : 'float', 'titleFromAlt' : true, 'autoSize': true, 'autoDimensions': true, } );
  $('.iframe-ligamos a').fancybox( { 'overlayShow': true, 'type' : 'iframe', 'width' : '550', 'height' : 'auto', 'titleShow' : false, 'titlePosition' : 'float', 'titleFromAlt' : true, 'autoSize': false, 'autoDimensions': true, } );

  $('.form-simulacao, .form-compre').on('submit', function () {
    gravaDados($(this));
    return false;
  })

  $('.form-email').on('submit', function () {
    enviaEmail($(this));
    return false;
  })

});

function gravaDados($this) {
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      $('body').removeClass('load');
      if (data == 'OK') {
        window.location.href = $this.data('redirect');
      } else {
        $erros = '';
        Object.keys(data).forEach(function (k) {
          $erros += data[k] + '\n';
        });
        swal({
          title: 'Oops...',
          text: $erros,
          type: 'error'
        });
      }
    },
    beforeSend: function () {
      $('body').addClass('load');
    },
    complete: function () {}
  });
}

function enviaEmail($this) {
  $.ajax({
    url: $this.data('url'),
    headers: {
      'X-CSRF-Token': $('meta[name=_token]').attr('content')
    },
    async: true,
    method: 'POST',
    data: $this.serialize(),
    success: function (data) {
      $('body').removeClass('load');
      if (data == 'OK') {
        swal({
          title: 'Obrigado!',
          text: 'Sua mensagem foi enviada com sucesso, e em breve retornaremos o contato!',
          type: 'success',
          confirmButtonText: "OK",
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
        }).then((result) => {
          if( result.value ){
            window.location.href = $this.data('redirect'); 
          }
        });
      } else {
        $erros = '';
        Object.keys(data).forEach(function (k) {
          $erros += data[k] + '\n';
        });
        swal({
          title: 'Oops...',
          text: $erros,
          type: 'error'
        });
      }
    },
    beforeSend: function () {
      $('body').addClass('load');
    },
    complete: function () {}
  });
}
