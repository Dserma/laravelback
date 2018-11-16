<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AppController extends Controller {

    function index() {
      if (Auth::check()) {
        return response()->redirectTo(route('backend.home'));
      }else{
        return response()->redirectTo(route('backend.form'));
      }
    }

}