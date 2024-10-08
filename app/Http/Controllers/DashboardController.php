<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
public function avant_projet_soumis_par_region_et_par_sexe(Request $request){
    $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojets')
                                                ->leftjoin('promoteurs',function($join){
                                                    $join->on('promoteurs.id','=','preprojets.promoteur_id');
                                                })
                                                ->leftjoin('valeurs',function($join){
                                                  $join->on('valeurs.id','=','preprojets.region');
                                                })
                                                ->groupBy('preprojets.region','valeurs.libelle')
                                                ->select('valeurs.libelle as region' ,
                                                        DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                        DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                                ->get();
                                    return json_encode($avant_projet_soumis_par_region_et_par_sexe);
 }
 public function avant_projet_par_region(Request $request){
                        $avant_projet_par_region = DB::table('preprojets')
                                                    ->leftjoin('valeurs',function($join){
                                                      $join->on('valeurs.id','=','preprojets.region');
                                                    })
                                                    ->groupBy('preprojets.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojets.id) as nombre"))
                                                    ->get();
                        return json_encode($avant_projet_par_region);
}
public function avant_projet_par_secteur_dactivite(){
  $avant_projet_par_secteur_dactivite = DB::table('preprojets')
                                    ->leftjoin('valeurs',function($join){
                                      $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                    })
                                    ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                    ->select('valeurs.libelle as secteur_dactivite' ,
                                            DB::raw("count(preprojets.id) as nombre"))
                                    ->get();
                        return json_encode($avant_projet_par_secteur_dactivite);

}
public function avant_projet_soumis_par_region_et_par_sexe_pe(Request $request){
  $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojet_pes')
                                              ->leftjoin('promoteurs',function($join){
                                                  $join->on('promoteurs.id','=','preprojet_pes.promoteur_id');
                                              })
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojet_pes.region');
                                              })
                                              ->groupBy('preprojet_pes.region','valeurs.libelle')
                                              ->select('valeurs.libelle as region' ,
                                                      DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                      DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                              ->get();
                                  return json_encode($avant_projet_soumis_par_region_et_par_sexe);
}
public function avant_projet_par_region_pe(Request $request){
                      $avant_projet_par_region = DB::table('preprojet_pes')
                                                  ->leftjoin('valeurs',function($join){
                                                    $join->on('valeurs.id','=','preprojet_pes.region');
                                                  })
                                                  ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                  ->select('valeurs.libelle as region' ,
                                                          DB::raw("count(preprojet_pes.id) as nombre"))
                                                  ->get();
                      return json_encode($avant_projet_par_region);
}
public function avant_projet_par_secteur_dactivite_pe(){
$avant_projet_par_secteur_dactivite = DB::table('preprojet_pes')
                                  ->leftjoin('valeurs',function($join){
                                    $join->on('valeurs.id','=','preprojet_pes.secteur_dactivite');
                                  })
                                  ->groupBy('preprojet_pes.secteur_dactivite','valeurs.libelle')
                                  ->select('valeurs.libelle as secteur_dactivite' ,
                                          DB::raw("count(preprojet_pes.id) as nombre"))
                                  ->get();
                      return json_encode($avant_projet_par_secteur_dactivite);

}
}
