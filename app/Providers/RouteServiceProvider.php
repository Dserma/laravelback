<?php

namespace App\Providers;

use App\Models\Backend\User;
use App\Models\Backend\Cotas\Cota;
use App\Models\Backend\Dicas\Dica;
use Illuminate\Support\Facades\Route;
use App\Models\Backend\Pedidos\Pedido;
use App\Models\Backend\Dicas\Categoria;
use App\Models\Backend\Clientes\Cliente;
use App\Models\Backend\ComoFunciona\Passos;
use App\Models\Backend\Depoimentos\Depoimento;
use App\Models\Backend\Investidores\Investidor;
use App\Models\Backend\Administradoras\Administradora;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
  
  /**
  * This namespace is applied to your controller routes.
  *
  * In addition, it is set as the URL generator's root namespace.
  *
  * @var string
  */
  protected $namespace = 'App\Http\Controllers';
  
  /**
  * Define your route model bindings, pattern filters, etc.
  *
  * @return void
  */
  public function boot()
  {
    //
    
    parent::boot();
    
    Route::bind(
      'usuario',
      function ($handle) {
        return User::Find($handle);
      }
    );

    Route::bind(
      'passo',
      function ($handle) {
        return Passos::find($handle);
      }
    );

    Route::bind(
      'categoria',
      function ($handle) {
        return Categoria::find($handle);
      }
    );

    Route::bind(
      'dica',
      function ($handle) {
        return Dica::find($handle);
      }
    );

    Route::bind(
      'dicaslug',
      function ($handle) {
        return Dica::where('slug', $handle)
        ->first();
      }
    );

    Route::bind(
      'categoriaslug',
      function ($handle) {
        return Categoria::where('slug', $handle)
        ->first();
      }
    );

    Route::bind(
      'administradora',
      function ($handle) {
        return Administradora::find($handle);
      }
    );

    Route::bind(
      'cota',
      function ($handle) {
        return Cota::find($handle);
      }
    );

    Route::bind(
      'depoimento',
      function ($handle) {
        return Depoimento::find($handle);
      }
    );

    Route::bind(
      'investidor',
      function ($handle) {
        return Investidor::find($handle);
      }
    );

    Route::bind(
      'pedido',
      function ($handle) {
        return Pedido::find($handle);
      }
    );

    Route::bind(
      'cliente',
      function ($handle) {
        return Cliente::find($handle);
      }
    );

  }
  
  /**
  * Define the routes for the application.
  *
  * @return void
  */
  public function map()
  {
    $this->mapApiRoutes();
    $this->mapWebRoutes();
    
    //
  }
  
  /**
  * Define the "web" routes for the application.
  *
  * These routes all receive session state, CSRF protection, etc.
  *
  * @return void
  */
  protected function mapWebRoutes()
  {
    Route::group(
      [
        'middleware' => 'web',
        'namespace' => $this->namespace,
      ],
      function () {
        // Default
        include base_path('routes/web.php');
        include base_path('routes/backend/app.php');
        include base_path('routes/backend/como-funciona.php');
        include base_path('routes/backend/seja-nosso-parceiro.php');
        include base_path('routes/backend/dicas.php');
        include base_path('routes/backend/localizacao.php');
        include base_path('routes/backend/fale-conosco.php');
        include base_path('routes/backend/administradoras.php');
        include base_path('routes/backend/cotas.php');
        include base_path('routes/backend/simulacao.php');
        include base_path('routes/backend/depoimentos.php');
        include base_path('routes/backend/sobre-nos.php');
        include base_path('routes/backend/consorcio-novo.php'); 
        include base_path('routes/backend/banners.php');
        include base_path('routes/backend/investidores.php');
        include base_path('routes/backend/home.php');
        include base_path('routes/backend/pedidos.php');
        include base_path('routes/backend/clientes.php');
        include base_path('routes/backend/configuracoes-tema.php');
        include base_path('routes/backend/usuarios.php');
      }
    );
  }
  
  /**
  * Define the "api" routes for the application.
  *
  * These routes are typically stateless.
  *
  * @return void
  */
  protected function mapApiRoutes()
  {
    Route::prefix('api')
    ->middleware('api')
    ->namespace($this->namespace)
    ->group(base_path('routes/api.php'));
  }
  
}