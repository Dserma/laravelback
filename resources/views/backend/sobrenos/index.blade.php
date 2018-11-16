@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Sobre Nós"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sobre Nós</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.sobre-nos.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página <b>"Sobre Nós"</b></h3>
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
              <label for="nome">Ícone Missão</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_missao}}" alt="Ícone Missão"/>
              <input type="hidden" name="icone_missao" value="{{$item->icone_missao}}" class="url-imagem" id="imagem1">
            </div>
            <div class="form-group">
              <label for="nome">Missão</label>
              <textarea class="form-control editor" placeholder="" name="missao">{{$item->missao}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone Visão</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_visao}}" alt="Ícone Visão"/>
              <input type="hidden" name="icone_visao" value="{{$item->icone_visao}}" class="url-imagem" id="imagem2">
            </div>
            <div class="form-group">
              <label for="nome">Visão</label>
              <textarea class="form-control editor" placeholder="" name="visao">{{$item->visao}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone Valores</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_valores}}" alt="Ícone Valores"/>
              <input type="hidden" name="icone_valores" value="{{$item->icone_valores}}" class="url-imagem" id="imagem2">
            </div>
            <div class="form-group">
              <label for="nome">Valores</label>
              <textarea class="form-control editor" placeholder="" name="valores">{{$item->valores}}</textarea>
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
<script src="{{assets('js/backend/frfa.js')}}"></script>
<script src="{{assets('js/backend/paginas/app.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.img-editor').each(function(){
      makeImgEditor($(this));
    });
  });
</script>
@endsection