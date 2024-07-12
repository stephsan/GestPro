<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    function createEntreprise($identreprise,$indicateur, $note ){
        Evaluation::create([
            "entreprise_id"=>$identreprise,
            "note"=>$note,
            "indicateur"=> $indicateur
        ]);
    }
    public function create(Request $request)
    {
        $promoteur_code= $request->promoteur_code;
        $promoteur=Promotrice::where('code_promoteur',$promoteur_code )->first();
       // dd($promoteur->suscription_etape);
        if(!empty($request->entreprise)){
            $entreprise=Entreprise::where("id",$request->entreprise )->first();
        }
        $regions=Valeur::where('parametre_id',1 )->get();
        $forme_juridiques=Valeur::where('parametre_id',8 )->get();
        $nature_clienteles=Valeur::where('parametre_id',10 )->get();
        $provenance_clients=Valeur::where('parametre_id',9 )->get();
        $maillon_activites=Valeur::where('parametre_id',7 )->get();
        $source_appros=Valeur::where('parametre_id',12 )->get();
        $sys_suivi_activites=Valeur::where('parametre_id',13 )->get();
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        $futur_annees=Valeur::where('parametre_id',17 )->get();
        $rentabilite_criteres=Valeur::where('parametre_id',14)->where('id','!=',env("VALEUR_ID_NOMBRE_CLIENT"))->whereNotIn('id',[7098,7099,7100,7101,7102,7116])->get();
        $effectifs=Valeur::where('parametre_id',15 )->get();
        $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
        $nb_annee_activites= Valeur::where('parametre_id', env('PARAMETRE_NB_ANNEE_EXISTENCE_ENT') )->get();
        $techno_utilisees= Valeur::where('parametre_id', env('PARAMETRE_TECHNO_UTILISE_ENTREPRISE_ID') )->get();
        $nouveaute_entreprises=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
        $ouinon_reponses=Valeur::where('parametre_id',env("PARAMETRE_REPONSES_OUINON_ID") )->get();
        $niveau_resiliences=Valeur::where('parametre_id',env("PARAMETRE_NIVEAUDE_RESILIENCE_ID") )->get();
    if($promoteur->suscription_etape==1 || $promoteur->suscription_etape==null){
        return view("fond_partenariat.entreprise", compact("regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","promoteur_code","annees","rentabilite_criteres","effectifs", "nb_annee_activites","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences"));
    }elseif($promoteur->suscription_etape==2 && $entreprise!= null){
        return view("public.projet", compact("nature_clienteles","source_appros","promoteur_code","entreprise","futur_annees","effectifs"));
    }
  else{
    return view("validateStep1", compact("promoteur"))->with('success','Item created successfully!');
  }
}
}
