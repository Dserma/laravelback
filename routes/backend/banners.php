<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/banners'
], function() {
  
  Route::get('/', [
    'as' => 'backend.banners',
    'uses' => 'Backend\Banners\BannersController@Index'
  ]);
      
  Route::post('/banner', [
    'as' => 'backend.banners.adicionar',
    'uses' => 'Backend\Banners\BannersController@Adicionar'
  ]);

  Route::get('/getbanners', [
    'as' => 'backend.banners.getbanners',
    'uses' => 'Backend\Banners\BannersController@Getbanners'
  ]);
        
  Route::get('/banner/{banner}', [
    'as' => 'backend.banners.banner',
    'uses' => 'Backend\Banners\BannersController@Editar'
  ]);
          
  Route::put('/banner', [
    'as' => 'backend.banners.salvar',
    'uses' => 'Backend\Banners\BannersController@Salvar'
  ]);
            
  Route::delete('/banner/{banner}', [
    'as' => 'backend.banner.apagar',
    'uses' => 'Backend\Banners\BannersController@Apagar'
  ]);

});