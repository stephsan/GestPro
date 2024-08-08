@extends('./layouts/base')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Souscription</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Souscription</li>
                <li class="breadcrumb-item active text-dark">Visuliser</li>
            </ol>
        </nav>
        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-evaluer-avant-projet" data-toggle="modal"  data-toggle="tooltip" title="Evaluer l'avant projet" class="text-white"><i class="bi bi-plus-square"></i> Evaluer l'avant projet</a>
            </button>
        </nav>
    </div>
<section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                            <div class="card card-success card-tabs">
                              <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Informations sur le Promoteur</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Informations sur le projet</a>
                                  </li>
                                  {{-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-chiffre-tab" data-toggle="pill" href="#custom-tabs-one-chiffre" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Previsions chiffrées</a>
                                  </li> --}}
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Les Piece jointes</a>
                                  </li>
                                 
                                  <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Les Decisions</a>
                                  </li>
                                </ul>
                              </div>
                              <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent" >
                                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab" >
                                     <div class="row">
                                        <center><p class="titre-show">Identite du promoteur</p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Code Promoteur : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->code_promoteur)
                                                        Informations non disponible
                                                    @endempty
                                                    {{$preprojet->promoteur->code_promoteur}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Nom du promoteur : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->nom)
                                                        Informations non disponible
                                                    @endempty
                                                    {{$preprojet->promoteur->nom}} {{$preprojet->promoteur->prenom}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Date de naissance : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->datenais)
                                                        Informations non disponible
                                                    @endempty
                                                    {{ format_date($preprojet->promoteur->datenais)}}

                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Sexe: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->genre)
                                                        Informations non disponible
                                                    @endempty
                                                    @if($preprojet->promoteur->genre==1)
                                                        Masulin
                                                    @else
                                                        Feminin
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           
                                                <div  class="form-group ">
                                                    <span class="col-md-5 control-label labdetail"> <span class="labdetail">Type de document d'identité : </span> </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                        @empty($preprojet->promoteur->type_identite)
                                                            Informations non disponible
                                                        @endempty
                                                        @if($preprojet->promoteur->type_identite=1)
                                                            CNIB
                                                        @else
                                                            PASSEPORT
                                                        @endif
                                                    </span>
                                                </span>
                                                </div>
                                            
                                           
                                                <div  class="form-group ">
                                                    <span class="col-md-5 control-label labdetail"> <span class="labdetail">Numero d'identité : </span> </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                        @empty($preprojet->promoteur->numero_identite)
                                                            Informations non disponible
                                                        @endempty
                                                            {{  $preprojet->promoteur->numero_identite }}
                                                    </span>
                                                </span>
                                                </div>
                                           
                                        
                                                <div  class="form-group ">
                                                    <span class="col-md-5 control-label labdetail"> <span class="labdetail">Date d'entablissement : </span> </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                        @empty($preprojet->promoteur->date_etabli_identite)
                                                            Informations non disponible
                                                        @endempty
                                                            {{ format_date($preprojet->promoteur->date_etabli_identite)}}
                                                    </span>
                                                </span>
                                                </div>
                                           
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Lieu de residence</p></center>
                                        <div class="col-md-6">
                                            
                                                <div  class="form-group ">
                                                    <span class="col-md-5 control-label labdetail"> <span class="labdetail">Region: </span> </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                        @empty($preprojet->promoteur->region_residence)
                                                            Informations non disponible
                                                        @endempty
                                                            {{ getlibelle($preprojet->promoteur->region_residence)}}
                                                    </span>
                                                </span>
                                                </div>
                                                <div  class="form-group ">
                                                    <span class="col-md-5 control-label labdetail"> <span class="labdetail">Province: </span> </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                        @empty($preprojet->promoteur->province_residence)
                                                            Informations non disponible
                                                        @endempty
                                                            {{ getlibelle($preprojet->promoteur->province_residence)}}
                                                    </span>
                                                </span>
                                                </div>
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Commune: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->commune_residence)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->promoteur->commune_residence)}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Secteur/village: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->arrondissement_residence)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->promoteur->arrondissement_residence)}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Contacts</p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Email: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->email_promoteur)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ $preprojet->promoteur->email_promoteur}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Telephone promoteur: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->telephone_promoteur)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ $preprojet->promoteur->telephone_promoteur}} / {{ $preprojet->promoteur->mobile_promoteur}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Telephone d'un proche du promoteur: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->numero_du_proche)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ $preprojet->promoteur->numero_du_proche}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Compétences du promoteur</p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Niveau d'instruction: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->niveau_instruction)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->promoteur->niveau_instruction)}}
                                                        @if($preprojet->promoteur->domaine_detude)
                                                            en {{ $preprojet->promoteur->domaine_detude }}
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Membre d'associations: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->membre_ass)
                                                        Informations non disponible
                                                        @endempty
                                                    @if($preprojet->promoteur->membre_ass==1)
                                                                Oui à {{ $preprojet->promoteur->associations }}
                                                        @else
                                                            Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Formation en rapport avec l'activité: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @if($preprojet->promoteur->formation_en_rapport_avec_activite==1)
                                                    Apprentissage sur le tas
                                                    @elseif($preprojet->promoteur->formation_en_rapport_avec_activite==2)
                                                                Formation Formelle dans le domaine/thème : {{ $preprojet->promoteur->domaine_formation }}
                                                    @else
                                                        Autre
                                                    @endif
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Situation profession actuelle: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->promoteur->occupation_professionnelle_actuelle)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->promoteur->occupation_professionnelle_actuelle)}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <center><p class="titre-show">Identification du projet</p></center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Numero du dossier :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->num_projet)
                                                            Informations non disponible
                                                        @endempty
                                                      {{ $preprojet->num_projet }}
                                                </span></span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Titre du projet : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->titre_projet)
                                                        Informations non disponible
                                                    @endempty
                                                    {{$preprojet->titre_projet}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Secteur d'activité : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->secteur_dactivite)
                                                        Informations non disponible
                                                    @endempty
                                                    {{getlibelle($preprojet->secteur_dactivite)}} 
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Maillon d'activité : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->maillon_dactivite)
                                                        Informations non disponible
                                                    @endempty
                                                    {{ getlibelle($preprojet->maillon_dactivite)}}
                                                </span>
                                            </span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Les innovations de votre projet:  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail">
                                                    @foreach ($projet_innovations as $preprojet->projet_innovation)
                                                        {{ getlibelle($preprojet->projet_innovation->valeur_id) }},
                                                    @endforeach
                                                       
                                                </span></span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Forme juridique envisagée : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->forme_juridique_envisage)
                                                        Informations non disponible
                                                    @endempty
                                                    {{ getlibelle($preprojet->forme_juridique_envisage)}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Description du projet :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->description)
                                                            Informations non disponible
                                                        @endempty
                                                      {{ $preprojet->description }}
                                                </span></span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Objectifs du projet :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->objectifs)
                                                            Informations non disponible
                                                        @endempty
                                                    {{ $preprojet->objectifs }}
                                                </span></span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Description de l'innovation du projet :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->innovation_details)
                                                            Informations non disponible
                                                        @endempty
                                                        {{ $preprojet->innovation_details }}
                                                </span></span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Disponibilite du site :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->site_disponible)
                                                            Informations non disponible
                                                        @endempty
                                                        @if($preprojet->site_disponible==1)
                                                            Oui le site disponible. 
                                                            @if($preprojet->type_site==1)
                                                                c'est un domaine personnel
                                                            @else
                                                                Je suis en location
                                                            @endif
                                                        @else
                                                            Non je dispose pas de site 
                                                        @endif
                                                </span></span>
                                            </div>
                                        </div>
                                     </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            
                                            
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Nombre d’emplois prévisionnels qui sera créé :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->description)
                                                            Informations non disponible
                                                        @endempty
                                                      {{ getlibelle($preprojet->emploi_previsionnel) }}
                                                </span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Les sources d'approvisionnement en intrant  :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                   @foreach ($source_appros as $sources_dapprovisionnement )
                                                        {{ getlibelle($sources_dapprovisionnement->valeur_id) }},
                                                   @endforeach
                                                </span></span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Origine de la clientèle visée du projet :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->origine_clientele)
                                                            Informations non disponible
                                                        @endempty
                                                      {{ getlibelle($preprojet->origine_clientele) }}
                                                </span></span>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Chiffre d'affaire estimatif  :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                    @empty($preprojet->chiffre_daffaire_previsionnel)
                                                            Informations non disponible
                                                        @endempty
                                                      {{ getlibelle($preprojet->chiffre_daffaire_previsionnel) }}
                                                </span></span>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Les besoins en formations </p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Déja Participer a une formation e entrepreneuriat?: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->deja_suivi_une_formation)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->deja_suivi_une_formation==1)
                                                            Oui
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                            @if($preprojet->deja_suivi_une_formation==1)
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Les formations en entreprenariat deja effectuées :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                   @foreach ($formations_effectuees as $formations_effectuee )
                                                        {{ getlibelle($formations_effectuee->valeur_id) }},
                                                   @endforeach
                                                </span></span>
                                            </div>
                                        @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span class="col-md-5 control-label labdetail">Les besoins en renforcement des capacités souhaités :  </span>
                                                    <span class="col-md-6" >
                                                    <span class="valdetail" style="text-justify: auto;">
                                                   @foreach ($formations_souhaites as $formations_souhaite )
                                                        {{ getlibelle($formations_souhaite->valeur_id) }},
                                                   @endforeach
                                                </span></span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Autres besoins en formation souhaitée: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->autre_besoin_en_formation)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ $preprojet->autre_besoin_en_formation}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Zone d’installation du projet </p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Region: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->region)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->region)}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Province: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->province)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->province)}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Commune: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->commune)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->commune)}}
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Secteur/village: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->secteur_village)
                                                        Informations non disponible
                                                    @endempty
                                                        {{ getlibelle($preprojet->secteur_village)}}
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <center><p class="titre-show">Niveau de maturité du projet </p></center>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Etude de faisabilité réalisée: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->etude_technique_de_faisabilite)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->etude_technique_de_faisabilite==1)
                                                            Oui
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Prototype ou d’une preuve de conception disponible: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->prototype_existe)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->prototype_existe==1)
                                                            Oui
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Etude de faisabilité réalisée: </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->etude_de_marche)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->etude_de_marche==1)
                                                            Oui
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Démarches pour les recherches de financement réalisé : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->prototype_existe)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->prototype_existe==1)
                                                            Oui
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                            <div  class="form-group ">
                                                <span class="col-md-5 control-label labdetail"> <span class="labdetail">Un agrément ou une autorisation est-il exigé  : </span> </span>
                                                <span class="col-md-6" >
                                                <span class="valdetail">
                                                    @empty($preprojet->aggrement_exige)
                                                        Informations non disponible
                                                    @endempty
                                                        @if($preprojet->aggrement_exige==1)
                                                            Oui {{ $preprojet->precise_aggrement }}
                                                        @else
                                                             Non
                                                        @endif
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                    <h1 class="labdetail">Pièces jointes</h1>
                                    <table class="table table-vcenter table-condensed table-bordered listepdf valdetail"   >
                                            <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Type</th>
                                                        <th>Actions</th>
                                                    </tr>
                                              </thead>
                                              <tbody id="tbadys">
                                        @foreach($piecejointes as $key => $piecejointe)
                                        <tr>
                                                <td>
                                                {{ $key + 1 }}
                                                </td>
                                                     <td>
                                                        {{getlibelle($piecejointe->type_piece)}}
                                                    </td>
                                        <td>
                                            <a href="{{ route('telechargerpiecejointe',$piecejointe->id)}}"title="télécharger" class="btn btn-xs btn-default"  target="_blank"><i class="fa fa-download"></i> </a>
                                            <a href="{{ route('detaildocument',$piecejointe->id)}}"title="Visualiser le document" class="btn btn-xs btn-default" ><i class="fa fa-eye"></i> </a>
                                        </td>

                                    </tr>
                                @endforeach
                             </tbody>
                            </table>
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-chiffre" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <center><p class="titre-show">Chiffre d'affaire previsionnel </p></center>
                                            <table class="table table-condensed table-bordered" style="text-align: center">
                                            <thead style="text-align: center !important">
                                                    <tr>
                                                        <th style="text-align: center; width:5%">Annee</th>
                                                        <th style="text-align: center; width:5%">Montant</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tbadys">
                                        @foreach($chiffre_daffaires as $key => $chiffre_daffaire)
                                        <tr>
                                                    <td>
                                                        {{getlibelle($chiffre_daffaire->annee)}}
                                                    </td>
                                                    <td>
                                                        {{format_prix($chiffre_daffaire->quantite)}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 ">
                                        <center><p class="titre-show">Nombre de client envisagés </p></center>
                                        <table class="table table-condensed table-bordered" style="text-align: center">
                                        <thead style="text-align: center !important">
                                                <tr>
                                                    <th style="text-align: center; width:5%">Annee</th>
                                                    <th style="text-align: center; width:5%">Montant</th>
                                                </tr>
                                        </thead>
                                        <tbody id="tbadys">
                                    @foreach($chiffre_daffaires as $key => $chiffre_daffaire)
                                    <tr>
                                                <td>
                                                    {{getlibelle($chiffre_daffaire->annee)}}
                                                </td>
                                                <td>
                                                    {{format_prix($chiffre_daffaire->quantite)}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <center><p class="titre-show">Effectifs Permanent previsionel</p></center>
                                    <table class="table table-condensed table-bordered" style="text-align: center">
                                    <thead style="text-align: center !important">
                                            <tr>
                
                                                <th style="text-align: center; width:5%">Annee</th>
                                                <th style="text-align: center; width:5%">Homme</th>
                                                <th style="text-align: center; width:5%">Femme</th>
                                                <th style="text-align: center; width:5%">Total</th>
                                            </tr>
                                      </thead>
                                      <tbody id="tbadys">
                                @foreach($effectif_permanent_previsionels as $key => $effectif_permanent_previsionel)
                                <tr>
                
                                             <td>
                                                {{getlibelle($effectif_permanent_previsionel->annee)}}
                                            </td>
                                            <td>
                                                {{$effectif_permanent_previsionel->homme}}
                                            </td>
                                            <td>
                                                {{$effectif_permanent_previsionel->femme}}
                                            </td>
                                            <td>
                                                {{$effectif_permanent_previsionel->femme + $effectif_permanent_previsionel->homme }}
                                            </td>
                
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <center><p class="titre-show">Effectifs Temporaire previsionnel </p></center>
                                    <table class="table table-condensed table-bordered" style="text-align: center">
                                    <thead style="text-align: center !important">
                                            <tr>
                
                                                <th style="text-align: center; width:5%">Annee</th>
                                                <th style="text-align: center; width:5%">Homme</th>
                                                <th style="text-align: center; width:5%">Femme</th>
                                                <th style="text-align: center; width:5%">Total</th>
                                            </tr>
                                      </thead>
                                      <tbody id="tbadys">
                                @foreach($effectif_temporaire_previsionels as $key => $effectif_temporaire_previsionel)
                                <tr>
                
                                             <td>
                                                {{getlibelle($effectif_temporaire_previsionel->annee)}}
                                            </td>
                                            <td>
                                                {{$effectif_temporaire_previsionel->homme}}
                                            </td>
                                            <td>
                                                {{$effectif_temporaire_previsionel->femme}}
                                            </td>
                                            <td>
                                                {{$effectif_temporaire_previsionel->femme + $effectif_temporaire_previsionel->homme }}
                                            </td>
                
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div> 
                                
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    @foreach ($evaluations as $evaluation )
                                                        <div class="row">
                                                            <div  id="condanation" class="form-group row">
                                                                <p class="col-md-7 control-label labdetail"><span class="">{{ $evaluation->critere->libelle }} : </span> </p>
                                                                    <p class="col-md-5" >
                                                                    <span class="valdetail">
                                                                    @empty($evaluation->note)
                                                                    0/{{ $evaluation->critere->ponderation }}
                                                                @else
                                                                        {{$evaluation->note}}/{{ $evaluation->critere->ponderation }}
                                                                    @endempty
                                                                </span></p>
                                                            </div>
                                                        </div>
                                                        
                                                    @endforeach
                                                    <div class="row">
                                                        <div  id="condanation" class="form-group row">
                                                            <p class="col-md-7 control-label labdetail"><span class="">Total : </span> </p>
                                                                <p class="col-md-5" >
                                                                <span class="valdetail">
                                                                @empty($preprojet->note_totale)
                                                            @else
                                                               {{ $preprojet->note_totale }}
                                                             @endempty
                                                            </span></p>
                                                        </div>
                                                    </div>
                                                  
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                 </div>
                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
                         
            
        </div>
</section>
@endsection
@section('modal_part')

<div id="modal-evaluer-avant-projet" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Evaluer l'avant projet</h2>
            </div>
            <div class="modal-body">
            <form method="post"  action="{{ route('preprojet.evaluation') }}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="avant_projet" id="" value="{{ $preprojet->id }}">
                {{-- <div class="form-group{{ $errors->has('grille_devaluation') ? ' has-error' : '' }}">
                    <label class="control-label col-md-4" for="grille_devaluation">Joindre la grille d'évaluation <span class="text-danger">*</span></label>
                    <div class="input-group col-md-6">
                        <input class="form-control col-md-6" type="file" name="grille_devaluation" id="" accept=".pdf, .jpeg, .png"   placeholder="Charger la grille d'évaluation" required>
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                    </div>
                    @if ($errors->has('grille_devaluation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('grille_devaluation') }}</strong>
                        </span>
                        @endif
                </div> --}}
                <div class="row">
                    @foreach ($evaluations as $evaluation )
                    <div class="col-md-4" >
                        <div class="form-group row">
                            <label class="control-label" for="example-username">{{ $evaluation->critere->libelle}}  </label>
                                <input type="number" id="{{ $evaluation->id}}" name="{{ $evaluation->id}}" max='{{ $evaluation->note}}' min="0" class="form-control" value="{{ $evaluation->note }}" disabled>
                        </div>
                        @if ($errors->has('note'))
                        <span class="help-block">
                            <strong>{{ $errors->first('note') }}</strong>
                        </span>
                        @endif
                    </div>
                    @endforeach
                </div>
               <div class="row">
                @foreach ($criteres as $critere )
                <div class="col-md-4" >
                    <div class="form-group row">
                        <label class="control-label" for="example-username">{{ $critere->libelle}}  sur {{ $critere->ponderation}} </label>
                            <input type="number" id="{{ $critere->id}}" name="{{ $critere->id}}" max='{{ $critere->ponderation}}' min="0" class="form-control" placeholder="Evaluer ..." text="Valeur depassé" required onchange="isValid('{{ $critere->id}}')">
                    </div>
                    <p id='message_ponderation_depasse' style="background-color:red; display:none">La Note maximal pour ce critère est {{ $critere->ponderation}}</p>
                    @if ($errors->has('note'))
                    <span class="help-block">
                        <strong>{{ $errors->first('note') }}</strong>
                    </span>
                    @endif
                </div>  
            
                @endforeach
                </div> 
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a  type="button" class="btn btn-sm btn-danger" data-dismiss="modal"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success valider_evaluation" ><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
            </form>      
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
@endsection 
<script>
   function isValid(champ){
        
        var valeur= $('#'+champ).val();
        var max= $('#'+champ).attr('max');
        //alert(valeur)
         if(parseInt(valeur) > parseInt(max) ){
             //alert('ok');
             $('#message_ponderation_depasse').show();
             $('.valider_evaluation').prop('disabled', true)
         }
         else{
             $('#message_ponderation_depasse').hide();
             $('.valider_evaluation').prop('disabled', false)
         }
              
 }
    function changelistevale()
         {   var idparent_val = $("#parametre").val();
         var url = '{{ route('valeur.listeval') }}';
             $.ajax({
                     url: url,
                     type: 'GET',
                     data: {idparent_val: idparent_val},
                     dataType: 'json',
                     error:function(data){alert("Erreur");},
                     success: function (data) {


                         var options = '';

                         for (var x = 1; x < data.length; x++) {
                             var rout= '{{ route("valeurs.edit",":id")}}';
                             var rout = rout.replace(':id', data[x]['id']);
                             options +='<tr> <td  width="5%" > ' + x + '</td><td width="20%" > ' + data[x]['libelle'] + '</td><td  width="40%"> ' + data[x]['description'] + '  </td> <td  width="15%"><div class="btn-group"><a  onclick="detailvaleur(' + data[x]['id'] + ' );" href="#modal-voir-detail" data-toggle="modal" title="Voir details" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a><a href="'+rout+'" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a><a href="#modal-confirm-delete" onclick="delConfirm(' + data[x]['id'] + ');" data-toggle="modal" title="Supprimer" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></div></td></tr>';
                              }
                        $('#tbadys').html(options);
                     }
             });
         }
    </script>

