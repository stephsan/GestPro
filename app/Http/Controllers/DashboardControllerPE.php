<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardControllerPE extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function avant_projet_soumis_par_region_et_par_sexe_pe(Request $request){
        if($request->type_entreprise=='startup'){
            if($request->statut=='soumis')
            {
            $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojet_pes')
                                                                ->leftjoin('promoteurs',function($join){
                                                                    $join->on('promoteurs.id','=','preprojet_pes.promoteur_id');
                                                                })
                                                                ->where('entreprise_id',null)
                                                                ->leftjoin('valeurs',function($join){
                                                                $join->on('valeurs.id','=','preprojet_pes.region');
                                                                })
                                                                ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                                ->select('valeurs.libelle as region' ,
                                                                        DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                                        DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                                               ->get();
            }
            elseif($request->statut=='eligible'){
                $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojet_pes')
                                                            ->leftjoin('promoteurs',function($join){
                                                                $join->on('promoteurs.id','=','preprojet_pes.promoteur_id');
                                                            })
                                                            ->where('preprojet_pes.eligible','eligible')
                                                            ->where('entreprise_id',null)
                                                            ->leftjoin('valeurs',function($join){
                                                            $join->on('valeurs.id','=','preprojet_pes.region');
                                                            })
                                                            ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                            ->select('valeurs.libelle as region' ,
                                                                    DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                                    DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                                        ->get();
            }
            elseif($request->statut=='selectionne'){
                $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojet_pes')
                                                                ->leftjoin('promoteurs',function($join){
                                                                    $join->on('promoteurs.id','=','preprojet_pes.promoteur_id');
                                                                })
                                                                ->where('preprojet_pes.decision_du_comite','favorable')
                                                                ->where('entreprise_id',null)
                                                                ->leftjoin('valeurs',function($join){
                                                            $join->on('valeurs.id','=','preprojet_pes.region');
                                                            })
                                                            ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                            ->select('valeurs.libelle as region' ,
                                                                    DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                                    DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                                        ->get();
            }
           }
           elseif($request->type_entreprise=='mpme'){

           }
               return json_encode($avant_projet_soumis_par_region_et_par_sexe);
      }
      public function avant_projet_par_region_pe(Request $request){
        if($request->type_entreprise=='startup'){
                if($request->statut=='soumis')
                {
                        $avant_projet_par_region = DB::table('preprojet_pes')
                                                    ->leftjoin('valeurs',function($join){
                                                    $join->on('valeurs.id','=','preprojet_pes.region');
                                                    })
                                                    ->where('entreprise_id',null)
                                                    ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojet_pes.id) as nombre"))
                                                    ->get();
                }
                elseif($request->statut=='eligible')
                {
                        $avant_projet_par_region = DB::table('preprojet_pes')
                                                    ->leftjoin('valeurs',function($join){
                                                    $join->on('valeurs.id','=','preprojet_pes.region');
                                                    })
                                                    ->where('entreprise_id',null)
                                                    ->where('preprojet_pes.eligible','eligible')
                                                    ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojet_pes.id) as nombre"))
                                                    ->get();
                }
                elseif($request->statut=='selectionne')
                {
                        $avant_projet_par_region = DB::table('preprojet_pes')
                                                    ->leftjoin('valeurs',function($join){
                                                    $join->on('valeurs.id','=','preprojet_pes.region');
                                                    })
                                                    ->where('entreprise_id',null)
                                                    ->where('preprojet_pes.decision_du_comite','favorable')
                                                    ->groupBy('preprojet_pes.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojet_pes.id) as nombre"))
                                                    ->get();
                        
                }
             }
             elseif($request->type_entreprise=='mpme'){

             }
                            return json_encode($avant_projet_par_region);
      }
      public function avant_projet_par_secteur_dactivite_pe(Request $request){
        if($request->type_entreprise=='startup'){
            if($request->statut=='soumis')
            {
            $avant_projet_par_secteur_dactivite = DB::table('preprojet_pes')
                                                        ->leftjoin('valeurs',function($join){
                                                        $join->on('valeurs.id','=','preprojet_pes.secteur_dactivite');
                                                        })
                                                        ->where('entreprise_id',null)
                                                        ->groupBy('preprojet_pes.secteur_dactivite','valeurs.libelle')
                                                        ->select('valeurs.libelle as secteur_dactivite' ,
                                                                DB::raw("count(preprojet_pes.id) as nombre"))
                                                        ->get();
            }
            elseif($request->statut=='eligible')
            {
            $avant_projet_par_secteur_dactivite = DB::table('preprojet_pes')
                                                        ->leftjoin('valeurs',function($join){
                                                        $join->on('valeurs.id','=','preprojet_pes.secteur_dactivite');
                                                        })
                                                        ->where('entreprise_id',null)
                                                        ->where('preprojet_pes.eligible','eligible')
                                                        ->groupBy('preprojet_pes.secteur_dactivite','valeurs.libelle')
                                                        ->select('valeurs.libelle as secteur_dactivite' ,
                                                                DB::raw("count(preprojet_pes.id) as nombre"))
                                                        ->get();
            }
            elseif($request->statut=='selectionne')
            {
            $avant_projet_par_secteur_dactivite = DB::table('preprojet_pes')
                                                        ->leftjoin('valeurs',function($join){
                                                        $join->on('valeurs.id','=','preprojet_pes.secteur_dactivite');
                                                        })
                                                        ->where('entreprise_id',null)
                                                        ->where('preprojet_pes.decision_du_comite','favorable')
                                                        ->groupBy('preprojet_pes.secteur_dactivite','valeurs.libelle')
                                                        ->select('valeurs.libelle as secteur_dactivite' ,
                                                                DB::raw("count(preprojet_pes.id) as nombre"))
                                                        ->get();
            }
        }
            elseif($request->type_entreprise=='mpme'){

            }
                            return json_encode($avant_projet_par_secteur_dactivite);
      
      }
}
