<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Preprojet;
use App\Models\Coach;
use App\Models\Promoteur;
use App\Models\Valeur;
use App\Models\Piecejointe;
use Illuminate\Http\Request;
use App\Models\GrilleEvalPca;
use App\Models\EvaluationPCA;
use App\Models\InvestissementProjet;
use Illuminate\Support\Facades\Auth;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;
use App\Models\Activite;
use App\Models\Realisation;

class ProjetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function supprimer_doublon_de_pj($preprojet_id, $type_doc){
        $priece_a_supprimer= Piecejointe::where(['type_piece'=>$type_doc, 'preprojet_fp_id'=>$preprojet_id])->first();
        if($priece_a_supprimer){
            $priece_a_supprimer->delete();
        }
    }
    function createEvaluation($idprojet,$indicateur,$note){
        $evaluation=EvaluationPca::where('projet_id',$idprojet)->where('grilleeval_id',$indicateur)->get();
        if(count($evaluation)==0){
            EvaluationPca::create([
               "projet_id"=>$idprojet,
               "note"=>$note,
               "grilleeval_id"=> $indicateur
           ]);
        }  
        else{
            $evaluation=EvaluationPca::where('projet_id',$idprojet)->where('grilleeval_id',$indicateur)->first();
            $evaluation->update([
                "note"=>$note,
            ]);
        }
    }
public function valider_investissement(Request $request)
{
    $invest= InvestissementProjet::find($request->invest_id);
    $projet= $invest->projet;
    $preprojet= $projet->preprojet;
    $montant_investissement_total = $projet->investissements->sum('montant_valide') + $request->cout;
    $subvention_demandee_valide_total = $projet->investissements->sum('subvention_demandee_valide') + $request->cout;
    $taux_subvention=$subvention_demandee_valide_total/ $montant_investissement_total*100;
    //Verification du code de financement suivant le guichet
    if((($preprojet->guichet==7165 ) && $taux_subvention >65 && $subvention_demandee_valide_total> 10000000) || (($preprojet->guichet==7166 ) && $taux_subvention >50  && $subvention_demandee_valide_total > 50000000 ) || (($preprojet->guichet==7167 ) && $taux_subvention >65 && $subvention_demandee_valide_total> 100000000)  )
    {
        return redirect()->back()->with('success', "Bien vouloir respecter le code de financement du guichet".' '.getlibelle($preprojet->guichet));
    }
    else{
    $invest->update([
        'designation'=> $request->designation,
        'montant_valide'=> reformater_montant2($request->cout),
        'apport_perso_valide'=> reformater_montant2($request->apport_perso),
        'subvention_demandee_valide'=> reformater_montant2($request->subvention),
        'statut' => 'validé'
    ]);
    return redirect()->back()->with('success',"Lignes d'investissement validée avec success !!!");
}
}
public function rejetter_investissement(Request $request){
    $invest= InvestissementProjet::find($request->invest_id);
    $invest->update([
        'statut' => 'rejeté',
        'montant_valide'=> 0,
        'apport_perso_valide'=> 0,
        'subvention_demandee_valide'=> 0,
    ]);
    return redirect()->back();
}

