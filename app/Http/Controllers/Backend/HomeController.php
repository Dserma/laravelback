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
      return view('backend.index');
    }

}