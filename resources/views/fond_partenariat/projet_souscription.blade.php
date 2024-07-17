@extends('layouts.frontend')
@section('content')

<div class="section-title">
      <h3>INFORMATIONS SUR LE PROJET</h3>
      </div>
      
      <div class="block">
        <p style="background-color: rgb(231, 179, 179); color">Les champs marqué d'étoile en <span style="color:red; font-size:15px;">*</span> rouge sont obligatoires</p>
        <div class="row">
            
            <div class="col-sm-12">
                <!-- Wizard Progress Bar, functionality initialized in js/pages/formsWizard.js -->
                <div class="progress progress-striped active">
                    <div id="progress-bar-wizard" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                </div>
                <!-- END Wizard Progress Bar -->

                <!-- Progress Wizard Content -->
                <div class="step-app">
                <form id="progress-wizard" action="{{ route("preprojet.creation") }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="progress-first" class="step">
                        <input type="hidden" id="code_promoteur" name="code_promoteur" value="{{ $promoteur_code }}">
                        <input type="hidden" id="entreprise_id" name="entreprise_id" value="{{ $entreprise }}">

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_denomination">Titre de votre projet<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="titre_projet" name="titre_projet" class="form-control" placeholder="Entrez votre la dénomination" value="{{old("denomination")}}" required >
                                </div>
                                <p id="error" style="background-color: rgb(231, 179, 179); color">Une entreprise est déja enregistrée sous cette dénomination.Merci de changer le nom de l'entreprise pour pouvoir remplir les autres champs</p>
                                @if ($errors->has('denomination'))
                                                    <span class="help-block text-danger">
                                                         <strong>Une entreprise a déja été enregistrée avec ce nom. </strong>
                                                    </span>
                                            @endif
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <fieldset>
                                    <legend>Informations générales sur le projet</legend>
                                    <div class="form-group">
                                        <label class="control-label" for="val_email">Secteur d'activité <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select id="secteur_activite" name="secteur_activite" class="select-select2" data-placeholder="Renseigner le secteur d'activite de votre entreprise" value="{{old("region")}}"   style="width:100%;" required>
                                                    <option></option>
                                                    @foreach ($secteur_activites as $secteur_activite )
                                                            <option value="{{ $secteur_activite->id  }}" {{ old('secteur_activite') == $secteur_activite->id ? 'selected' : '' }}>{{ $secteur_activite->libelle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-chosen">Maillon d'activité<span class="text-danger">*</span></label>
                                            <select id="maillon_activite" name="maillon_activite" class="select-select2" data-placeholder="Choisir le maillon d'activite" style="width: 100%;" required onchange="afficherautre('maillon_activite',  {{ env('VALEUR_ID_AUTRE_MAILLON_ACTIVITE') }} ,'autre_maillon_activite');">
                                                <option></option>
                                                @foreach ($maillon_activites as $maillon_activite )
                                                    <option value="{{ $maillon_activite->id  }}" {{ old('maillon_activite') == $maillon_activite->id ? 'selected' : '' }} value="{{ $maillon_activite->id }}">{{ $maillon_activite->libelle }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="">Cocher les innovations de votre projet  <span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                                            @foreach ($innovation_du_projets as $innovation_du_projet)
                                            <div class="col-lg-8 checkbox">
                                                <label><input type="checkbox" name='innovation_du_projets[]' value="{{ $innovation_du_projet->id }}"> {{ $innovation_du_projet->libelle }}</label>
                                            </div>
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>
                                </div>
                                <div class="offset-md-1 col-lg-5">
                                    <div class="form-group">
                                        <label class=" control-label" for="example-textarea-input">Description  du projet (expliquez votre idée de projet) <span data-toggle="tooltip" title="expliquez votre idée de projet"><i class="fa fa-info-circle"></i></span> </label>
                                            <textarea id="description_idee_de_projet" name="description_idee_de_projet" rows="6" class="form-control" placeholder="expliquez votre idée de projet" autofocus required title="Ce champ est obligatoire">{{old('description_idee_de_projet') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-textarea-input">Quels sont les objectifs du projet<span data-toggle="tooltip" title="expliquez les objectifs du projet"><i class="fa fa-info-circle"></i></span></label>
                                         <textarea id="objectifs_projet" name="objectifs_projet" rows="6" class="form-control" placeholder="expliquez les objectifs du projet" autofocus required title="Ce champ est obligatoire">{{old('objectifs_projet') }}</textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <fieldset>
                                <legend>Zone d’installation du projet</legend>
                            <div class="col-md-5">
                                    
                                <div class="form-group">
                                    <label class="control-label" for="region">Region<span class="text-danger">*</span></label>
                                        <select id="region_residence" name="region" class="select-select2" data-placeholder="Choisir votre residence .." value="{{old("region")}}" onchange="changeValue('region_residence', 'province_residence', {{ env('PARAMETRE_ID_PROVINCE') }});"   style="width:100%;" required>
                                            <option></option>
                                            @foreach ($regions as $region )
                                                    <option value="{{ $region->id  }}" {{ old('region') == $region->id ? 'selected' : '' }}>{{ $region->libelle }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="province_residence">Province<span class="text-danger">*</span></label>
                                        <select id="province_residence" name="province" class="select-select2" onchange="changeValue('province_residence', 'commune_residence', {{ env('PARAMETRE_ID_COMMUNE') }});" data-placeholder="Choisir la province"  style="width: 100%;">
                                            <option  value="{{ old('province') }}" {{ old('province') == old('province') ? 'selected' : '' }}>{{ getlibelle(old('province')) }}</option>
                                        </select>
                                </div>
                            </div>
                            <div class="offset-md-1 col-lg-5">
                                <div class="form-group">
                                    <label class="control-label" for="example-chosen">Commune/Ville<span class="text-danger">*</span></label>
                                        <select id="commune_residence" name="commune" class="select-select2" data-placeholder="Choisir la commune ..." onchange="changeValue('commune_residence', 'arrondissement_residence', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" style="width: 100%;" required>
                                            <option  value="{{ old('commune') }}" {{ old('commune') == old('commune') ? 'selected' : '' }}>{{ getlibelle(old('commune')) }}</option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="arrondissement">Secteur/Village<span class="text-danger">*</span></label>
                                        <select id="arrondissement_residence" class="select-select2" name="arrondissement"  data-placeholder="Arrondissment ou village" onchange="changeValue('arrondissement_residence', 'secteur_residence', {{ env('PARAMETRE_ID_SECTEUR') }});" style="width: 100%;" required>
                                            <option  value="{{ old('arrondissement') }}" {{ old('arrondissement') == old('arrondissement') ? 'selected' : '' }}>{{ getlibelle(old('arrondissement')) }}</option>
                                        </select>
                                </div>   
                            </div>
                        </fieldset>
                        </div>
                        
                    </div>
            <div id="progress-second" class="step">
                <div class="row">
                    <fieldset>
                        <legend>CADRE GENERAL DU PROJET</legend>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Un agrément ou une autorisation est-il exigé pour la mise en œuvre de votre projet<span class="text-danger">*</span></label>
                                    <select id="agrement_exige" name="agrement_exige" class="select-select2" onchange="afficherSiOui('agrement_exige','aggrementdoc');" data-placeholder="Aggrément exigé pour l'activite?" style="width: 100%;" required>
                                        <option></option>
                                        <option value="1" {{ old('agrement_exige') == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="2" {{ old('agrement_exige') == 2 ? 'selected' : '' }}>Non</option>
                                        <option value="3" {{ old('agrement_exige') == 3 ? 'selected' : '' }}>Je ne sais pas</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Avez-vous déjà obtenu une promesse de financement de votre projet <span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà obtenu une promesse de financement de votre projet auprès des institutions financières (banques, institutions de microfinance ?"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="promesse_de_financement" name="promesse_de_financement" class="select-select2" onchange="afficherSiOui('promesse_de_financement','aggrementdoc');" data-placeholder="Aggrément exigé pour l'activite?" style="width: 100%;" required>
                                        <option></option>
                                        <option value="1" {{ old('promesse_de_financement') == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="2" {{ old('promesse_de_financement') == 2 ? 'selected' : '' }}>Non</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-select2">Sources d’approvisionnement prévisionnelles <span class="text-danger">*</span> <span data-toggle="tooltip" title="précisez vos sources potentielles d’approvisionnement en intrant"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="source_appro" name="source_appro" class="select-select2" data-placeholder="Choisir la source" style="width:100%;" autofocus required title="Ce champ est obligatoire" >
                                        <option></option>
                                        @foreach ($source_appros as $source_appro )
                                            <option value="{{$source_appro->id  }}" {{ old('source_appro') == $source_appro->id ? 'selected' : '' }} value="{{ $source_appro->id }}">{{ $source_appro->libelle }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="offset-md-1 col-lg-5">
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Origine de la clientèle du projet <span class="text-danger">*</span></label>
                                    <select id="provenance_clientele" name="provenance_clientele" class="select-select2" data-placeholder="Choisir la provenance de votre clientèle" style="width: 100%;" required onchange="afficherautre('provenance_clientele',  {{ env('VALEUR_ID_AUTRE_PROVENANCE_CLIENTELE') }} ,'autre_provenance_clientele');">
                                        <option></option>
                                        @foreach ($provenance_clients as $provenance_client )
                                        <option value="{{$provenance_client->id  }}" {{ old('provenance_clientele') == $provenance_client->id ? 'selected' : '' }} value="{{ $provenance_client->id }}">{{ $provenance_client->libelle }}</option>
                                        @endforeach <!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Type de clientèle envisagée <span class="text-danger">*</span></label>
                                    <select id="nature_client" name="nature_client" class="select-select2" data-placeholder="La nature de la clientèle" style="width: 100%;" onchange="afficherautre('nature_client',  {{ env('VALEUR_ID_AUTRE_NATURE_CLIENTELE') }} ,'autre_nature_clientele');" required >
                                        <option></option>
                                        @foreach ($nature_clienteles as $nature_clientele )
                                        <option value="{{$nature_clientele->id  }}" {{ old('nature_client') == $nature_clientele->id ? 'selected' : '' }} value="{{ $nature_clientele->id }}">{{ $nature_clientele->libelle }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Disposer vous d’un site de mise en œuvre de votre projet? <span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà obtenu une promesse de financement de votre projet auprès des institutions financières (banques, institutions de microfinance ?"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="site_disponible" name="site_disponible" class="select-select2" onchange="afficherSiOui('site_disponible','docsite');" data-placeholder="Disposer vous d’un site de mise en œuvre de votre projet" style="width: 100%;" required>
                                        <option></option>
                                        <option value="1" {{ old('site_disponible') == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="2" {{ old('site_disponible') == 2 ? 'selected' : '' }}>Non</option>
                                    </select>
                            </div>
                            <div class="docsite form-group{{ $errors->has('docsite') ? ' has-error' : '' }}" style="display: none">
                                <label class=" control-label" for="docidentite">Joindre le document du site</label>
                                    <input class="form-control" type="file" id="docsite" accept=".pdf, .jpeg, .png" name="docsite"  placeholder="Charger une copie du document du site" onchange="VerifyUploadSizeIsOK('docsite');"  required>
                                    <span class="help-block" style="text-align: center; color:red;">
                                        Taille maximale autorirée :2MB
                                    </span>
                                @if ($errors->has('docsite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('docsite') }}</strong>
                                    </span>
                                    @endif
                            </div>
                        </div>
                    </fieldset>   
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>Présentation du coût total de votre projet</fieldset>
                        </div>
                       <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="val_email">Coût total du Projet <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text"   id="cout_total" name="cout_total"  class="form-control" placeholder=" Cout total du projet" autofocus required title="Ce champ est obligatoire." onchange="format_montant('cout_total')">
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="val_email">Apport personnel  <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text"   id="apport_personnel" name="apport_personnel"  class="form-control" placeholder=" Apport personnel" autofocus required title="Ce champ est obligatoire.">
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="val_email">Subvention sollicitée<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text"   id="subvention_sollicite" name="subvention_sollicite"  class="form-control" placeholder=" subvention sollicitée" autofocus required title="Ce champ est obligatoire.">
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="val_email">Autres sources de financement  <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text"   id="autre_source" name="autre_source"  class="form-control" placeholder="Autres sources de financement" autofocus required title="Ce champ est obligatoire." onchange="cout_preprojet('cout_total','apport_personnel','subvention_sollicite','autre_source')">
                                        </div>
                                </div>
                            </div>
                        </div>  
                     </div>
                </div>
            </div>
            <div id="progress-third" class="step">
            
                <div class="row">
                    <div class="row">
                        @foreach ($indicateur_previsionel_du_projets as $indicateur_previsionel_du_projet )
                        <div class="col-md-6">
                        <fieldset>
                            <legend>{{ $indicateur_previsionel_du_projet->libelle }} </legend>
                        {{-- @if($indicateur_previsionel_du_projet->id== 41)
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="unite_de_mesure">Unité de mesure<span class="text-danger">*</span><span data-toggle="tooltip" title="Préciser l'unité(tonne, nombre de plat, nombre de tête d'animaux, ...) de mesure de la quantite de produit vendus?"><i class="fa fa-info-circle"></i></span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text"  name="unite_de_mesure" value="" class="form-control" placeholder=" renseigner l'unite de mesure" autofocus required title="Ce champ est obligatoire.">
                                    </div>
                                </div>
                            </div> 
                        @endif--}}
                            @foreach ($futur_annees as $futur_annee )
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val_email">En {{ $futur_annee->libelle }}<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number"   id="num_rccm" name="{{ $indicateur_previsionel_du_projet->id }}{{$futur_annee->id }}" value="{{old('{!! $indicateur_previsionel_du_projet->id !!}{!! $futur_annee->id !!}')}}" class="form-control" placeholder=" Saisir la quantité" autofocus required title="Ce champ est obligatoire.">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </fieldset>
                        </div>
                        @endforeach
                    </div>
                    @foreach ($effectifs as $effectif )
                    <div class="col-md-6">
                    <fieldset>
                        <legend>{{ $effectif->libelle }} prévisionnel </legend>
                        @foreach ( $futur_annees as $futur_annee )
                            <p>En {{ $futur_annee->libelle }} </p>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="num_rccm">Homme<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number" min="0" id="num_rccm" name="{{ $effectif->id }}{{$futur_annee->id }}homme"  value="{{old('{!! $effectif->id !!}{!! $futur_annee->id !!}homme')}}" class="form-control" placeholder=" Saisir l'effectif" autofocus required title="Ce champ est obligatoire">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="effectif">Femme<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="number" min="0" id="effectif" name="{{ $effectif->id }}{{$futur_annee->id }}femme" class="form-control" placeholder=" Saisir l'effectif" value="{{old('{!! $effectif->id !!}{!! $annee->id !!}femme')}}" autofocus required title="Ce champ est obligatoire" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>
                    </div>
                    @endforeach
                </div>
                
            <div class="row">
                

            </div>
            <div class="row">
                
                
            </div>
    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                            <input type="reset" class="btn btn-sm btn-warning" id="back3" value="Back">
                            <input type="submit" class="btn btn-sm btn-primary" id="next3" value="Next">
                        </div>
                    </div>
                    <!-- END Form Buttons -->
                </form>
        </div>
            </div>
                <!-- END Progress Wizard Content -->
            </div>
        </div>
        <!-- END Progress Bar Wizard Content -->
    </div>

@endsection