@extends('layouts.frontend')
@section('content')
        <div class="section-title">
            <h3>Informations sur l'entreprise</h3>
        </div>
      <div class="block">
        <p style="background-color: rgb(231, 179, 179); color">Les champs marqué d'étoile en <span style="color:red; font-size:15px;">*</span> rouge sont obligatoires</p>
        <div class="row">
            <div class="col-sm-12">
            <div class="step-app">
                <form action="{{ route("entreprise.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" id="code_promoteur" name="code_promoteur" value="{{ $promoteur_code }}">
                        <input type="hidden" id="type_entreprise" name="type_entreprise" value="{{ $type_entreprise }}">
                        <input type="hidden" id="programme" name="programme" value="{{ $programme }}">

                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_denomination">Dénomination<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" id="denomination" name="denomination" class="form-control" placeholder="Entrez votre la dénomination" value="{{old("denomination")}}" required >
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
                    <div class="col-lg-6">
                        <fieldset>
                            <legend>Localisation de l'entreprise</legend>
                                    <div class="form-group">
                                        <label class="control-label" for="region">Region<span class="text-danger">*</span></label>
                                            <select id="region_residence" name="region" class="select-select2" data-placeholder="Choisir votre residence .." value="{{old("region")}}" onchange="changeValue('region_residence', 'province_residence', {{ env('PARAMETRE_ID_PROVINCE') }});"   style="width:100%;" required>
                                                <option></option><!-- Required for data-placeholder attribute to work with select2 plugin -->
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
                                                       
                            </fieldset>
                        </div> 
                        <div class="col-md-5">
                            <fieldset>
                                <legend>Information sur l'activité</legend>
                            <div class="form-group">
                                <label class="control-label" for="val_email">Secteur d'activité <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="secteur_activite" name="secteur_activite" class="select-select2" data-placeholder="Renseigner le secteur d'activite de votre entreprise" value="{{old("region")}}"   style="width:100%;" required>
                                            <option></option><!-- Required for data-placeholder attribute to work with select2 plugin -->
                                            @foreach ($secteur_activites as $secteur_activite )
                                                    <option value="{{ $secteur_activite->id  }}" {{ old('secteur_activite') == $secteur_activite->id ? 'selected' : '' }}>{{ $secteur_activite->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Maillon d'activité<span class="text-danger">*</span></label>
                                    <select id="maillon_activite" name="maillon_activite" class="select-select2" data-placeholder="Choisir le maillon d'activite" style="width: 100%;" required onchange="afficherautre('maillon_activite',  {{ env('VALEUR_ID_AUTRE_MAILLON_ACTIVITE') }} ,'autre_maillon_activite');">
                                        <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        @foreach ($maillon_activites as $maillon_activite )
                                            <option value="{{ $maillon_activite->id  }}" {{ old('maillon_activite') == $maillon_activite->id ? 'selected' : '' }} value="{{ $maillon_activite->id }}">{{ $maillon_activite->libelle }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label " for=""> Nombre d’années d’existence de l’entreprise (depuis le début des activités) <span class="text-danger">*</span></label>
                                <select id="nb_annee_existences" name="nb_annee_existence" class="select-select2" data-placeholder="Choisir le maillon d'activite" style="width: 100%;" required onchange="afficherautre('maillon_activite',  {{ env('VALEUR_ID_AUTRE_MAILLON_ACTIVITE') }} ,'autre_maillon_activite');">
                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    @foreach ($nb_annee_existences as $nb_annee_existence )
                                        <option value="{{ $nb_annee_existence->id  }}" {{ old('nb_annee_existence') == $nb_annee_existence->id ? 'selected' : '' }} value="{{ $nb_annee_existence->id }}">{{ $nb_annee_existence->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </fieldset>
                        </div>
                </div>
                <hr>
                <div class="row">
                            <div class="col-md-5">
                                <fieldset>
                                    <legend>Information sur l'entreprise</legend>
                                <div class="form-group">
                                    <label class=" control-label" for="compte_dispo">L’entreprise dispose-t-elle d’un compte bancaire?<span class="text-danger">*</span><span data-toggle="tooltip" title="L’entreprise dispose-t-elle d’un compte dans une institution financière (Banques ou structures de microfinance?"><i class="fa fa-info-circle"></i></span></label>
                                        <select id="compte_dispo" name="compte_dispo" class="select-select2" data-placeholder="L'entreprise dispose t-elle d’un compte dans une banque ou une institution?" style="width: 100%;"  autofocus required title="Ce champ est obligatoire" onchange="afficherSiOui('compte_dispo', 'nom_structure')">
                                            <option></option>
                                            <option value="1" {{ old('compte_dispo') == 1 ? 'selected' : '' }}>Oui</option>
                                            <option value="2" {{ old('compte_dispo') == 2 ? 'selected' : '' }}>Non</option>
                                        </select>
                                </div>
                                <div class="form-group nom_structure" >
                                    <label class=" control-label" for="">Précisez le nom de la banque</label>
                                        <div class="input-group">
                                            <input type="text" name="structure_financiere_entreprise" class="form-control" placeholder="Précisez le nom de la structure financière" value="{{old("structure_financiere_personne")}}">
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="example-chosen">Entreprise est-elle formalisée?<span class="text-danger">*</span></label>
                                        <select id="formalise" name="formalise" class="select-select2" onchange="afficher();" data-placeholder="formalisée?" style="width: 100%;" required>
                                            <option></option>
                                            <option value="1" {{ old('formalise') == 1 ? 'selected' : '' }}>Oui</option>
                                            <option value="2" {{ old('formalise') == 2 ? 'selected' : '' }}>Non</option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        </select>
                                </div>
                                <div class="form-group entreformalise">
                                    <label class=" control-label" for="val_username">Date de formalisation</label>
                                        <div class="input-group">
                                            <input type="text" id="" name="date_de_formalisation" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="Date de formalisation de l'entreprise .." value="{{old('date_de_formalisation')}}" >
                                        </div>
                                </div>
                                <div class="form-group entreformalise">
                                    <label class=" control-label" for="val_email">Numéro RCCM</label>
                                        <div class="input-group">
                                            <input type="text" id="num_rccm" name="num_rccm" class="form-control" placeholder="numéro RCCM" value="{{old('num_rccm')}}" >

                                        </div>
                                </div>
                                <div class="entreformalise form-group{{ $errors->has('docrccm') ? ' has-error' : '' }}">
                                    <label class=" control-label" for="docidentite">Joindre une copie du RCCM</label>
                                        <input class="form-control" type="file" id="docrccm" accept=".pdf, .jpeg, .png" name="docrccm"  placeholder="Charger une copie du RCCM" onchange="VerifyUploadSizeIsOK('docrccm');">
                                        <span class="help-block" style="text-align: center; color:red;">
                                            Taille maximale autorirée :2MB
                                           </span>
                                    @if ($errors->has('docrccm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('docrccm') }}</strong>
                                        </span>
                                        @endif
                                </div> 
                                </fieldset>         
                            </div>
                    <div class="col-md-5">
                            @foreach ($rentabilite_criteres as $rentabilite_critere )
                            <div class="row">
                            <fieldset>
                                <legend>{{ $rentabilite_critere->libelle }} </legend>
                                @foreach ($annees as $annee )
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="val_email">En {{ $annee->libelle }}<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="number"   id="num_rccm" name="{{ $rentabilite_critere->id }}{{$annee->id }}" value="{{old('{!! $rentabilite_critere->id !!}{!! $annee->id !!}')}}" class="form-control" placeholder=" Saisir la valeur" autofocus required title="Ce champ est obligatoire.">
                                            </div>
                                        </div>
                                    </div>
                              @endforeach
                            </fieldset>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    @foreach ($effectifs as $effectif )
                <div class="col-md-6">
                <fieldset>
                    <legend>{{ $effectif->libelle }} </legend>
                    @foreach ($annees as $annee )
                        <p>En {{ $annee->libelle }} </p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="num_rccm">Homme<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" min="0" id="num_rccm" name="{{ $effectif->id }}{{$annee->id }}homme"  value="{{old('{!! $effectif->id !!}{!! $annee->id !!}homme')}}" class="form-control" placeholder=" Saisir l'effectif" autofocus required title="Ce champ est obligatoire">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="effectif">Femme<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" min="0" id="effectif" name="{{ $effectif->id }}{{$annee->id }}femme" class="form-control" placeholder=" Saisir l'effectif" value="{{old('{!! $effectif->id !!}{!! $annee->id !!}femme')}}" autofocus required title="Ce champ est obligatoire" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </fieldset>
                </div>
                @endforeach
                </div>
                
                <div class="step-footer">
                    <center><button class="btn btn-danger btn-submit" type="reset">Annuler</button>
                        <button class="btn btn-success btn-submit"  type="submit">Valider</button></center>
                </div>
                    <!-- END Form Buttons -->
                </form>
              </div>
            </div>
                <!-- END Progress Wizard Content -->
            </div>
        </div>
        <!-- END Progress Bar Wizard Content -->
@endsection