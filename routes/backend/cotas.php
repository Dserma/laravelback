<?php
Route::group([
  'middleware' => ['auth'],
  'prefix' => '/backend/cotas'
], function() {
  
  Route::get('/imoveis', [
    'as' => 'backend.cotas.imoveis',
    'uses' => 'Backend\Cotas\CotasController@Index'
  ]);
      
  Route::get('/automoveis', [
    'as' => 'backend.cotas.automoveis',
    'uses' => 'Backend\Cotas\CotasController@Index'
  ]);
      
  Route::post('/cota', [
    'as' => 'backend.cotas.adicionar',
    'uses' => 'Backend\Cotas\CotasController@Adicionar'
  ]);

  Route::post('/cota/agrupamento', [
    'as' => 'backend.cotas.agrupamento.adicionar',
    'uses' => 'Backend\Cotas\CotasController@AdicionarAgrupamento'
  ]);
  
  Route::post('/agrupa', [
    'as' => 'backend.cotas.agrupar',
    'uses' => 'Backend\Cotas\CotasController@Agrupar'
  ]);

  Route::get('/getcotas', [
    'as' => 'backend.cotas.getcotas',
    'uses' => 'Backend\Cotas\CotasController@GetCotas'
  ]);
        
  Route::get('/getcotasagrupadas', [
    'as' => 'backend.cotas.getcotasagrupadas',
    'uses' => 'Backend\Cotas\CotasController@GetCotasAgrupadas'
  ]);
        
  Route::get('/cota/{cota}', [
    'as' => 'backend.cotas.cota',
    'uses' => 'Backend\Cotas\CotasController@Editar'
  ]);

  Route::get('/cota/agrupada/{cota}', [
    'as' => 'backend.cotas.cota.agrupada',
    'uses' => 'Backend\Cotas\CotasController@EditarAgrupada'
  ]);
          
  Route::put('/cota', [
    'as' => 'backend.cotas.salvar',
    'uses' => 'Backend\Cotas\CotasController@Salvar'
  ]);
            
  Route::delete('/cota/{cota}', [
    'as' => 'backend.cota.apagar',
    'uses' => 'Backend\Cotas\CotasController@Apagar'
  ]);

  Route::delete('/agrupada/removecota', [
    'as' => 'backend.cota.agrupada.remover',
    'uses' => 'Backend\Cotas\CotasController@RemoveAgrupada'
  ]);

  Route::delete('/agrupada/{cota}', [
    'as' => 'backend.cota.agrupada.apagar',
    'uses' => 'Backend\Cotas\CotasController@ApagarAgrupada'
  ]);

  Route::delete('/cotas', [
    'as' => 'backend.cotas.apagalote',
    'uses' => 'Backend\Cotas\CotasController@ApagarLote'
  ]);
  
  Route::get('/imprimir/imoveis', [
    'as' => 'backend.cotas.imprimir.imoveis',
    'uses' => 'Backend\Cotas\CotasController@ImprimirImoveis'
  ]);

  Route::get('/imprimir/automoveis', [
    'as' => 'backend.cotas.imprimir.automoveis',
    'uses' => 'Backend\Cotas\CotasController@ImprimirAutomoveis'
  ]);

  Route::get('/vender/{cota}', [
    'as' => 'backend.cota.vender',
    'uses' => 'Backend\Cotas\CotasController@Vender'
  ]);

  Route::post('/venda', [
    'as' => 'backend.cota.venda',
    'uses' => 'Backend\Pedidos\PedidosController@CriaPedido'
  ]);

  Route::get('/infos/{cota}', [
    'as' => 'backend.cota.infos',
    'uses' => 'Backend\Cotas\CotasController@Infos'
  ]);

  Route::post('/infos/salvar', [
    'as' => 'backend.cota.infos.salvar',
    'uses' => 'Backend\Cotas\CotasController@SalvarInfos'
  ]);

  Route::post('/destaque/{cota}', [
    'as' => 'backend.cotas.destaque',
    'uses' => 'Backend\Cotas\CotasController@Destaque'
  ]);

  Route::get('/cota/{cota}/cota-grupo', [
    'as' => 'backend.cota.cota-grupo',
    'uses' => 'Backend\Cotas\CotasController@CotaGrupo'
  ]);

  Route::put('/cota/cota-grupo', [
    'as' => 'backend.cota.cota-grupo.salvar',
    'uses' => 'Backend\Cotas\CotasController@SalvaCotaGrupo'
  ]);

  /** PAGINAS */

  Route::get('/pagina-imoveis', [
    'as' => 'backend.cotas.pagina.imoveis',
    'uses' => 'Backend\Cotas\PaginaController@IndexImoveis'
  ]);

  Route::get('/pagina-automoveis', [
    'as' => 'backend.cotas.pagina.automoveis',
    'uses' => 'Backend\Cotas\PaginaController@IndexAutomoveis'
  ]);

  Route::post('/', [
    'as' => 'backend.cotas.pagina.salvar',
    'uses' => 'Backend\Cotas\PaginaController@Salvar'
  ]);

  Route::get('/compramos', [
    'as' => 'backend.cotas.compramos',
    'uses' => 'Backend\Cotas\CompramosController@Index'
  ]);

  Route::post('/compramos', [
    'as' => 'backend.cotas.compramos.salvar',
    'uses' => 'Backend\Cotas\CompramosController@Salvar'
  ]);

});