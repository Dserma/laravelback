<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/depoimentos'
], function() {
  
  Route::get('/', [
    'as' => 'backend.depoimentos',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Index'
  ]);
      
  Route::post('/depoimento', [
    'as' => 'backend.depoimentos.adicionar',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Adicionar'
  ]);

  Route::get('/getdepoimentos', [
    'as' => 'backend.depoimentos.getdepoimentos',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Getdepoimentos'
  ]);
        
  Route::get('/depoimento/{depoimento}', [
    'as' => 'backend.depoimentos.depoimento',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Editar'
  ]);
          
  Route::put('/depoimento', [
    'as' => 'backend.depoimentos.salvar',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Salvar'
  ]);
            
  Route::delete('/depoimento/{depoimento}', [
    'as' => 'backend.depoimento.apagar',
    'uses' => 'Backend\Depoimentos\DepoimentosController@Apagar'
  ]);

});