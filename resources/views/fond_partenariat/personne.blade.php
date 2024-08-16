@extends('layouts.frontend')
@section('content')

<div class="section-title">
      <h3>Formulaire Personne</h3>
      </div>
<div class="step-app" id="demo">
    
<form role="form" action="" method="post" enctype="multipart/form-data">
    @csrf 
      <div class="step-tab-panel" data-step="step1">
      <div class="col-lg-6">
                <!-- <h3> Identification</h3> -->
                                <div class="form-group">
                                    <label class="control-label" for="val_username">Nomhh(<span class="text-danger">*</span>)</label>
                                        <div class="input-group">
                                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom.." required>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="val_username">Prenom (<span class="text-danger">*</span>)</label>
                                        <div class="input-group">
                                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Votre prenom.." required>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                        </div>
                                </div>
            </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Etablissement fréquenté (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <input type="text" id="etablissement" name="etablissement" class="form-control" placeholder="Votre établissement.." required>
                                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Classe (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <!-- <input type="text" id="classe" name="classe" class="form-control" placeholder="Votre classe.." required> -->
                                                <select name="classe" id="sexe" class="form-control" required>
											<option value="">Choisir</option>
											<option value="CP1">CP1</option>
											<option value="CP2">CP2</option>
                                            <option value="CE1">CE1</option>
											<option value="CE2">CE2</option>

											</select>
                                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                            </div>
                                    </div> 
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Date de naissance (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <input type="date" id="date_naissance" min="2008-01-01" max="2014-12-31" name="date_naissance" class="form-control" required>
                                                <span class="input-group-addon"><i class="gi gi-calendar"></i></span>
                                            </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-label" for="val_skill">Sexe (<span class="text-danger">*</span>)</label>
                                            <select id="sexe" name="sexe" class="form-control" required>
                                                <option value=""></option>
                                                <option value="M">Masculin</option>
                                                <option value="F">Feminin</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">L'enfant a t-il dejà participé à la colonie? (<span class="text-danger">*</span>)</label>
                                            <select id="niveau" name="niveau" class="form-control"  title="Le champs est obligatoire" required>
                                                <option value=""></option>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                    </div> 
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Région (<span class="text-danger">*</span>)</label>
                                            <select id="region" name="region" class="form-control"  title="Le champs region est obligatoire"  value="{{old("region")}}" onchange="changeValue('region', 'province', {{ env('PARAMETRE_ID_PROVINCE') }});" required>
                                            <option value="">Choisir</option>
                                                
                                            </select>
                                    </div> 
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Province (<span class="text-danger">*</span>)</label>
                                            <select id="province" name="province" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .."  onchange="changeValue('province', 'commune', {{ env('PARAMETRE_ID_COMMUNE') }});" required>
                                            <option value="">Choisir</option>
                                               
                                            </select>
                                    </div> 
                                    <!-- <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Comune (<span class="text-danger">*</span>)</label>
                                            <select id="commune" name="commune" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .." onchange="changeValue('commune', 'arrondissement', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" required>
                                            <option value="">Choisir</option>
                                            
                                            </select>
                                    </div> -->
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Commune (<span class="text-danger">*</span>)</label>
                                            <select id="commune" name="commune" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .." onchange="changeValue('commune', 'arrondissement', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" required>
                                            <option value="">Choisir</option>
                                           
                                            </select>
                                    </div>
                                    
                                </div>
      </div>


    <div class="step-footer">
    <center><button class="btn btn-danger btn-submit" type="reset">Annuler</button>
        <button class="btn btn-success btn-submit" type="submit">Valider</button></center>
    
    </div>
    </form>
  </div>

@endsection