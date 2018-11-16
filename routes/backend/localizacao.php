<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/localizacao'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.localizacao',
      'uses' => 'Backend\Localizacao\LocalizacaoController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.localizacao.salvar',
      'uses' => 'Backend\Localizacao\LocalizacaoController@Salvar'
    ]);
  });
            