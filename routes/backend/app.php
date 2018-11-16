<?php

Route::group([ 
  'middleware' => 'auth',
  'prefix' => '/backend'
], function()
{
  Route::get('/home', [
    'as' => 'backend.home',
    'uses' => 'Backend\HomeController@index'
  ]);
    
  Route::get('/sair', [
    'as' => 'sair',
    'uses' => 'Backend\LoginController@Sair'
  ]);

  Route::post('/upload', [
    'as' => 'backend.ajax.upload',
    'uses' => 'Backend\ImageController@Upload'
  ]);

  Route::post('/load', [
    'as' => 'backend.ajax.load',
    'uses' => 'Backend\ImageController@Load'
  ]);
      
  Route::delete('/delete', [
    'as' => 'backend.ajax.delete',
    'uses' => 'Backend\ImageController@Delete'
  ]);

  Route::get('/log', [
    'as' => 'backend.log',
    'uses' => 'Backend\LogController@Index'
  ]);

  Route::get('/getlog', [
    'as' => 'backend.log.getlog',
    'uses' => 'Backend\LogController@GetLog'
  ]);
      
});
