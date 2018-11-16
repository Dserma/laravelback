<?php

namespace App\Models\Backend\FaleConosco;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FaleConosco extends Model
{

  use LogsActivity;

  protected $table = 'fale_conosco';
  protected $fillable = [
    'legenda',
    'icone_atendimento',
    'atendimento',
    'icone_email',
    'email',
    'icone_parceiro',
    'parceiro',
  ];

  protected static $logName = 'Fale Conosco';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }
}
