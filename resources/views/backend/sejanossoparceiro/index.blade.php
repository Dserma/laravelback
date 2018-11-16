@extends('backend.layouts.default') @section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Seja Nosso Parceiro"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Seja Nosso Parceiro</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.parceiro.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página "Seja Nosso Parceiro"</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Legenda do Topo</label>
              <textarea class="form-control editor" placeholder="" name="legenda">{{$item->legenda}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Conteúdo</label>
              <textarea class="form-control editor" placeholder="" name="conteudo">{{$item->conteudo}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">O que Oferecemos - Imóveis</label>
              <textarea class="form-control editor" placeholder="" name="oferecemos_imoveis">{{$item->oferecemos_imoveis}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">O que Oferecemos - Veículos</label>
              <textarea class="form-control editor" placeholder="" name="oferecemos_veiculos">{{$item->oferecemos_veiculos}}</textarea>
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
@endsection