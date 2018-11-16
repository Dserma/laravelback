<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/administradoras'
], function() {
  
  Route::get('/', [
    'as' => 'backend.administradoras',
    'uses' => 'Backend\Administradoras\AdministradorasController@Index'
  ]);
      
  Route::post('/administradora', [
    'as' => 'backend.administradoras.adicionar',
    'uses' => 'Backend\Administradoras\AdministradorasController@Adicionar'
  ]);

  Route::get('/getadministradoras', [
    'as' => 'backend.administradoras.getadministradoras',
    'uses' => 'Backend\Administradoras\AdministradorasController@Getadministradoras'
  ]);
        
  Route::get('/administradora/{administradora}', [
    'as' => 'backend.administradoras.administradora',
    'uses' => 'Backend\Administradoras\AdministradorasController@Editar'
  ]);
          
  Route::put('/administradora', [
    'as' => 'backend.administradoras.salvar',
    'uses' => 'Backend\Administradoras\AdministradorasController@Salvar'
  ]);
            
  Route::delete('/administradora/{administradora}', [
    'as' => 'backend.administradora.apagar',
    'uses' => 'Backend\Administradoras\AdministradorasController@Apagar'
  ]);

});