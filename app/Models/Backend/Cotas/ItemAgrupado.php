<?php

namespace App\Models\Backend\Cotas;

use Illuminate\Database\Eloquent\Model;

class ItemAgrupado extends Model
{
  
  protected $table = 'itens_agrupados';
  protected $fillable = ['cota_pai_id', 'cota_id'];

  function cotaPai(){
    return $this->belongsTo('App\Models\Backend\Cotas\Cota', 'cota_pai_id', 'id');
  }

}
