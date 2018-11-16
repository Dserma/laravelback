<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/seja-nosso-parceiro'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.parceiro',
      'uses' => 'Backend\SejaNossoParceiro\PaginaController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.parceiro.salvar',
      'uses' => 'Backend\SejaNossoParceiro\PaginaController@Salvar'
    ]);
  });
            