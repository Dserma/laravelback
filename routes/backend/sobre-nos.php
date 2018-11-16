<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/sobre-nos'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.sobre-nos',
      'uses' => 'Backend\SobreNos\SobreNosController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.sobre-nos.salvar',
      'uses' => 'Backend\SobreNos\SobreNosController@Salvar'
    ]);
  });
            