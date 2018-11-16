<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Cotas\Cota;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pedidos\Pedido;
use App\Models\Backend\Simulacao\Simulacao;
use DateTime;


class HomeController extends Controller {

    function index(Request $request) {
      $date = new DateTime();
      $date->modify("-30 day");
      $inicio = $date->format("Y-m-d H:i:s");
      $this->log::whereBetween('created_at', [$inicio, now()])->delete();
      $cotasImoveis = Cota::where('tipo', 1)->get()->count();
      $cotasAutos = Cota::where('tipo', 2)->get()->count();
      $simulacoes = Simulacao::all()->count();
      $pedidos = Pedido::where('status', '0')->get()->count();
      return view('backend.index')
        ->with('cotasImoveis', $cotasImoveis)
        ->with('cotasAutos', $cotasAutos)
        ->with('pedidos', $pedidos)
        ->with('simulacoes', $simulacoes);
    }

}