@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Fale Conosco"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Fale Conosco</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.fale-conosco.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página "Fale Conosco"</h3>
            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-check"></i> Salvar</button>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Legenda do Topo</label>
              <textarea class="form-control editor" placeholder="" name="legenda">{{$item->legenda}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone Atendimento</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_atendimento}}" alt="Imagem de imagem"/>
              <input type="hidden" name="icone_atendimento" value="{{$item->icone_atendimento}}" class="url-imagem" id="imagem">
            </div>
            <div class="form-group">
              <label for="nome">Atendimento</label>
              <textarea class="form-control editor" placeholder="" name="atendimento">{{$item->atendimento}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone E-mail</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_email}}" alt="Imagem de imagem"/>
              <input type="hidden" name="icone_email" value="{{$item->icone_email}}" class="url-imagem" id="imagem1">
            </div>
            <div class="form-group">
              <label for="nome">E-mail</label>
              <textarea class="form-control editor" placeholder="" name="email">{{$item->email}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Ícone Parceiro</label>
              <img class="img-responsive img-editor icone fr-fil fr-dib" src="{{$item->icone_parceiro}}" alt="Imagem de imagem"/>
              <input type="hidden" name="icone_parceiro" value="{{$item->icone_parceiro}}" class="url-imagem" id="imagem2">
            </div>
            <div class="form-group">
              <label for="nome">Parceiro</label>
              <textarea class="form-control editor" placeholder="" name="parceiro">{{$item->parceiro}}</textarea>
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
    $('.icone').each(function(){
      makeImgEditor($(this));
    });
  });
</script>
@endsection