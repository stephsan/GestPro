<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Preprojet;
use App\Models\Projet;
use App\Models\Composante;

use App\Models\PreprojetPe;
class DashboardController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
  public function index(){
   if(Auth::user()->isbeneficiary==1){
        return redirect()->route('beneficiaire.profil');
   }
   else{
    if(return_role_adequat(env('ID_ROLE_MEMBRE_COMITE_FP'))){
        return redirect()->route('preprojet.soumis_au_comite_fp');
    }
    elseif(return_role_adequat(env('ID_ROLE_MEMBRE_COMITE_PE'))){
      return redirect()->route('preprojet.soumis_au_comite_pe');
    }
    // elseif(return_role_adequat(env('ID_ROLE_CONSEILLER_PE'))|| return_role_adequat(env('ID_ROLE_RESPONSABLE_PE'))){
    //     return redirect()->route('dashboard.pe');
    // }
    elseif(return_role_adequat(env('ID_ROLE_CONSEILLER_FP')) || return_role_adequat(env('ID_ROLE_RESPONSABLE_FP'))){
      return redirect()->route('dashboard.fp');
    }
    else{
        return redirect()->route('dashboard.fp');
    }
  }
  }

  public function dashboard(){
    if (Auth::user()->can('acceder_au_dashboard_du_fp')) {
        $all_projet=Projet::all();
        $projets_en_cours= Projet::all();
        $projets_termines=  Projet::all();
        $projet_soumis=Projet::all();
      return view('dashboard.dashboard_fp',compact('all_projet','projets_termines','projets_en_cours','projet_soumis'));
    }
  }
  public function dashboard_pe(){
    if (Auth::user()->can('acceder_au_dashboard_du_pe')) {
      $nombre_de_preprojet_soumis= PreprojetPe::where('entreprise_id',NULL)->count();
      $nombre_de_preprojet_eligible= PreprojetPe::where('entreprise_id',NULL)->where('eligible','eligible')->count();
      $nombre_de_preprojet_selectionne= PreprojetPe::where('entreprise_id',NULL)->where('decision_du_comite','favorable')->count();
      return view('dashboard.dashborad_pe', compact('nombre_de_preprojet_soumis','nombre_de_preprojet_eligible','nombre_de_preprojet_selectionne'));
    }
    else{
      return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
    }

  }

public function pa_soumis_par_region_et_par_sexe(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
        $pa_soumis_par_region_et_par_sexe = DB::table('projets')
                                              ->leftjoin('preprojets',function($join){
                                                  $join->on('projets.preprojet_id','=','preprojets.id');
                                              })
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
     }
     elseif($request->statut=='selectionné'){
            $pa_soumis_par_region_et_par_sexe = DB::table('projets')
                                                ->leftjoin('preprojets',function($join){
                                                    $join->on('projets.preprojet_id','=','preprojets.id');
                                                })
                                                ->where('projets.statut','selectionné')
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
     }
    }
    return json_encode($pa_soumis_par_region_et_par_sexe);

}

public function pa_par_region(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
      $pa_par_region = DB::table('projets')
                                  ->leftjoin('preprojets',function($join){
                                    $join->on('projets.preprojet_id','=','preprojets.id');
                                  })
                                    ->leftjoin('valeurs',function($join){
                                      $join->on('valeurs.id','=','preprojets.region');
                                    })
                                    ->groupBy('preprojets.region','valeurs.libelle')
                                    ->select('valeurs.libelle as region' ,
                                            DB::raw("count(preprojets.id) as nombre"))
                                    ->get();
    }
    
    elseif($request->statut=='selectionné'){
      $pa_par_region = DB::table('projets')
                                    ->leftjoin('preprojets',function($join){
                                      $join->on('projets.preprojet_id','=','preprojets.id');
                                    })
                                    ->leftjoin('valeurs',function($join){
                                      $join->on('valeurs.id','=','preprojets.region');
                                    })
                                    ->where('projets.statut','selectionné')
                                    ->groupBy('preprojets.region','valeurs.libelle')
                                    ->select('valeurs.libelle as region' ,
                                            DB::raw("count(preprojets.id) as nombre"))
                                    ->get();
    }
        
  }
  elseif($request->type_entreprise=='startup'){

  }
 return json_encode($pa_par_region);
}
public function pa_par_secteur_dactivite(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
      $avant_projet_par_secteur_dactivite = DB::table('projets')
                                              ->leftjoin('preprojets',function($join){
                                                $join->on('projets.preprojet_id','=','preprojets.id');
                                              })
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                              })
                                              ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                              ->select('valeurs.libelle as secteur_dactivite' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
    elseif($request->statut=='selectionné'){
      $avant_projet_par_secteur_dactivite = DB::table('projets')
                                              ->leftjoin('preprojets',function($join){
                                                $join->on('projets.preprojet_id','=','preprojets.id');
                                              })
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                              })
                                              ->where('projets.statut','selectionné')
                                              ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                              ->select('valeurs.libelle as secteur_dactivite' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
         return json_encode($avant_projet_par_secteur_dactivite);
  }
  elseif($request->type_entreprise=='startup'){

  }

} 

