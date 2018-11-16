@extends('backend.layouts.vazio') 
@section('content')
<section class="login">
  <div class="container">
    <div class="row login-board align-items-center justify-content-center">
      <div class="board padding-20">
        <div class="row logo justify-content-center">
          <img src="{{assets('images/backend/logo.png')}}" alt="" />
        </div>
        <form data-action="{{route('backend.login')}}" class="form-login margin-left-15 margin-right-15">
          <div class="row margin-top-30">
            <input type="text" name="usuario" class="form-control" placeholder="Usuário" required="" />
          </div>
          <div class="row margin-top-30">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required="" />
          </div>
          <div class="row margin-top-30 justify-content-center">
            <button type="submit" class="btn btn-lg btn-cyan-2 btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<script src="{{asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('node_modules/sweetalert2/dist/sweetalert2.min.css')}}">
<script type="text/javascript">
  var routes = {
    ajax: {
      home: '{{route('backend.home')}}'
    }
  };
</script>
<script src="{{assets('js/backend/login.js')}}"></script>
@endsection