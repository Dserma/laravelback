<?php

  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/simulacao'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.simulacao',
      'uses' => 'Backend\Simulacao\PaginaController@Index'
    ]);

    Route::post('/', [
      'as' => 'backend.simulacao.salvar',
      'uses' => 'Backend\Simulacao\PaginaController@Salvar'
    ]);

    Route::get('/obrigado', [
      'as' => 'backend.simulacao.obrigado',
      'uses' => 'Backend\Simulacao\PaginaObrigadoController@Index'
    ]);

    Route::post('/obrigado', [
      'as' => 'backend.simulacao.obrigado.salvar',
      'uses' => 'Backend\Simulacao\PaginaObrigadoController@Salvar'
    ]);

  });
            
  Route::group([
    'middleware' => 'auth',
    'prefix' => '/backend/simulacoes'
  ], function() {
  
    Route::get('/', [
      'as' => 'backend.simulacoes',
      'uses' => 'Backend\Simulacao\SimulacaoController@Index'
    ]);
        
    Route::get('/getsimulacoes', [
      'as' => 'backend.simulacoes.getsimulacoes',
      'uses' => 'Backend\Simulacao\SimulacaoController@Getsimulacoes'
    ]);
          
    Route::get('/simulacoes/{simulacao}', [
      'as' => 'backend.simulacoes.simulacao',
      'uses' => 'Backend\Simulacao\SimulacaoController@Editar'
    ]);
            
    Route::delete('/simulacoes/{simulacao}', [
      'as' => 'backend.simulacoes.apagar',
      'uses' => 'Backend\Simulacao\SimulacaoController@Apagar'
    ]);

  });
            