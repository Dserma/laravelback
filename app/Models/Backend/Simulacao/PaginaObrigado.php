<?php

namespace App\Models\Backend\Simulacao;

use Illuminate\Database\Eloquent\Model;

class PaginaObrigado extends Model
{
  protected $table = 'pagina_obrigado';
  protected $fillable = [
    'legenda',
    'titulo',
    'subtitulo',
  ];
}
