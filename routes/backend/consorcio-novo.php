<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/consorcio-novo'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.consorcio-novo',
      'uses' => 'Backend\ConsorcioNovo\ConsorcioNovoController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.consorcio-novo.salvar',
      'uses' => 'Backend\ConsorcioNovo\ConsorcioNovoController@Salvar'
    ]);
  });
            