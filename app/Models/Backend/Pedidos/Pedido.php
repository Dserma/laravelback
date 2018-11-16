<?php

namespace App\Models\Backend\Pedidos;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
  
  protected $fillable = [
    'tipo',
    'cota_id',
    'nome',
    'telefone',
    'celular',
    'email',
    'status',
    'data_aprovacao',
    'data_rejeicao',
    'motivo_rejeicao',
  ];

  protected $dates = [
    'data_aprovacao',
    'data_rejeicao',
    'data_sinal',
    'data_pagamento_final',
    'data_entrega_transferencia',
  ];

  public function cota(){
    return $this->belongsTo('App\Models\Backend\Cotas\Cota', 'cota_id', 'id');
  }

  public function cliente(){
    return $this->belongsTo('App\Models\Backend\Clientes\Cliente');
  }
}
