<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardControllerPE extends Controller
{
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
