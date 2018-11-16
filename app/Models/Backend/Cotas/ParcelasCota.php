<?php

namespace App\Models\Backend\Cotas;

use Illuminate\Database\Eloquent\Model;

class ParcelasCota extends Model
{

  protected $fillable = [
    'cota_id',
    'parcelas',
    'valor_parcela'
  ];

  function cota(){
    return $this->belongsTo('App\Models\Backend\Cotas\Cota');
  }

}
