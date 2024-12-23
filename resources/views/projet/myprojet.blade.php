@extends('./layouts/beneficiary_page')
@section('title')
@endsection
@section('css')
@endsection
@section('project', 'active')
@section('content')

    <section class="section">
       
       
        <div class="row">
            <center>
                <h3 >
                    Informations sur le projet soumis
                </h3>
            </center>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body"style="margin-top:20px;">
                        <div class="row">
                        <div class="col-md-5">
                            <div  id="condanation" class="form-group row">
                                <p class="col-md-4 control-label labdetail"><span class="">Guichet choisi: </span> </p>
                                    <p class="col-md-8" >
                                    <span class="valdetail">
                                    @empty($projet->preprojet->guichet)
                                                        Informations non disponible
                                                        @endempty
                                         {{getlibelle($projet->preprojet->guichet)}}
                                </span></p>
                            </div>
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Titre du projet: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->titre_du_projet)
                                                      Informations non disponible
                                                      @endempty
                                       {{$projet->titre_du_projet}}
                              </span></p>
                          </div>
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Montant du projet: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->titre_du_projet)
                                                      Informations non disponible
                                                    @endempty
                                      {{ format_prix($projet->investissements->sum('montant')) }}
                              </span></p>
                          </div> 
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Subvention demandée: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->titre_du_projet)
                                                      Informations non disponible
                                                      @endempty
                                      {{ format_prix($projet->investissements->sum('subvention_demandee')) }}
                              </span></p>
                          </div> 
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Contrepartie à mobiliser: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->titre_du_projet)
                                                      Informations non disponible
                                                      @endempty
                                      {{ format_prix($projet->investissements->sum('apport_perso')) }}
                              </span></p>
                          </div> 
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"  style="text-align: justify;"><span class="">Objectifs du projet: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->objectifs)
                                                      Informations non disponible
                                                      @endempty
                                       {{$projet->objectifs}}
                              </span></p>
                          </div>
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"  style="text-align: justify;"><span class="">Activité Ménée: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->activites_menees)
                                                      Informations non disponible
                                                      @endempty
                                       {{$projet->activites_menees}}
                              </span></p>
                          </div>
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Mes Atouts: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->atouts_promoteur)
                                                      Informations non disponible
                                                      @endempty
                                       {{$projet->atouts_promoteur}}
                              </span></p>
                          </div>
                          <div  id="condanation" class="form-group row">
                              <p class="col-md-4 control-label labdetail"><span class="">Innovations: </span> </p>
                                  <p class="col-md-8" >
                                  <span class="valdetail">
                                  @empty($projet->innovation)
                                                      Informations non disponible
                                                      @endempty
                                       {{$projet->innovation}}
                              </span></p>
                          </div>
                          @if ($projet->statut == 'soumis')
                              <a href="#modal-pca-update" data-toggle="modal" onclick="edit_pca({{ $projet->id }})"  class="btn btn-success btn-lg ">Modifier le PCA </a>
                          @endif
                        </div>
                        <!-- /col-md-6 -->
                      <div class="col-md-7 detailed">
                              <h4>Plan d'investissement Soumis @if ($projet->statut!= 'selectionné')<span><a href="#modal-add-invest" data-toggle="modal" onclick="recupererprojet_id({{ $projet->id }})"><i class="fa fa-plus"></i></a></span> @endif</h4> 
                              <table class="table table-condensed table-bordered" style="text-align: center">
                              <thead style="text-align: center !important">
                                      <tr>
                                          <th style="text-align: center; width:5%">Designation</th>
                                          <th style="text-align: center; width:5%">Montant Soumis</th>
                                          <th style="text-align: center; width:5%">Apport Personnel Soumis</th>
                                          <th style="text-align: center; width:5%">Subvention Soumis</th>
                                          
                                      </tr>
                              </thead>
                              <tbody id="tbadys">
                          @foreach($projet->investissements as $investissment)
                              <tr >
                                  @if ($projet->statut!='selectionné')
                                      <td>
                                          <a href="#modal-modif-invest" data-toggle="modal"  onclick="edit_investissement({{ $investissment->id }});" >{{getlibelle($investissment->designation)}}</a>
                                      </td>
                                  @else
                                  <td>
                                      {{getlibelle($investissment->designation)}}
                                  </td>
                                  @endif
                                  <td>
                                      {{format_prix($investissment->montant)}}
                                  </td>
                                  <td>
                                      {{format_prix($investissment->apport_perso)}}
                                  </td>
                                  <td>
                                      {{format_prix($investissment->subvention_demandee)}}
                                  </td>
          
                              </tr>
                              @endforeach
                          </tbody>
                          </table>
          
                  @if ($projet->statut=='selectionné')
                  <h4>Plan d'investissement validé</h4>
                  <table class="table table-condensed table-bordered" style="text-align: center">
                  <thead style="text-align: center !important">
                          <tr>
                              <th style="text-align: center; width:5%">Designation</th>
                              <th style="text-align: center; width:5%">Montant</th>
                              <th style="text-align: center; width:5%">Apport Personnel validé</th>
                              <th style="text-align: center; width:5%">Subvention validée</th>
                              
                          </tr>
                  </thead>
                  <tbody id="tbadys">
                  @foreach($projet->investissements as $investissment)
                  <tr >
                      @if ($projet->statut!='selectionné')
                          <td>
                              <a href="#modal-modif-invest" data-toggle="modal"  onclick="edit_investissement({{ $investissment->id }});" >{{getlibelle($investissment->designation)}}</a>
                          </td>
                      @else
          
                      <td>
                          {{getlibelle($investissment->designation)}}
                      </td>
                      @endif
                      <td>
                          {{format_prix($investissment->montant_valide)}}
                      </td>
                      <td>
                          {{format_prix($investissment->apport_perso_valide)}}
                      </td>
                      <td>
                          {{format_prix($investissment->subvention_demandee_valide)}}
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
              @endif
                  @if($projet_piecejointes)
                          <div class="row">
                              <div class="col-md-11">
                                  <div class="block">
                                  <div class="block-title">
                                   <h4> Documents du PCA  @if ($projet->statut == 'soumis')<span><a href="#modal-add-piece" data-toggle="modal" onclick="recupererprojet_id({{ $projet->id }})"><i class="fa fa-plus"></i></a></span>@endif</h4> 
                                </div>
                                  <div class="table-responsive">
                                      <table class="table table-vcenter table-condensed table-bordered listepdf valdetail"   > 
                                          <thead>
                                                  <tr>
                                                      <th>N°</th>
                                                      <th>Type</th>
                                                      <th>Actions</th>
                                                  </tr>
                                            </thead>
                                            <tbody id="tbadys">
                                      @foreach($projet_piecejointes as $key => $piecejointe)
                                      <tr>
                                              <td>
                                              {{ $key + 1 }}
                                              </td>
                                              @if ($projet->statut !='selectionné')
                                              <td>
                                                  <a href="#modal-modif-pj" data-toggle="modal"  onclick="edit_piecejointe({{ $piecejointe->id }});" > {{getlibelle($piecejointe->type_piece)}} </a>
                                              </td>
                                              @else
                                              <td>
                                                   {{getlibelle($piecejointe->type_piece)}} 
                                              </td>
                                              @endif
                                              
                                                  
                                      <td>
                                          <a href="{{ route('telechargerpiecejointe',$piecejointe->id)}}"title="télécharger" class="btn btn-xs btn-default"  target="_blank"><i class="fa fa-download"></i> </a>
                                          {{-- <a href="{{ route('detaildocument',$piecejointe->id)}}"title="Visualiser le document" class="btn btn-xs btn-default" ><i class="fa fa-eye"></i> </a> --}}
                                      </td>
                              
                                  </tr>
                              @endforeach
                              </tbody>
                              </table>
                                    </div>
                              </div>
                          </div>
                          </div>
                  @endif
                 
                         
                          
                      
                    
                    </div>
                        <!-- /col-md-6 -->
                      </div>  
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('modal_part')
<div id="modal-non-respect-code-de-financement" class="modal fade" aria-labelledby="alertModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="padding:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="gi gi-pen" ></i>Non respect du code de financement</h3>
            </div>
            <div id="alertMessage" class="alert alert-warning" role="alert">
                <!-- Dynamic message will be inserted here by JavaScript -->
            </div>
          <div class="modal-footer">
            <button type="button"class="btn btn-sm btn-danger" onclick="$('#modal-non-respect-code-de-financement').modal('hide')" data-dismiss="modal">Fermer</button>
          </div>
            </div>
            
        </div>
 </div>
 <div id="modal-pca-update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier le plan d'affaire</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('pca.modifier')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   
            <div class="row">
                <input type="hidden" id="pca_id" name="pca_id">
                <input type="hidden" name="guichet" id="guichet" value={{ $preprojet->guichet }}>
                <div class="form-group col-md-6">
                    <label class=" control-label" for="example-chosen">Selectionner le redacteur du PCA<span class="text-danger">*</span></label>
                        <select id="coach_u" name="coach"  value="{{old("coach")}}"  class="form-control" data-placeholder="Selectionner le coach ayant appuyer à l'elaboration du PCA .." style="width: 80%;" required>
                            <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                            @foreach ($coachs as $coach )
                                    <option value="{{ $coach->id  }}" {{ old('coach') == $coach->id ? 'selected' : '' }}>{{ $coach->nom }} {{ $coach->prenom }}</option>
                            @endforeach
                        </select>
                </div>
                
            </div>
            <div class="row">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-11" style="margin-left:0px;">
                    <label class="control-label" for="name">Titre du projet : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="titre_projet" type="text" class="form-control" name="titre_projet" placeholder="Cout de l'investissement" value="{{ old('cout') }}" required autofocus >
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('titre_projet'))
                        <span class="help-block">
                            <strong>{{ $errors->first('titre_projet') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5" style="margin-left:10px;">
                    <div class="form-group">
                        <label class=" control-label" for="example-bio">Objectifs du projet</label>
                            <textarea id="objectif_projet" name="objectifs" rows="5" maxlength="500" class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class=" control-label" for="example-email">Activités menées</label>
                        <textarea id="activite_menee" name="activite_menee" rows="5"  maxlength="500"  class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                    </div>
                </div>
                <div class="col-md-6" style="margin-left:10px;">
                    <div class="form-group">
                        <label class=" control-label" for="example-bio">Atouts du promoteur ou de l’entreprise</label>
                            <textarea id="atout_promo" name="atouts_entreprise" rows="5"  maxlength="500"  class="form-control" placeholder="De quels atouts que l’entreprise dispose pour conduire le projet (Qualification du personnel, expérience, niveau d’investissement disponible, surface financière, etc.) ? Quels sont ses forces ?  " required></textarea>
                        
                    </div>
                    <div class="form-group">
                        <label class=" control-label" for="example-email">Caractère innovant du projet (produit ou technologie)  </label>
                        <textarea id="caractere_innovant" name="innovations_apportes" rows="5" class="form-control"  maxlength="500"  placeholder="Qu’apportez-vous de nouveau avec ce projet ? En quoi est-il innovant ? " required></textarea>
                    </div>
                </div>
            </div>
                    
                <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <a href="" onclick="reload()" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-arrow-right"></i> Modifier</button>

                </div>
            </div>
            </form>
            </div>
            <!-- END Modal Body  modal-devis-edit -->
        </div>
    </div>
</div>
<div id="modal-modif-invest" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier une ligne d'investissement</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('investissement.modifier')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id='invest_id' name="invest_id" value="">
            <div class="row">
                <p style="color:brown; display:none;" class="message_respect_code_de_financement" >Code de financement non respecté</p>
                <div class="form-group col-md-3">
                    <label class="control-label" for="example-chosen">Catégorie<span class="text-danger">*</span></label>
                        <select id="categorie_invest" name="designation" class="form-control" onchange="afficher();" data-placeholder='' style="width: 100%;" required>
                            <option></option>
                           @foreach ($categorie_investissments as $categorie_investissment)
                            <option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id)}}</option>
                           @endforeach
                        </select>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Cout : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="cout" type="text" class="form-control" name="cout" placeholder="Cout de l'investissement" value="{{ old('cout') }}" required autofocus >
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cout') }}</strong>
                        </span>
                        @endif

                    </div>

                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Subvention demandée  : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="subvention" type="text" class="form-control" name="subvention" placeholder="Cout de l'investissement" value="{{ old('subvention') }}" required autofocus onChange="controle_code_investissement('subvention','apport_perso','cout')">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subvention') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Apport personnel : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="apport_perso" type="text" class="form-control" name="apport_perso" placeholder="Cout de l'investissement" value="{{ old('apport_perso') }}" required autofocus onChange="verifier_montant('montant','devi_id','facture_id_fictif')">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apport_perso') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>   
                <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" onclick="reload()" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-arrow-right"></i> Valider</button>

                </div>
            </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<div id="modal-add-invest" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Ajouter une nouvelle ligne d'investissement sur le premier appui</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('add.investissement')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id='projet_id_new_invest' name="projet_id" >
                    <input type="hidden" id='' name="appui" value=1 >

            <div class="row">
                <div class="form-group col-md-3" style="margin-left: 15px;">
                    <label class="control-label" for="example-chosen">Catégorie d'investissement<span class="text-danger">*</span></label>
                        <select id="categorie_invest_add" name="designation" class="form-control" onchange="afficher();" data-placeholder="formalisée?" style="width: 100%;" required>
                            <option></option>
                           @foreach ($categorie_investissments as $categorie_investissment)
                            <option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id)}}</option>
                           @endforeach
                        </select>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Cout : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="cout_add" type="text" class="form-control" name="cout" placeholder="Cout de l'investissement" value="{{ old('cout') }}" required autofocus >
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cout') }}</strong>
                        </span>
                        @endif

                    </div>

                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Subvention demandée  : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="subvention_add" type="text" class="form-control" name="subvention" placeholder="Cout de l'investissement" value="{{ old('subvention') }}" required autofocus onChange="deux_somme_complementaire('subvention_add','apport_perso_add','cout_add')">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subvention') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-3" style="margin-left:0px;">
                    <label class="control-label" for="name">Apport personnel : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="apport_perso_add" type="text" class="form-control" name="apport_perso" placeholder="Cout de l'investissement" value="{{ old('apport_perso') }}" required autofocus onChange="verifier_montant('montant','devi_id','facture_id_fictif')">
                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        @if ($errors->has('designation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apport_perso') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>   
                <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" onclick="reload()" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-arrow-right"></i> Valider</button>

                </div>
            </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<div id="modal-add-piece" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Ajouter une nouvelle pièce</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('add.piecetoprojet')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id='projet_id_add_piece' name="projet_id" >
            <div class="row">
                <div class="form-group col-md-4" style="margin-left: 15px;">
                    <label class="control-label" for="example-chosen">Type pièce<span class="text-danger">*</span></label>
                        <select id="type_piece" name="type_piece" class="form-control" data-placeholder="Selectionner le type de la pièce" style="width: 100%;" required>
                            <option></option>
                           @foreach ($projet_type_pieces as $projet_type_piece)
                            <option value="{{ $projet_type_piece->id}}">{{ getlibelle($projet_type_piece->id)}}</option>
                           @endforeach
                        </select>
                </div>  
                <div class="form-group{{ $errors->has('piece_file') ? ' has-error' : '' }} col-md-8" style="margin-left:10px;">
                    <label  class="control-label"  class="control-label" for="piece_file">Joindre la nouvelle piece jointe <span class="text-danger">*</span></label>
                    <div class="input-group col-md-8">
                        <input class="form-control docsize"  type="file" name="piece_file" id="piece_file" accept=".pdf, .jpeg, .png"   onchange="VerifyUploadSizeIsOK('piece_file');" placeholder="Charger la nouvelle piece" required>
                        <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('piece_file')">Vider le champ</a></span>
                    </div>
                    @if ($errors->has('piece_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('piece_file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>   
                <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" onclick="reload()" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-arrow-right"></i> Valider</button>

                </div>
            </div>
            </form>
            </div>
           
        </div>
    </div>
</div>
<div id="modal-modif-pj" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Changer de pièce jointe</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('piecejointe.modifier')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id='piece_id' name="piece_id" value="">
                    <input type="hidden" id='type_piece' name="type_piece" value="">
            <div class="row">
                <div class="form-group{{ $errors->has('piece_file') ? ' has-error' : '' }} col-md-10" style="margin-left:10px;">
                    <label  class="control-label col-md-4"  class="control-label" for="piece_file">Joindre la nouvelle piece jointe <span class="text-danger">*</span></label>
                    <div class="input-group col-md-6">
                        <input class="form-control docsize"  type="file" name="piece_file" id="piece_file_u" accept=".pdf, .jpeg, .png"   onchange="VerifyUploadSizeIsOK('piece_file_u');" placeholder="Charger la nouvelle piece">
                        <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('piece_file_u')">Vider le champ</a></span>
                    </div>
                    @if ($errors->has('piece_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('piece_file') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 
           
                <div class="form-group form-actions">
                <div class="col-md-8 col-md-offset-4">
                    <button type="button" onclick="reload()" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-arrow-right"></i> Valider</button>

                </div>
            </div>
            </form>
            </div>
        </div>   
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
   // alert('okok');
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    //var fieldHTML = '<div><label for="">Ligne dinvestissement:</label> <select  name="designation[]" data-placeholder="designation" > <option></option> @foreach ($categorie_investissments as  $categorie_investissment)<option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id) }}</option>@endforeach </select> <input type="number" name="cout[]"  placeholder="cout" min="1000" required/> <input type="number" name="subvention[]"  min="1000" placeholder="Subvention demandée"  required/> <input type="number" name="apport_perso[]"  min="1000" placeholder="Apport personne" required />   <a href="javascript:void(0);" class="remove_button"><span> <i class="fa fa-minus"></i></a></div>';
    //var fieldHTML2 = '<div><input type="text" name="field_name1[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html
    var x = 0; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
       // alert('add');
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            var desi="desi"+x;
            var cout='cout'+x ;
            var fieldHTML = '<br><div> <select class="col-md-2"  name="designation[]"  data-placeholder="designation" > <option></option> @foreach ($categorie_investissments as  $categorie_investissment)<option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id) }}</option>@endforeach </select> <input class="col-md-3" type="text" name="cout[]"  placeholder="cout"  id="' + cout + '"  required/> <input  class="col-md-3" type="text" name="subvention[]"  placeholder="Subvention demandée" id="sub' + x +'"  onChange=controle_code_investissement("sub' + x +'","apport' + x +'","' + cout + '")  required/> <input class="col-md-3" type="text" name="apport_perso[]"   placeholder="Apport personne" id="apport' + x +'"   required />   <a href="javascript:void(0);" class="remove_button"><span> <i class="fa fa-minus"></i></a></div>';
            $(wrapper2).append(fieldHTML);
           
        }
    });
   // alert($('#cout1').val());
    $('#cout1').change(function(){
alert("The text has been changed.");
}); 
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script>
    function controle_code_investissement(montant1, montant2, somme){
    var valmontant1= $("#"+montant1).val();
    var valmontant2= $("#"+montant2).val();
    var valsomme= $("#"+somme).val();
    var not_good=0;
    var taux_subvention= valmontant1/valsomme*100;
   // alert(taux_subvention);
    var guichet= $("#guichet").val();
    if(guichet=='7165'){
        if(taux_subvention>65 ){
            not_good=1;
        }
    }

    else if(guichet=='7166'){
        if(taux_subvention>50 ){
            not_good=1;
            
    }
    }
    else if(guichet=='7167'){
        if(taux_subvention>80 ){
            not_good=1;
    }
    }
    if(not_good==1){
      $('.message_respect_code_de_financement').show();
     //$('#modal-non-respect-code-de-financement').modal('show');
      $("#tester").prop('disabled', true);
      $("#"+montant1).val(' ');
      $("#"+somme).val(' ');
      $("#"+montant2).val(' ');
    }else{
        $("#tester").prop('disabled', false);
          var restant= valsomme - valmontant1;
          $("#"+montant2).val(restant);
          format_montant(montant2);
          format_montant(montant1);
          format_montant(somme);
    }
   
}    
    
 
  
</script>
<script>
    function recupererprojet_id(id_projet){
       document.getElementById("projet_id_new_invest").setAttribute("value", id_projet);
       document.getElementById("projet_id_new_invest2").setAttribute("value", id_projet);
       document.getElementById("projet_id_add_piece").setAttribute("value", id_projet);
       
}
</script>
<script>

function edit_investissement(id){
           var id=id;
           var url = "{{ route('investissement.modif') }}";
           $.ajax({
               url: url,
               type:'GET',
               dataType:'json',
               data: {id: id} ,
               error:function(){alert('error');},
               success:function(data){
                   $("#invest_id").val(data.id);
                   $("#categorie_invest").val(data.categorie);
                  $("#cout").val(data.cout);
                  $("#subvention").val(data.subvention);
                  $("#apport_perso").val(data.apport_perso);

               }
           });
   }
  
   function edit_piecejointe(id){
           var id=id;
           var url = "{{ route('piece.modif') }}";
           $.ajax({
               url: url,
               type:'GET',
               dataType:'json',
               data: {id: id} ,
               error:function(){alert('error');},
               success:function(data){
                   $("#piece_id").val(data.id);
                   $("#type_piece").val(data.type_piece);
                   

               }
           });
   }
   function edit_pca(id){
           var id=id;
           var url = "{{ route('pca.modif') }}";
           $.ajax({
               url: url,
               type:'GET',
               dataType:'json',
               data: {id: id} ,
               error:function(){alert('error');},
               success:function(data){

                   $("#pca_id").val(data.id);
                    $("#coach_u").val(data.coach_id);
                    $("#banque_choisi_u").val(data.banque_id);
                  $("#titre_projet").val(data.titre_du_projet);
                  $("#objectif_projet").val(data.objectifs);
                  $("#activite_menee").val(data.activites_menees);
                  $("#atout_promo").val(data.atout_promoteur);
                  $("#caractere_innovant").val(data.innovation)

               }
           });
   }
</script>
@endsection
    


