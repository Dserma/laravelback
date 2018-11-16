@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Localização"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Localização</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.localizacao.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página "Localização"</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Legenda do Topo</label>
              <textarea class="form-control editor" placeholder="" name="legenda">{{$item->legenda}}</textarea>
            </div>
            <div class="form-group">
              {{--  <label for="nome">Mapa</label>
              <input type="text" class="form-control endereco" value="{{$item->mapa}}" name="mapa" placeholder="Digite o endereço aqui..." >
              <div class="mapa"></div>  --}}
            </div>
            <div class="form-group details">
              {{--  <label for="">Retorno da Google</label>
              <div class="form-group">
                <label> Latitude: </label>
                <input type="text" class="form-control latitude" value="{{$item->latitude}}" name="latitude" id="" data-geo="lat" readonly >
              </div>
              <div class="form-group">
                <label> Longitude: </label>
                <input type="text" class="form-control longitude" value="{{$item->longitude}}" name="longitude" id="" data-geo="lng" readonly >
              </div>  --}}
              <div class="form-group">
                <label> Endereço Completo: </label>
                <input type="text" class="form-control" value="{{$item->endereco}}" name="endereco" id="" data-geo="formatted_address" required >
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success">
              <i class="fa fa-check"></i> Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBs5bAk4ckB86kytyr0TDNO1HTJuPLQ0PA"></script>
<script src="{{assets('js/backend/paginas/app.js')}}"></script>
<script src="{{assets('js/backend/geocomplete.js')}}"></script>
<script>
  $(document).ready(function(){
    if( $(".endereco").val() != '' ){
      $(".endereco").geocomplete({
        map: ".mapa",
      });
      $(".endereco").geocomplete('find', $(this).val()).bind("geocode:result", function(event, result){
        $(".endereco").geocomplete('destroy');
        $(".endereco").geocomplete({
          location: [$(".latitude").val(), $(".longitude").val()],
          map: ".mapa",
          mapOptions: {
            zoom: 17,
            scrollwheel: false,
            mapTypeId: "roadmap"
        },
          details: ".details",
          detailsAttribute: "data-geo"
        });
      });
    }else{
      $(".endereco").geocomplete({
        map: ".mapa",
        details: ".details",
        detailsAttribute: "data-geo"
      });
    }
  });
</script>
@endsection