<?php
Route::group([
  'middleware' => ['cors','auth'],
  'prefix' => '/backend/dicas'
], function() {
  
  /** PÁGINA  */
  Route::get('/pagina', [
    'as' => 'backend.dicas.pagina',
    'uses' => 'Backend\Dicas\PaginaController@Index'
  ]);
  
  Route::post('/pagina', [
    'as' => 'backend.dicas.pagina.salvar',
    'uses' => 'Backend\Dicas\PaginaController@Salvar'
  ]);

  /** CATEGORIAS  */
  
  Route::get('/categorias', [
    'as' => 'backend.dicas.categorias',
    'uses' => 'Backend\Dicas\CategoriaController@Index'
  ]);
      
  Route::post('/categoria', [
    'as' => 'backend.dicas.categorias.adicionar',
    'uses' => 'Backend\Dicas\CategoriaController@Adicionar'
  ]);

  Route::get('/getcategorias', [
    'as' => 'backend.dicas.categorias.getcategorias',
    'uses' => 'Backend\Dicas\CategoriaController@GetCategorias'
  ]);
        
  Route::get('/categoria/{categoria}', [
    'as' => 'backend.dicas.categorias.categoria',
    'uses' => 'Backend\Dicas\CategoriaController@Editar'
  ]);
          
  Route::put('/categoria', [
    'as' => 'backend.dicas.categorias.salvar',
    'uses' => 'Backend\Dicas\CategoriaController@Salvar'
  ]);
            
  Route::delete('/categoria/{categoria}', [
    'as' => 'backend.dicas.categoria.apagar',
    'uses' => 'Backend\Dicas\CategoriaController@Apagar'
  ]);

  /** DICAS */

  Route::get('/', [
    'as' => 'backend.dicas',
    'uses' => 'Backend\Dicas\DicaController@Index'
  ]);

  Route::get('/getdicas', [
    'as' => 'backend.dicas.getdicas',
    'uses' => 'Backend\Dicas\DicaController@GetDicas'
  ]);

  Route::post('/dica', [
    'as' => 'backend.dicas.adicionar',
    'uses' => 'Backend\Dicas\DicaController@Adicionar'
  ]);

  Route::get('/dica/{dica}', [
    'as' => 'backend.dicas.dica',
    'uses' => 'Backend\Dicas\DicaController@Editar'
  ]);
          
  Route::put('/dica', [
    'as' => 'backend.dicas.salvar',
    'uses' => 'Backend\Dicas\DicaController@Salvar'
  ]);
            
  Route::delete('/dica/{dica}', [
    'as' => 'backend.dicas.apagar',
    'uses' => 'Backend\Dicas\DicaController@Apagar'
    ]);

});
            