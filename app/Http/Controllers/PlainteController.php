<?php

namespace App\Http\Controllers;

use App\Models\Plainte;
use App\Models\Valeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class PlainteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accueil(){
        $regions=Valeur::where('parametre_id',env('PARAMETRE_ID_REGION'))->get();
        return view('plainte.plainte_create',compact('regions'));
    }
    public function lister(Request $request){
        if($request->type=='save'){
            $plaintes= Plainte::where('statut','enregistré')->get();
            $type='plaintes';
            $statut='plainte_enregistre';
            $titre="Liste des plaintes enregistrées non-traitée";
        }
        elseif($request->type=='en_cours'){
            $plaintes= Plainte::where('statut','en_cours')->get();
            $type='plaintes';
            $statut='plainte_en_cours';
            $titre="Liste des plaintes en cours de traitement";
        }
        elseif($request->type=='archives'){
            $plaintes= Plainte::where('statut','archivé')->get();
            $type='plaintes';
            $statut='plainte_archives';
            $titre="Liste des plaintes non-recevables archivées";
        }
        elseif($request->type=='resolue'){
            $plaintes= Plainte::where('statut','resolue')->get();
            $type='plaintes';
            $statut='plainte_resolus';
            $titre="Liste des plaintes resolues";
        }
        return view('plainte.lister',compact('plaintes','type','statut','titre'));
    }
    public function details(Request $request, Plainte $plainte){
         $plainte_categories=Valeur::where('parametre_id',33)->get();
         return view('plainte.details',compact('plainte','plainte_categories'));
    }
    public function qualifier(Request $request){
        $plainte=Plainte::find($request->plainte_id);
              if($request->categorie_plainte){
                $plainte->update([
                    'statut'=>'en_cours',
                    'categorie'=>$request->categorie_plainte
                ]);

              }
              else{
                $plainte->update([
                    'statut'=>'archivé',
                ]);
              }
        return redirect()->route('plainte.liste',['type' => 'save'])->with('success','La plainte a été qualifiée');
    }
    public function index()
    {
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastOne = DB::table('plaintes')->latest('id')->first();
        if($lastOne){
            $num_plainte="ECOTEC-PLTE-000". $lastOne->id+1;

        }
        else{
            $num_plainte= "ECOTEC-PLTE-000". '0';
        }
        $plainte=Plainte::create([
            'nom'=> $request->nom_plaignant,
            'prenom'=>$request->prenom_plaignant,
            'sexe'=>$request->sexe,
            'telephone'=>$request->telephone_plaignant,
            'email'=>$request->email_plaignant,
            'region'=>$request->region,
            'province'=>$request->province,
            'commune'=>$request->commune,
            'secteur'=>$request->secteur,
            'nom_personne_en_cause'=>$request->nom_personne_en_cause,
            'prenom_personne_en_cause'=>$request->prenom_personne_en_cause,
            'objet'=>$request->objet_plainte,
            'solution_preconisee'=>$request->solution_preconise,
            'statut'=>'enregistré',
            'num_plainte'=>$num_plainte
        ]);
        return view('plainte.generate_accuse',compact('plainte'));
       
    }
    public function generer_laccuse_de_plainte(Plainte $plainte){
        $qrcode =  base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate("Ceci est un accusé de récépissé de d'enregistrement de plainte sur la plateforme ECOTEC."."Numero de plainte:"." ".$plainte->num_plainte."_".$plainte->id."ECOTEC"));
        $pdf = PDF::loadView('pdf.accuse_de_reception', compact('plainte','qrcode'));
        return  $pdf->download('accusee_denregistrement_de_plainte.pdf');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plainte  $plainte
     * @return \Illuminate\Http\Response
     */
    public function show(Plainte $plainte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plainte  $plainte
     * @return \Illuminate\Http\Response
     */
    public function edit(Plainte $plainte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plainte  $plainte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plainte $plainte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plainte  $plainte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plainte $plainte)
    {
        //
    }
}
