@extends('layouts.frontend')
@section('content')

<div class="section-title">
      <h3>PROGRAMME ENTREPRENDRE INFORMATIONS SUR LE PROJET</h3>
      </div>
      
      <div class="block">
        <p style="background-color: rgb(231, 179, 179); color">Les champs marqué d'étoile en <span style="color:red; font-size:15px;">*</span> rouge sont obligatoires</p>
        <div class="row">
            
            <div class="col-sm-12">
                <!-- Wizard Progress Bar, functionality initialized in js/pages/formsWizard.js -->
                <div class="progress progress-striped active">
                    <div id="progress-bar-wizard" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                </div>
                
                <div class="step-app">
                <form id="progress-wizard" action="{{ route("preprojet_pe.creation") }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="progress-first" class="step">
                        <input type="hidden" id="code_promoteur" name="code_promoteur" value="{{ $promoteur_code }}">
                        <input type="hidden" id="programme" name="programme" value="{{ $programme }}">
                        {{-- <input type="hidden" id="entreprise_id" name="entreprise_id" value="{{ $entreprise }}"> --}}
                        <div class="row">
                           
                            <div class="offset-md-1 col-md-8">
                                <div class="form-group">
                                    <label class="control-label" for="val_denomination">Titre de votre projet<span class="text-danger">*</span></label>
                                    <input type="text" id="titre_projet" name="titre_projet" class="form-control" placeholder="Entrez votre la dénomination" value="{{old("denomination")}}" required >
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
                                        <label class=" control-label" for="example-textarea-input">Description  du projet (expliquez votre idée de projet) <span data-toggle="tooltip" title="expliquez votre idée de projet"><i class="fa fa-info-circle"></i></span><span class="text-danger">*</span> </label>
                                            <textarea id="description_idee_de_projet" name="description_idee_de_projet" rows="6" class="form-control" placeholder="expliquez votre idée de projet" autofocus required title="Ce champ est obligatoire">{{old('description_idee_de_projet') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-textarea-input">Quels sont les objectifs du projet<span data-toggle="tooltip" title="expliquez les objectifs du projet"><i class="fa fa-info-circle"></i></span><span class="text-danger">*</span></label>
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
                        <legend>Niveau de maturation du projet </legend>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class=" control-label" for="example-chosen">Etude technique de faisabilité de votre projet realisée?<span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà obtenu une promesse de financement de votre projet auprès des institutions financières (banques, institutions de microfinance ?"><i class="fa fa-info-circle"></i></span></label>
                                <select id="etude_technique_de_faisabilite" name="etude_technique_de_faisabilite" class="select-select2"  data-placeholder="Avez-vous déjà réalisé une étude technique de faisabilité de votre projet" style="width: 100%;" required>
                                    <option></option>
                                    <option value="1" {{ old('etude_technique_de_faisabilite') == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="2" {{ old('etude_technique_de_faisabilite') == 2 ? 'selected' : '' }}>Non</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label class=" control-label" for="example-chosen">Avez déjà réalisé une étude de marché de votre projet?<span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez déjà réalisé une étude de marché de votre projet ?"><i class="fa fa-info-circle"></i></span></label>
                                <select id="etude_de_marche_realise" name="etude_de_marche_realise" class="select-select2"  data-placeholder="Avez déjà réalisé une étude de marché de votre projet" style="width: 100%;" required>
                                    <option></option>
                                    <option value="1" {{ old('etude_de_marche_realise') == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="2" {{ old('etude_de_marche_realise') == 2 ? 'selected' : '' }}>Non</option>
                                </select>
                        </div> 
                        
                    </div>
                    <div class="col-md-offset-1 col-md-5">
                        <div class="form-group">
                            <label class=" control-label" for="example-chosen">Prototype du produit ou du service disponible ?<span class="text-danger">*</span> <span data-toggle="tooltip" title="Disposez vous d’un prototype ou preuve de conception de votre produit ou service  ?"><i class="fa fa-info-circle"></i></span></label>
                                <select id="existence_de_prototype" name="existence_de_prototype" class="select-select2"  data-placeholder="Disposez vous d’un prototype ou preuve de conception de votre produit ou service " style="width: 100%;" required>
                                    <option></option>
                                    <option value="1" {{ old('existence_de_prototype') == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="2" {{ old('existence_de_prototype') == 2 ? 'selected' : '' }}>Non</option>
                                </select>
                        </div> 
                        <div class="form-group">
                            <label class=" control-label" for="example-chosen">Démarches pour les recherches de financement effectuées?<span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà engagé des démarches pour les recherches de financement ?"><i class="fa fa-info-circle"></i></span></label>
                                <select id="recherche_de_financement" name="recherche_de_financement" class="select-select2"  data-placeholder="Avez-vous déjà engagé des démarches pour les recherches de financement" style="width: 100%;" required>
                                    <option></option>
                                    <option value="1" {{ old('recherche_de_financement') == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="2" {{ old('recherche_de_financement') == 2 ? 'selected' : '' }}>Non</option>
                                </select>
                        </div> 
                            {{-- <div class="form-group">
                                <label class="col-md-8 control-label">Avez-vous déjà engagé des démarches pour les recherches de financement</label>
                                <div class="col-md-4">
                                    <label class="radio-inline" for="example-inline-radio1">
                                        <input type="radio" id="example-inline-radio1" name="recherche_de_financement" value="1"> Oui
                                    </label>
                                    <label class="radio-inline" for="example-inline-radio2">
                                        <input type="radio" id="example-inline-radio2" name="recherche_de_financement" value="2"> Non
                                    </label>
                                </div>
                            </div> --}}
                           
                    
                        </div>
                    </fieldset>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class=" control-label" for="">Quels sont vos besoins en renforcement des capacités<span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                                @foreach ($formations_souhaites as $formations_souhaite)
                                <div class="col-lg-8 checkbox">
                                    <label><input type="checkbox" name='formations_souhaites[]' value="{{ $formations_souhaite->id }}"> {{ $formations_souhaite->libelle }}</label>
                                </div>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class=" control-label" for="">Avez-vous déjà suivi une formation en entreprenariat?<span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                                @foreach ($formations_effectuees as $formations_effectuee)
                                <div class="col-lg-8 checkbox">
                                    <label><input type="checkbox" name='formations_effectuees[]' value="{{ $formations_effectuee->id }}"> {{ $formations_effectuee->libelle }}</label>
                                </div>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                <div class="offset-md-1 col-md-5">
                    {{-- <div class="form-group">
                        <label class=" control-label" for="">Avez-vous déjà suivi une formation en entreprenariat ? <span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                            @foreach ($formations_effectuees as $formations_effectuee)
                            <div class="col-lg-8 checkbox">
                                <label><input type="checkbox" name='formations_effectuees[]' value="{{ $formations_effectuee->id }}"> {{ $formations_effectuee->libelle }}</label>
                            </div>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label class=" control-label" for="example-chosen">Avez-vous une expérience dans le domaine d’activité de votre projet? <span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous une expérience / connaissance dans le domaine d’activité de votre projet?  ?"><i class="fa fa-info-circle"></i></span></label>
                            <select id="connaissance_sur_lactivite" name="connaissance_sur_lactivite" class="select-select2" onchange="afficherSiOui('connaissance_sur_lactivite','acquisition_des_connaissances');" data-placeholder="Avez-vous une expérience / connaissance dans le domaine d’activité de votre projet? " style="width: 100%;" required>
                                <option></option>
                                <option value="1" {{ old('connaissance_sur_lactivite') == 1 ? 'selected' : '' }}>Oui</option>
                                <option value="2" {{ old('connaissance_sur_lactivite') == 2 ? 'selected' : '' }}>Non</option>
                            </select>
                    </div>
                    <div class="form-group acquisition_des_connaissances">
                        <label class=" control-label" for="example-chosen">Comment avez-vous acquis ces expériences<span class="text-danger">*</span><span data-toggle="tooltip" title="Comment avez-vous acquis ces expériences / connaissances "><i class="fa fa-info-circle"></i></span></label>
                            <select id="mode_dacquisition_des_connaissances" name="mode_dacquisition_des_connaissances" class="select-select2" data-placeholder="Comment avez-vous acquis ces expériences / connaissances" style="width: 100%;" required >
                                <option></option>
                                <option value="1" {{ old('mode_dacquisition_des_connaissances') == 1 ? 'selected' : '' }}>Apprentissage sur le tas</option>
                                <option value="2" {{ old('mode_dacquisition_des_connaissances') == 2 ? 'selected' : '' }}>Formation Technique</option>
                                <option value="3" {{ old('mode_dacquisition_des_connaissances') == 3 ? 'selected' : '' }}>Stage</option> 
                            </select>
                    </div>
                </div>
            </div>
                   
              
            </div>
            <div id="progress-third" class="step">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group" >
                            <label class=" control-label" for="example-chosen">Une autorisation est-il exigée pour la mise en œuvre de votre projet ? <span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà obtenu une promesse de financement de votre projet auprès des institutions financières (banques, institutions de microfinance ?"><i class="fa fa-info-circle"></i></span></label>
                                <select id="aggrement_exige" name="aggrement_exige" class="select-select2" onchange="afficherSiOui('aggrement_exige','type_aggrement');" data-placeholder="Une autorisation est-il exigée pour la mise en œuvre de votre projet" style="width: 100%;" required>
                                    <option></option>
                                    <option value="1" {{ old('aggrement_exige') == 1 ? 'selected' : '' }}>Oui</option>
                                    <option value="2" {{ old('aggrement_exige') == 2 ? 'selected' : '' }}>Non</option>
                                </select>
                        </div>
                        <div class="form-group type_aggrement" style="display: none;">
                            <label class="control-label" for="precise_aggrement">Precisez l'aggrément exigé <pan class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text"   id="precise_aggrement" name="precise_aggrement"  class="form-control" placeholder="Preciser l'aggrement ou l'autorisation exigé pour le projet"  autofocus required>
                                </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label" for="">La forme juridique que vous envisagez pour votre entreprise <span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                            <select id="forme_juridique_envisage" name="forme_juridique_envisage" class="select-select2" data-placeholder="La nature de la clientèle" style="width: 100%;"  required >
                                <option></option>
                                @foreach ($forme_juridiques as $forme_juridique )
                                <option value="{{$forme_juridique->id  }}" {{ old('nature_client') == $forme_juridique->id ? 'selected' : '' }} value="{{ $forme_juridique->id }}">{{ $forme_juridique->libelle }}</option>
                                @endforeach
                            </select>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class=" control-label" for="example-chosen">Origine de la clientèle de votre projet <span class="text-danger">*</span></label>
                                <select id="provenance_clientele" name="provenance_clientele" class="select-select2" data-placeholder="Choisir la provenance de votre clientèle" style="width: 100%;" required onchange="afficherautre('provenance_clientele',  {{ env('VALEUR_ID_AUTRE_PROVENANCE_CLIENTELE') }} ,'autre_provenance_clientele');">
                                    <option></option>
                                    @foreach ($provenance_clients as $provenance_client )
                                    <option value="{{$provenance_client->id  }}" {{ old('provenance_clientele') == $provenance_client->id ? 'selected' : '' }} value="{{ $provenance_client->id }}">{{ $provenance_client->libelle }}</option>
                                    @endforeach <!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                </select>
                        </div>
                        
                    </div>
                    <div class="col-md-offset-1 col-md-5">
                        <div class="form-group">
                            <label class=" control-label" for="">Sources d’approvisionnement prévisionnelles  <span data-toggle="tooltip" title="Quelles sont les innovations de votre projet"><i class="fa fa-info-circle"></i></span> </label>
                                @foreach ($source_appros as $source_appro)
                                <div class="col-lg-8 checkbox">
                                    <label><input type="checkbox" name='source_appros[]' value="{{ $source_appro->id }}"> {{ $source_appro->libelle }}</label>
                                </div>
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
                            <div class="form-group docsite" style="display: none">
                                <label class=" control-label" for="example-chosen">Type de propriété <span class="text-danger">*</span> <span data-toggle="tooltip" title="Avez-vous déjà obtenu une promesse de financement de votre projet auprès des institutions financières (banques, institutions de microfinance ?"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="type_site" name="type_site" class="select-select2" data-placeholder="Disposer vous d’un site de mise en œuvre de votre projet" style="width: 100%;" required>
                                        <option></option>
                                        <option value="1" {{ old('type_site') == 1 ? 'selected' : '' }}>Domaine personnel</option>
                                        <option value="2" {{ old('type_site') == 2 ? 'selected' : '' }}>En location</option>
                                    </select>
                            </div>
                    </div>
                </div>
                
                
            <div class="row">
               <p style="color: red; margin-bottom:20px;"> NB: Une fois validé les informations soumises ne seront plus modifiables. Merci de reparcourir le formulaire avant de le valider.</p>
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