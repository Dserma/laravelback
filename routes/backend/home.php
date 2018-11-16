<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/index'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.home.index',
      'uses' => 'Backend\Index\IndexController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.home.salvar',
      'uses' => 'Backend\Index\IndexController@Salvar'
    ]);
  });
            