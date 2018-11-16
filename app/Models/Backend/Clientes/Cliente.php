<?php

namespace App\Models\Backend\Clientes;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  
  protected $guarded = ['id'];

  public function pedidos(){
    return $this->hasMany('App\Models\Backend\Pedidos\Pedido');
  }

}