public function pa_par_guichet(Request $request){
   if($request->type_entreprise=='mpme'){
     if($request->statut=='soumis')
       {
        $plan_daffaire_par_guichets = DB::table('projets')
                                          ->leftjoin('preprojets',function($join){
                                              $join->on('projets.preprojet_id','=','preprojets.id');
                                          })
                                          ->rightJoin('valeurs', function ($join) {
                                            $join->on('valeurs.id','=','preprojets.region')
                                                 ; 
                                          })
                                          ->where('valeurs.parametre_id',1)
                                          ->groupBy('preprojets.region','valeurs.libelle')
                                          ->select('valeurs.libelle as region',
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN 1 else 0 end) as guichet1"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN 1 else 0 end) as guichet2"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN 1 else 0 end) as guichet3"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN projets.montant_demande else 0 end) as montant_petit_sous_projet"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN projets.montant_demande else 0 end) as montant_projet_standards"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN projets.montant_demande else 0 end) as montant_projet_de_transformation_vert"),
                                           )
                                          ->get();
       }
       if($request->statut=='selectionné')
       {
        $plan_daffaire_par_guichets = DB::table('projets')
                                          ->leftjoin('preprojets',function($join){
                                              $join->on('projets.preprojet_id','=','preprojets.id');
                                          })
                                          ->rightJoin('valeurs', function ($join) {
                                            $join->on('valeurs.id','=','preprojets.region'); 
                                          })
                                          ->where('projets.statut','selectionné')
                                          ->where('valeurs.parametre_id',1)
                                          ->groupBy('preprojets.region','valeurs.libelle')
                                          ->select('valeurs.libelle as region',
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN 1 else 0 end) as guichet1"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN 1 else 0 end) as guichet2"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN 1 else 0 end) as guichet3"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN projets.montant_demande else 0 end) as montant_petit_sous_projet"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN projets.montant_demande else 0 end) as montant_projet_standards"),
                                                DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN projets.montant_demande else 0 end) as montant_projet_de_transformation_vert"),
                                           )
                                          ->get();
       }
     }
    return json_encode($plan_daffaire_par_guichets);
}

public function taux_par_composante(Request $request){
          $projet= Projet::find($request->projet_id);
         $cpsantes= $projet->composantes->map(function ($composante) {
                    return [
                        'id' => $composante->id,
                        'libelle' => $composante->denomination,
                        'taux_physique' => $composante->taux_physique,
                        'taux_financier' => $composante->taux_financier,
                        // 'delais_consomme' => $composante->delais_consomme,
                        // 'cible_prevu' => $composante->cible_prevu,
                        // 'cible_realise' => $composante->cible_realise
                    ];
                });
     
      return json_encode($cpsantes);
 }
 public function getTaux(Request $request){
                $projet= Projet::find($request->projet_id);
               $projet_taux=[
                      'id' => $projet->id,
                      'libelle' => $projet->denomination,
                      'taux_physique' => $projet->taux_physique,
                      'taux_financier' => $projet->taux_financier,
                      'delais_consomme' => $projet->delais_consomme,
                      'taux_decaissement' => $projet->taux_decaissement,
                      'cible_prevu' => $projet->cible_prevu,
                      'cible_realise' => $projet->cible_realise,
                      'taux_cible' => $projet->taux_cible
                  ];
              
  
    return json_encode($projet_taux);
 }
 public function taux_par_categorie(Request $request){
    $projet= Projet::find($request->projet_id);
    $bycategorie = DB::table('activites')
                        ->leftjoin('realisations',function($join){
                            $join->on('realisations.activite_id','=','activites.id');
                        })
                        ->where('realisations.annee','2025')
                        ->leftjoin('composantes',function($join){
                          $join->on('composantes.id','=','activites.composante_id');
                          })
                        ->leftjoin('projets',function($join){
                          $join->on('projets.id','=','composantes.projet_id');
                        })
                        ->rightJoin('valeurs', function ($join) {
                          $join->on('valeurs.id','=','activites.categorie_id'); 
                        })
                        ->where('projets.id',$projet->id)
                        ->groupBy('activites.categorie_id','valeurs.libelle','realisations.taux_physique')
                        ->select('valeurs.libelle as categorie',  DB::raw('AVG(realisations.taux_physique) as moyenne_taux'))
                          ->get();
           return json_encode($bycategorie);
                        
 }
