<?php

namespace App\Models\Backend\ComoFunciona;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Passos extends Model
{
  use Sluggable;

  protected $fillable = [
    'nome',
    'subtitulo_menu',
    'conteudo',
    'slug'
  ];

  public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nome'
            ]
        ];
    }
}
