<?php

namespace App\Models\Backend\Dicas;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PaginaDica extends Model
{

  use LogsActivity;

  protected $fillable = ['legenda'];
  protected static $logName = 'Página Dicas';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }
}
