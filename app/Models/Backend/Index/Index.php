<?php

namespace App\Models\Backend\Index;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
  protected $table = 'index';
  protected $fillable = [
    'conteudo',
    'imagem',
    'icone_oferecemos',
    'oferecemos'
  ];
}
