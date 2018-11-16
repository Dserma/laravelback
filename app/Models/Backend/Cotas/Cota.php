<?php

namespace App\Models\Backend\Cotas;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Cota extends Model
{
  
  use LogsActivity;

  protected $fillable = [
    'tipo',
    'administradora_id',
    'investidor_id',
    'valor_investidor',
    'credito',
    'entrada',
    'juros',
    'status',
    'destaque',
    'infos',
    'entrada_opicional',
    'grupo',
    'cota',
  ];

  protected static $logName = 'Cotas';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string{
    return trans('log.' .$eventName);
  }

  function administradora(){
    return $this->belongsTo('App\Models\Backend\Administradoras\Administradora');
  }

  function investidores(){
    return $this->belongsToMany('App\Models\Backend\Investidores\Investidor');
  }

  function parcelas(){
    return $this->hasMany('App\Models\Backend\Cotas\ParcelasCota');
  }

  function cotas(){
    return $this->hasMany('App\Models\Backend\Cotas\ItemAgrupado', 'cota_pai_id', 'id');
  }

  function pedidos(){
    return $this->hasMany('App\Models\Backend\Pedidos\Pedido', 'cota_id', 'id');
  }
  

}
