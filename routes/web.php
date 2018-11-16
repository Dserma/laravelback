<?php

Route::group([ 
	'prefix' => '/'
], function()
{
  /** BACKEND */
  Route::get('/backend', [
    'as' => 'backend.index',
    'uses' => 'Backend\AppController@index'
    ]);
    
  Route::get('/backend/login', [
    'as' => 'backend.form',
    'uses' => 'Backend\LoginController@Form'
  ]);
      
  Route::post('/backend/login', [
    'as' => 'backend.login',
    'uses' => 'Backend\LoginController@Index'
  ]);

  /** FRONTEND */

  Route::get('/', [
    'as' => 'index',
    'uses' => 'AppController@Index'
  ]);

  Route::get('/sobre-nos', [
    'as' => 'sobre',
    'uses' => 'SobreNosController@Index'
  ]);
        
  Route::get('/como-funciona', [
    'as' => 'como',
    'uses' => 'ComoFuncionaController@Index'
  ]);
        
  Route::get('/seja-nosso-parceiro', [
    'as' => 'parceiro',
    'uses' => 'SejaNossoParceiroController@Index'
  ]);

  Route::get('/dicas', [
    'as' => 'dicas',
    'uses' => 'DicasController@Index'
  ]);
        
  Route::get('/dicas/{dicaslug}', [
    'as' => 'dica-single',
    'uses' => 'DicasController@Single'
  ]);

  Route::get('/dicas/categorias/{categoriaslug}', [
    'as' => 'categoria',
    'uses' => 'DicasController@PorCategoria'
  ]);

  Route::get('/localizacao', [
    'as' => 'localizacao',
    'uses' => 'LocalizacaoController@Index'
  ]);
        
  Route::get('/fale-conosco', [
    'as' => 'fale-conosco',
    'uses' => 'FaleConoscoController@Index'
  ]);
        
  Route::get('/cotas-imoveis', [
    'as' => 'cotas-imoveis',
    'uses' => 'CotasController@IndexImoveis'
  ]);

  Route::get('/cotas-automoveis', [
    'as' => 'cotas-automoveis',
    'uses' => 'CotasController@IndexAutomoveis'
  ]);

  Route::get('/cotas-imoveis/compre/{cota}', [
    'as' => 'cotas-imoveis-compre',
    'uses' => 'CotasController@CompreImoveis'
  ]);
        
  Route::get('/cotas-automoveis/compre/{cota}', [
    'as' => 'cotas-automoveis-compre',
    'uses' => 'CotasController@CompreAutomoveis'
  ]);

  Route::post('/cotas/compre/{cota}', [
    'as' => 'salvar-compra',
    'uses' => 'CotasController@SalvarCompra'
  ]);

  Route::get('/cota/{cota}', [
    'as' => 'cota-info',
    'uses' => 'CotasController@Infos'
  ]);

  Route::get('/cota-mobile/{cota}', [
    'as' => 'cota-info-mobile',
    'uses' => 'CotasController@InfosMobile'
  ]);

  Route::get('/cota/{cota}/infos', [
    'as' => 'cota-infos',
    'uses' => 'CotasController@MaisInfos'
  ]);

  Route::get('/cotas/imoveis/imprimir', [
    'as' => 'cotas.imprimir.imoveis',
    'uses' => 'CotasController@ImprimirImoveis'
  ]);
        
  Route::get('/cotas/veiculos/imprimir', [
    'as' => 'cotas.imprimir.veiculos',
    'uses' => 'CotasController@ImprimirVeiculos'
  ]);
        
  Route::get('/simule', [
    'as' => 'simule',
    'uses' => 'SimulacaoController@Index'
  ]);

  Route::post('/simule/salvar', [
    'as' => 'simulacao-salvar',
    'uses' => 'SimulacaoController@Salvar'
  ]);

  Route::get('/obrigado-simulacao', [
    'as' => 'obrigado-simulacao',
    'uses' => 'SimulacaoController@Obrigado'
  ]);
        
  Route::get('/compramos-sua-cota', [
    'as' => 'compramos',
    'uses' => 'CompramosController@Index'
  ]);
        
  Route::get('/consorcio-novo', [
    'as' => 'novo',
    'uses' => 'ConsorcioNovoController@Index'
  ]);
        
  Route::post('/envia-contato', [
    'as' => 'envia-contato',
    'uses' => 'EmailController@Contato'
  ]);
        
  Route::post('/envia-parceiro', [
    'as' => 'envia-parceiro',
    'uses' => 'EmailController@Parceiro'
  ]);
        
  Route::post('/envia-compramos', [
    'as' => 'envia-compramos',
    'uses' => 'EmailController@Compramos'
  ]);
        


});
      