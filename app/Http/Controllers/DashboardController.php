<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
  public function index(){
    //return redirect()->route('dashboard.pe');
    if(return_role_adequat(env('ID_ROLE_MEMBRE_COMITE_FP'))){
        return redirect()->route('preprojet.soumis_au_comite_fp');
    }
    elseif(return_role_adequat(env('ID_ROLE_MEMBRE_COMITE_PE'))){
      return redirect()->route('preprojet.soumis_au_comite_pe');
    }
    elseif(return_role_adequat(env('ID_ROLE_CONSEILLER_PE'))|| return_role_adequat(env('ID_ROLE_RESPONSABLE_PE'))){
        return redirect()->route('dashboard.pe');
    }
    elseif(return_role_adequat(env('ID_ROLE_CONSEILLER_FP')) || return_role_adequat(env('ID_ROLE_RESPONSABLE_FP'))){
      return redirect()->route('dashboard.fp');
    
    }
    else{
        return redirect()->route('dashboard.fp');
    }
      
  }
  public function dashboard_fp(){
    if (Auth::user()->can('acceder_au_dashboard_du_fp')) {
      return view('dashboard.dashboard_fp');
    }
  }
  public function dashboard_pe(){
    if (Auth::user()->can('acceder_au_dashboard_du_pe')) {
    return view('dashboard.dashborad_pe');
    }
    else{
      return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
    }

  }
}
