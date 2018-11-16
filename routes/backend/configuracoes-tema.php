<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/configuracoes-tema'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.configuracoes-tema',
      'uses' => 'Backend\ConfiguracoesTema\ConfiguracoesTemaController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.configuracoes-tema.salvar',
      'uses' => 'Backend\ConfiguracoesTema\ConfiguracoesTemaController@Salvar'
    ]);
  });
            