@extends('layouts.frontend')
@section('content')

<div class="section-title">
      <h3>Informations de l'entreprise</h3>
      </div>
      
      <div class="block">
        <p style="background-color: rgb(231, 179, 179); color">Les champs marqué d'étoile en <span style="color:red; font-size:15px;">*</span> rouge sont obligatoires</p>
        <div class="row">
            
            <div class="col-sm-10 col-sm-offset-1">
                <!-- Wizard Progress Bar, functionality initialized in js/pages/formsWizard.js -->
                <div class="progress progress-striped active">
                    <div id="progress-bar-wizard" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                </div>
                <!-- END Wizard Progress Bar -->

                <!-- Progress Wizard Content -->
                <div class="step-app">
                <form id="progress-wizard" action="page_forms_wizard.html" method="post" class="form-horizontal">
                    <div id="progress-first" class="step">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_denomination">Dénomination<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                <div class="input-group">
                                    {{-- <input type="text" id="denomination" name="denomination" class="form-control" placeholder="Entrez votre la dénomination" value="{{old("denomination")}}" required onchange="unique();"> --}}
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
                        <div class="col-lg-5">
                                    <fieldset>
                                        <legend>Localisation sur l'entreprise</legend>
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
                                    </div>
                                 <div class="offset-md-1 col-lg-5">
                                    </fieldset>
                                            <fieldset>
                                                <legend>Informations sur l'activite</legend>
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
                                                    <label class=" control-label" for="example-chosen">Nombre d’années d’existence de l’entreprise  <span class="text-danger">*</span></label>
                                                           <select id="nbre_dannee_experience" name="nombre_annee_experience" class="select-select2" data-placeholder="Quel est votre niveau d'instruction.."  style="width: 100%;"  required>
                                                               <option></option>
                                                               @foreach ($nbre_dannee_experiences as $nbre_dannee_experience )
                                                                    <option value="{{ $nbre_dannee_experience->id  }}" {{ old('nombre_annee_experience') == $nbre_dannee_experience->id ? 'selected' : '' }}>{{ $nbre_dannee_experience->libelle }}</option>
                                                               @endforeach
                                                           </select>
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
                                                        <input class="form-control" type="file" id="docrccm" accept=".pdf, .jpeg, .png" name="docrccm"  placeholder="Charger une copie du RCCM" required>
                                                    @if ($errors->has('docrccm'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('docrccm') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                     </fieldset>
                                </div>
                            </div>
            </div>

        <div id="progress-second" class="step">
                        <div class="row">
                                <fieldset>
                                    <legend>Informations sur l'activite</legend>
                                    <div class="col-md-5">
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
                                        <label class=" control-label" for="compte_dispo">Avez-vous déjà obtenu un financement(crédit)?<span class="text-danger">*</span><span data-toggle="tooltip" title="L’entreprise a t-elle déjà beneficier d'un prêt auprès d'une institution financière ?"><i class="fa fa-info-circle"></i></span></label>
                                            <select id="beneficier_credit" name="beneficier_credit" class="select-select2" data-placeholder="Avez-vous déjà obtenu un financement des institutions financières?" style="width: 100%;"  autofocus required title="Ce champ est obligatoire">
                                                <option></option>
                                                <option value="1" {{ old('beneficier_credit') == 1 ? 'selected' : '' }}>Oui</option>
                                                <option value="2" {{ old('beneficier_credit') == 2 ? 'selected' : '' }}>Non</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-textarea-input">Brève description de l'activité<span class="text-danger">*</span> </label>
                                            <textarea id="description_activite" name="description_activite" rows="9" class="form-control" placeholder="en quoi consiste votre activité ? 200 mots" autofocus required title="Ce champ est obligatoire">{{old('description_activite') }}</textarea>
                                    </div>
                                    </div>
                                    <div class="offset-md-1 col-md-5">
                                        <div class="form-group">
                                            <label class=" control-label" for="example-select2">Source d'approvisionement <span class="text-danger">*</span> </label>
                                                <select id="source_appro" name="source_appro" class="select-select2" data-placeholder="Choisir la source" style="width:100%;" autofocus required title="Ce champ est obligatoire" >
                                                    <option></option>
                                                    @foreach ($source_appros as $source_appro )
                                                        <option value="{{$source_appro->id  }}" {{ old('source_appro') == $source_appro->id ? 'selected' : '' }} value="{{ $source_appro->id }}">{{ $source_appro->libelle }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label class=" control-label" for="example-select2">Technologie utilisée <span class="text-danger">*</span> </label>
                                                <select id="source_appro" name="source_appro" class="select-select2" data-placeholder="Choisir la technologie utilisée" style="width:100%;" autofocus required title="Ce champ est obligatoire" >
                                                    <option></option>
                                                    @foreach ($techno_utilisees as $techno_utilisee )
                                                        <option value="{{$techno_utilisee->id  }}" {{ old('techno_utilisee') == $techno_utilisee->id ? 'selected' : '' }} value="{{ $techno_utilisee->id }}">{{ $techno_utilisee->libelle }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label class=" control-label" for="example-chosen">Provenance de la clientele<span class="text-danger">*</span></label>
                                                <select id="provenance_clientele" name="provenance_clientele" class="select-select2" data-placeholder="Choisir la provenance de votre clientèle" style="width: 100%;" required onchange="afficherautre('provenance_clientele',  {{ env('VALEUR_ID_AUTRE_PROVENANCE_CLIENTELE') }} ,'autre_provenance_clientele');">
                                                    <option></option>
                                                    @foreach ($provenance_clients as $provenance_client )
                                                    <option value="{{$provenance_client->id  }}" {{ old('provenance_clientele') == $provenance_client->id ? 'selected' : '' }} value="{{ $provenance_client->id }}">{{ $provenance_client->libelle }}</option>
                                                    @endforeach <!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                                </select>
                                        </div>
                                        {{-- <div class="form-group" id="autre_provenance_clientele">
                                            <label class=" control-label" for="">Précisez</label>

                                            <div class="input-group">
                                                <input type="text"   name="autre_provenance_clientele" class="form-control" placeholder="Précisez autre occupation " value="{{old("autre_occupation")}}" required>

                                        </div> --}}
                                    {{-- </div> --}}
                                        <div class="form-group">
                                            <label class=" control-label" for="example-chosen">Nature de la clientèle<span class="text-danger">*</span></label>
                                                <select id="nature_client" name="nature_client" class="select-select2" data-placeholder="La nature de la clientèle" style="width: 100%;" onchange="afficherautre('nature_client',  {{ env('VALEUR_ID_AUTRE_NATURE_CLIENTELE') }} ,'autre_nature_clientele');" required >
                                                    <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                                    @foreach ($nature_clienteles as $nature_clientele )
                                                    <option value="{{$nature_clientele->id  }}" {{ old('nature_client') == $nature_clientele->id ? 'selected' : '' }} value="{{ $nature_clientele->id }}">{{ $nature_clientele->libelle }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        {{-- <div class="form-group" id="autre_nature_clientele">
                                            <label class=" control-label" for="">Précisez</label>

                                            <div class="input-group">
                                                <input type="text"   name="autre_nature_clientele" class="form-control" placeholder="Précisez autre nature clientele " value="{{old("autre_nature_clientele")}}" required>

                                        </div>
                                </div> --}}
                                        <div class="form-group">
                                            <label class=" control-label" for="example-chosen">Utilisez-vous un systeme suivi ?<span class="text-danger">*</span><span data-toggle="tooltip" title="Votre entreprise dispose t-elle d'un système de suivi financière et comptables "><i class="fa fa-info-circle"></i></span></label>

                                                <select id="systeme_suivi" name="systeme_suivi" class="select-select2" data-placeholder="Disposez-vous d'un système de suivi" onchange="cachertypeSystem();" style="width: 100%;" autofocus required title="Ce champ est obligatoire" >
                                                    <option></option>
                                                    <option value="1" {{ old('systeme_suivi') == 1 ? 'selected' : '' }}>Oui</option>
                                                    <option value="2" {{ old('systeme_suivi') == 2 ? 'selected' : '' }}>Non</option>
                                    <!-- Required for data-placeholder attribute to work with select2 plugin -->
                                                </select>
                                        </div>
                                        <div class="form-group" id="typesyssuivi">
                                            <label class="control-label" for="example-select2">Type de système <span data-toggle="tooltip" title="Indiquez le type de système de suivi financière et comptable que vous utilisez "><i class="fa fa-info-circle"></i></span></label>
                                                <select id="type_de_systeme_suivi" name="type_de_systeme_suivi" class="select-select2" data-placeholder="Choisir le type de systeme de suivi" style="width: 100%;" onchange="afficherautre('type_de_systeme_suivi',  {{ env('VALEUR_ID_AUTRE_SYSTEME_DE_SUIVI_ACTIVITE') }} ,'autre_systeme_de_suivi');" >
                                                    <option></option>
                                                    @foreach ($sys_suivi_activites as $sys_suivi_activite )
                                                        <option value="{{$sys_suivi_activite->id  }}" {{ old('systeme_suivi') == $sys_suivi_activite->id ? 'selected' : '' }} value="{{ $sys_suivi_activite->id }}">{{ $sys_suivi_activite->libelle }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="row">
                                @foreach ($rentabilite_criteres as $rentabilite_critere )
                                <div class="col-md-6">
                                <fieldset>
                                    <legend>{{ $rentabilite_critere->libelle }} </legend>
                                @if($rentabilite_critere->id== 41)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="unite_de_mesure">Unité de mesure<span class="text-danger">*</span><span data-toggle="tooltip" title="Préciser l'unité(tonne, nombre de plat, nombre de tête d'animaux, ...) de mesure de la quantite de produit vendus?"><i class="fa fa-info-circle"></i></span></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text"  name="unite_de_mesure" value="" class="form-control" placeholder=" renseigner l'unite de mesure" autofocus required title="Ce champ est obligatoire.">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @foreach ($annees as $annee )
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_email">En {{ $annee->libelle }}<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="number"   id="num_rccm" name="{{ $rentabilite_critere->id }}{{$annee->id }}" value="{{old('{!! $rentabilite_critere->id !!}{!! $annee->id !!}')}}" class="form-control" placeholder=" Saisir la quantité" autofocus required title="Ce champ est obligatoire.">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </fieldset>
                                </div>
                                @endforeach
                            </div>
                    </div>
           
                    <!-- END Second Step -->

                    <!-- Third Step -->
       
                    <div id="progress-third" class="step">
       
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
                        <div class="row">
                            @foreach ($nouveaute_entreprises as $nouveaute_entreprise )
                            <div class="col-md-4">
                            <fieldset>
                                <legend>{{ $nouveaute_entreprise->libelle }} <span data-toggle="tooltip" title="{{$nouveaute_entreprise->description}}"><i class="fa fa-info-circle"></i></span></legend>
                                @foreach ($annees as $annee)
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="val_email">En {{ $annee->libelle }}<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="number" min=0 id="num_rccm" name="{{ $nouveaute_entreprise->id }}{{$annee->id }}" value="{{old('{!! $nouveaute_entreprise->id !!}{!! $annee->id !!}')}}" class="form-control" placeholder=" Saisir la quantité" autofocus required title="Ce champ est obligatoire.">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </fieldset>
                            </div>
                            @endforeach
                        </div>
                    <div class="row">
                        <div class="col-md-5">
                           
                        </div>
                        <div class="offset-md-1 col-md-5">
                                <div class="form-group">
                                    <label class="control-label" for="example-chosen">Entreprise affectée par la crise sécuritaire? <span class="text-danger">*</span> <span data-toggle="tooltip" title="Votre entreprise a-t-elle été affectée par la pandémie de COVID-19 ? "><i class="fa fa-info-circle"></i></span></label>
                                        <select id="affecte_par_securite" name="affecte_par_securite" class="select-select2" onchange="afficher();" data-placeholder="Affectée par la crise securitaire?" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($ouinon_reponses as $ouinon_reponse )
                                                <option value="{{$ouinon_reponse->id  }}" {{ old('affecte_par_securite') == $ouinon_reponse->id ? 'selected' : '' }} value="{{ $ouinon_reponse->id }}">{{ $ouinon_reponse->libelle }}</option>
                                            @endforeach<!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label class=" control-label" for="example-textarea-input">Décrire les effets de la crise sécuritaire sur l'activité <span data-toggle="tooltip" title="Décrivez brièvement comment votre entreprise a été affectée par la crise securitaire"><i class="fa fa-info-circle"></i></span> </label>
                                        <textarea id="description_effet_securite" name="description_effet_securite" rows="9" class="form-control" placeholder="Décrivez brièvement comment votre entreprise a été affectée par la crise securitaire" autofocus required title="Ce champ est obligatoire">{{old('description_activite') }}</textarea>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                        <label class="control-label" for="example-chosen">Niveau de resilience <span class="text-danger">*</span><span data-toggle="tooltip" title="Une entreprise résiliente est une entreprise solide et flexible. Elle peut se remettre des difficultés, faire face aux risques et surmonter les obstacles. C'est une survivante"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="niveau_resilience" name="niveau_resilience" class="select-select2" onchange="afficher();" data-placeholder="Entreprise affectée par la covid?" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($niveau_resiliences as $niveau_resilience )
                                            <option value="{{$niveau_resilience->id  }}" {{ old('niveau_resilience') == $niveau_resilience->id ? 'selected' : '' }} value="{{ $niveau_resilience->id }}">{{ $niveau_resilience->libelle }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="offset-md-1 col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="example-chosen">Pouvez-vous mobiliser la contrepartie? <span class="text-danger">*</span><span data-toggle="tooltip" title="Pouvez-vous mobiliser une somme de 3 000 000 FCFA à 6 000 000 FCFA comme contrepartie pour financer votre entreprise ?"><i class="fa fa-info-circle"></i></span></label>
                                    <select id="mobililise_contrepartie" name="mobililise_contrepartie" class="select-select2" onchange="afficher();" data-placeholder="Pouvez-vous mobiliser une somme de 3 000 000 FCFA à 6 000 000 FCFA comme contrepartie pour financer votre entreprise " style="width: 100%;" required>
                                        <option></option>
                                        <option value="Oui" {{ old('mobililise_contrepartie') == 'oui' ? 'selected' : '' }}>Oui</option>
                                        <option value="Non" {{ old('mobililise_contrepartie') == 'oui' ? 'selected' : '' }}>Non</option>
                                    </select>
                            </div>
                        </div>
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