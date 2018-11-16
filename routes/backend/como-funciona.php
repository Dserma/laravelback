<?php
Route::group([
  'middleware' => 'auth',
  'prefix' => '/backend/como-funciona'
], function() {
  
  Route::get('/passos', [
    'as' => 'backend.como.passos',
    'uses' => 'Backend\ComoFunciona\PassosController@Index'
  ]);

  Route::get('/getpassos', [
    'as' => 'backend.como.getpassos',
    'uses' => 'Backend\ComoFunciona\PassosController@GetPassos'
  ]);
    
  Route::get('/novo-passo', [
    'as' => 'backend.como.passos.novo',
    'uses' => 'Backend\ComoFunciona\PassosController@Novo'
  ]);
      
  Route::post('/novo-passo', [
    'as' => 'backend.como.passos.adicionar',
    'uses' => 'Backend\ComoFunciona\PassosController@Adicionar'
  ]);
        
  Route::get('/passo/{passo}', [
    'as' => 'backend.como.passos.passo',
    'uses' => 'Backend\ComoFunciona\PassosController@Editar'
  ]);
          
  Route::put('/passo', [
    'as' => 'backend.como.passos.salvar',
    'uses' => 'Backend\ComoFunciona\PassosController@Salvar'
  ]);
            
  Route::delete('/passo/{passo}', [
    'as' => 'backend.como.passos.apagar',
    'uses' => 'Backend\ComoFunciona\PassosController@Apagar'
    ]);

});
            