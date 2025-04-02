<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComposanteRequest;
use App\Http\Requests\UpdateComposanteRequest;
use App\Models\Composante;
use App\Models\Valeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComposanteController extends Controller
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
        //
    }

    public function modif()
    {
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComposanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastOne = DB::table('Composantes')->latest('id')->first();
        if($lastOne){
            $code_composante = 'C'.$lastOne->id+1;
        }
        else{
            $i=0+1;
            $code_composante = 'C'.$i;
        }
    try{
        Composante::create(
            [
                'denomination'=>$request->denomination,
                'code_composante'=>$code_composante,
               'projet_id'=>$request->projet_id

            ]
            );
        }
        catch(QueryException $e){
            redirect()->back()->with('errors',"Une erreur dectectée lors de l'enregistrement de la composants". $e->getMessage());
        }
        return redirect()->back()->with('success','La composante a été enregistrée avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function show(Composante $composante)
    {
        $categorie_activites=Valeur::where('parametre_id',5)->get();
        return view('projet.show_composante', compact('composante','categorie_activites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function edit(Composante $composante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComposanteRequest  $request
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComposanteRequest $request, Composante $composante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Composante  $composante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Composante $composante)
    {
        //
    }
}
