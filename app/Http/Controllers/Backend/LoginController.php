<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Models\Backend\User;
use App\Traits\Handler;

class LoginController extends Controller
{
  use Handler;
  
  public function form(){
    if (Auth::check()) {
      return response()->redirectTo(route('backend.home'));
    }else{
      return view('backend.login');
    }
  }
  
  public function Index(Request $request){
    $rules = array(
      'usuario' => 'required|alphaNum|min:3', 
      'senha'   => 'required|min:4' 
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      echo $validator->errors(); 
    }else{
      $credentials = array(
        'usuario' => $request->usuario,
        'password' => $request->senha
      );
      if(auth()->attempt($credentials)){
        echo 'OK';
      }else{        
        $this->sendFailedLoginResponse($request);
      }
    }
  }
  
  public function Sair(){
    auth()->logout();
    return response()->redirectTo(route('backend.index'));
  }
  
  protected function sendFailedLoginResponse(Request $request){
    if ( !User::where('usuario', $request->usuario)->first() ) {
      echo 'Usuário não encontrado!';
      exit;
    }
    
    if ( !User::where('usuario', $request->usuario)->where('senha', bcrypt($request->senha))->first() ) {
      echo 'Senha incorreta!';
      exit;
    }
  }
}