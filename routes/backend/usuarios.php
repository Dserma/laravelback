<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/usuarios'
], function() {
  
  Route::get('/', [
    'as' => 'backend.usuarios',
    'uses' => 'Backend\Usuarios\UsuariosController@Index'
  ]);
      
  Route::post('/usuario', [
    'as' => 'backend.usuarios.adicionar',
    'uses' => 'Backend\Usuarios\UsuariosController@Adicionar'
  ]);

  Route::get('/getusuarios', [
    'as' => 'backend.usuarios.getusuarios',
    'uses' => 'Backend\Usuarios\UsuariosController@Getusuarios'
  ]);
        
  Route::get('/usuario/{usuario}', [
    'as' => 'backend.usuarios.usuario',
    'uses' => 'Backend\Usuarios\UsuariosController@Editar'
  ]);
          
  Route::put('/usuario', [
    'as' => 'backend.usuarios.salvar',
    'uses' => 'Backend\Usuarios\UsuariosController@Salvar'
  ]);
            
  Route::delete('/usuario/{usuario}', [
    'as' => 'backend.usuario.apagar',
    'uses' => 'Backend\Usuarios\UsuariosController@Apagar'
  ]);

});