public function savedecisioncomite(Request $request){
    $projet=Projet::find($request->projet_id);
    $preprojet= $projet->preprojet;
    $montant_investissement_total = $projet->investissements->sum('montant_valide') + $request->cout;
    $subvention_demandee_valide_total = $projet->investissements->sum('subvention_demandee_valide') + $request->cout;
    $taux_subvention=$subvention_demandee_valide_total/ $montant_investissement_total*100;
    //Verification du code de financement suivant le guichet
    if((($preprojet->guichet==7165 ) && $taux_subvention >65 && $subvention_demandee_valide_total> 10000000) || (($preprojet->guichet==7166 ) && $taux_subvention >50  && $subvention_demandee_valide_total > 50000000 ) || (($preprojet->guichet==7167 ) && $taux_subvention >65 && $subvention_demandee_valide_total> 100000000)  )
    {
        return redirect()->back()->with('success', "Bien vouloir respecter le code de financement du guichet".' '.getlibelle($preprojet->guichet));
    }
 
else{ 
        if($request->avis=='selectionné'){
            foreach($projet->appui1_investissements as $investissement){
                if($investissement->statut==null){
                    $investissement->update([
                        'statut'=>'validé',
                        'montant_valide'=>$investissement->montant,
                        'apport_perso_valide'=> $investissement->apport_perso,
                        'subvention_demandee_valide'=> $investissement->subvention_demandee,
                    ]);
                }
            }
        }
        elseif($request->avis =='rejeté'){
            foreach($projet->appui1_investissements as $investissement){
                if($investissement->statut==null){
                    $investissement->update([
                        'statut'=>'rejeté',
                        
                    ]);
                }
            }
        }
        $projet->update([
            'statut'=>$request->avis,
            'date_session_comite'=>now(),
            'observations'=>$request->observation,
            'montant_accorde'=>$projet->investissementvalides->sum('montant_valide')
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
    public function lister(Request $request){
        if($request->statut=='encours'){
            $texte= 'en cours';
            $page='projet_encours';
            $projets= Projet::all();
        }
        return view('projet.lister',compact('projets','texte','page'));
        
    }
    public function analyser(Projet $projet)
    {
        $categorie_investissements=Valeur::where('parametre_id', 38)->get();
        $categorie_projets=Valeur::where('parametre_id', 56)->get();

        $piecejointes=Piecejointe::where("preprojet_fp_id",$projet->preprojet->id)->whereIn('type_piece', [env("VALEUR_ID_DOCUMENT_PCA"), env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"), env("VALEUR_ID_DOCUMENT_DEVIS"),env("VALEUR_ID_DOCUMENT_FONCIER"), env("VALEUR_ID_FICHE_DANALYSE"), env("VALEUR_ID_DOCUMENT_AVIS_SES"), env("VALEUR_ID_DOCUMENT_AVIS_ANEVE"),env('VALEUR_ID_DOCUMENT_FICHE_EVALUATION'),env('VALEUR_ID_DOCUMENT_FICHE_DIAGNOSTIC')])->orderBy('updated_at', 'desc')->get();
    if($projet->preprojet->entreprise_id!=null){
        $criteres= GrilleEvalPca::where('categorie','MPME_existant')->get();
    }
    else{
        $criteres= GrilleEvalPca::where('categorie','startup')->get();
    }

        return view("projet.analyse", compact('categorie_projets','categorie_investissements','projet', 'piecejointes', 'criteres'));
    }
    public function rejeter_lanalyse_pa(){

    }
    public function chargerEvaluation(Request $request){
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());
        $reader = SimpleExcelReader::create($fichier);
        $rows = $reader->getRows();
        foreach($rows as $row){
            $datas[]= array('num_dossier'=>trim($row['num_dossier']),'1'=>$row['1']);
        }
        foreach($datas as $data){
            $preprojet=Preprojet::where('num_projet',$data['num_dossier'])->first();
            $projet=Projet::where('preprojet_id', $preprojet->id)->first();
            if($projet)
            {
                $this->createEvaluation($projet->id,1, $data['1']);
                $projet->update([
                    'statut' => 'evalué'
                ]);
            }
        }
        return redirect()->back()->with('success','La liste des évaluation de projet a été importée');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coachs= Coach::all();
       $categorie_investissments=Valeur::where('parametre_id', 38)->get();
        $promoteur = Promoteur::where('code_promoteur',Auth::user()->login)->first();
        $projet_type_pieces= Valeur::whereIn('id',[env('VALEUR_ID_DOCUMENT_DEVIS'),env('VALEUR_ID_DOCUMENT_FONCIER')])->get();
        //$preprojets = Preprojet::where('promoteur_id', $promoteur->id)->where('decision_du_comite','favorable')->get();
        $preprojet = Preprojet::where('promoteur_id', $promoteur->id)->where('decision_du_comite','favorable')->first();
        $projet = Projet::where('preprojet_id', $preprojet->id)->first();
            if($projet){
            $projet_piecejointes=Piecejointe::where("preprojet_fp_id",$preprojet->id)->whereIn('type_piece', [env("VALEUR_ID_DOCUMENT_PCA"), env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"), env("VALEUR_ID_DOCUMENT_DEVIS"),env("VALEUR_ID_DOCUMENT_FONCIER"),env("VALEUR_ID_DOCUMENT_ATTESTATION")])->orderBy('updated_at', 'desc')->get();
                return view('projet.myprojet',compact('projet_type_pieces','coachs','preprojet','projet','projet_piecejointes','categorie_investissments'));
            }else{
                return view('projet.create',compact('coachs','promoteur','preprojet','categorie_investissments'));
            }
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $year = date('Y');
        $this->validate($request, [
    		'denomination'=>'unique:projets,denomination',
    	]);
        $lastOne = DB::table('projets')->latest('id')->first();
        if($lastOne){
            $code_projet = 'PRJ'.'_00'.$lastOne->id;
        }
        else{
            $code_projet = 'PRJ'.'_00'.'0';
        }
        Projet::create(
            [
                'denomination'=>$request->denomination,
                'code_projet'=>$code_projet,
                'statut'=>0

            ]
            );
       return redirect()->back()->with('success','Le projet a été enregistré avec success');
}
            

public function pca_modif(Request $request){
    $projet= Projet::find($request->id);
    $data = array(
     'id'=>$projet->id,
    // 'banque_id' => $projet->entreprise->banque_id,
     'coach_id' => $projet->coach_id,
     'titre_du_projet'=>$projet->titre_du_projet,
     'objectifs'=>$projet->objectifs,
     'activites_menees'=>$projet->activites_menees,
     'atout_promoteur'=>$projet->atouts_promoteur,
     'innovation'=>$projet->innovation,
 );
 return json_encode($data);
}
public function pca_modifier(Request $request){
    $projet= Projet::find($request->pca_id);
        $projet->update([
            'coach_id' => $request->coach,
            'titre_du_projet' => $request->titre_projet,
            'objectifs' => $request->objectifs,
            'activites_menees'  => $request->activite_menee,
            'atouts_promoteur'  => $request->atouts_entreprise,
            'innovation'  =>$request->innovations_apportes,
        ]);
   
        return redirect()->back();
}


public function invest_modif(Request $request){
    $investissement= InvestissementProjet::find($request->id);
    $data = array(
     'id'=>$investissement->id,
     'categorie'=>$investissement->designation,
     'cout'=>$investissement->montant,
     'subvention'=>$investissement->subvention_demandee,
     'apport_perso'=>$investissement->apport_perso,
 );
 return json_encode($data);
}
public function invest_modifier(Request $request){
    $invest= InvestissementProjet::find($request->invest_id);
    $projet= Projet::find($invest->projet_id);
    $preprojet=$projet->preprojet;
    $cout= reformater_montant2($request->cout);
    $subvention= reformater_montant2($request->subvention);
    $taux_subvention=$subvention/$cout*100;
    if((($preprojet->guichet==7165) && $taux_subvention >65) || (($preprojet->guichet==7166 ) && $taux_subvention >50) || (($preprojet->guichet==7167 ) && $taux_subvention >65)  )
        {
            return redirect()->back()->with('error','Bien vouloir respecter le code de financement du guichet'.' '.getlibelle($preprojet->guichet));
        }
    else{
        $invest->update([
            'designation' => $request->designation,
            'montant'=> reformater_montant2($request->cout),
            'apport_perso'=> reformater_montant2($request->apport_perso),
            'subvention_demandee'=> reformater_montant2($request->subvention)
        ]);
            $projet->update([
                'montant_demande' => $projet->investissements->sum('montant')
            ]);
            return redirect()->back()->with('success',"La ligne d'investissement a été modifié avec success"); 
        }
      
}
public function add_investissement(Request $request){
    $projet= Projet::find($request->projet_id);
    $preprojet=$projet->preprojet;
    $montant_total= $projet->investissements->sum('montant') + reformater_montant2($request->cout);
    $subvention_total= $projet->investissements->sum('subvention_demandee') + reformater_montant2($request->subvention);
    $taux_subvention=$subvention_total/$montant_total*100;
    if((($preprojet->guichet==7165) && $taux_subvention >65) || (($preprojet->guichet==7166 ) && $taux_subvention >50) || (($preprojet->guichet==7167 ) && $taux_subvention >65)  )
        {
            return redirect()->back()->with('error','Bien vouloir respecter le code de financement du guichet'.' '.getlibelle($preprojet->guichet));
        }
    else{
        InvestissementProjet::create([
            'projet_id'=>$request->projet_id,
            'designation'=>$request->designation,
            'montant'=>reformater_montant2($request->cout),
            'subvention_demandee'=>reformater_montant2($request->subvention),
            'apport_perso'=>reformater_montant2($request->apport_perso),
        ]);
        $projet->update([
            'montant_demande' => $projet->investissements->sum('montant')
        ]);
        return redirect()->back()->with('success',"La ligne d'investissement a été ajoutée avec success !!!");
     }
    }
public function modif_piecej(Request $request){
    $piecejointe= Piecejointe::find($request->id);
    $data = array(
     'id'=>$piecejointe->id,
     'type_piece'=>$piecejointe->type_piece
 );
 return json_encode($data);

}
public function modifier_piecej(Request $request){
    $piecejointe= Piecejointe::find($request->piece_id);
    $piecejointe_type=$piecejointe->type_piece;
    $year=date("Y");
   //$cat_entreprise=$piecejointe->entreprise->aopOuleader;
if($piecejointe->type_piece==env('VALEUR_ID_DOCUMENT_DEVIS')){
    $file = $request->file('piece_file');
    $extension=$file->getClientOriginalExtension();
    $fileName = Auth::user()->login.'_'.'devis_des_investissements'.'.'.$extension;
    $chaine='public/'.$year.'/'.'devis_des_investissement_ala_soumission/'; 
}
elseif( $piecejointe->type_piece==env('VALEUR_ID_DOCUMENT_PCA')){
    $file = $request->file('piece_file');
    $extension=$file->getClientOriginalExtension();
    $fileName = Auth::user()->login.'_'.'plan_de_continute'.'.'.$extension;
    $chaine='public/'.$year.'/'.'pca/';
}
elseif( $piecejointe->type_piece==env('VALEUR_ID_DOCUMENT_SYNTHESE_PCA')){
    $file = $request->file('piece_file');
    $extension=$file->getClientOriginalExtension();
    $fileName = Auth::user()->login.'_'.'fiche_synthetique'.'.'.$extension;
    $chaine='public/'.$year.'/'.'synthese_pca/'; 
}
elseif($piecejointe->type_piece==env('VALEUR_ID_DOCUMENT_FONCIER')){
    $file = $request->file('piece_file');
    $extension=$file->getClientOriginalExtension();
    $fileName = Auth::user()->login.'_'.'copie_document_foncier'.'.'.$extension;
    $chaine='public/'.$year.'/'.'foncier/';

}
elseif($piecejointe->type_piece==env('VALEUR_ID_DOCUMENT_ATTESTATION')){
    $file = $request->file('piece_file');
    $extension=$file->getClientOriginalExtension();
    $fileName = Auth::user()->login.'_'.'attestation_de_formation'.'.'.$extension;
    $chaine='public/'.$year.'/'.'attestation_de_formation/';
}
    if ($request->hasFile('piece_file')) {
        $urlpiece= $request->piece_file->storeAs($chaine,$fileName);
        try{
            $piecejointe->update([
                'url'=>$urlpiece,
            ]);
            return redirect()->back();
        }catch(e){
            return redirect()->back()->with("error','Une erreur est survenue lors de l'engistrement");
        }
            
    }
}
public function storeaval(Request $request){
    if (Auth::user()->can('lister_avant_projet_selectionnes_fp')) {
        $year=date("Y");
        $projet= Projet::find( $request->projet);
        if ($request->hasFile('grille_devaluation')) {
            $file = $request->file('grille_devaluation');
            $extension=$file->getClientOriginalExtension();
            $fileName = $projet->preprojet->num_projet.'_'.'fiche_devaluation'.'.'.$extension;
            $emplacement='public/'.$year.'/'.'grilleEval'; 
            $urlpiece= $request['grille_devaluation']->storeAs($emplacement, $fileName);
          $pj=  Piecejointe::create([
              'type_piece'=> env("VALEUR_ID_DOCUMENT_GRILLEEVAL"),
                'preprojet_fp_id'=>$projet->preprojet->id,
                'url'=>$urlpiece,
            ]);
        }
    
    if($pj){
        if($projet->preprojet->entreprise_id!=null){
            $criteres= GrilleEvalPca::where('categorie','MPME_existant')->get();
        }
        else{
            $criteres= GrilleEvalPca::where('categorie','Startup')->get();
        }
        foreach($criteres as $critere){
            $note= $critere->id;
        //S'assurer de l'unicité de l'evaluation par projet et par critere
        $nombre_devaluation_du_projet = EvaluationPca::where(['projet_id'=>$request->projet,'grilleeval_id'=> $critere->id,])->count();
        if($nombre_devaluation_du_projet==0){
            EvaluationPca::create([
                    'projet_id'=> $request->projet,
                    'grilleeval_id'=> $critere->id,
                    'note'=> $request->$note
            ]);
        }        
        }

        $projet->update([
            'statut'=>'evalué',
            //'motif_du_rejet_de_lanalyse'=>''
         ]);
         
         return redirect()->back()->with('success','Le Dossier a été évalué avec success');
    }
    else{
       
        return redirect()->back()->with('error',"Bien vouloir joindre la grille d'evaluation !!!");
    }
    }
    else{
        
        return redirect()->back()->with('error',"Vous n'avez pas ce droit d'acces bien vouloir contacter l'administrateur !!!");
    }
    
    }
    public function pca_save_avis_chefdantenne(Request $request){
        $projet= Projet::find($request->projet_id);
            $projet->update([
                'avis_chefdantenne'=>$request->avis,
                'observation_chefdantenne'=>$request->observation,
                'statut'=>'analysé',
            ]);
        return redirect()->back()->with('success',"L'avis du chef d'antenne a été enregistré avec success");
            
       
    }
    public function pca_save_avis_equipe_fp(Request $request){

        $projet= Projet::find($request->projet_id);
            $projet->update([
                'avis_equipe_fp'=>$request->avis,
                'observation_equipe_fp'=>$request->observation,
                'statut'=>'soumis_au_comite_de_selection',
            ]);
        return redirect()->back()->with('success',"L'avis de l'équipe du fond de partenariat a été enregistré avec success");
       
    }
    public function avis_ses(Request $request){
            $year=date("Y");
        $projet=Projet::find($request->projet_id);
        if ($request->hasFile('fiche_sreening_es')) {
            $file = $request->file('fiche_sreening_es');
            $extension=$file->getClientOriginalExtension();
            if($request->type_decision=='avis_ses'){
                $fileName = $projet->preprojet->num_projet.'_'.'fiche_SES_avis_ses'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'fiche_SES_avis_ses';
                $type_doc=env("VALEUR_ID_DOCUMENT_AVIS_SES");
            }
            else{
                $fileName = $projet->preprojet->num_projet.'_'.'fiche_SES_decision_aneve'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'fiche_SES_decision_aneve';
                $type_doc=env("VALEUR_ID_DOCUMENT_AVIS_ANEVE");
            }
            $urlpiece= $request['fiche_sreening_es']->storeAs($emplacement, $fileName);
          $pj=  Piecejointe::create([
                'type_piece'=> $type_doc,
                'preprojet_fp_id'=>$projet->preprojet->id,
                'url'=>$urlpiece,
            ]);
        if($request->type_decision=='avis_ses')
            {
                $projet->update([
                    'avis_ses'=>$request->avis_ses,
                    'categorie_projet'=>$request->categorie,
                ]);
            }
        else{
                $projet->update([
                    'decision_aneve'=>$request->avis_ses,
                    'categorie_projet'=>$request->categorie,
                ]);
            }
        }
        return redirect()->back()->with('success', "Votre avis a été enregistré pour ce projet !!!");

    }
    public function completer_dossier(Request $request){
            $year=date("Y");
    $projet=Projet::find($request->projet_id);
    $type_pj=Piecejointe::where('preprojet_fp_id',$projet->preprojet->id)->where('type_piece',$request->type_document)->count();
    ($request->type_document==env('VALEUR_ID_DOCUMENT_FICHE_EVALUATION'))?$type_document=env('VALEUR_ID_DOCUMENT_FICHE_EVALUATION'):$type_document=env('VALEUR_ID_DOCUMENT_FICHE_DIAGNOSTIC');
    ($request->type_document==env('VALEUR_ID_DOCUMENT_FICHE_EVALUATION'))?$dossier="fiche d'évaluation":$dossier="Fiche de diagnostic";
    if($type_pj == 0){
        if ($request->hasFile('document_joint')) {
           // $this->supprimer_doublon_de_pj($preprojet->id, $type_document);
            $file = $request->file('document_joint');
            $extension=$file->getClientOriginalExtension();
            $fileName = $projet->preprojet->code_promoteur.'_'.'document_joint'.'.'.$extension;
            $emplacement='public/'.$year.'/'.$dossier.'/'; 
            $urldocument_joint= $request['document_joint']->storeAs($emplacement, $fileName);
            Piecejointe::create([
                'type_piece'=>$type_document,
                'preprojet_fp_id'=>$projet->preprojet->id,
                'url'=>$urldocument_joint,
            ]);
        }
        else{
            $urldocument_joint=null;
        }
        return redirect()->back()->with('success','La piece a été enregistrée avec succes');
    }
    else
        return redirect()->back()->with('error','Cette piece a déja été joint a ce dossier');
            
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
       return view('projet.analyse', compact('projet'));
    }

    public function importer_realisation(Request $request){
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());
        $reader = SimpleExcelReader::create($fichier);
        $rows = $reader->getRows();
        foreach($rows as $row){
            $datas[]= array('annee'=>trim($row['annee']),'activite_code'=>trim($row['activite_code']),'taux_physique'=>trim($row['taux_physique']),'cible_prevu'=>trim($row['cible_prevu']),'delais_consomme'=>trim($row['delais_consomme']),'taux_decaissement'=>trim($row['taux_decaissement']),'cible_realise'=>trim($row['cible_realise']),'taux_financier'=>trim($row['taux_financier']),'taux_cible'=>trim($row['taux_cible']));
        }
        foreach($datas as $data){
            $activite=Activite::where('code_activite',$data['activite_code'])->first();
           // $projet=Projet::where('preprojet_id', $preprojet->id)->first();
            if($activite)
            {
                Realisation::create([
                   'activite_id'=>$activite->id,
                   'annee'=>$data['annee'],
                    'taux_physique'=>$data['taux_physique'],
                    'taux_financier'=>$data['taux_financier'],
                    'taux_decaissement'=>$data['taux_decaissement'],
                    'delais_consomme'=>$data['delais_consomme'],
                    'cible_prevu'=>$data['cible_prevu'],
                    'cible_realise'=>$data['cible_realise'],
                    'taux_cible'=>$data['taux_cible']
                ]);
                if($data['taux_physique']==0){
                    $statut_activite='Non demarré';
                }
                elseif($data['taux_physique']>0 && $data['taux_physique']<100){
                         $statut_activite='En cours';
                }
                elseif($data['taux_physique']==100){
                    $statut_activite='Terminé';
                }
                $activite->update([
                    'statut'=>$statut_activite
                ]);
            }
        }
        return redirect()->back()->with('Fichier de realisation importer avec success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function edit(Projet $projet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projet $projet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
        //
    }
}
