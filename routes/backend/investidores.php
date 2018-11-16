<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/investidores'
], function() {
  
  Route::get('/', [
    'as' => 'backend.investidores',
    'uses' => 'Backend\Investidores\InvestidoresController@Index'
  ]);
      
  Route::post('/investidor', [
    'as' => 'backend.investidores.adicionar',
    'uses' => 'Backend\Investidores\InvestidoresController@Adicionar'
  ]);

  Route::get('/getinvestidores', [
    'as' => 'backend.investidores.getinvestidores',
    'uses' => 'Backend\Investidores\InvestidoresController@Getinvestidores'
  ]);
        
  Route::get('/investidor/{investidor}', [
    'as' => 'backend.investidores.investidor',
    'uses' => 'Backend\Investidores\InvestidoresController@Editar'
  ]);
          
  Route::put('/investidor', [
    'as' => 'backend.investidores.salvar',
    'uses' => 'Backend\Investidores\InvestidoresController@Salvar'
  ]);
            
  Route::delete('/investidor/{investidor}', [
    'as' => 'backend.investidor.apagar',
    'uses' => 'Backend\Investidores\InvestidoresController@Apagar'
  ]);

});