<?php

namespace App\Models\Backend\Cotas;

use Illuminate\Database\Eloquent\Model;

class PaginaCotas extends Model
{
  protected $fillable = [
    'titulo',
    'subtitulo'
  ];
}
