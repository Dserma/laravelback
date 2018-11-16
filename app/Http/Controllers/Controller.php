<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\Handler;
use Spatie\Activitylog\Traits\LogsActivity;
use Mail;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        Handler,
        LogsActivity;

    protected function geraErros($validator){
      foreach( $validator->errors()->all() as $e ){
        $erros[] = $e;
      }
      return response()->json($erros);
    }
}
