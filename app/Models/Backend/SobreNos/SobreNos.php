<?php

namespace App\Models\Backend\SobreNos;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SobreNos extends Model
{
  use LogsActivity;

  protected $table = 'sobrenos';
  protected $fillable = [
    'legenda',
    'conteudo',
    'imagem',
    'icone_missao',
    'missao',
    'icone_visao',
    'visao',
    'icone_valores',
    'valores',
  ];

  protected static $logName = 'Sobre Nós';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }

}
