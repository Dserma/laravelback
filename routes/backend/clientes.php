<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/clientes'
], function() {
  
  Route::get('/', [
    'as' => 'backend.clientes',
    'uses' => 'Backend\Clientes\ClientesController@Index'
  ]);
      
  Route::post('/cliente', [
    'as' => 'backend.clientes.adicionar',
    'uses' => 'Backend\Clientes\ClientesController@Adicionar'
  ]);

  Route::get('/getclientes', [
    'as' => 'backend.clientes.getclientes',
    'uses' => 'Backend\Clientes\ClientesController@GetClientes'
  ]);
        
  Route::get('/cliente/{cliente}', [
    'as' => 'backend.clientes.cliente',
    'uses' => 'Backend\Clientes\ClientesController@Editar'
  ]);

  Route::put('/cliente', [
    'as' => 'backend.clientes.salvar',
    'uses' => 'Backend\Clientes\ClientesController@Salvar'
  ]);
            
  Route::delete('/cliente/{cliente}', [
    'as' => 'backend.cliente.apagar',
    'uses' => 'Backend\Clientes\ClientesController@Apagar'
  ]);

});