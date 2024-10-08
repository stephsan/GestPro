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
use App\Models\HistoriquePreprojet;
use App\Models\HistoriquePreprojetPe;
use Illuminate\Support\Facades\Mail;
use App\Mail\recepisseMail;
use App\Mail\resumeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PreprojetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(["store_preprojet",'store_preprojet_pe']);
    }
    function createEvaluation_fp($idprojet,$indicateur,$note,$type_evaluation ){
     $evaluation=Evaluation::where('preprojet_fp_id',$idprojet)->where('critere_id',$indicateur)->get();
     if(count($evaluation)==0){
        Evaluation::create([
            "preprojet_fp_id"=>$idprojet,
            "type_evaluation"=>$type_evaluation,
            "note"=>$note,
            "critere_id"=> $indicateur
        ]);
     }  
    }
    function create_historique_preprojet_traitement($preproje_id,$operation){
        HistoriquePreprojet::create([
            'preprojet_id'=>$preproje_id,
            'operation'=>$operation,
            'user_id' =>Auth::user()->id,
        ]);
    }
    function create_historique_preprojet_traitement_pe($preproje_id,$operation){
        HistoriquePreprojetPe::create([
            'preprojet_pe_id'=>$preproje_id,
            'operation'=>$operation,
            'user_id' =>Auth::user()->id,
        ]);
    }
    function createEvaluation_pe($idprojet,$indicateur,$note ){
        $evaluation=Evaluation::where('preprojet_pe_id',$idprojet)->where('critere_id',$indicateur)->get();
        if(count($evaluation)==0){
           Evaluation::create([
               "preprojet_pe_id"=>$idprojet,
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
                $type='pe_startup';
                $statut='fp_a_evaluer';
        }
        else if($type_entreprise=='entreprise_existante'){
            $preprojets=Preprojet::where('entreprise_id','!=', null)->orderBy('created_at','desc')->get();
            $type='fp_mpme_existante';
            $statut='fp_enregistre';
        }
        return view('preprojet.index',compact('preprojets','type','statut'));
    }
    public function lister_pe(Request $request){
        $type_entreprise= $request->type_entreprise;
        if($type_entreprise=='startup'){
            $preprojets=PreprojetPe::where('entreprise_id', null)->orderBy('created_at','desc')->get();
            $type='pe_startup';
            $statut='pe_enregistre';
            
        }
        else if($type_entreprise=='entreprise_existante'){
            $preprojets=PreprojetPe::where('entreprise_id','!=', null)->orderBy('created_at','desc')->get();
            $type='pe_mpme_existante';
            $statut='pe_enregistre';
        }
        return view('preprojet.index_pe',compact('preprojets','type','statut'));
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
        return redirect()->back();
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
                "innovation_details"=>  $request->innovation_details,
                "deja_suivi_une_formation"=>  $request->deja_suivi_une_formation,
                'forme_juridique_envisage'=>$request->forme_juridique_envisage,
                'emploi_previsionnel' =>$request->emploi_previsionnel,
                'chiffre_daffaire_previsionnel'=>$request->chiffre_daffaire_previsionnel,
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
                "promoteur_id"=> $promoteur->id,
                'experience_du_promoteur'=>$request->experience_promoteur,
            ]);
            
            $promoteur->update([
                "suscription_etape_pe"=>3,
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
                        $innovations=$request->innovation_du_projets;
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
                        ($preprojet->promoteur->situation_residence==2)?($note_situation_residence=5):($note_situation_residence=0);
                        ($preprojet->promoteur->avec_handicape==1)?($note_handicap=5):($note_handicap=0);
                        ($preprojet->etude_technique_de_faisabilite==1)?($note_etude_technique_de_faisabilite=5):($note_etude_technique_de_faisabilite=0);
                        ($preprojet->prototype_existe==1)?($note_prototype_existe=5):($note_prototype_existe=0);
                        ($preprojet->etude_de_marche==1)?($note_etude_de_marche=5):($note_etude_de_marche=0);
                        ($preprojet->recherche_de_financement_envisage==1)?($note_recherche_de_financement_envisage=5):($note_recherche_de_financement_envisage=0);
                        ($preprojet->site_disponible==1)?($note_site=5):($note_site=0);


                        /* potentialite creation d'emploi */
                            $creation_demploi=$preprojet->emploi_previsionnel  ;
                            if($creation_demploi==7180){
                                $note_creation_emplois=2;
                            }
                            elseif($creation_demploi==7181){
                                $note_creation_emplois=3;
                            }
                            else{
                                $note_creation_emplois=5;
                            }
                         
                            if($preprojet->experience_du_promoteur==6686){
                                $note_experience_promoteur=0;
                            }
                            if($preprojet->experience_du_promoteur==6687){
                                $note_experience_promoteur=2;
                            }
                            if($preprojet->experience_du_promoteur==6688){
                                $note_experience_promoteur=3;
                            }
                            if($preprojet->experience_du_promoteur==6689){
                                $note_experience_promoteur=5;
                            }
                            
                            $this->createEvaluation_pe($preprojet->id,1, $note_genre);
                            $this->createEvaluation_pe($preprojet->id,2, $note_handicap);
                            $this->createEvaluation_pe($preprojet->id,14, $note_experience_promoteur);
                            $this->createEvaluation_pe($preprojet->id,16, $note_creation_emplois);
                            $this->createEvaluation_pe($preprojet->id,19, $note_etude_technique_de_faisabilite);
                            $this->createEvaluation_pe($preprojet->id,22, $note_site);
                            $this->createEvaluation_pe($preprojet->id,21, $note_recherche_de_financement_envisage);
                            $this->createEvaluation_pe($preprojet->id,20, $note_prototype_existe);

                            if ($request->hasFile('doc_projet')) {
                                $file = $request->file('doc_projet');
                                $extension=$file->getClientOriginalExtension();
                                $fileName = 'doc_projet'.'.'.$extension;
                                $emplacement='public'.'/'.$preprojet->num_projet;
                                $urldoc_projet= $request['doc_projet']->storeAs($emplacement, $fileName);
                                Piecejointe::create([
                                      'type_piece'=>env("VALEUR_ID_DOCUMENT_SYNTHETIQUE_PROJET"),
                                      'preprojet_pe_id'=>$preprojet->id,
                                      'url'=>$urldoc_projet,
                                  ]);
                            }
                            else{
                                $urldoc_projet=null;
                            }
                            if ($request->hasFile('engagement')) {
                                $file = $request->file('engagement');
                                $extension=$file->getClientOriginalExtension();
                                $fileName = 'engagement'.'.'.$extension;
                                $emplacement='public'.'/'.$preprojet->num_projet;
                                $urlengagement= $request['engagement']->storeAs($emplacement, $fileName);
                                Piecejointe::create([
                                      'type_piece'=>env("VALEUR_ID_DOCUMENT_ENGAGEMENT"),
                                      'preprojet_pe_id'=>$preprojet->id,
                                      'url'=>$urlengagement,
                                  ]);
                            }
                            else{
                                $urlengagement=null;
                            }
                            $data["email"] = $promoteur->email_promoteur;
                            $this->email= $promoteur->email_promoteur;
                            Mail::to($this->email)->queue(new recepisseMail($promoteur->id,'PE'));
            
        }
            $nbre_ent_nn_traite = count($entreprise_nn_traite);
            return view("programme_entreprendre.validateStep1", compact('programme',"type_entreprise","promoteur","nbre_ent_nn_traite"));
     }

     public function afficher_details_fp(Preprojet $preprojet, Request $request){
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $promoteur=Promoteur::where('id',$preprojet->promoteur_id)->first();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $chiffre_daffaires=Infoentreprise::where('entreprise_id',$entreprise->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE'))->get();
        $effectif_permanent= Infoeffectifentreprise::where('entreprise_id',$entreprise->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire= Infoeffectifentreprise::where('entreprise_id',$entreprise->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $projet_innovations= PreprojetParametre::where("parametre_id",44)->where("preprojet_fp_id",$preprojet->id)->get();
        $sources_dapprovisionnements= PreprojetParametre::where("parametre_id",12)->where("preprojet_fp_id",$preprojet->id)->get();
        $evaluations=Evaluation::where('preprojet_fp_id',$preprojet->id)->where('type_evaluation','automatique')->get();
        $all_evaluations=Evaluation::where('preprojet_fp_id',$preprojet->id)->get();

       // dd($evaluations);
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
            
           $criteres= Critere::where('categorie','FP_preprojet')->orWhere('categorie','Toute_categorie')->get();
            //$criteres= Critere::where('categorie','FP_preprojet')->get();
            $criteres= $criteres->except($id_criteres);
            //dd($evaluations);
        if($entreprise)
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("entreprise_id", $entreprise->id )->orWhere("preprojet_fp_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        else
            $piecejointes=Piecejointe::Where("preprojet_fp_id", $promoteur->id )->orWhere("projet_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        if($request->type_detail=='analyser'){
            $evaluations_humains=Evaluation::where('preprojet_fp_id',$preprojet->id)->where('type_evaluation','humain')->get();
            return view('preprojet.analyser',compact('all_evaluations','evaluations_humains','sources_dapprovisionnements','evaluations','criteres','projet_innovations','effectif_permanent','effectif_temporaire','chiffre_daffaires','preprojet','piecejointes'));
        }
       
           else
        return view('preprojet.show',compact('sources_dapprovisionnements','evaluations','criteres','projet_innovations','effectif_permanent','effectif_temporaire','chiffre_daffaires','preprojet','piecejointes'));
        
    }
    public function afficher_details_pe(PreprojetPe $preprojet, Request $request){
        $entreprise=Entreprise::where('id',$preprojet->entreprise_id)->first();
        $promoteur=Promoteur::where('id',$preprojet->promoteur_id)->first();
        $chiffre_daffaires=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $nombre_de_client_envisages=Infoentreprise::where('preprojet_id',$preprojet->id)->where('indicateur',env('VALEUR_ID_CHIFFRE_DAFFAIRE_PREVI'))->get();
        $effectif_permanent_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_PERMANENENT"))->get();
        $effectif_temporaire_previsionels= Infoeffectifentreprise::where("preprojet_id",$preprojet->id)->where("effectif",env("VALEUR_EFFECTIF_TEMPORAIRE"))->get();
        $projet_innovations= PreprojetParametre::where("preprojet_pe_id",$preprojet->id)->where('parametre_id',44)->get();
        $source_appros= PreprojetParametre::where("preprojet_pe_id",$preprojet->id)->where('parametre_id',12)->get();
        $formations_effectuees= PreprojetParametre::where("preprojet_pe_id",$preprojet->id)->where('parametre_id',51)->get();
        $formations_souhaites= PreprojetParametre::where("preprojet_pe_id",$preprojet->id)->where('parametre_id',50)->get();
        //$evaluations=Evaluation::where('preprojet_pe_id',$preprojet->id)->get();
        $evaluations=Evaluation::where('preprojet_pe_id',$preprojet->id)->where('type_evaluation','automatique')->get();
        $all_evaluations=Evaluation::where('preprojet_pe_id',$preprojet->id)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','PE_preprojet')->orWhere('categorie','Toute_categorie')->get();
        $criteres= $criteres->except($id_criteres);
        if($entreprise)
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("entreprise_id", $entreprise->id )->orWhere("preprojet_pe_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        else
            $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("preprojet_pe_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        if($request->type_detail=='analyser'){
            $evaluations_humains=Evaluation::where('preprojet_pe_id',$preprojet->id)->where('type_evaluation','humain')->get();
            return view('preprojet.analyser_pe',compact('source_appros','all_evaluations','evaluations_humains','effectif_permanent_previsionels','evaluations','effectif_temporaire_previsionels','criteres','projet_innovations','formations_effectuees','formations_souhaites','chiffre_daffaires','preprojet','piecejointes'));
        }
       else
        return view('preprojet.show_pe',compact('source_appros','all_evaluations','effectif_permanent_previsionels','evaluations','effectif_temporaire_previsionels','criteres','projet_innovations','formations_effectuees','formations_souhaites','chiffre_daffaires','preprojet','piecejointes'));
          
    }
    public function show(Preprojet $preprojet)
    {
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
        $piecejointes=Piecejointe::Where("promoteur_id", $promoteur->id )->orWhere("preprojet_fp_id", $preprojet->id )->orderBy('updated_at', 'desc')->get();
        
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

    public function save_eligibilite(Request $request){
        $preprojet= Preprojet::find($request->preprojet_id);
        $preprojet->update([
            'eligible'=>$request->avis,
            'commentaire_eligibilité'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement($preprojet->id,"Eligiblité de l'avant-projet");
        return redirect()->back();
    }
    public function valider_evaluation(Request $request){
        $preprojet= Preprojet::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>$request->avis,
            'commentaire_evaluation'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement($preprojet->id,"Valider l'évaluation");
        return redirect()->back();
    }
    public function save_avis_de_lequipe(Request $request){
        $preprojet= Preprojet::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>'affectes_au_comite_de_selection',
            'avis_de_lequipe'=>$request->avis,
            'commentaires_de_lequipe'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement($preprojet->id,"Donner l'avis de l'équipe");
        return redirect()->back();
    }
    public function save_avis_de_lequipe_pe(Request $request){
        $preprojet= PreprojetPe::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>'affectes_au_comite_de_selection',
            'avis_de_lequipe'=>$request->avis,
            'commentaires_de_lequipe'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement_pe($preprojet->id,"Donner l'avis de l'équipe");
        return redirect()->back();
    }
    public function save_avis_decision_du_comite(Request $request){
        $preprojet= Preprojet::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>'traite_par_le_comite',
            'decision_du_comite'=>$request->avis,
            'commentaire_du_comite'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement($preprojet->id,"Enregistrer la décision du comité");
        return redirect()->back();
    }
    public function save_avis_decision_du_comite_pe(Request $request){
        $preprojet= PreprojetPe::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>'traite_par_le_comite',
            'decision_du_comite'=>$request->avis,
            'commentaire_du_comite'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement_pe($preprojet->id,"Enregistrer la décision du comité");
        return redirect()->back();

    }
    public function evaluer(Request $request){
    if (Auth::user()->can('evaluer_souscription')) {
        $preprojet = Preprojet::find($request->avant_projet);
        $evaluations=Evaluation::where('preprojet_fp_id',$request->avant_projet)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','FP_preprojet')->orWhere('categorie','Toute_categorie')->get();
        $criteres= $criteres->except($id_criteres);
        foreach($criteres as $critere){
            $note= $critere->id;
        $evaluation_du_projet = Evaluation::where(['preprojet_fp_id'=>$preprojet->id,'critere_id'=> $critere->id,])->get();
        if($evaluation_du_projet->count()==0){
            Evaluation::create([
                'preprojet_fp_id'=> $preprojet->id,
                'critere_id'=> $critere->id,
                'type_evaluation'=>'humain',
                'note'=> $request->$note
        ]);
        }        
        }
        $note_totale=Evaluation::where('preprojet_fp_id',$request->avant_projet)->sum('note');
        $preprojet->update([
            'note_totale'=>$note_totale,
            'statut'=>'evalue'
        ]);
        $this->create_historique_preprojet_traitement($preprojet->id,'evaluation');
        return redirect()->back()->with('success',"Evaluation enregistrée avec success");
     }
     else{
        return back()->with('error', 'Vous ne disposez pas des droits requis pour cette action.');
     }
    }

    public function evaluation_modify(Request $request){
        $preprojet= Preprojet::find($request->avant_projet);
        $evaluations_humains=Evaluation::where('preprojet_fp_id',$preprojet->id)->where('type_evaluation','humain')->get();
        foreach($evaluations_humains as $evaluations_humain){
            $variable=$evaluations_humain->id;
            $evaluations_humain->update([
                'note'=>$request->$variable,
            ]);

        }
        $evaluations=Evaluation::where('preprojet_fp_id',$preprojet->id)->get();
        $total=$evaluations->sum('note');
       // dd($total);
        $preprojet->update([
            'statut'=>'evalue',
            'note_totale'=> $total,
            'commentaire_evaluation'=>''

        ]);
        return back()->with('success', 'Evaluation modifiée avec succes');

    }
    public function evaluation_modify_pe(Request $request){
        $preprojet= PreprojetPe::find($request->avant_projet);
        $evaluations_humains=Evaluation::where('preprojet_pe_id',$preprojet->id)->where('type_evaluation','humain')->get();
        foreach($evaluations_humains as $evaluations_humain){
            $variable=$evaluations_humain->id;
            $evaluations_humain->update([
                'note'=>$request->$variable,
            ]);

        }
        $evaluations=Evaluation::where('preprojet_pe_id',$preprojet->id)->get();
        $total=$evaluations->sum('note');
       // dd($total);
        $preprojet->update([
            'statut'=>'evalue',
            'note_totale'=> $total,
            'commentaire_evaluation'=>''

        ]);
        return back()->with('success', 'Evaluation modifiée avec succes');

    }
    public function save_eligibilite_pe(Request $request){
        $preprojet= PreprojetPe::find($request->preprojet_id);
        $preprojet->update([
            'eligible'=>$request->avis,
            'commentaire_eligibilité'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement_pe($preprojet->id,"Eligiblité de l'avant-projet");
        return redirect()->back();
    }

    public function evaluer_pe(Request $request){
        $preprojet = PreprojetPe::find($request->avant_projet);
        $evaluations=Evaluation::where('preprojet_pe_id',$request->avant_projet)->get();
        $id_criteres=[];
        $i=0;
        foreach($evaluations as $evaluation)
                {
                    $id_criteres[$i]= $evaluation->critere_id;
                    $i++;
                }
        $criteres= Critere::where('categorie','PE_preprojet')->orWhere('categorie','Toute_categorie')->get();
        $criteres= $criteres->except($id_criteres);
        foreach($criteres as $critere){
            $note= $critere->id;
        $evaluation_du_projet = Evaluation::where(['preprojet_pe_id'=>$preprojet->id,'critere_id'=> $critere->id,])->get();
        if($evaluation_du_projet->count()==0){
            Evaluation::create([
                'preprojet_pe_id'=> $request->avant_projet,
                'critere_id'=> $critere->id,
                'type_evaluation'=>'humain',
                'note'=> $request->$note
        ]);
            $this->create_historique_preprojet_traitement_pe($preprojet->id,"Eligiblité de l'avant-projet");

        } 
        }
        $note_totale=Evaluation::where('preprojet_pe_id',$request->avant_projet)->sum('note');
        $preprojet->update([
            'note_totale'=>$note_totale,
            'statut'=>'evalue'
        ]);
        return redirect()->back()->with('success',"Evaluation enregistrée avec success");

    }
    public function valider_evaluation_pe(Request $request){
        $preprojet= PreprojetPe::find($request->preprojet_id);
        $preprojet->update([
            'statut'=>$request->avis,
            'commentaire_evaluation'=>$request->observation,
        ]);
        $this->create_historique_preprojet_traitement_pe($preprojet->id,"Valider l'évaluation");
        return redirect()->back();
    }
    public function store_preprojet(Request $request){
        return redirect()->back();
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
            //  $request->validate([
            //         'cout_total' =>'required',
            //         'apport_personnel' =>'required',
            //         'subvention_souhaite' =>'required',
            //         'autre_financement' =>'required',
            //         'titre_projet' =>'required',
            //         ]);
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
                // 'experience_du_promoteur'=>$request->experience_du_promoteur,
                'nbre_nouveau_marche'=>$request->nbre_nouveau_marche,
                'nbre_nouveau_produit'=>$request->nbre_nouveau_produits,
                'effectif_permanent_homme'=>$request->effectif_permanent_homme,
                'effectif_permanent_femme'=>$request->effectif_permanent_femme,
                'effectif_temporaire_homme'=>$request->effectif_temporaire_homme,
                'effectif_temporaire_femme'=>$request->effectif_temporaire_femme,
                'chiffre_daffaire_previsionnel'=>$request->chiffre_daffaire_previsionnel,
                "num_projet"=>  $num_projet,
                "entreprise_id"=>  $request->entreprise_id,
                "promoteur_id"=> $promoteur->id,
                'experience_du_promoteur'=>$request->experience_promoteur,
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
($preprojet->promoteur->avec_handicape==1)?($note_handicap=5):($note_handicap=0);
($preprojet->promoteur->situation_residence==2)?($note_situation_residence=5):($note_situation_residence=0);

/* potentialite creation d'emploi */
$creation_demploi=$preprojet->effectif_permanent_homme + $preprojet->effectif_permanent_femme + $preprojet->effectif_temporaire_homme + $preprojet->effectif_temporaire_femme  ;
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
if($preprojet->experience_du_promoteur==6686){
    $note_experience_promoteur=0;
}
if($preprojet->experience_du_promoteur==6687){
    $note_experience_promoteur=2;
}
if($preprojet->experience_du_promoteur==6688){
    $note_experience_promoteur=3;
}
if($preprojet->experience_du_promoteur==6689){
    $note_experience_promoteur=5;
}
if($preprojet->entreprise->nombre_annee_existence==6702){
    $note_existence_entreprise=2;
}
if($preprojet->entreprise->nombre_annee_existence==6703){
    $note_existence_entreprise=3;
}
if($preprojet->entreprise->nombre_annee_existence==6704){
    $note_existence_entreprise=5;
}
$this->createEvaluation_fp($preprojet->id,1, $note_genre,'automatique');
$this->createEvaluation_fp($preprojet->id,2, $note_handicap,'automatique');
$this->createEvaluation_fp($preprojet->id,14, $note_experience_promoteur,'automatique');
$this->createEvaluation_fp($preprojet->id,16, $note_creation_emplois,'automatique');
$this->createEvaluation_fp($preprojet->id,23, $note_existence_entreprise,'automatique');

if ($request->hasFile('doc_projet')) {
    $file = $request->file('doc_projet');
    $extension=$file->getClientOriginalExtension();
    $fileName = 'doc_projet'.'.'.$extension;
    $emplacement='public'.'/'.$preprojet->num_projet;
    $urldoc_projet= $request['doc_projet']->storeAs($emplacement, $fileName);
    Piecejointe::create([
        'type_piece'=>env("VALEUR_ID_DOCUMENT_SYNTHETIQUE_PROJET"),
          'preprojet_fp_id'=>$preprojet->id,
          'url'=>$urldoc_projet,
      ]);
}
else{
    $urldoc_projet=null;
}
if ($request->hasFile('engagement')) {
    $file = $request->file('engagement');
    $extension=$file->getClientOriginalExtension();
    $fileName = 'engagement'.'.'.$extension;
    $emplacement='public'.'/'.$preprojet->num_projet;
    $urlengagement= $request['engagement']->storeAs($emplacement, $fileName);
    Piecejointe::create([
        'type_piece'=>env("VALEUR_ID_DOCUMENT_ENGAGEMENT"),
          'preprojet_fp_id'=>$preprojet->id,
          'url'=>$urlengagement,
      ]);
}
else{
    $urlengagement=null;
}

// Startup

if($preprojet->entreprise_id==null){

}
// Entreprise existante
elseif($preprojet->entreprise_id==null){
    
}
        $data["email"] = $promoteur->email_promoteur;
        $this->email= $promoteur->email_promoteur;
        //Mail::to($this->email)->queue(new resumeMail($entreprise->promotrice->id));
        Mail::to($this->email)->queue(new recepisseMail($promoteur->id,'FP'));
        //$entreprise=$entreprise->id;
        
     }
        $nbre_ent_nn_traite = count($entreprise_nn_traite);
        return view("fond_partenariat.validateStep1", compact('programme',"type_entreprise","promoteur","nbre_ent_nn_traite"));
  }

        public function completer_evaluation_automatique(Request $request){
                $preprojets=Preprojet::all();
                foreach($preprojets as $preprojet){
                    ($preprojet->promoteur->situation_residence==2)?($note_situation_residence=5):($note_situation_residence=0);
                    if($preprojet->entreprise->formalise==1){
                        if($preprojet->entreprise->forme_juridique=19){
                            $note_forme_juridique=3;
                        }
                        else{
                            $note_forme_juridique=5;
                        }
                    }
                    else{
                        $note_forme_juridique=0;
                    }
                    $this->createEvaluation_fp($preprojet->id,3, $note_situation_residence,'automatique');
                    //$this->createEvaluation_fp($preprojet->id,13, $note_forme_juridique,'automatique');
                }
                return redirect()->back()->with('success','Evaluation complémentaire éffectuée avec success');
        }

/*** BLOC TRAITEMENT DES avant-projets fonds de partenariat */

public function lister_preprojet_fp_en_traitement(Request $request){
    if($request->type_entreprise=='entreprise_existante'){
        if($request->statut=='a_evaluer'){
            //statuer sur l'éligibilité
            if (Auth::user()->can('lister_avant_projet_a_evaluer_fp')) {
                        $preprojets= Preprojet::where('statut',NULL)->where('eligible', NULL)->where('region', Auth::user()->zone)->orWhere('zone_daffectation', Auth::user()->zone)->orderBy('updated_at','desc')->get();
                        $type='fp_mpme_existante';
                        $statut='fp_a_evaluer';
                        $titre='Liste des avant-projets a analyser du fonds de partenatiat';   
                }
                else{
                    return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
                }                 
        }
        //dossiers analysés en attente d'evaluation des conseillers
        elseif($request->statut=='eligible'){
            if (Auth::user()->can('lister_avant_projet_a_evaluer_fp')) {
                if(Auth::user()->zone!=100){
                    $preprojets= Preprojet::where(function ($query) {
                        $query->where('statut', '=', NULL)
                              ->orWhere('statut', '=', 'evaluation_rejetee');
                                })
                                ->where(function ($query) {
                                    $query->where('zone_daffectation', '=', Auth::user()->zone)
                                        ->orWhere('region', '=', Auth::user()->zone);
                                })
                                ->where('eligible','eligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }else{
                    $preprojets= Preprojet::where('eligible','eligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }
                    $type='fp_mpme_existante';
                    $statut='fp_eligible';
                    $titre="Liste des avant-projets éligibles en attente d'évaluation";
            }
            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
        }
        elseif($request->statut=='ineligible'){
            if (Auth::user()->can('lister_avant_projet_ineligible')) {
                if(Auth::user()->zone!=100){
                    $preprojets= Preprojet::where(function ($query) {
                        $query->where('statut', '=', NULL)
                              ->orWhere('statut', '=', 'evaluation_rejetee');
                                })
                                ->where(function ($query) {
                                    $query->where('zone_daffectation', '=', Auth::user()->zone)
                                        ->orWhere('region', '=', Auth::user()->zone);
                                })
                                ->where('eligible','ineligible')
                                ->orderBy('updated_at','desc')
                                ->get();
              }
            else{
                    $preprojets= Preprojet::where('eligible','ineligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }
                        $type='fp_mpme_existante';
                        $statut='fp_ineligible';
                        $titre="Liste des avant-projets inéligibles";
        }
        else{
            return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
        } 
        }
        elseif($request->statut=='evalues'){
            if (Auth::user()->can('lister_avant_projet_evalues_fp')) {
                $preprojets= Preprojet::whereIn('statut',['evalue','evaluation_validee'])->orderBy('updated_at','desc')->get();
                $type='fp_mpme_existante';
                $statut='fp_evalues';
                $titre="Liste des avant-projets en attente de l'avis de l'équipe";
            }
            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
        }
        elseif($request->statut=='soumis_au_comite' ){
            if (Auth::user()->can('lister_avant_projet_soumis_au_comite_fp')) {
                $preprojets= Preprojet::where('statut','affectes_au_comite_de_selection')->orderBy('updated_at','desc')->get();
                $type='fp_mpme_existante';
                $statut='fp_soumis_au_comite';
                $titre="Liste des avant-projets soumis au comité";
            }

            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
    }
        return view('preprojet.liste_traitement_preprojet',compact('preprojets','type','statut','titre'));

        }
        
        else{
        return redirect()->back();
        }
}

public function lister_preprojet_fp_preselectionnes(Request $request){
    if($request->type_entreprise=='entreprise_existante'){
        if(Auth::user()->zone!=100){
            $preprojets= Preprojet::where('statut','traite_par_le_comite')->where('decision_du_comite','favorable')
            ->where(function ($query) {
                $query->where('zone_daffectation', '=', Auth::user()->zone)
                    ->orWhere('region', '=', Auth::user()->zone);
            })
            ->orderBy('updated_at','desc')->get();
        }
        elseif(Auth::user()->zone==100){
            $preprojets= Preprojet::where('statut','traite_par_le_comite')->where('decision_du_comite','favorable')->orderBy('updated_at','desc')->get();
        }
            $type='fp_mpme_existante';
            $statut='fp_selectionne_par_le_comite';
            $titre="Liste des avant-projets sélectionnés par le comité de selection";
       
    }
    elseif($request->type_entreprise=='startup'){

    }
    
    return view('preprojet.liste_preprojet_traite_par_le_comite',compact('preprojets','type','statut','titre'));
}

public function lister_preprojet_pe_preselectionnes(Request $request){
    if($request->type_entreprise=='startup'){
        if(Auth::user()->zone!=100){
            $preprojets= PreprojetPe::where('statut','traite_par_le_comite')->where('decision_du_comite','favorable')
            ->where(function ($query) {
                $query->where('zone_daffectation', '=', Auth::user()->zone)
                    ->orWhere('region', '=', Auth::user()->zone);
            })
            ->orderBy('updated_at','desc')->get();
        }
        elseif(Auth::user()->zone==100){
            $preprojets= PreprojetPe::where('statut','traite_par_le_comite')->where('decision_du_comite','favorable')->orderBy('updated_at','desc')->get();
        }
            $type='pe_startup';
            $statut='pe_selectionne_par_le_comite';
            $titre="Liste des avant-projets sélectionnés par le comité de sélection pour le programme entreprendre";
    }
    elseif($request->type_entreprise=='mpme_existante'){

    }
    
    return view('preprojet.liste_preprojet_traite_par_le_comite_pe',compact('preprojets','type','statut','titre'));
}



public function lister_preprojet_pe_en_traitement(Request $request){
    if($request->type_entreprise=='startup'){
        if($request->statut=='a_evaluer'){
            if (Auth::user()->can('lister_avant_projet_a_evaluer_pe')) {
                    $preprojets= PreprojetPe::where('statut',NULL)->where('eligible', NULL)
                        ->where(function ($query) {
                            $query->where('zone_daffectation', '=', Auth::user()->zone)
                                ->orWhere('region', '=', Auth::user()->zone);
                        })
                        ->orderBy('updated_at','desc')
                        ->get();
                $type='pe_startup';
                $statut='pe_a_analyser';
                $titre='Liste des avant-projets a analyser du programme entreprendre';
            }
            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }
        }
        elseif($request->statut=='eligible'){
            if (Auth::user()->can('lister_avant_projet_a_evaluer_pe')) {
                if(Auth::user()->zone!=100){
                    $preprojets= PreprojetPe::where(function ($query) {
                        $query->where('statut', '=', NULL)
                              ->orWhere('statut', '=', 'evaluation_rejetee');
                                })
                                ->where(function ($query) {
                                    $query->where('zone_daffectation', '=', Auth::user()->zone)
                                        ->orWhere('region', '=', Auth::user()->zone);
                                })
                                ->where('eligible','eligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }else{
                    $preprojets= PreprojetPe::where('eligible','eligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }
                    $type='pe_startup';
                    $statut='pe_eligible';
                    $titre="Liste des avant-projets éligibles en attente d'évaluation";
            }
            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
        }
        elseif($request->statut=='ineligible'){
            if (Auth::user()->can('lister_avant_projet_ineligible_pe')) {
                if(Auth::user()->zone!=100){
                    $preprojets= PreprojetPe::where(function ($query) {
                        $query->where('statut', '=', NULL)
                              ->orWhere('statut', '=', 'evaluation_rejetee');
                                })
                                ->where(function ($query) {
                                    $query->where('zone_daffectation', '=', Auth::user()->zone)
                                        ->orWhere('region', '=', Auth::user()->zone);
                                })
                                ->where('eligible','ineligible')
                                ->orderBy('updated_at','desc')
                                ->get();
              }
            else{
                    $preprojets= PreprojetPe::where('eligible','ineligible')
                                ->orderBy('updated_at','desc')
                                ->get();
                }
                        $type='pe_startup';
                        $statut='pe_ineligible';
                        $titre="Liste des avant-projets du programme entreprendre inéligibles";
        }
        else{
            return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
        } 
        }
        elseif($request->statut=='evalues'){
            if (Auth::user()->can('lister_avant_projet_evalues_pe')) {
                $preprojets= PreprojetPe::whereIn('statut',['evalue','evaluation_validee'])->orderBy('updated_at','desc')->get();
                $type='pe_startup';
                $statut='pe_evalues';
                $titre="Liste des avant-projets du programme entreprendre en attente de l'avis de l'équipe";
            }
            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
        }
        elseif($request->statut=='soumis_au_comite' ){
            if (Auth::user()->can('lister_avant_projet_soumis_au_comite_pe')) {
                $preprojets= PreprojetPe::where('statut','affectes_au_comite_de_selection')->orderBy('updated_at','desc')->get();
                $type='pe_startup';
                $statut='pe_soumis_au_comite';
                $titre="Liste des avant-projets du programme entreprendre soumis au comité";
            }

            else{
                return redirect()->back()->with('error','Vous ne disposez pas des droits requis pour acceder a cette ressource');
            }  
     }
    }
    return view('preprojet.liste_traitement_preprojet_pe',compact('preprojets','type','statut','titre'));
}
public function lister_preprojet_soumis_au_comite_fp(Request $request)
{
    $type='fp_mpme_existante';
    $statut='fp_soumis_au_comite';
    $titre="Liste des avant-projets soumis au comité";
    $preprojets= Preprojet::where('statut','soumis_au_comite')->get();
    return view('preprojet.liste_traitement_preprojet',compact('preprojets','type','statut','titre'));

}
public function lister_preprojet_soumis_au_comite_pe(Request $request)
{
    $type='pe_startup';
    $statut='pe_soumis_au_comite';
    $titre="Liste des avant-projets soumis au comité pour le programme entreprendre";
    $preprojets= PreprojetPe::where('statut','soumis_au_comite')->get();
    return view('preprojet.liste_traitement_preprojet_pe',compact('preprojets','type','statut','titre'));

}

/*** FIn du bloc  */

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
