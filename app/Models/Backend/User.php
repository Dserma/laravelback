<?php

namespace App\Models\Backend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
  
	/**
  * The attributes that are mass assignable.
  *
  * @var array
  */
	protected $fillable = [
		'nome', 'usuario', 'senha', 'email',
	];
  
	/**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
	protected $hidden = [
		'senha', 'remember_token',
	];
  
  public function getAuthPassword() {
    return $this->senha;
  }
}