<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Valeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('gerer_user')) {
            $docs_categories= Valeur::where('parametre_id', env('PARAMETRE_CATEGORIE_DOC_ID') )->get();
            $documents=Document::orderBy('updated_at', 'desc')->get();
            return view('document.index',compact('documents','docs_categories'));
        }
        else{
           // flash("Vous n'avez pas le droit d'acceder à cette resource. Veillez contacter l'administrateur!!!")->error();
            return redirect()->back();
        }
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
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $extension=$file->getClientOriginalExtension();
            $fileName = $request->titre.'.'.$extension;
            $emplacement='public'.'/'.$request->docs_categorie;
            $urldoc= $request['document']->storeAs($emplacement, $fileName);
            Document::create([
                  'titre'=>$request->titre,
                  'categorie_id'=>$request->categorie,
                  'cible'=>$request->cible,
                  'url_doc'=>$urldoc,
              ]);
        }
        else{
            $urldoc=null;
        }
        return redirect()->route('documents.index');
    }

    public function modifier(Request $request){
        $document= Document::find($request->id);
        // $data = array(
        //     'id'=>$document->id,
        //     'titre'=>$document->libelle,
        //     'categorie'=> $document->categorie, 
        //     'type_entreprise'=> $document->type_entreprise,
        //     'ponderation'=>$document->ponderation,
        // );
        return json_encode($document);
        }
        public function modifierstore(Request $request){
        $document= Document::find($request->document_id);
    if ($request->hasFile('document')) {
            $file = $request->file('document');
            $extension=$file->getClientOriginalExtension();
            $fileName = $request->titre.'.'.$extension;
            $emplacement='public'.'/'.$request->docs_categorie;
            $urldoc= $request['document']->storeAs($emplacement, $fileName);
            $document->update([
                'titre'=>$request->titre,
                'categorie_id'=>$request->categorie,
                'cible'=>$request->cible,
                'url_doc'=>$urldoc,
                ]);
      }
         return redirect()->route('documents.index');
        
        }
        public function lister_docs_pubics(){
                $docs= Document::where('cible','public')->get();
                return view('document.document_utiles',compact('docs'));
        }
        public function telecharger(Document $document){
           // dd($document);
            return $path = Storage::download($document->url_doc);
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
