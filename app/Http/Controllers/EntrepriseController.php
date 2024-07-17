<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Infoentreprise;
use App\Models\Infoeffectifentreprise;
use App\Models\Preprojet;
use App\Models\Piecejointe;
use App\Models\Valeur;
use App\Models\EntrepriseDifficulte;
use App\Models\InnovationProjet;
use App\Models\Promoteur;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\recepisseMail;
use App\Mail\resumeMail;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
class EntrepriseController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }
    public function creation(Request $request)
    {
        $type_entreprise=$request->type_entreprise;
        $promoteur_code= $request->promoteur_code;
        $promoteur=Promoteur::where('code_promoteur',$promoteur_code )->first();
        if(!empty($request->entreprise)){
            $entreprise=Entreprise::where("id",$request->entreprise )->first();
        }
        $regions=Valeur::where('parametre_id',1 )->get();
        $forme_juridiques=Valeur::where('parametre_id',8 )->get();
        $nature_clienteles=Valeur::where('parametre_id',10 )->get();
        $provenance_clients=Valeur::where('parametre_id',9 )->get();
        $maillon_activites=Valeur::where('parametre_id',7 )->get();
        $source_appros=Valeur::where('parametre_id',12 )->get();
        $nb_annee_existences=Valeur::where("parametre_id", env('PARAMETRE_NB_ANNEE_EXISTENCE_ENT'))->get();
        $sys_suivi_activites=Valeur::where('parametre_id',13 )->get();
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        $futur_annees=Valeur::where('parametre_id',17 )->get();
        $rentabilite_criteres=Valeur::where('parametre_id',14)->whereIn('id',[env("VALEUR_ID_NOMBRE_CLIENT"),env("VALEUR_ID_CHIFFRE_DAFFAIRE")])->get();
        $effectifs=Valeur::where('parametre_id',15 )->get();
        $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
        $nb_annee_activites= Valeur::where('parametre_id', env('PARAMETRE_NB_ANNEE_EXISTENCE_ENT') )->get();
        $techno_utilisees= Valeur::where('parametre_id', env('PARAMETRE_TECHNO_UTILISE_ENTREPRISE_ID') )->get();
        $nouveaute_entreprises=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
        $ouinon_reponses=Valeur::where('parametre_id',env("PARAMETRE_REPONSES_OUINON_ID") )->get();
        $niveau_resiliences=Valeur::where('parametre_id',env("PARAMETRE_NIVEAUDE_RESILIENCE_ID") )->get();

        $innovation_du_projets=Valeur::where('parametre_id',44 )->get();
        $difficultes=Valeur::where('parametre_id',47 )->get();

        $indicateur_previsionel_du_projets=Valeur::where('parametre_id',46 )->whereNotIn('id',[7155])->get();
        $futur_annees=Valeur::where('parametre_id',17 )->get();
        $entreprise=$request->entreprise;
        //dd($entreprise);
        if(($promoteur->suscription_etape==1 || $promoteur->suscription_etape==null)&& $type_entreprise=='MPMEExistant'){
            return view("fond_partenariat.create_entreprise", compact('difficultes','type_entreprise','nb_annee_existences',"regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","promoteur_code","annees","rentabilite_criteres","effectifs", "nb_annee_activites","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences"));
        }
        elseif(($promoteur->suscription_etape==1 || $promoteur->suscription_etape==null)&& $type_entreprise!='MPMEExistant'){
            return view("fond_partenariat.create_preprojetstartup", compact('difficultes','entreprise','futur_annees','indicateur_previsionel_du_projets','innovation_du_projets','nb_annee_existences',"regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","promoteur_code","annees","rentabilite_criteres","effectifs", "nb_annee_activites","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences"));
        }
        elseif($promoteur->suscription_etape==2 && $type_entreprise=='MPMEExistant'){
           
            return view("fond_partenariat.projet_souscription", compact('difficultes','entreprise','futur_annees','indicateur_previsionel_du_projets','innovation_du_projets','nb_annee_existences',"regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","promoteur_code","annees","rentabilite_criteres","effectifs", "nb_annee_activites","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences"));
        }
        else{
            return view("fond_partenariat.validateStep1", compact("promoteur"))->with('success','Item created successfully!');
        }
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promoteur=Promoteur::where("code_promoteur",$request->code_promoteur)->first();
        $type_entreprise=$request->type_entreprise;
      
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get(); 
        $rentabilite_criteres=Valeur::where('parametre_id',14)->whereIn('id',[env("VALEUR_ID_NOMBRE_CLIENT"),env("VALEUR_ID_CHIFFRE_DAFFAIRE")])->get();
        $effectifs=Valeur::where('parametre_id',15 )->get();
        $nouveaute_entreprises=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
        $entreprises= Entreprise::where('promoteur_id',$promoteur->id)->get();
        $entreprise_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->get();
        $entreprise_nn_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->get();
        $date_de_formalisation= date('Y-m-d', strtotime($request->date_de_formalisation));
       //Pour eviter les doubles enregistrements
        $entreprise_controle_doublon= Entreprise::where("code_promoteur",$promoteur->code_promoteur)->where("denomination",$request->denomination)->get();
       if(count($entreprise_controle_doublon)==0){
         $entreprise = Entreprise::create([
            'denomination'=>$request->denomination,
            'region'=>$request->region,
            'province'=>$request->province,
            'commune'=>$request->commune,
            'arrondissement'=>$request->arrondissement,
            'categorie_entreprise'=>1,
            'secteur_activite'=>$request->secteur_activite,
            'nombre_annee_existence'=>$request->nb_annee_existence,
            'maillon_activite'=>$request->maillon_activite,
            'formalise'=>$request->formalise,
            'date_de_formalisation'=>$date_de_formalisation,
            'num_rccm'=>$request->num_rccm,
            'forme_juridique'=>$request->forme_juridique,
            'num_rccm'=>$request->num_rccm,
            'structure_financiere'=>$request->structure_financiere_entreprise,
            //'banque_entreprise'=>$request->structure_financiere_entreprise,
            'compte_dispo'=>$request->compte_dispo,
            'systeme_suivi'=>$request->systeme_suivi,
            'type_sys_suivi'=>$request->type_de_systeme_suivi,
            'code_promoteur'=>$request->code_promoteur,
            'promoteur_id'=>$promoteur->id,
            'affecte_par_securite'=>$request->affecte_par_securite,
            'desc_affecte_par_securite'=>$request->description_effet_securite,
            'niveau_resilience'=>$request->niveau_resilience,
            'status'=>0,
            'phase_de_souscription'=>2,
        ]);

        if ($request->hasFile('docrccm')) {
            $file = $request->file('docrccm');
            $extension=$file->getClientOriginalExtension();
            $fileName = $entreprise->code_promoteur.'.'.$extension;
            $emplacement='public/docrccm';
            $urldocrccm= $request['docrccm']->storeAs($emplacement, $fileName);
            Piecejointe::create([
                'type_piece'=>env("VALEUR_ID_DOCUMENT_RCCM"),
                  'entreprise_id'=>$entreprise->id,
                  'url'=>$urldocrccm,
              ]);
        }
        else{
            $urldocrccm=null;
        }
            $promoteur->update([
                "suscription_etape"=>2,
            ]);
            $difficultes=$request->difficultes;
            if($difficultes){
                foreach($difficultes as $difficulte){
                        EntrepriseDifficulte::create([
                                'entreprise_id'=>$entreprise->id,
                                'difficulte_id'=>$difficulte,
                        ]);
                }
                }
        foreach($rentabilite_criteres as $rentabilite_critere){
            foreach($annees as $annee){
                $variable=$rentabilite_critere->id.$annee->id;
                Infoentreprise::create([
                    "indicateur"=>$rentabilite_critere->id,
                    "annee"=>$annee->id,
                    "quantite"=>$request->$variable,
                    "entreprise_id"=>$entreprise->id,
                    "code_promoteur"=>$request->code_promoteur
                ]);
            }
        }
        foreach($effectifs as $effectif){
            foreach($annees as $annee){
                $homme=$effectif->id.$annee->id."homme";
                $femme=$effectif->id.$annee->id."femme";
                Infoeffectifentreprise::create([
                    "effectif"=>$effectif->id,
                    "annee"=>$annee->id,
                    "homme"=>$request->$homme,
                    "femme"=>$request->$femme,
                    "entreprise_id"=>$entreprise->id,
                    "code_promoteur"=>$request->code_promoteur
                ]);
            }
        }
        
    $entreprise=$entreprise->id;
    $entreprise_nn_traite= Entreprise::where('code_promoteur', $promoteur->code_promoteur)->get();
        //nombre de nouvelle entreprise enregistré pas le promoteur
        $nbre_ent_nn_traite = count($entreprise_nn_traite);
 }
 else{
   $entreprise= Entreprise::where("code_promoteur",$promoteur->code_promoteur)->where("denomination",$request->denomination)->first()->id;
 }
return view("fond_partenariat.validateStep1", compact("type_entreprise","promoteur","entreprise","nbre_ent_nn_traite"));

// else{
//     return view("fond_partenariat.validateStep2", compact("promoteur") );
//        }
}
public function genereRecpisse(Request $request)
{
    //return route()->back();
    $promoteur= Promoteur::where("slug", $request->promoteur)->first();
    $preprojet= Preprojet::where("promoteur_id", $promoteur->id)->orderBy('created_at','desc')->first();
    $contact_chef_de_zone= env("NUMERO_SUPPORT");
    $data["email"] = $promoteur->email_promoteur;
    $this->email= $promoteur->email_promoteur;
    $qrcode =  base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate("Ceci est un recepissé généré par la plateforme de gestion des bénéficiaires du projet ECOTEC"."Code didentification:"." ".$promoteur->code_promoteur."_".$promoteur->id."ECOTEC"));
    $pdf = PDF::loadView('pdf.recepisse', compact('promoteur','preprojet','contact_chef_de_zone','qrcode'));
    return  $pdf->download('récépissé_plateforme_ECOTEC.pdf');
}

