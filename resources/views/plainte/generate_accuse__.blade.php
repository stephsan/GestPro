@extends('layouts.frontend')
@section('content')
<div class="row">
    <div style="border:solid 1px black; margin-left:15%; margin-top:20px;" class="col-md-9" >
        <div class="row" style="border-bottom: solid 1px black; text-align:center; padding-top:10px;">
            <h2>Informations Importantes sur la Gestion des Plaintes</h2>
        </div>
        <div class="row" style="font-size:22px; text-align:justify; padding:20px; color:rgb(48, 50, 48)">
            <p style="color: red;">Votre Plainte </p>
            <p style="padding-left:45px;">
              <span style="font-weight: bold;">-	Les demande d’informations ou doléances :</span> critères d’éligibilité au programme entreprendre et au fonds de partenariat, processus de sélection, composition des dossiers, opportunités offertes par le projet, demandes d’aide, etc.
            </p>
            <p style="padding-left:45px;">
              <span style="font-weight: bold;">- Plaintes ou réclamations liées à la gestion environnementale et sociale du projet : </span> non-respect des mesures environnementales et sociales par les promoteurs et les entreprises des travaux ; conflits de propriété, etc. 
             </p>
             <p style="padding-left:45px;">
              <span style="font-weight: bold;">-	Plaintes liées aux travaux de génie civil et prestations : </span> qualité des travaux, non-respect des clauses contractuelles, mauvais comportement des travailleurs des entreprises, des sous-traitants, plainte sur le processus de sélection des bénéficiaires et le traitement administratif des dossiers ; non-respect des us et coutumes, dommages matériels sur les biens et les personnes occasionnés durant les travaux, etc.  
             </p>
        </div>
          <a class="btn btn-danger elementor-button" style="margin-left:40%"   data-toggle="modal" data-target="#modal-create-plainte" href="#">ENREGISTRER LA PLAINTE</a>

    </div>
</div>
 
@endsection
@section('modal')
<div id="modal-create-plainte"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="padding:15px;">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title"><i class="fa fa-print" ></i> Enregistrer une plainte</h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
          </div>
        <div class="modal-body">
          <form  id="form-validation" action="{{route("plainte.store")}}" method="post">
            @csrf
            <fieldset>
              <legend>Localité de la plainte</legend>
              <div class="row">
                <div class="form-group col-md-6">
                  <label class="control-label" for="user_name">Region (<span class="text-danger">*</span>)</label>
                  <select id="region_residence" name="region" class="select-select2" data-placeholder="Choisir votre residence .." value="{{old("region")}}" onchange="changeValue('region_residence', 'province_residence', {{ env('PARAMETRE_ID_PROVINCE') }});"   style="width:100%;" required>
                    <option></option>
                    @foreach ($regions as $region )
                            <option value="{{ $region->id  }}" {{ old('region') == $region->id ? 'selected' : '' }}>{{ $region->libelle }}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label" for="user_name">Province (<span class="text-danger">*</span>)</label>
                    <select id="province_residence" name="province" class="select-select2" onchange="changeValue('province_residence', 'commune_residence', {{ env('PARAMETRE_ID_COMMUNE') }});" data-placeholder="Choisir la province"  style="width: 100%;">
                      <option  value="{{ old('province') }}" {{ old('province') == old('province') ? 'selected' : '' }}>{{ getlibelle(old('province')) }}</option>
                    </select>
                </div>
              </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Commune (<span class="text-danger">*</span>)</label>
                    <select id="commune_residence" name="commune" class="select-select2" data-placeholder="Choisir la commune ..." onchange="changeValue('commune_residence', 'arrondissement_residence', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" style="width: 100%;" required>
                      <option  value="{{ old('commune') }}" {{ old('commune') == old('commune') ? 'selected' : '' }}>{{ getlibelle(old('commune')) }}</option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                  </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Secteur/village (<span class="text-danger">*</span>)</label>
                      <select id="arrondissement_residence" class="select-select2" name="secteur"  data-placeholder="Secteur ou village" onchange="changeValue('arrondissement_residence', 'secteur_residence', {{ env('PARAMETRE_ID_SECTEUR') }});" style="width: 100%;" required>
                        <option  value="{{ old('arrondissement') }}" {{ old('arrondissement') == old('arrondissement') ? 'selected' : '' }}>{{ getlibelle(old('arrondissement')) }}</option>
                      </select>
                  </div>
                </div>
             
            </fieldset>
            <fieldset>
                <legend>Informations sur le plaignant</legend>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Nom (<span class="text-danger">*</span>)</label>
                        <input type="text" id="" name="nom_plaignant" class="form-control" >
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Prénom (<span class="text-danger">*</span>)</label>
                        <input type="text" id="" name="prenom_plaignant" class="form-control" >
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label class="form-label" for="val_skill">Sexe (<span class="text-danger">*</span>)</label>
                        <select id="sexe" name="sexe" class="form-control" required>
                            <option value=""></option>
                            <option value="1">Masculin</option>
                            <option value="2">Feminin</option>
                        </select>
                </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Email (<span class="text-success">*</span>)</label>
                        <input type="email" id="" name="email_plaignant" class="form-control" >
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Téléphone (<span class="text-danger">*</span>)</label>
                        <input type="text" id="" name="telephone_plaignant" class="form-control"  required>
                  </div>
                </div>
            </fieldset>
            <fieldset>
              <legend>Identité de la personne contre qui la plainte est formulée</legend>
              <div class="row">
                <div class="form-group col-md-6">
                  <label class="control-label" for="user_name">Nom (<span class="text-success">*</span>)</label>
                      <input type="text" id="" name="nom_personne_en_cause" class="form-control" >
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label" for="user_name">Prénom (<span class="text-success">*</span>)</label>
                        <input type="text" id="" name="prenom_personne_en_cause" class="form-control" >
                  </div>
              </div>

            </fieldset>
            <fieldset>
              <legend>Details sur la plainte</legend>
              <div class="row">
                <div class="form-group">
                  <label class=" control-label" for="example-textarea-input">Objet de la plainte (<span class="text-danger">*</span>)<span data-toggle="tooltip" title="Decrire l'objet de la plainte en quelques mots"><i class="fa fa-info-circle"></i></span></label>
                   <textarea id="objectifs_projet" name="objet_plainte" rows="6" class="form-control" placeholder="Décrire l'objet de la plainte" autofocus required title="Ce champ est obligatoire" >{{old('objectifs_projet') }}</textarea>
              </div>
                <div class="form-group">
                  <label class=" control-label" for="example-textarea-input">Solutions préconisées par le plaignant (<span class="text-danger">*</span>) <span data-toggle="tooltip" title="Préconiser la solution en quelque mots"><i class="fa fa-info-circle"></i></span></label>
                  <textarea id="objectifs_projet" name="solution_preconise" rows="6" class="form-control" placeholder="Préconiser la solution en quelque mots" autofocus required title="Ce champ est obligatoire">{{old('solution_preconise') }}</textarea>
              </div>  
                
              </div>
              
            </fieldset>
       
            <div class="form-group create_compte_promoteur" >
                <div class="col-xs-12 text-right">
                  <button type="submit" id="save_compte" class="btn btn-md btn-success" onclick="location.reload(); ">Enregistrer</button>
                    <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Annuler</button>
                </div>
            </div>
       
        </form>
    </div>
       
      </div>
  </div>
</div>

@endsection

@section('modal')




@endsection
