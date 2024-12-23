<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Preprojet;
use App\Models\Coach;
use App\Models\Promoteur;
use App\Models\Valeur;
use App\Models\Piecejointe;
use Illuminate\Http\Request;
use App\Models\InvestissementProjet;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
{
    public function supprimer_doublon_de_pj($preprojet_id, $type_doc){
        $priece_a_supprimer= Piecejointe::where(['type_piece'=>$type_doc, 'preprojet_fp_id'=>$preprojet_id])->first();
        if($priece_a_supprimer){
            $priece_a_supprimer->delete();
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
        if($request->statut=='soumis'){
            if($request->type_entreprise=='mpme'){
                $projets = Projet::whereIn('statut',['soumis','analyse'])->orderBy('updated_at', 'desc')->get();
                $type_entreprise='fp_mpme_existante';
            }
            else{
                $projets = Projet::whereIn('statut',['soumis','analyse'])->where('avis_chefdezone',null)->whereIn('type_entreprise',['leader','aop'])->where('zone_affectation', Auth::user()->zone)->orderBy('updated_at', 'desc')->get();
                $type_entreprise='fp_startup';
            }
            $texte= 'soumis';
            $page='projet_soumis';
        }
        return view('projet.lister',compact('projets','type_entreprise','texte','page'));
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
            $projet_piecejointes=Piecejointe::where("preprojet_fp_id",$preprojet->id)->whereIn('type_piece', [env("VALEUR_ID_DOCUMENT_PCA"), env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"), env("VALEUR_ID_DOCUMENT_DEVIS"),env("VALEUR_ID_DOCUMENT_FONCIER"),env("VALEUR_ID_DOCUMENT_ATTESTATION"), env("VALEUR_ID_FICHE_DANALYSE")])->orderBy('updated_at', 'desc')->get();
           // dd($projet_piecejointes);
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
    		'preprojet_id'=>'unique:projets,preprojet_id',
    	]);
        $designations = $request->designation;
        $couts = $request->cout;
        $subventions = $request->subvention;
        $montant_investissement_total= 0;
        $montant_subvention_total = 0;
        $preprojet= Preprojet::find($request->preprojet_id);
        foreach($subventions as $subvention){
                $montant_subvention_total = $montant_subvention_total + reformater_montant2($subvention);
        }
        foreach($couts as $cout){
            $montant_investissement_total = $montant_investissement_total + reformater_montant2($cout);
        }
         $taux_subvention=$montant_subvention_total/ $montant_investissement_total*100;
        //dd($montant_investissement_total_appui1.' '.$montant_investissement_total_appui2);
    if($request->hasFile('synthese_plan_de_continute')&&$request->hasFile('synthese_plan_de_continute')){
    //Verification du code de financement suivant le guichet
   if((($preprojet->guichet==7165 ) && $taux_subvention >65) || (($preprojet->guichet==7166 ) && $taux_subvention >50) || (($preprojet->guichet==7167 ) && $taux_subvention >65)  )
        {
            flash("Bien vouloir respecter le code de financement du guichet".' '.getlibelle($preprojet->guichet))->error();
            return redirect()->back();
        }
    else{
            ($preprojet->region_affectation == null )?($zone= $preprojet->region):($zone=$preprojet->region_affectation );
           // $promoteur = Promotrice::where('code_promoteur',Auth::user()->code_promoteur)->first();
            $projet = Projet::create([
                'preprojet_id' => $request->preprojet_id,
                'coach_id' => $request->coach,
                'zone_affectation'=> $zone,
                'titre_du_projet' => $request->titre_du_projet,
                'objectifs'  => $request->titre_du_projet,
                'activites_menees'  => $request->activite_menee,
                'atouts_promoteur'  => $request->atouts_entreprise,
                'innovation'  =>$request->innovations_apportes,
                'statut'  =>"soumis",
                //'type_entreprise' =>$entreprise->aopOuleader
            ]);
            for($i=0; $i<count($designations); $i++){
                     if($designations[$i]!="" && $couts[$i]!="" && reformater_montant2($request->subvention[$i])!=null){
                        InvestissementProjet::create([
                            "projet_id"=>$projet->id,
                            "designation"=>$designations[$i],
                            "montant"=>reformater_montant2($couts[$i]),
                            "apport_perso"=>reformater_montant2($request->apport_perso[$i]),
                            "subvention_demandee"=>reformater_montant2($request->subvention[$i])
                        ]);
                   }
            }
            
            $projet->update([
                'montant_demande'=>$projet->investissements->sum('montant')
            ]);
                $year=date("Y");
               if ($request->hasFile('plan_de_continute')) {
                $this->supprimer_doublon_de_pj($preprojet->id, env("VALEUR_ID_DOCUMENT_PCA"));
                $file = $request->file('plan_de_continute');
                $extension=$file->getClientOriginalExtension();
                $fileName = $preprojet->code_promoteur.'_'.'plan_de_continute'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'pca/'; 
                $urlplan_de_continute= $request['plan_de_continute']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_PCA"),
                    'preprojet_fp_id'=>$request->preprojet_id,
                    'url'=>$urlplan_de_continute,
                  ]);
            }
            else{
                $urlplan_de_continute=null;
            }
            if ($request->hasFile('synthese_plan_de_continute')) {
                $this->supprimer_doublon_de_pj($preprojet->id, env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"));
                $file = $request->file('synthese_plan_de_continute');
                $extension=$file->getClientOriginalExtension();
                $fileName = $preprojet->code_promoteur.'_'.'synthese_plan_de_continute'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'synthese_pca/'; 
                $urlsynthese_plan_de_continute= $request['synthese_plan_de_continute']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"),
                      'preprojet_fp_id'=>$request->preprojet_id,
                      'url'=>$urlsynthese_plan_de_continute,
                  ]);
            }
            else{
                $urlsynthese_plan_de_continute=null;
            }
            if ($request->hasFile('devis_des_investissements')) {
                $this->supprimer_doublon_de_pj($preprojet->id, env("VALEUR_ID_DOCUMENT_DEVIS"));
                $file = $request->file('devis_des_investissements');
                $extension=$file->getClientOriginalExtension();
                $fileName = $preprojet->code_promoteur.'_'.'devis_des_investissements'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'devis_des_investissement_ala_soumission/'.$anne_en_cours.'/'; 
                $urldevis_des_investissements= $request['devis_des_investissements']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_DEVIS"),
                      'preprojet_fp_id'=>$request->preprojet_id,
                      'url'=>$urldevis_des_investissements,
                  ]);
            }
            else{
                $urldevis_des_investissements=null;
            }
            if ($request->hasFile('copie_document_foncier')) {
                $this->supprimer_doublon_de_pj($preprojet->id, env("VALEUR_ID_DOCUMENT_FONCIER"));
                $file = $request->file('copie_document_foncier');
                $extension=$file->getClientOriginalExtension();
                $fileName = $preprojet->code_promoteur.'_'.'copie_document_foncier'.'.'.$extension;
                $emplacement='public/'.$year.'/'.'foncier/'; 
                $urlcopie_document_foncier= $request['copie_document_foncier']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_FONCIER"),
                    'preprojet_fp_id'=>$request->preprojet_id,
                      'url'=>$urlcopie_document_foncier,
                  ]);
            }
            else{
                $urlcopie_document_foncier=null;
            }
            
        }
       return redirect()->back()->with('success','Le projet a été enregistré avec success');
}
            
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
      
        InvestissementProjet::create([
            'projet_id'=>$request->projet_id,
            'appui'=>$request->appui,
            'designation'=>$request->designation,
            'montant'=>reformater_montant2($request->cout),
            'subvention_demandee'=>reformater_montant2($request->subvention),
            'apport_perso'=>reformater_montant2($request->apport_perso),
        ]);
        $projet->update([
            'montant_demande' => $projet->investissements->sum('montant')
        ]);
        flash("La ligne d'investissement a été ajoutée avec success !!!")->success();
        return redirect()->back();
    // }
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
    $fileName = Auth::user()->login.'_'.'synthese_plan_de_continute'.'.'.$extension;
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
        $piecejointe->update([
              'url'=>$urlpiece,
          ]);
    }
return redirect()->back();
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        //
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
