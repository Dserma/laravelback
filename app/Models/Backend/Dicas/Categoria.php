<?php

namespace App\Models\Backend\Dicas;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;

class Categoria extends Model
{
  use Sluggable;
  use LogsActivity;
  
  protected $fillable = ['nome', 'slug'];
  protected static $logName = 'Categoria';
  protected static $logFillable = true;
  
  function dicas(){
    return $this->belongsToMany('App\Models\Backend\Dicas\Dica');
  }
  
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'nome'
        ]
      ];
    }

    public function getDescriptionForEvent(string $eventName): string
    {
      return trans('log.' .$eventName);
    }
    
  }