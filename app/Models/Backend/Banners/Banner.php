<?php

namespace App\Models\Backend\Banners;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Banner extends Model
{
  use LogsActivity;

  protected $fillable = [
    'titulo',
    'imagem',
    'conteudo',
    'botao',
    'link',
  ];

  protected static $logName = 'Banners';
  protected static $logFillable = true;
  protected static $logOnlyDirty = true;

  public function getDescriptionForEvent(string $eventName): string
  {
    return trans('log.' .$eventName);
  }

}
