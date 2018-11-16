@extends('backend.layouts.default') 
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small><b>Configurações do Tema</b></small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Configurações do Tema</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <form action="#" class="form-conteudo" data-url="{{route('backend.configuracoes-tema.salvar')}}">
        <input type="hidden" name="id" value="{{$item->id}}">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Confira abaixo as <b>Configurações do Tema</b></h3>
            <button type="submit" class="btn btn-success pull-right">
                <i class="fa fa-check"></i> Salvar</button>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Telefone Topo</label>
              <textarea class="form-control editor" placeholder="" name="telefone_topo">{{$item->telefone_topo}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Telefone Rodapé</label>
              <textarea class="form-control editor" placeholder="" name="telefone_rodape">{{$item->telefone_rodape}}</textarea>
            </div>
            <div class="form-group">
              <label for="nome">Endereço Rodapé</label>
              <textarea class="form-control editor" placeholder="" name="endereco_rodape">{{$item->endereco_rodape}}</textarea>
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
  });
</script>
@endsection