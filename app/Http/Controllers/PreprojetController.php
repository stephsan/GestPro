<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preprojet;
use App\Models\PreprojetPe;
use App\Models\Piecejointe;
use App\Models\Infoentreprise;
use App\Models\Infoeffectifentreprise;
use App\Models\Promoteur;
use App\Models\Evaluation;
use App\Models\InnovationProjet;
use App\Models\SourceDapprovisionnement;
use Illuminate\Support\Facades\DB;
use App\Models\Valeur;
use App\Models\Entreprise;
use App\Models\Critere;
use App\Models\PreprojetParametre;
use Illuminate\Support\Facades\Mail;
use App\Mail\recepisseMail;
use App\Mail\resumeMail;
use Illuminate\Support\Facades\Storage;
class PreprojetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(["store_preprojet",'store_preprojet_pe']);
    }
    function createEvaluation($idprojet,$indicateur,$note ){
     $evaluation=Evaluation::where('preprojet_id',$idprojet)->where('critere_id',$indicateur)->get();
     if(count($evaluation)==0){
        Evaluation::create([
            "preprojet_id"=>$idprojet,
            "type_evaluation"=>'automatique',
            "note"=>$note,
            "critere_id"=> $indicateur
        ]);
     }
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }
    public function lister_fp(Request $request){
        $type_entreprise= $request->type_entreprise;
        if($type_entreprise=='startup'){
            $preprojets=Preprojet::where('entreprise_id', null)->orderBy('created_at','desc')->get();
            $type='Startup';
        }
        else if($type_entreprise=='entreprise_existante'){
            $preprojets=Preprojet::where('entreprise_id','!=', null)->orderBy('created_at','desc')->get();
            $type='Entreprise existante';
        }
        return view('preprojet.index',compact('preprojets','type'));
    }
    public function lister_pe(Request $request){
        $type_entreprise= $request->type_entreprise;
        if($type_entreprise=='startup'){
            $preprojets=PreprojetPe::where('entreprise_id', null)->orderBy('created_at','desc')->get();
            $type='Startup';
        }
        else if($type_entreprise=='entreprise_existante'){
            $preprojets=PreprojetPe::where('entreprise_id','!=', null)->orderBy('created_at','desc')->get();
            $type='Entreprise existante';
        }
        return view('preprojet.index_pe',compact('preprojets','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     function store_preprojet_pe(Request $request){
        $type_entreprise=$request->type_entreprise;
        $programme=$request->programme;
        $innovation_du_projets=Valeur::where('parametre_id',44 )->get();
        $source_appros=Valeur::where('parametre_id',12 )->get();
        $promoteur= Promoteur::where('code_promoteur',$request->code_promoteur)->first();
        $lastOne = DB::table('preprojet_pes')->latest('id')->first();
        if($lastOne){
            $num_projet = $promoteur->code_promoteur.'PE'.'_00'.$lastOne->id;
        }
        else{
            $num_projet = $promoteur->code_promoteur.'PE'.'_00'.'0';
        }
        $entreprise_nn_traite= Entreprise::where('promoteur_id', $promoteur->id)->get();
        $preprojet_controle_doublon= PreprojetPe::where("promoteur_id",$promoteur->id)->where("titre_projet",$request->titre_projet)->get();
            if(count($preprojet_controle_doublon)==0){
            $preprojet=PreprojetPE::create([
                "titre_projet"=> $request->titre_projet,
                "secteur_dactivite"=>  $request->secteur_activite,
                "maillon_dactivite"=>  $request->maillon_activite,
                "region"=>  $request->region,
                "province"=>  $request->province,
                "commune"=>  $request->commune,
                "domaine_detude"=>  $request->domaine_detude,
                'forme_juridique_envisage'=>$request->forme_juridique_envisage,
                'aggrement_exige'=>$request->aggrement_exige,
                'precise_aggrement'=>$request->precise_aggrement,
                "secteur_village"=>  $request->arrondissement,
                 "autre_besoin_en_formation"=>  $request->autre_besoin_en_formation,
                "existence_dexprerience_du_promoteur"=> $request->connaissance_sur_lactivite,
                "mode_dacquisition_dexprerience_du_promoteur"=> $request->mode_dacquisition_dexprerience_du_promoteur,
                "etude_technique_de_faisabilite"=> $request->etude_technique_de_faisabilite,
                "etude_de_marche"=> $request->etude_de_marche_realise,
                "prototype_existe"=> $request->existence_de_prototype,
                 "recherche_de_financement_envisage"=> $request->recherche_de_financement,
                "origine_clientele"=> $request->provenance_clientele,
                "type_clientele"=>  $request->provenance_clientele,
                "site_disponible"=>$request->site_disponible,
                "type_site"=>$request->type_site,
                "description"=>  $request->description_idee_de_projet,
                "objectifs"=>  $request->objectifs_projet,
                "num_projet"=>  $num_projet,
                "entreprise_id"=>  $request->entreprise_id,
                "promoteur_id"=> $promoteur->id
            ]);
            
            $promoteur->update([
                "suscription_etape"=>3,
            ]);
            $formations_souhaites=$request->formations_souhaites;
            
            if($formations_souhaites){
                foreach($formations_souhaites as $formation){
                    $parametre_id=Valeur::find($formation)->parametre->id;
                        PreprojetParametre::create([
                                'preprojet_pe_id'=>$preprojet->id,
                                'parametre_id'=>$parametre_id,
                                'valeur_id'=>$formation,
                        ]);
                }
                }
            $formations_effectuees=$request->formations_effectuees;
                if($formations_effectuees){
                    foreach($formations_effectuees as $formation){
                        $parametre_id=Valeur::find($formation)->parametre->id;
                            PreprojetParametre::create([
                                    'preprojet_pe_id'=>$preprojet->id,
                                    'parametre_id'=>$parametre_id,
                                    'valeur_id'=>$formation,
                            ]);
                    }
                    }
                    $sources_dappros=$request->sources_dappros;
                    if($sources_dappros){
                        foreach($sources_dappros as $sources_dappro){
                            $parametre_id=Valeur::find($sources_dappro)->parametre->id;
                                PreprojetParametre::create([
                                        'preprojet_pe_id'=>$preprojet->id,
                                        'parametre_id'=>$parametre_id,
                                        'valeur_id'=>$sources_dappro,
                                ]);
                        }
                        }
                        $innovations=$request->innovations;
                        if($innovations){
                            foreach($innovations as $innovation){
                                $parametre_id=Valeur::find($innovation)->parametre->id;
                                    PreprojetParametre::create([
                                            'preprojet_pe_id'=>$preprojet->id,
                                            'parametre_id'=>$parametre_id,
                                            'valeur_id'=>$innovation,
                                    ]);
                            }
                            }
            
            $data["email"] = $promoteur->email_promoteur;
            $this->email= $promoteur->email_promoteur;
            Mail::to($this->email)->queue(new recepisseMail($promoteur->id,'PE'));
            
        }
            $nbre_ent_nn_traite = count($entreprise_nn_traite);
            return view("fond_partenariat.validateStep1", compact('programme',"type_entreprise","promoteur","nbre_ent_nn_traite"));


     }

     public function afficher_details_fp(Preprojet $preprojet){
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $promoteur=Promoteur::where('id',$preprojet->promoteur_id)->first();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $effectif_permanent_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $projet_innovations= PreprojetParametre::where("parametre_id",44)->where("preprojet_fp_id",$preprojet->id)->get();
        $sources_dapprovisionnements= PreprojetParametre::where("parametre_id",12)->where("preprojet_fp_id",$preprojet->id)->get();

        $evaluations=Evaluation::where('preprojet_id',$preprojet->id)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','FP_preprojet')->get();
        $criteres= $criteres->except($id_criteres);
        if($entreprise)
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("entreprise_id", $entreprise->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        else
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
            
        return view('preprojet.show',compact('sources_dapprovisionnements','evaluations','criteres','projet_innovations','effectif_permanent_previsionels','effectif_temporaire_previsionels','chiffre_daffaires','preprojet','piecejointes'));
           // dd($preprojet);
    }
    public function afficher_details_pe(PreprojetPe $preprojet){
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $promoteur=Promoteur::where('id',$preprojet->promoteur_id)->first();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $effectif_permanent_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $projet_innovations= InnovationProjet::where("projet_id",$preprojet->id)->get();
        $evaluations=Evaluation::where('preprojet_id',$preprojet->id)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','FP_preprojet')->get();
        $criteres= $criteres->except($id_criteres);
        if($entreprise)
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("entreprise_id", $entreprise->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        else
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
            
        return view('preprojet.show_pe',compact('evaluations','criteres','projet_innovations','effectif_permanent_previsionels','effectif_temporaire_previsionels','chiffre_daffaires','preprojet','piecejointes'));
           // dd($preprojet);
    }
    public function show(Preprojet $preprojet)
    {
       
        //$preprojet=Preprojet::where('id',$id)->first();
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $promoteur=Promoteur::where('id',$preprojet->promoteur_id)->first();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $effectif_permanent_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $projet_innovations= InnovationProjet::where("projet_id",$preprojet->id)->get();
        $evaluations=Evaluation::where('preprojet_id',$preprojet->id)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','FP_preprojet')->get();
        $criteres= $criteres->except($id_criteres);
    if($entreprise)
        $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("entreprise_id", $entreprise->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
    else
        $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        
       return view('preprojet.show',compact('evaluations','criteres','projet_innovations','effectif_permanent_previsionels','effectif_temporaire_previsionels','chiffre_daffaires','preprojet','piecejointes'));
    }
    public function telecharger($id)
    {
        $piecejointe= Piecejointe::where('id', $id)->first();
       return $path = Storage::download($piecejointe->url);
    }
    public function detaildocument(Piecejointe $piecejointe){
        return view("document.show", compact('piecejointe'));
    }

    public function evaluer(Request $request){
        $preprojet = Preprojet::find($request->avant_projet);
        $evaluations=Evaluation::where('preprojet_id',$request->avant_projet)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','FP_preprojet')->get();
        $criteres= $criteres->except($id_criteres);
        foreach($criteres as $critere){
            $note= $critere->id;
        $nombre_devaluation_du_projet = Evaluation::where(['preprojet_id'=>$request->projet,'critere_id'=> $critere->id,])->count();
        if($nombre_devaluation_du_projet==0){
            Evaluation::create([
                'preprojet_id'=> $request->avant_projet,
                'critere_id'=> $critere->id,
                'type_evaluation'=>'humain',
                'note'=> $request->$note
        ]);
        }        
        }
        $preprojet->update([
            'note_totale'=>$preprojet->evaluations->sum('note'),
        ]);
        return redirect()->back();
    }
    public function store_preprojet(Request $request){
        //dd($request->all());
        $type_entreprise=$request->type_entreprise;
        $programme=$request->programme;
       // dd($type_entreprise);
        $innovation_du_projets=Valeur::where('parametre_id',44 )->get();
        $indicateur_previsionel_du_projets=Valeur::where('parametre_id',46 )->whereNotIn('id',[7155])->get();
        $futur_annees=Valeur::where('parametre_id',17 )->get();
        $source_appros=Valeur::where('parametre_id',12 )->get();
        $effectifs=Valeur::where('parametre_id',15 )->get();
        $annees=Valeur::where('parametre_id',16 )->where('id','!=', 46)->get();
        $promoteur= Promoteur::where('code_promoteur',$request->code_promoteur)->first();
        $nouveaute_projets=Valeur::where('parametre_id',env("PARAMETRE_INOVATION_ENTREPRISE_ID") )->get();
        $lastOne = DB::table('preprojets')->latest('id')->first();
        if($lastOne){
            $num_projet = $promoteur->code_promoteur.'FP'.'_00'.$lastOne->id;
        }
        else{
            $num_projet = $promoteur->code_promoteur.'FP'.'_00'.'0';
        }
        $entreprise_nn_traite= Entreprise::where('promoteur_id', $promoteur->id)->get();
        $preprojet_controle_doublon= Preprojet::where("promoteur_id",$promoteur->id)->where("titre_projet",$request->titre_projet)->get();
       
             if(count($preprojet_controle_doublon)==0){
            $preprojet=Preprojet::create([
                "titre_projet"=> $request->titre_projet,
                "secteur_dactivite"=>  $request->secteur_activite,
                "maillon_dactivite"=>  $request->maillon_activite,
                "region"=>  $request->region,
                "province"=>  $request->province,
                "commune"=>  $request->commune,
                "guichet"=>  $request->guichet,
                "secteur_village"=>  $request->arrondissement,
                'forme_juridique_envisage'=>$request->forme_juridique_envisage,
                'aggrement_exige'=>$request->aggrement_exige,
                'precise_aggrement'=>$request->precise_aggrement,
                'nbre_innovation'=>$request->nbre_innovation,
                'nbre_nouveau_marche'=>$request->nbre_nouveau_marche,
                'nbre_nouveau_produit'=>$request->nbre_nouveau_produit,
                // 'effectif_permanent_homme'=>$request->effectif_permanent_homme,
                // 'effectif_permanent_femme'=>$request->effectif_permanent_femme,
                // 'effectif_temporaire_homme'=>$request->effectif_temporaire_homme,
                // 'effectif_temporaire_femme'=>$request->effectif_temporaire_femme,
                "origine_clientele"=> $request->provenance_clientele,
                "type_clientele"=>  $request->nature_client,
                "site_disponible"=>$request->site_disponible,
                "type_site"=>$request->type_site,
                "description"=>  $request->description_idee_de_projet,
                "objectifs"=>  $request->objectifs_projet,
                "cout_total"=>  reformater_montant2($request->cout_total),
                "apport_personnel"=>  reformater_montant2($request->apport_personnel),
                "subvention_souhaite"=>  reformater_montant2($request->subvention_sollicite),
                "autre_financement"=>  reformater_montant2($request->autre_source),
                'nbre_innovation'=>$request->nbre_innovation,
                'nbre_nouveau_marche'=>$request->nbre_nouveau_marche,
                'nbre_nouveau_produit'=>$request->nbre_nouveau_produits,
                'effectif_permanent_homme'=>$request->effectif_permanent_homme,
                'effectif_permanent_femme'=>$request->effectif_permanent_femme,
                'effectif_temporaire_homme'=>$request->effectif_temporaire_homme,
                'effectif_temporaire_femme'=>$request->effectif_temporaire_femme,
                'chiffre_daffaire_previsionnel'=>$request->chiffre_daffaire_previsionnel,
                "num_projet"=>  $num_projet,
                "entreprise_id"=>  $request->entreprise_id,
                "promoteur_id"=> $promoteur->id
            ]);
            
            $promoteur->update([
                "suscription_etape"=>3,
            ]);
            
        
        $innovations=$request->innovation_du_projets;
        if($innovations){
            foreach($innovations as $innovation){
                $parametre_id=Valeur::find($innovation)->parametre->id;
                    PreprojetParametre::create([
                            'preprojet_fp_id'=>$preprojet->id,
                            'parametre_id'=>$parametre_id,
                            'valeur_id'=>$innovation,
                    ]);
            }
            }
        
            $sources_dapprovisionnements=$request->source_appros;
           
            if($sources_dapprovisionnements){
                foreach($sources_dapprovisionnements as $sources_dapprovisionnement){
                    $parametre_id=Valeur::find($sources_dapprovisionnement)->parametre->id;
                        PreprojetParametre::create([
                                'preprojet_fp_id'=>$preprojet->id,
                                'parametre_id'=>$parametre_id,
                                'valeur_id'=>$sources_dapprovisionnement,
                        ]);
                }
                }
//Debut de l'evaluation du preprojet
//critere transversal
/* age et sexe du promoteur */

if($preprojet->promoteur->genre==1){
        $note_genre=5;
}
elseif($preprojet->promoteur->genre==2){
    if(calculer_age($preprojet->promoteur->datenais)>17 && calculer_age($preprojet->promoteur->datenais)<36){
        $note_genre=3;
    }
    else{
        $note_genre=0;
    }
}
/* handicap promoteur */
($preprojet->promoteur->avec_handicap==1)?($note_handicap=5):($note_handicap=0);
($preprojet->promoteur->situation_residence==2)?($note_situation_residence=5):($note_situation_residence=0);

/* potentialite creation d'emploi */
$creation_demploi=$preprojet->effectif_previsionnels->sum('homme')+$preprojet->effectif_previsionnels->sum('femme');
if($creation_demploi>5 || $creation_demploi==5){
    $note_creation_emplois=10;
}
if($creation_demploi>2 || $creation_demploi<5){
    $note_creation_emplois=5;
}
if($creation_demploi==2 || $creation_demploi==1){
    $note_creation_emplois=3;
}
if($creation_demploi==0){
    $note_creation_emplois=0;
}
$this->createEvaluation($preprojet->id,1, $note_genre);
$this->createEvaluation($preprojet->id,2, $note_handicap);
$this->createEvaluation($preprojet->id,3, $note_situation_residence);
$this->createEvaluation($preprojet->id,16, $note_creation_emplois);



// Startup

if($preprojet->entreprise_id==null){

}
// Entreprise existante
elseif($preprojet->entreprise_id==null){
    
}

        $data["email"] = $promoteur->email_promoteur;
        $this->email= $promoteur->email_promoteur;
       // Mail::to($this->email)->queue(new resumeMail($entreprise->promotrice->id));
       // Mail::to($this->email)->queue(new recepisseMail($promoteur->id,'FP'));
        //$entreprise=$entreprise->id;
        
     }
        $nbre_ent_nn_traite = count($entreprise_nn_traite);
        return view("fond_partenariat.validateStep1", compact('programme',"type_entreprise","promoteur","nbre_ent_nn_traite"));
  }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
