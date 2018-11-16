<?php

namespace App\Models\Backend\Dicas;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Dica extends Model
{
  use Sluggable;
  
  protected $fillable= [
    'titulo',
    'imagem',
    'resumo',
    'conteudo',
    'slug'
  ];

  function categorias(){
    return $this->belongsToMany('App\Models\Backend\Dicas\Categoria');
  }
  
  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'titulo'
        ]
      ];
    }
    
  }
  