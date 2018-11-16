@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Consórcio Novo"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Consórcio Novo</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.consorcio-novo.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página <b>"Consórcio Novo"</b></h3>
            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-check"></i> Salvar</button>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Legenda do Topo</label>
              <textarea class="form-control editor" placeholder="" name="legenda">{{$item->legenda}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Imagem</label>
              <img class="img-editor imagem fr-fil fr-dib" src="{{$item->imagem}}" alt="Imagem"/>
              <input type="hidden" name="imagem" value="{{$item->imagem}}" class="url-imagem" id="imagem">
            </div>
            <div class="form-group">
              <label for="nome">Conteúdo</label>
              <textarea class="form-control editor" placeholder="" name="conteudo">{{$item->conteudo}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone Vantagem</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_vantagem}}" alt="Ícone Missão"/>
              <input type="hidden" name="icone_vantagem" value="{{$item->icone_vantagem}}" class="url-imagem" id="imagem1">
            </div>
            <div class="form-group">
              <label for="nome">Vantagem</label>
              <textarea class="form-control editor" placeholder="" name="vantagem">{{$item->vantagem}}</textarea>
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
<script>
  $(document).ready(function(){
    $('.img-editor').each(function(){
      makeImgEditor($(this));
    });
  });
</script>
@endsection