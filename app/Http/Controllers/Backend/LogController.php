<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datetime;

class LogController extends Controller
{
  
  function Index(){
    return view('backend.log.index');
  }

  public function GetLog(){
    $data['data'] = $this->log::orderBy('id', 'desc')->get();
    foreach( $data['data'] as $d ){
      $d->id = $d->id;
      $d->data = dateTimeBdToApp($d->created_at);
      $d->usuario = $d->causer->nome;
      $d->modulo = $d->log_name;
      $d->acao = $d->description;
      $d->descricao = $this->getAcao($d);
    }
    return response()->json($data);
  }

  protected function getAcao($d){
    $old = $d->properties['old'] ?? true;
    $new = $d->properties['attributes'];

    if( $d->description == 'Alteração' ){
      $msg = '';
      foreach( $new as $k => $v ){
        $msg .= 'O item <b>'.$k. '</b> foi <span style="color: #2d9c69">alterado</span> para <b>' .strip_tags($v). ' </b>.<br />';
      }
      return $msg;
    }

    if( $d->description == 'Exclusão' ){
      return 'O item <b>'.reset($new). '</b> foi <span style="color: #cf3328">excluído!</span>';
    }

    if( $d->description == 'Criação' ){
      return 'O item <b>'.reset($new). '</b> foi <span style="color: #2d5d9c">criado!</span>';
    }

  }

}
