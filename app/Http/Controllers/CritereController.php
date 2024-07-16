<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criteres= Critere::all();
        return view('critere.index', compact('criteres'));
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
        Critere::create([
            'categorie'=> $request->categorie, 
            'libelle'=> $request->libelle, 
            'ponderation'=> $request->ponderation, 
        ]);
        return redirect()->route('critere.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function show(Critere $critere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function edit(Critere $critere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Critere $critere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Critere  $critere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Critere $critere)
    {
        //
    }
    public function modifier(Request $request){
        $critere= Critere::find($request->id);
        $data = array(
            'id'=>$critere->id,
            'libelle'=>$critere->libelle,
            'categorie'=> $critere->categorie, 
            'ponderation'=>$critere->ponderation,
        );
        return json_encode($data);
        }
        public function modifierstore(Request $request){
        $grille= Critere::find($request->grille_id);
        $grille->update([
            'libelle'=> $request->libelle, 
            'categorie'=> $request->categorie, 
            'ponderation'=> $request->ponderation, 
            ]);
        return redirect()->route('critere.index');
        
        }
}
