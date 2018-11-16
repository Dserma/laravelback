@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Home"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Painel Inicial </a>
    </li>
    <li class="active">Home</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.home.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página <b>"Home"</b></h3>
            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-check"></i> Salvar</button>
          </div>
          <div class="box-body">
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
              <label for="nome">Ícone Oferecemos</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_oferecemos}}" alt="Ícone Missão"/>
              <input type="hidden" name="icone_oferecemos" value="{{$item->icone_oferecemos}}" class="url-imagem" id="imagem1">
            </div>
            <div class="form-group">
              <label for="nome">Oferecemos</label>
              <textarea class="form-control editor" placeholder="" name="oferecemos">{{$item->oferecemos}}</textarea>
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
<script src="{{assets('js/backend/paginas/app.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.img-editor').each(function(){
      makeImgEditor($(this));
    });
  });
</script>
@endsection