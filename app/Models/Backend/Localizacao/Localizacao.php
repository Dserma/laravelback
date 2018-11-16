<?php

namespace App\Models\Backend\Localizacao;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Localizacao extends Model
{
  use LogsActivity;
  
  protected $fillable = [
    'legenda',
    'mapa',
    'latitude',
    'longitude',
    'endereco'
  ];

  protected static $logName = 'Localização';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName). ";O item :subject foi " .trans('log.action.' .$eventName);
  }

}
