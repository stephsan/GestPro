<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(){
    if(return_role_adequat(env('ID_ROLE_MEMBRE_COMITE'))){
        return redirect()->route('preprojet.soumis_au_comite_fp');
    }
    else{
        return view('dashboard.dashboard_fp');
    }
      
  }
}
