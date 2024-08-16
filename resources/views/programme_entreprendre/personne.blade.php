@extends('layouts.frontend')
@section('content')

<div class="section-title">
      <h3>Identification du Promoteur</h3>
      </div>
<div class="step-app" id="demo">
    
<form  action="{{ route("promoteur.store") }}" method="post" enctype="multipart/form-data">
    @csrf 
      <div class="step-tab-panel" data-step="step1">
        <div class="row">
            <p class="message_doublon" style="color: red; display:none;">Désole vous vous êtes déjà enregistré sur la plateforme avec le code promoteur. Votre code promoteur vous sera envoyé par mail. </p>
          <div class="col-lg-6">
                    <fieldset>
                           <legend>Informations générales</legend>
                             <input type="hidden" name="type_entreprise" value="{{ $type_entreprise }}">
                             <input type="hidden" name="programme" value="{{ $programme }}">
                                   <div class="form-group">
                                       <label class="control-label" for="nom_promoteur">Nom <span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <input type="text" id="nom_promoteur" name="nom_promoteur" class="form-control" style="width: 100%;" value="{{old('nom_promoteur')}}" placeholder="Entrez votre nom" title="Ce champ est obligatoire" required >
                                           @if ($errors->has('nom'))
                                                   <span class="help-block">
                                                        <strong>{{ $errors->first('nom_promoteur') }}</strong>
                                                   </span>
                                           @endif
                                       </div>
                               </div>
                               <div class="form-group">
                                   <label class="control-label" for="val_username">Prénom (s) <span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <input type="text" id="prenom_promoteur" name="prenom_promoteur" class="form-control" value="{{old('prenom_promoteur')}}"placeholder="Entrez le prenom.." required="Ce champ est obligatoire">
                                       </div>
                               </div>
                               <div class="form-group">
                                   <label class="control-label" for="val_username">Date de naissance<span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <input type="text" id="datenais_promoteur" name="datenais_promoteur" value="{{old('datenais_promoteur')}}" class="form-control datepicker_nais" data-date-format="dd-mm-yyyy" placeholder="Entrer votre date de naissance.." required="Ce champ est obligatoire">
                                       </div>
                               </div>
                               <div class="form-group">
                                   <label class=" control-label" for="example-chosen">Sexe<span class="text-danger">*</span></label>
                                       <select id="genre" name="genre" class="select-select2 test" data-placeholder="Choisir le genre" style="width: 100%;" required="Ce champ est obligatoire" title="Ce champ est obligatoire">
                                           <option></option>
                                           <option value="1" {{ old('genre') == 1 ? 'selected' : '' }}>Féminin</option>
                                           <option value="2" {{ old('genre') == 2 ? 'selected' : '' }}>Masculin</option>
                                       </select>
                               </div>
                               
                               <div class="form-group">
                                <label class=" control-label" for="example-chosen">Avez-vous un Handicap ?<span class="text-danger">*</span></label>
                                    <select id="handicape" name="handicape" class="select-select2" data-placeholder="Avez-vous un handicap" style="width: 100%;" required="Ce champ est obligatoire" title="Ce champ est obligatoire" onchange="afficherSiOui('handicape','handicap_precise')">
                                        <option></option>
                                        <option value="1" {{ old('handicape') == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="2" {{ old('handicape') == 2 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                                <div class="form-group handicap_precise">
                                    
                                        <label class=" control-label" for="example-chosen">Quel handicap avez vous<span class="text-danger">*</span></label>
                                               <select id="type_handicap" name="type_handicap" class="select-select2" data-placeholder="Quel handicap avez vous ?.."  style="width: 100%;" >
                                                   <option></option>
                                                   @foreach ($type_handicaps as $type_handicap )
                                                        <option value="{{ $type_handicap->id  }}" {{ old('type_handicap') == $type_handicap->id ? 'selected' : '' }}>{{ $type_handicap->libelle }}</option>
                                                   @endforeach
                                               </select>
                                     
                                </div>
                               </fieldset>
                                   </div>
                                   <div class="col-lg-6">
                                       <fieldset>
                                           <legend>Référence du document d’identité</legend>
                                           <div class="form-group select-list">
                                               <label class=" control-label" for="example-chosen">Type<span class="text-danger">*</span></label>
                                                   <select id="type_identite_promoteur" name="type_identite_promoteur" data-placeholder="Choisir type identite" onchange="afficherchampidentite()" class="select-select2" style="width: 100%;" required>
                                                       <option></option>
                                                       <option value="1" {{ old('type_identite_promoteur') == 1 ? 'selected' : '' }} >CNIB</option>
                                                       <option value="2" {{ old('type_identite_promoteur') == 2 ? 'selected' : '' }}>Passeport</option>
                                                   </select>
                                           </div>
                                           <div class="form-group" id='champ_cnib' style="display: none;">
                                               <label class=" control-label" for="">Numéro de la cnib (Le NIP) <span class="text-danger">*</span> <span data-toggle="tooltip" title="Renseigner le numéro à 17 chiffres au recto de la CNIB (partie photo)"><i class="fa fa-info-circle"></i></span></label>
                                               <div class="input-group">
                                                   <input type="text" id="numero_identite_cnib" name="numero_identite_cnib" value="{{old('numero_identite')}}" class="form-control masked_cnib" placeholder="ex:090102001150029567" onchange="controler_de_doublon_promotrice('numero_identite_cnib')">
                                               </div>
                                               @if ($errors->has('numero_identite'))
                                                   <span class="help-block text-danger">
                                                        <strong>Un promoteur a déja été enregistré avec ce numéro d'identité</strong>
                                                   </span>
                                               @endif
                                         </div>
                                         <div class="form-group" id='champ_passport' style="display: none">
                                            <label class=" control-label" for="">Numéro de passeport <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" id="numero_identite_passport" name="numero_identite_passport" value="{{old('numero_identite')}}" class="form-control" placeholder="numéro.." onchange="controler_de_doublon_promotrice('numero_identite_passport')">
                                            </div>
                                            @if ($errors->has('numero_identite'))
                                                <span class="help-block text-danger">
                                                     <strong>Un promoteur a déja été enregistré avec ce numéro d'identité</strong>
                                                </span>
                                            @endif
                                      </div>
                                       <div class="form-group">
                                           <label class=" control-label" for="">Date d'établissement <span class="text-danger">*</span></label>
                                       <div class="input-group">
                                           <input type="text" id="date_identification" value="{{old('date_identification')}}" name="date_identification" class="form-control datepicker" data-date-format="dd-mm-yyyy" placeholder="dd/mm/yy"required>
                                   </div>
                                       </div>
                                   
                           <div class="form-group{{ $errors->has('docidentite') ? ' has-error' : '' }}">
                               <label class="control-label" for="docidentite">Joindre une copie scannée<span class="text-danger">*</span></label>
                                   <input class="form-control" type="file" name="docidentite" id="docidentite1" accept=".pdf, .jpeg, .png"   placeholder="Charger une copie du document d'identification" onchange="VerifyUploadSizeIsOK('docidentite1')" required>
                                   <span class="help-block" style="text-align: center; color:red;">
                                    Taille maximale autorirée :2MB
                                   </span>
                               @if ($errors->has('docidentite'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('docidentite') }}</strong>
                                   </span>
                               @endif
                       </div>
                       </fieldset>
                       </div>
                </div>
                <div class="row">
                    <fieldset>
                        <legend>Contacts</legend>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=" control-label" for="val_username">Télephone Principal (préciser sans indicatif):<span class="text-danger">*</span><span data-toggle="tooltip" title="Ce numéro de téléphone ne sera pas utilisé pour d'autre souscription"><i class="fa fa-info-circle"></i></span></label>
                                    <div class="input-group">
                                        <input type="text" id="telephone_promoteur" name="telephone_promoteur" class="form-control masked_phone"  data-inputmask='"mask": "(999) 999-9999"' value="{{old('telephone_promoteur')}}" placeholder="Votre numéro de télephone" required="Ce champ est obligatoire" onchange="controler_de_doublon_promotrice('telephone_promoteur')">
                                    </div>
                                    @if ($errors->has('telephone_promoteur'))
                                    <center>
                                         <span class="help-block text-danger">
                                             <strong>Un promoteur a déja été enregistré avec ce numéro de telephone</strong>
                                     </span>
                                    </center>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="val_username">Mobile (WhatsApp préciser avec indicatif)<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="mobile_promoteur" name="mobile_promoteur" value="{{old('mobile_promoteur')}}" class="form-control" placeholder="Votre numéro de télephone WhatsApp" onchange="controler_de_doublon_promotrice('mobile_promoteur')" required >
                                    </div>
                            </div>
                            
                        </div>

                        <div class="offset-md-1 col-lg-5">
                            <div class="form-group">
                                <label class=" control-label" for="val_email">Entrer le numéro d'un proche<span class="text-danger">*</span><span data-toggle="tooltip" title="Entrer le numéro de téléphone d'un proche "><i class="fa fa-info-circle"></i></span></label>
                                    <div class="input-group">
                                        <input type="text" id="numero_de_proche" name="numero_du_proche" class="form-control masked_phone" placeholder="Votre numéro de télephone d'un proche"  value="{{old('numero_du_proche')}}"  required="Ce champ est obligatoire" >
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="val_email">Email <span class="text-danger">*</span><span data-toggle="tooltip" title="Cet adresse sera utilisé pour les notifications sur votre dossier par email "><i class="fa fa-info-circle"></i></span></label>
                                    <div class="input-group">
                                        <input type="email" id="email_promoteur" name="email_promoteur" class="form-control" value="{{old('email_promoteur')}}" placeholder="test@example.com" required="Ce champ est obligatoire" onchange="controler_de_doublon_promotrice('email_promoteur')" >
                                    </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            <div class="row">
                <fieldset>
                           <legend>Lieu de Residence</legend>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Region<span class="text-danger">*</span></label>
                                    <select id="region_residence" name="region_residence"  value="{{old("region_promoteur")}}" onchange="changeValue('region_residence', 'province_residence', {{ env('PARAMETRE_ID_PROVINCE') }});" class="select-select2" data-placeholder="Selectionnez votre région de residence .." style="width: 100%;" required>
                                        <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        @foreach ($regions as $region )
                                                <option value="{{ $region->id  }}" {{ old('region_residence') == $region->id ? 'selected' : '' }}>{{ $region->libelle }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Province<span class="text-danger">*</span></label>
                                    <select id="province_residence" name="province_residence" class="select-select2"  onchange="changeValue('province_residence', 'commune_residence', {{ env('PARAMETRE_ID_COMMUNE') }});" data-placeholder="Selectionnez votre province de residence .." style="width: 100%" required>
                                        <option  value="{{ old('province_residence') }}" {{ old('province_residence') == old('province_residence') ? 'selected' : '' }}>{{ getlibelle(old('province_residence')) }}</option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    </select>
                            </div>
                        </div>
                           <div class="offset-md-1 col-lg-5">
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Commune/Ville<span class="text-danger">*</span></label>
                                    <select id="commune_residence" name="commune_residence"  class="select-select2" value="{{old("commune_residence")}}" data-placeholder="Selectionnez votre commune de residence .." onchange="changeValue('commune_residence', 'arrondissement_residence', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" style="width: 100%;" required>
                                        <option value="{{ old('commune_residence') }}" {{ old('commune_residence') == old('commune_residence') ? 'selected' : '' }}>{{ getlibelle(old('commune_residence')) }}</option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="arrondissement_resident">Secteur/Village<span class="text-danger">*</span></label>
                                    <select id="arrondissement_residence" class="select-select2" value="{{old("arrondissement_residence")}}" name="arrondissement_residence"  data-placeholder="Selectionnez votre village ou secteur de residence .." onchange="changeValue('arrondissement_residence', 'secteur_residence', {{ env('PARAMETRE_ID_SECTEUR') }});" style="width: 100%;" required>
                                        <option value="{{ old('arrondissement_residence') }}" {{ old('arrondissement_residence') == old('arrondissement_residence') ? 'selected' : '' }}>{{ getlibelle(old('arrondissement_residence')) }}</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Situation de résidence<span class="text-danger">*</span></label>
                                    <select id="example-chosen" name="situation_residence" class="select-select2" value="{{old("situation_residence")}}"  data-placeholder="Quelle est votre situation de residence .." style="width: 100%;" required>
                                        <option></option>
                                        <option value="1" {{ old('situation_residence') == 1 ? 'selected' : '' }}>Resident</option>
                                        <option value="2" {{ old('situation_residence') == 2 ? 'selected' : '' }}>Déplacé</option>
                                    </select>
                            </div>
                           </div>
                </fieldset>
                </div>
                <fieldset>
                    <legend>Compétences du promoteur</legend>
                <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=" control-label" for="example-chosen">Niveau d’instruction<span class="text-danger">*</span></label>
                                       <select id="niveau_instruction" name="niveau_instruction" class="select-select2" data-placeholder="Quel est votre niveau d'instruction.."  style="width: 100%;" onchange="afficherautre('niveau_instruction',  {{ env('VALEUR_ID_AUTRE_NIVEAU_INSTRUCTION') }} ,'autre_niveau_instruction');" required>
                                           <option></option>
                                           @foreach ($niveau_instructions as $niveau_instruction )
                                                <option value="{{ $niveau_instruction->id  }}" {{ old('niveau_instruction') == $niveau_instruction->id ? 'selected' : '' }}>{{ $niveau_instruction->libelle }}</option>
                                           @endforeach
                                       </select>
                               </div>
                               <div class="form-group">
                                <label class=" control-label" for="">Préciser le domaine d’étude <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="domaine_detude" name="domaine_detude" value="{{old('domaine_detude')}}" class="form-control" placeholder="Préciser le domaine d’étude"  required>
                                </div>
                                @if ($errors->has('domaine_detude'))
                                    <span class="help-block text-danger">
                                         <strong></strong>
                                    </span>
                                @endif
                            </div>
                                <div class="form-group">
                                    <label class=" control-label" for="example-chosen">Formation (s) en rapport avec l’activité<span class="text-danger">*</span><span data-toggle="tooltip" title="Comment vous vous êtes formé sur l'activité que vous menez comme activité de l'entreprise "><i class="fa fa-info-circle"></i></span></label>
                                        <select id="formation_activite" name="formation_activite" class="select-select2" data-placeholder="Le mode de formation en relation avec l'activite" style="width: 100%;" required onchange="afficherautre('formation_activite',  2 ,'domaine_formation');">
                                            <option></option>
                                            <option value="1" {{ old('formation_activite') == 1 ? 'selected' : '' }}>Apprentissage sur le tas</option>
                                            <option value="2" {{ old('formation_activite') == 2 ? 'selected' : '' }}>Formation Technique</option>
                                            <option value="3" {{ old('formation_activite') == 3 ? 'selected' : '' }}>Stage</option> 
                                        </select>
                                </div>
                                <div class="form-group" id="domaine_formation">
                                    <label class="control-label" for="">Précisez le domaine ou thème</label>
                                    <div class="input-group">
                                        <input type="text"  name="domaine_formation" class="form-control" data-placeholder=""="Précisez le domaine de formation " value="{{old("domaine_formation")}}" >
                                        <span class="input-group-addon"><i class="gi gi-learning"></i></span>
                                    </div>
                                </div>
                                
                          </div>
                        <div class="offset-md-1 col-md-5">
                                
                                {{-- <div class="form-group">
                                    <label class=" control-label" for="example-chosen">Nombre d’années d’expérience dans le domaine d’activité <span class="text-danger">*</span></label>
                                           <select id="nbre_dannee_experience" name="nombre_annee_experience" class="select-select2" data-placeholder="Quel est votre niveau d'instruction.."  style="width: 100%;"  required>
                                               <option></option>
                                               @foreach ($nbre_dannee_experiences as $nbre_dannee_experience )
                                                    <option value="{{ $nbre_dannee_experience->id  }}" {{ old('nombre_annee_experience') == $nbre_dannee_experience->id ? 'selected' : '' }}>{{ $nbre_dannee_experience->libelle }}</option>
                                               @endforeach
                                           </select>
                                </div> --}}
                                <div class="form-group">
                                    <label class=" control-label" for="example-chosen">Situation profssionnelle actuelle<span class="text-danger">*</span></label>
                                        <select id="situation_professionnelle" name="situation_professionnelle"  value="{{old("situation_profession")}}"  class="select-select2" data-placeholder="Selectionnez une situation professionelle .." style="width: 100%;" required>
                                            <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                            @foreach ($occupation_professionnelle_actuelles as $situation_professionnelle )
                                                    <option value="{{ $situation_professionnelle->id  }}" {{ old('situation_professionnelle') == $situation_professionnelle->id ? 'selected' : '' }}>{{ $situation_professionnelle->libelle }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="arrondissement_resident">Membre d'une association?<span class="text-danger">*</span><span data-toggle="tooltip" title="Etes-vous membre d’une association ou d’une organisation professionnelle? "><i class="fa fa-info-circle"></i></span></label>
                                            <select id="membre_ass" class="select-select2" name="membre_ass"  data-placeholder="Ou d'une organisation professionnel" onchange="afficher_citer_association();" style="width: 100%;" required>
                                                <option></option>
                                                <option value="1" {{ old('membre_ass') == 1 ? 'selected' : '' }}>Oui</option>
                                                <option value="2" {{ old('membre_ass') == 2 ? 'selected' : '' }}>Non</option>
                                            </select>
                                    </div>
                                <div class="form-group associations">
                                    <label class=" control-label" for="example-textarea-input">Citer les associations <span data-toggle="tooltip" title="Citer les associations dont vous êtes membre "><i class="fa fa-info-circle"></i></span></label>
                                        <textarea id="associations" name="associations" rows="9" class="form-control" placeholder="citer les associations..">{{old('associations') }}</textarea>
                                </div>   
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="offset-md-1 col-md-10">
                        <div class="form-group">
                            <label class="col-md-5 control-label"><a href="#modal-terms" data-toggle="modal" style="color: #d9534f; font-size:17px;">Cliquer ici pour lire et accepter les conditions</a> <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <label class="switch switch-primary" for="val_terms">
                                    <input type="checkbox" id="val_terms" name="val_terms" value="1" onclick="validerterme()">
                                    <span data-toggle="tooltip" title="Lire et accepter les conditions! Pour lire les conditions cliquer sur le lien<.Vous devez accepter avant de pouvoir enregister les données"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        </fieldset>
      </div>
    <div class="step-footer">
    <center><button class="btn btn-danger btn-submit" type="reset">Annuler</button>
        <button class="btn btn-success btn-submit" id="valider" type="submit">Valider</button></center>
    
    </div>
    </form>
  </div>

@endsection