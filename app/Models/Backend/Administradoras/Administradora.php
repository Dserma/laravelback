<?php

namespace App\Models\Backend\Administradoras;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Administradora extends Model
{
  
  use LogsActivity;

  protected $fillable = [
    'nome',
    'imagem',
  ];

  protected static $logName = 'Administradoras';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }

  function cotas(){
    return $this->hasMany('App\Models\Backend\Cotas\Cota');
  }

}
