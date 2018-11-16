<?php

namespace App\Models\Backend\Simulacao;

use Illuminate\Database\Eloquent\Model;

class Simulacao extends Model
{
  
  protected $table = 'simulacoes';
  protected $fillable = [
    'nome',
    'telefone',
    'celular',
    'email',
    'tipo',
    'credito',
    'valor_parcela',
    'entrada',
    'status',
  ];

}
