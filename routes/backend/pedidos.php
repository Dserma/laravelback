<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/pedidos'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.pedidos',
      'uses' => 'Backend\Pedidos\PedidosController@Index'
    ]);

    Route::get('/getpedidos', [
      'as' => 'backend.pedidos.getpedidos',
      'uses' => 'Backend\Pedidos\PedidosController@Getpedidos'
    ]);

    Route::get('/getpedidosaprovados', [
      'as' => 'backend.pedidos.getpedidosaprovados',
      'uses' => 'Backend\Pedidos\PedidosController@GetpedidosAprovados'
    ]);
          
    Route::get('/getpedidosrecusados', [
      'as' => 'backend.pedidos.getpedidosrecusados',
      'uses' => 'Backend\Pedidos\PedidosController@GetpedidosRecusados'
    ]);
          
    Route::get('/pedidos/{pedido}', [
      'as' => 'backend.pedidos.pedido',
      'uses' => 'Backend\Pedidos\PedidosController@Editar'
    ]);

    Route::get('/pedidos/aprovado/{pedido}', [
      'as' => 'backend.pedidos.pedido.aprovado',
      'uses' => 'Backend\Pedidos\PedidosController@EditarAprovado'
    ]);

    Route::post('/pedidos/aprovado/{pedido}/salvar', [
      'as' => 'backend.pedido.aprovado.salvar',
      'uses' => 'Backend\Pedidos\PedidosController@SalvarAprovado'
    ]);

    Route::post('/pedidos', [
      'as' => 'backend.pedidos.recusar',
      'uses' => 'Backend\Pedidos\PedidosController@Recusar'
    ]);

    Route::post('/pedidos/motivo/{pedido}', [
      'as' => 'backend.pedidos.pedido.motivo',
      'uses' => 'Backend\Pedidos\PedidosController@Motivo'
    ]);

    Route::post('/pedidos/aprova', [
      'as' => 'backend.pedidos.aprova',
      'uses' => 'Backend\Pedidos\PedidosController@Aprovar'
    ]);

    Route::delete('/pedidos/{pedido}', [
      'as' => 'backend.pedido.apagar',
      'uses' => 'Backend\Pedidos\PedidosController@Apagar'
    ]);

    
  });
            