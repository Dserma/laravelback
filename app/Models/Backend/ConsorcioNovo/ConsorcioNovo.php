<?php

namespace App\Models\Backend\ConsorcioNovo;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ConsorcioNovo extends Model
{
  use LogsActivity;

  protected $table = 'consorcio_novos';
  protected $fillable = [
    'legenda',
    'conteudo',
    'imagem',
    'icone_vantagem',
    'vantagem',
  ];

  protected static $logName = 'Consórcio Novo';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }
}
