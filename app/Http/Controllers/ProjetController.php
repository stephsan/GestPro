<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Preprojet;
use App\Models\Coach;
use App\Models\Promoteur;
use App\Models\Valeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
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
    public function create()
    {
        $coachs= Coach::all();
       $categorie_investissments=Valeur::where('parametre_id', 38)->get();
        $promoteur = Promoteur::where('code_promoteur',Auth::user()->login)->first();
        $preprojet = Preprojet::where('promoteur_id', $promoteur->id)->first();
        return view('projet.create',compact('coachs','promoteur','preprojet','categorie_investissments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
    		//'entreprise_id'=>'unique:projets,entreprise_id',
    	]);
        $designations = $request->designation;
        $couts = $request->cout;
        $montant_investissement_total_appui1= 0;
        $entreprise= Entreprise::find($request->entreprise);
        foreach($couts as $cout){
                $montant_investissement_total_appui1 = $montant_investissement_total_appui1 + reformater_montant2($cout);
        }
        //dd($montant_investissement_total_appui1.' '.$montant_investissement_total_appui2);
if($request->hasFile('synthese_plan_de_continute')&& $request->hasFile('attestation_de_formation')&&$request->hasFile('synthese_plan_de_continute')){
   if((($entreprise->aopOuleader=='aop' ||$entreprise->aopOuleader=='leader') && $montant_investissement_total_appui1 >60000000) || ($entreprise->aopOuleader=='mpme' && $montant_investissement_total_appui1 >18000000)  )
        {
            flash("Verifier le montant du projet. Le montant total de chaque phase du projet ne doit pas être supérieur au plafond accordé par le projet")->error();
            return redirect()->back();
        }
    elseif((($entreprise->aopOuleader=='aop' || $entreprise->aopOuleader=='leader') && $montant_investissement_total_appui1 < 18000000)|| ($entreprise->aopOuleader=='mpme' && $montant_investissement_total_appui1 <6000000)  )
    {
        flash("Verifier le montant du projet. Le montant total de chaque phase du projet ne doit pas être inférieur au planché accordé par le projet suivant la catégorie de votre entreprise !!!")->error();
        return redirect()->back();
    }
    elseif((($entreprise->aopOuleader=='aop' ||$entreprise->aopOuleader=='leader') && $montant_investissement_total_appui2 >60000000) || ($entreprise->aopOuleader=='mpme' && $montant_investissement_total_appui2 >18000000)  )
        {
            flash("Verifier le montant du projet. Le montant total de chaque phase du projet ne doit pas être supérieur au plafond accordé par le projet")->error();
            return redirect()->back();
        }
    elseif((($entreprise->aopOuleader=='aop' || $entreprise->aopOuleader=='leader') && $montant_investissement_total_appui2 < 18000000)|| ($entreprise->aopOuleader=='mpme' && $montant_investissement_total_appui2 <6000000)  )
    {
        flash("Verifier le montant du projet. Le montant total de chaque phase du projet ne doit pas être inférieur au planché accordé par le projet suivant la catégorie de votre entreprise !!!")->error();
        return redirect()->back();
    }
        else{
            ($entreprise->region_affectation == null )?($zone= $entreprise->region):($zone=$entreprise->region_affectation );
            $promoteur = Promotrice::where('code_promoteur',Auth::user()->code_promoteur)->first();
            $proportiondedepence=Proportion_de_depense_promotrice::where('promotrice_id', $promoteur->id )->get();
            $annees=Valeur::where('parametre_id',16 )->get();
            $entreprise->update([
                'banque_id' => $request->banque_choisi
             ]);
            $projet = Projet::create([
                'entreprise_id' => $request->entreprise,
                'coach_id' => $request->coach,
                'zone_affectation'=> $zone,
                'titre_du_projet' => $request->titre_du_projet,
                'objectifs'  => $request->titre_du_projet,
                'activites_menees'  => $request->activite_menee,
                'atouts_promoteur'  => $request->atouts_entreprise,
                'innovation'  =>$request->innovations_apportes,
                'statut'  =>"soumis",
                'type_entreprise' =>$entreprise->aopOuleader
            ]);
            for($i=0; $i<count($designations); $i++){
                     if($designations[$i]!="" && $couts[$i]!="" && reformater_montant2($request->subvention[$i])!=null){
                        InvestissementProjet::create([
                            "projet_id"=>$projet->id,
                            'appui'=> 1,
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
               if ($request->hasFile('plan_de_continute')) {
                $this->supprimer_doublon_de_pj($entreprise->id, env("VALEUR_ID_DOCUMENT_PCA"));
                $file = $request->file('plan_de_continute');
                $extension=$file->getClientOriginalExtension();
                $fileName = $entreprise->code_promoteur.'_'.'plan_de_continute'.'.'.$extension;
                $emplacement='public/pca/'.$entreprise->aopOuleader.'/'; 
                $urlplan_de_continute= $request['plan_de_continute']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_PCA"),
                    'entreprise_id'=>$request->entreprise,
                    'url'=>$urlplan_de_continute,
                  ]);
            }
            else{
                $urlplan_de_continute=null;
            }
            if ($request->hasFile('synthese_plan_de_continute')) {
                $this->supprimer_doublon_de_pj($entreprise->id, env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"));
                $file = $request->file('synthese_plan_de_continute');
                $extension=$file->getClientOriginalExtension();
                $fileName = $entreprise->code_promoteur.'_'.'synthese_plan_de_continute'.'.'.$extension;
                $emplacement='public/synthese_pca/'.$entreprise->aopOuleader.'/'; 
                $urlsynthese_plan_de_continute= $request['synthese_plan_de_continute']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_SYNTHESE_PCA"),
                      'entreprise_id'=>$request->entreprise,
                      'url'=>$urlsynthese_plan_de_continute,
                  ]);
            }
            else{
                $urlsynthese_plan_de_continute=null;
            }
            if ($request->hasFile('devis_des_investissements')) {
                $this->supprimer_doublon_de_pj($entreprise->id, env("VALEUR_ID_DOCUMENT_DEVIS"));
                $file = $request->file('devis_des_investissements');
                $extension=$file->getClientOriginalExtension();
                $fileName = $entreprise->code_promoteur.'_'.'devis_des_investissements'.'.'.$extension;
                $emplacement='public/devis_des_investissement_ala_soumission/'.$entreprise->aopOuleader.'/'; 
                $urldevis_des_investissements= $request['devis_des_investissements']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_DEVIS"),
                      'entreprise_id'=>$request->entreprise,
                      'url'=>$urldevis_des_investissements,
                  ]);
            }
            else{
                $urldevis_des_investissements=null;
            }
            if ($request->hasFile('copie_document_foncier')) {
                $this->supprimer_doublon_de_pj($entreprise->id, env("VALEUR_ID_DOCUMENT_FONCIER"));
                $file = $request->file('copie_document_foncier');
                $extension=$file->getClientOriginalExtension();
                $fileName = $entreprise->code_promoteur.'_'.'copie_document_foncier'.'.'.$extension;
                $emplacement='public/foncier/'.$entreprise->aopOuleader.'/'; 
                $urlcopie_document_foncier= $request['copie_document_foncier']->storeAs($emplacement, $fileName);
                Piecejointe::create([
                    'type_piece'=>env("VALEUR_ID_DOCUMENT_FONCIER"),
                      'entreprise_id'=>$request->entreprise,
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
