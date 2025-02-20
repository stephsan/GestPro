<?php

namespace App\Http\Controllers;

use App\Models\Plainte;
use App\Models\Valeur;
use Illuminate\Http\Request;

class PlainteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accueil(){
        $regions=Valeur::where('parametre_id',env('PARAMETRE_ID_REGION'))->get();
        return view('plainte.plainte',compact('regions'));
    }
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Plainte::create([
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
            'statut'=>'enregistré'
        ]);
        return redirect()->back()->with('success','Votre plainte a été enregistrée avec success');
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
