<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/fale-conosco'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.fale-conosco',
      'uses' => 'Backend\FaleConosco\FaleConoscoController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.fale-conosco.salvar',
      'uses' => 'Backend\FaleConosco\FaleConoscoController@Salvar'
    ]);
  });
            