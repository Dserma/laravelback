@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Conteúdo da página "Cotas Contempladas <b>{{$tipo}}</b>"</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Cotas Contempladas {{$tipo}}</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.cotas.pagina.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo o dados da página "Cotas Contempladas <b>{{$tipo}}</b>"</h3>
            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-check"></i> Salvar</button>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Título</label>
              <textarea class="form-control editor" placeholder="" name="titulo">{{$item->titulo}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Subtítulo</label>
              <textarea class="form-control editor" placeholder="" name="subtitulo">{{$item->subtitulo}}</textarea>
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