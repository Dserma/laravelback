<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SemImagem implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      $n = explode('/', $value);
      $name = end($n);
      return $name != 'sem-imagem.png';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O campo ':attribute' é obrigatório! Por favor, selecione uma imagem.<br>";
    }
}