public function repartition_par_satut_activite(Request $request){
  $projet= Projet::find($request->projet_id);
  $repartition_par_statut_activite = DB::table('activites')
                                    ->leftjoin('realisations',function($join){
                                        $join->on('realisations.activite_id','=','activites.id')
                                        ->where('realisations.annee','2025');
                                    })
                                    ->whereRaw('realisations.id = (SELECT MAX(r2.id) FROM realisations r2 WHERE r2.activite_id = activites.id AND r2.annee = 2025)')
                                    ->leftjoin('composantes',function($join){
                                      $join->on('composantes.id','=','activites.composante_id');
                                      })
                                    ->leftjoin('projets',function($join){
                                      $join->on('projets.id','=','composantes.projet_id');
                                    })
                                    ->where('projets.id',$projet->id)
                                    ->rightJoin('valeurs', function ($join) {
                                      $join->on('valeurs.id','=','activites.categorie_id'); 
                                    })
                                    ->groupBy('activites.statut')
                                    ->select('activites.statut as statut',DB::raw('Count(activites.id) as nombre_activite')
                                      )
                                      ->get();
         return json_encode($repartition_par_statut_activite);

}

 public function taux_par_categorie_dactivite(Request $request){
                  if($request->type_entreprise=='mpme'){
                    if($request->statut=='soumis'){
                      $avant_projet_par_region = DB::table('preprojets')
                                                    ->leftjoin('valeurs',function($join){
                                                      $join->on('valeurs.id','=','preprojets.region');
                                                    })
                                                    ->groupBy('preprojets.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojets.id) as nombre"))
                                                    ->get();
                    }
                    if($request->statut=='eligible'){
                      $avant_projet_par_region = DB::table('preprojets')
                                                    ->leftjoin('valeurs',function($join){
                                                      $join->on('valeurs.id','=','preprojets.region');
                                                    })
                                                    ->where('preprojets.eligible','eligible')
                                                    ->groupBy('preprojets.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojets.id) as nombre"))
                                                    ->get();
                    }
                    if($request->statut=='selectionne'){
                      $avant_projet_par_region = DB::table('preprojets')
                                                    ->leftjoin('valeurs',function($join){
                                                      $join->on('valeurs.id','=','preprojets.region');
                                                    })
                                                    ->where('preprojets.decision_du_comite','favorable')
                                                    ->groupBy('preprojets.region','valeurs.libelle')
                                                    ->select('valeurs.libelle as region' ,
                                                            DB::raw("count(preprojets.id) as nombre"))
                                                    ->get();
                    }
                        
                  }
                  elseif($request->type_entreprise=='startup'){

                  }
                 return json_encode($avant_projet_par_region);
}
public function taux_par_statut_activite(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
      $avant_projet_par_secteur_dactivite = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                              })
                                              ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                              ->select('valeurs.libelle as secteur_dactivite' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
    elseif($request->statut=='eligible'){
      $avant_projet_par_secteur_dactivite = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                              })
                                              ->where('preprojets.eligible','eligible')
                                              ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                              ->select('valeurs.libelle as secteur_dactivite' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
    elseif($request->statut=='selectionne'){
      $avant_projet_par_secteur_dactivite = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.secteur_dactivite');
                                              })
                                              ->where('preprojets.decision_du_comite','favorable')
                                              ->groupBy('preprojets.secteur_dactivite','valeurs.libelle')
                                              ->select('valeurs.libelle as secteur_dactivite' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
         return json_encode($avant_projet_par_secteur_dactivite);
  }
  elseif($request->type_entreprise=='startup'){

  }

}
public function avant_projet_par_guichet(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
      $avant_projet_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.guichet');
                                              })
                                              ->groupBy('preprojets.guichet','valeurs.libelle')
                                              ->select('valeurs.libelle as guichet' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
    elseif($request->statut=='eligible'){
      $avant_projet_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.guichet');
                                              })
                                              ->where('preprojets.eligible','eligible')
                                              ->groupBy('preprojets.guichet','valeurs.libelle')
                                              ->select('valeurs.libelle as guichet' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
    elseif($request->statut=='selectionne'){
      $avant_projet_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.guichet');
                                              })
                                              ->where('preprojets.decision_du_comite','favorable')
                                              ->groupBy('preprojets.guichet','valeurs.libelle')
                                              ->select('valeurs.libelle as guichet' ,
                                                      DB::raw("count(preprojets.id) as nombre"))
                                              ->get();
    }
         return json_encode($avant_projet_par_guichet);
  }
  elseif($request->type_entreprise=='startup'){

  }

}
public function avant_projet_selectionne_par_region_et_par_sexe(Request $request){
  $avant_projet_soumis_par_region_et_par_sexe = DB::table('preprojets')
                                              ->leftjoin('promoteurs',function($join){
                                                  $join->on('promoteurs.id','=','preprojets.promoteur_id');
                                              })
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.region');
                                              })
                                              ->where('preprojets.decision_du_comite','favorable')
                                              ->groupBy('preprojets.region','valeurs.libelle')
                                              ->select('valeurs.libelle as region' ,
                                                      DB::raw("sum(CASE WHEN promoteurs.genre=2 THEN 1 else 0 end) as masculin"),
                                                      DB::raw("sum(CASE WHEN promoteurs.genre=1 THEN 1 else 0 end) as feminin"),)
                                              ->get();
                                  return json_encode($avant_projet_soumis_par_region_et_par_sexe);
}
public function avant_projet_par_guichet_par_region(Request $request){
  if($request->type_entreprise=='mpme'){
    if($request->statut=='soumis'){
      $avant_projet_par_region_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.region');
                                              })
                                              ->groupBy('preprojets.region','valeurs.libelle')
                                              ->select('valeurs.libelle as region' ,
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN 1 else 0 end) as guichet_1"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN 1 else 0 end) as guichet_2"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN 1 else 0 end) as guichet_3"),)
                                              ->get();
    }
    elseif($request->statut=='eligible'){
      $avant_projet_par_region_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.region');
                                              })
                                              ->groupBy('preprojets.region','valeurs.libelle')
                                              ->select('valeurs.libelle as region' ,
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN 1 else 0 end) as 10000000"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN 1 else 0 end) as 50000000"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN 1 else 0 end) as 100000000"),)
                                              ->get();
    }
    elseif($request->statut=='selectionne'){
      $avant_projet_par_region_par_guichet = DB::table('preprojets')
                                              ->leftjoin('valeurs',function($join){
                                                $join->on('valeurs.id','=','preprojets.region');
                                              })
                                              ->groupBy('preprojets.region','valeurs.libelle')
                                              ->select('valeurs.libelle as region' ,
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7165 THEN 1 else 0 end) as 10000000"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7166 THEN 1 else 0 end) as 50000000"),
                                                      DB::raw("sum(CASE WHEN preprojets.guichet=7167 THEN 1 else 0 end) as 100000000"),)
                                              ->get();
    }
         return json_encode($avant_projet_par_region_par_guichet);
  }
  elseif($request->type_entreprise=='startup'){

  }

}
public function avant_projet_pe_geopresenation()
{
  $avant_projets= PreprojetPe::all();
  //  $type_entreprise= $request->type_entreprise;
  //  $forme= $request->valeur_de_forme;
  //  if($request->statut=='selectionne'){
  //   $souscriptionsgeo= PreprojetPe::where("aopOuleader",$type_entreprise)->where("decision_du_comite_phase1","selectionnee")->where('participer_a_la_formation',$forme)->get();
  //  }
  //  else{
  //   $souscriptionsgeo= Entreprise::where("aopOuleader",$type_entreprise)->where("decision_du_comite_phase1","selectionnee")->get();
  //  }
    $datageo=[];
        foreach( $avant_projets as $value)
        {
           $datageo[] = [
                          'lat'=>$value->latitude,'long'=>$value->longitude,'titre_projet'=> $value->num_projet,'promoteur'=>$value->promoteur->nom.' '.$value->promoteur->prenom,
                          'label' => [ 'color' => 'white', 'text' => $value->titre_projet ],
                          'draggable' => true ];
                          // 'id'=>$value->id,'denomination'=>$value->titre_projet,'telephone'=>$value->promoteur->telephone_promoteur, 'longitude'=>$value->longitude, 'latitude'=>$value->latitude, 'secteur_dactivite'=> getlibelle($value->secteur_dactivite),'region'=>getlibelle($value->region) );
        }
         // dd($datageo);
        return json_encode($datageo);
}

}
