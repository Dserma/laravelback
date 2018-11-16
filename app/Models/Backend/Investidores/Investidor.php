<?php

namespace App\Models\Backend\Investidores;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Investidor extends Model
{
  use LogsActivity;

  protected $table = 'investidores';

  protected $fillable = [
    'nome',
    'codigo'
  ];

  protected static $logName = 'Investidores';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string{
    return trans('log.' .$eventName);
  }

  function cotas(){
    return $this->belongsToMany('App\Models\Backend\Cotas\Cota');
  }

}