public function create2(Promoteur $promoteur, Request $request)
{
$entreprise_nn_traite= Entreprise::where('code_promoteur', $request->promoteur_code)->where("conforme",null)->get();

    if(count($entreprise_nn_traite )<2 ){
    $entreprise= Entreprise::where("promoteur_id", $promoteur->id)->orderBy('created_at','desc')->first();
    $promoteur_code=$promoteur->code_promoteur;
    $regions=Valeur::where('parametre_id',1 )->whereNotIn('id', [62,64,63,59,58,53])->get();

    $forme_juridiques=Valeur::where('parametre_id',8 )->get();
    $nature_clienteles=Valeur::where('parametre_id',10 )->get();
    $provenance_clients=Valeur::where('parametre_id',9 )->get();
    $maillon_activites=Valeur::where('parametre_id',7 )->get();
    $source_appros=Valeur::where('parametre_id',12 )->get();
    $sys_suivi_activites=Valeur::where('parametre_id',13 )->get();
    $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
    $futur_annees=Valeur::where('parametre_id',17 )->get();
    $rentabilite_criteres=Valeur::where('parametre_id',14 )->get();
    $effectifs=Valeur::where('parametre_id',15 )->get();
    $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
    // $secteur_activites= Valeur::where('parametre_id', env('PARAMETRE_SECTEUR_ACTIVITE_ID') )->get();
    $nb_annee_activites= Valeur::where('parametre_id', env('PARAMETRE_NB_ANNEE_EXISTENCE_ENT') )->get();
    $techno_utilisees= Valeur::where('parametre_id', env('PARAMETRE_TECHNO_UTILISE_ENTREPRISE_ID') )->get();
    $nouveaute_entreprises=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
    $ouinon_reponses=Valeur::where('parametre_id',env("PARAMETRE_REPONSES_OUINON_ID") )->get();
    $niveau_resiliences=Valeur::where('parametre_id',env("PARAMETRE_NIVEAUDE_RESILIENCE_ID") )->get();
if($promoteur->suscription_etape==3){
    return view("public.enrentreprise", compact("regions","forme_juridiques","nature_clienteles","provenance_clients","maillon_activites","source_appros","sys_suivi_activites","promoteur_code","annees","rentabilite_criteres","effectifs","secteur_activites","techno_utilisees","nouveaute_entreprises","ouinon_reponses","niveau_resiliences","nb_annee_activites"));
}elseif($promoteur->etape_suscription2== 2 && $entreprise!= null){
    return view("public.projet", compact("nature_clienteles","source_appros","promoteur_code","entreprise","futur_annees","effectifs"));
}
else{
return view("validateStep1", compact("promoteur"))->with('success','Item created successfully!');
}
}
else{
return redirect()->back();
}

}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entreprise)
    {
        //
    }
}
