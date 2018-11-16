<?php

namespace App\Models\Backend\Depoimentos;

use Illuminate\Database\Eloquent\Model;

class Depoimento extends Model
{
  protected $fillable = [
    'autor',
    'conteudo'
  ];
}
