<?php

namespace App\Models\Backend\Simulacao;

use Illuminate\Database\Eloquent\Model;

class PaginaSimulacao extends Model
{
  
  protected $table = 'pagina_simulacao';
  protected $fillable = [
    'legenda',
    'titulo',
    'subtitulo',
  ];

}
