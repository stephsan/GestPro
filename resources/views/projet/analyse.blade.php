@extends('./layouts/base')
@section('title')
@section('fp_mpme_existante', 'show')
@section('mpme_existant', 'active')
@endsection
@section('css')
@endsection
@section('content')
<div class="pagetitle">
        <h1 class="text-success">Projet</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Projet</li>
                <li class="breadcrumb-item active text-dark">Visuliser</li>
            </ol>
        </nav>
<div class="row">
<div class="col-md-6 offset-md-3">
@can('lister_les_projets_soumis', Auth::user())
    @if($projet->statut =='soumis')
        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-evaluer-pca" data-toggle="modal"  data-toggle="tooltip" title="Evaluer l'avant projet" class="text-white"><i class="bi bi-plus-square"></i> Evaluer le projet </a>
            </button>
        </nav>
    @endif
    @if($projet->statut =='evalué')
    <nav>
        <button type="button" class="btn btn-success">
            <a href="#modal-avis-chefdezone-pca" data-toggle="modal"  data-toggle="tooltip" title="Avis de l'équipe technique" class="text-white"><i class="bi bi-plus-square"></i> Avis du chef d'antenne </a>
        </button>
    </nav>
@endif
@can('valider_levaluation_de_lavant_projet_fp', Auth::user())
    @if($projet->statut =='analysé')
    <nav>
        <button type="button" class="btn btn-danger">
        <a href="#modal-rejet-de-lanalyse" data-toggle="modal"  data-toggle="tooltip" title="Rejeter l'analyse du plan d'affaire" class="text-white"><i class="bi bi-plus-square"></i> Rejetter l'analyse </a>
        </button>
        <button type="button" class="btn btn-success">
            <a href="#modal-avis-equipe-fp" data-toggle="modal"  data-toggle="tooltip" title="Avis de l'équipe de fonds de partenariat" class="text-white"><i class="bi bi-plus-square"></i> Avis de l'équipe FP </a>
        </button>
    </nav>
    @endif
@endcan

@endcan
@can('valider_la_decision_du_comite',Auth::user())
    @if($projet->statut =='soumis_au_comite_de_selection')
    <nav>
        <button type="button" class="btn btn-success">
            <a href="#modal-decision-comite-de-selection" data-toggle="modal"  data-toggle="tooltip" title="Décision du comité de sélection" class="text-white"><i class="bi bi-plus-square"></i> Décision du comité de sélection </a>
        </button>
    </nav>
    @endif
@endcan

</div>

</div>
</div>
<hr>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
<div class="card">
<div class="row">
    <div class="col-md-7" style="margin-left:15px;">
    @if ($projet->motif_du_rejet_de_lanalyse)
        <div class="form-group row" >
            <div class="col-md-4">
            <label>Motif de rejet de l'analyse :</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->motif_du_rejet_de_lanalyse}}</label>
            </div>
        </div>
    @endif
                <div class="form-group row">
                    <div class="col-md-4">
                    <label>Coach:</label>
                    </div>
                    <div class="col-sm-7 mb-3 mb-sm-0">
                    <label class="fb"> {{$projet->coach->nom}} {{$projet->coach->prenom}} / {{$projet->coach->contact}}</label>
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-md-4">
                      <label>Titre du projet :</label>
                    </div>
                    <div class="col-sm-7 mb-3 mb-sm-0">
                      <label class="fb"> {{$projet->titre_du_projet}}</label>
                    </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-4">
                        <label>Coût total du projet :</label>
                      </div>
                      <div class="col-sm-7 mb-3 mb-sm-0">
                        <label class="fb"> {{ format_prix($projet->investissements->sum('montant'))   }} </label>
                      </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label>Coût total du projet validé:</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> {{ format_prix($projet->investissementvalides->sum('montant_valide'))   }} </label>
                </div>
            </div>
            @if(count($projet->investissements)!=0)
                <div class="form-group row">
                    <div class="col-sm-4">
                    <label>Coût du projet validés:</label>
                    </div>
                    <div class="col-sm-7 mb-3 mb-sm-0">
                    <label class="fb"> {{ format_prix($projet->investissementvalides->sum('montant_valide'))   }} </label>
                    </div>
                </div>
                
            @endif
              <div class="form-group row">
                <div class="col-sm-4">
                  <label>Subvention demandée:</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> {{ format_prix($projet->investissements->sum('subvention_demandee'))   }}</label>
                </div>
             </div>
             <div class="form-group row">
                <div class="col-sm-4">
                  <label>Apport personnel :</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> {{ format_prix($projet->investissements->sum('apport_perso'))   }} </label>
                </div>
             </div>
             <div class="form-group row">
                <div class="col-sm-4">
                  <label>Subvention accordée :</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> {{ format_prix($projet->investissements->sum('subvention_demandee_valide'))   }}</label>
                </div>
             </div>
                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label>Les objectifs :</label>
                    </div>
                    <div class="col-sm-8 mb-3 mb-sm-0">
                      <label class="fb"> {{ $projet->objectifs }} </label>
                    </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-4">
                        <label>Les activités ménées :</label>
                      </div>
                      <div class="col-sm-8 mb-3 mb-sm-0">
                        <p style="text-align: justify">  {{ $projet->activites_menees }} </p>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-4">
                        <label>Les Atouts du projet :</label>
                      </div>
                      <div class="col-sm-8 mb-3 mb-sm-0">
                        <p style="text-align: justify"> {{  $projet->innovation }}</p>
                      </div>
                  </div>
    </div>
    <div class="col-md-4">
        <h2>Evaluation</h2>
        @foreach ( $projet->evaluations as $evaluation)
        <div class="form-group row" >
            <div class="col-md-9">
            <label>{{ $evaluation->critere->libelle }} :</label>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$evaluation->note}}</label>
            </div>
        </div>
        @endforeach
        <div class="form-group row" >
            <div class="col-md-9">
            <label>Total:</label>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->evaluations->sum('note')}}</label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 row">
        <div class="col-md-4">
            <label>Avis Chef de Zone:</label>
            </div>
            <div class="col-sm-6 mb-6 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->avis_chefdantenne}}</label>
            </div>
        </div>
    <div class="col-md-6 row">
        <div class="col-md-4">
            <label>Observation chef de Zone:</label>
            </div>
            <div class="col-sm-6 mb-6 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->observation_chefdantenne}}</label>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 row">
        <div class="col-md-4">
            <label>Avis UGP:</label>
            </div>
            <div class="col-sm-6 mb-6 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->avis_equipe_fp}}</label>
        </div>
    </div>
    <div class="col-md-6 row">
        <div class="col-md-4">
            <label>Observation UGP:</label>
            </div>
            <div class="col-sm-6 mb-6 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->observation_equipe_fp}}</label>
        </div>
    </div>
@if($projet->liste_dattente_observations)
    <div class="col-md-6">
        <div class="col-md-6">
            <label>Observation Liste d'attente:</label>
            </div>
            <div class="col-sm-6 mb-6 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->liste_dattente_observations}}</label>
        </div>
    </div>
@endif
</div>
<hr>

<div class="row">
    <table class="table table-vcenter table-condensed table-bordered  valdetail"   >
        <thead>
        <h4>Les investissements</h4>
                <tr>
                    <th>N°</th>
                    <th>Designation</th>
                    <th>Coût total</th>
                    <th>Subvention Demandée</th>
                    <th>Apport Personnel</th>
                    <th>Coût accordé</th>
                    <th>Subvention accordée</th>
                    <th>Actions</th>
                </tr>
          </thead>
          <tbody id="tbadys">
    @foreach($projet->investissements as $key => $investissement)
    <tr 
    @if($investissement->statut == 'validé' )
        style="color:green;"
    @elseif($investissement->statut == 'rejeté')
    style="color:red;"

    @endif>
            <td>
            {{ $key + 1 }}
            </td>
                 <td>
                    {{getlibelle($investissement->designation)}}
                </td>
                <td>
                    {{format_prix($investissement->montant)}}
                </td>
                <td>
                    {{format_prix($investissement->apport_perso)}}
                </td>
                <td>
                    {{format_prix($investissement->subvention_demandee)}}
                </td>
                <td>
                    {{format_prix($investissement->montant_valide)}}
                </td>
                <td>
                    {{format_prix($investissement->subvention_demandee_valide)}}
                </td>
    <td>
    @can('verdict_du_comite_plan_daffaire', Auth::user())
        @if ($projet->statut=='soumis_au_comite_de_selection' && ($investissement->statut==null))
            <a  href="#rejetter_investissement" data-toggle="modal"title="Rejetter la ligne- d'investissement"  onclick="edit_investissemnt_by_comite({{ $investissement->id }});" class="btn btn-md btn-danger" ><i class="fa fa-times"></i> </a>
            <a href="#modal-valider-investissement" data-toggle="modal" title="Valider la ligne d'investissement" onclick="edit_investissemnt_by_comite({{ $investissement->id }});" class="btn btn-md btn-success" ><i class="fa fa-check"></i> </a>
        @endif
    @endcan
</td>

</tr>
@endforeach
</tbody>
</table>
</div>       
<div class="row">
    <h4> Documents au PCA </h4>
       
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
    

</div>
</div>
</div>
</div>
</section>
@endsection
@section('modal_part')
<div id="modal-valider-investissement" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i> Valider la ligne d'investissement</h2>
            </div>
            <div class="modal-body">
        <form method="post"  action="{{route('investissement.valide')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id='invest_id' name="invest_id" value="">
            <div class="row">
                <div class="form-group col-md-3" >
                    <label class="control-label " for="example-chosen">Categorie d'investissement<span class="text-danger">*</span></label>
                        <select id="categorie_invest"  name="designation" class="form-control" onchange="afficher();" data-placeholder="formalisée?" style="width: 100%;" required>
                            <option></option>
                           @foreach ($categorie_investissements as $categorie_investissment)
                            <option value="{{ $categorie_investissment->id}}"
                                >{{ getlibelle($categorie_investissment->id)}}</option>
                           @endforeach
                        </select>
                </div>
                 <div class="col-md-3" >
                    <div class="form-group">
                        <label class="control-label" for="example-username"> Montant</label>
                            <input type="text" id="montant_invest" name="cout"  min="0" class="form-control" placeholder="Montant ..." text="Valeur depassé" required >
                    </div>
                    @if ($errors->has('cout'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cout') }}</strong>
                    </span>
                    @endif
                </div> 
                <div class="col-md-3" >
                    <div class="form-group">
                        <label class="control-label" for="example-username">Subvention accordée</label>
                            <input type="text" id="subvention" name="subvention"  class="form-control" placeholder="Evaluer ..." text="Valeur depassé"  onChange="deux_somme_complementaire('subvention','apport_perso','montant_invest')" required >
                    </div>
                    @if ($errors->has('note'))
                    <span class="help-block">
                        <strong>{{ $errors->first('note') }}</strong>
                    </span>
                    @endif
                </div> 
                <div class="col-md-3" >
                    <div class="form-group">
                        <label class="control-label" for="example-username">Apport personnel</label>
                            <input type="text" id="apport_perso" name="apport_perso" class="form-control" placeholder="Evaluer ..."  required >
                    </div>
                    @if ($errors->has('note'))
                    <span class="help-block">
                        <strong>{{ $errors->first('note') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
                 
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success " ><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
            </form>      
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="rejetter_investissement" class="modal fade" aria-labelledby="alertModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-times" ></i> Rejeter la ligne d'investissement</h3>
            </div>
            <form method="post"  action="{{route('rejeter.investissement')}}" class="form-horizontal form-bordered">
                {{ csrf_field() }}
            <div class="row">
                <input type="hidden" name="invest_id" id="invest_id_rejet">
            <p style="color: red; font-size:22px;">Voulez-vous rejetter cette ligne d'investissement ??</p>
            </div>
                <div class="form-group form-actions">
                    <div class="text-right">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-md btn-success" >Confirmer</button>
                    </div>
                </div>
        </form>
            </div>
            
        </div>
 </div>
<div id="modal-rejet-de-lanalyse" class="modal fade" aria-labelledby="alertModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="padding:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="gi gi-pen" ></i>Rejeter l'analyse du Plan d'affaire</h3>
            </div>
            <div id="alertMessage" class="alert alert-warning" role="alert">
                <p style="color: red;">Voulez-vous rejeter l'analyse du plan d'affaire</p>
            </div>
          <div class="modal-footer">
            <button type="button"class="btn btn-sm btn-success" onclick="rejeter_lanalyse_du_pca();" data-dismiss="modal">Confirmer</button>
            <button type="button"class="btn btn-sm btn-danger" onclick="$('#modal-rejet-de-lanalyse').modal('hide')" data-dismiss="modal">Fermer</button>
          </div>
            </div>
            
        </div>
 </div>
<div id="modal-evaluer-pca" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Evaluer le Projet</h2>
            </div>
            <div class="modal-body">
            <form method="post"  action="{{ route('pca.evaluation') }}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="projet" id="" value="{{ $projet->id }}">
                <div class="form-group{{ $errors->has('grille_devaluation') ? ' has-error' : '' }}">
                    <label class="control-label col-md-4" for="grille_devaluation">Joindre la grille d'évaluation <span class="text-danger">*</span></label>
                    <div class="input-group col-md-8">
                        <input class="form-control" type="file" name="grille_devaluation" id="" accept=".pdf, .jpeg, .png"   placeholder="Charger la grille d'évaluation" required>

                    </div>
                    @if ($errors->has('grille_devaluation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('grille_devaluation') }}</strong>
                        </span>
                        @endif
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
                        <a href="#" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success valider_evaluation" ><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
            </form>      
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-avis-chefdezone-pca" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i> Avis du chef d'antenne</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" name="projet_id"  id='projet_chef_de_zone' value="{{ $projet->id }}">
                <input type="hidden" name=""  id='champ_avis_chef_zone'>

                <div class="form-group">
                  <label for="">Entrez les observations :</label>
                  <textarea id="observation_avis_chefdezone" name="observation" placeholder="Observation"  cols="60" rows="10" onchange="activerbtn('btn_desactive','observation_avis_chefdezone')" aria-describedby="helpId"></textarea>
                </div>
            <div class="form-group form-actions">
                <div class="text-right">
                    <button  class="btn btn-md btn-success btn_desactive" onclick="save_pca_chefdezone('favorable');" disabled>Favorable</button>
                    <button class="btn btn-md btn-danger btn_desactive"   onclick="save_pca_chefdezone('defavorable');" disabled>Defavorable</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-decision-comite-de-selection" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i> Décision du comité de sélection</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" name="projet_id"  id='projet_comite' value="{{ $projet->id }}">
                <input type="hidden" name="" id='champ_avis_comite'>
                <div class="form-group">
                  <label for="">Entrez les observations :</label>
                  <textarea id="observation_comite" name="observation" placeholder="Observation"  cols="60" rows="10" onchange="activerbtn('btn_desactive','observation_equipe_fp')" aria-describedby="helpId"></textarea>
                </div>
            <div class="form-group form-actions">
                <div class="text-right">
                    <button  class="btn btn-md btn-success btn_desactive" onclick="save_decision_comite('selectionné');" disabled>Favorable</button>
                    <button class="btn btn-md btn-danger btn_desactive"   onclick="save_decision_comite('rejeté');" disabled>Défavorable</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-avis-equipe-fp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i> Avis de l'équipe fonds de partenariat</h2>
            </div>
            <div class="modal-body">
                <input type="hidden" name="projet_id"  id='projet_equipe_fp' value="{{ $projet->id }}">
                <input type="hidden" name=""  id='champ_avis_equipe_fp'>
                <div class="form-group">
                  <label for="">Entrez les observations :</label>
                  <textarea id="observation_equipe_fp" name="observation" placeholder="Observation"  cols="60" rows="10" onchange="activerbtn('btn_desactive','observation_equipe_fp')" aria-describedby="helpId"></textarea>
                </div>
            <div class="form-group form-actions">
                <div class="text-right">
                    <button  class="btn btn-md btn-success btn_desactive" onclick="save_avis_equipe_fp('favorable');" disabled>Favorable</button>
                    <button class="btn btn-md btn-danger btn_desactive"   onclick="save_avis_equipe_fp('defavorable');" disabled>Defavorable</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
 <script>
    function setTypeavis(type, champ){
        $('#'+champ).val(type);
    }
    //const inputElement = document.querySelector('input');
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
function save_decision_comite(avis){
        var projet_id= $("#projet_comite").val();
        var observation= $("#observation").val();
        //var type= $("#champ_decision_comite").val();
        var url = "{{ route('plan_daffaire.save_decision_du_comite') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis} ,
                error:function(){alert('error');},
                success:function(){
                    $('#modal-confirm-rejet').hide();
                    location.reload();
                }
            });
    }
function save_pca_chefdezone(avis){
        var projet_id= $("#projet_chef_de_zone").val();
        var type = $("#champ_avis_chef_zone").val();
        var observation= $("#observation_avis_chefdezone").val();
        var url = "{{ route('pca.save_avis_chefdantenne') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis,type:type} ,
                error:function(){alert('error');},
                success:function(){
                    window.location=document.referrer;
                }
            });
    }
    function save_avis_equipe_fp(avis){
        var projet_id= $("#projet_chef_de_zone").val();
       // var type = $("#champ_avis_chef_zone").val();
        var observation= $("#observation_equipe_fp").val();
        var url = "{{ route('pca.save_avis_equipe_fp') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis} ,
                error:function(){alert('error');},
                success:function(){
                    window.location=document.referrer;
                }
            });
    }
    function rejeter_lanalyse_du_pca(){
        var url = "{{ route('pca.rejeter_lanalyse_pa') }}";
        $.ajax({
                url: url,
                type:'GET',
               // data: {projet_id: projet_id, observation:observation, avis:avis} ,
                error:function(){alert('error');},
                success:function(){
                    window.location=document.referrer;
                }
            });
    }
 </script>
 <script>
        function edit_investissemnt_by_comite(id){
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
                        $("#montant_invest").val(data.cout);
                        $("#subvention").val(data.subvention);
                        $("#apport_perso").val(data.apport_perso);
                        $("#categorie_invest").val(data.categorie);
                        //Pour gerer les rejet recuperer id de la ligne à  rejetter
                        $("#invest_id_rejet").val(data.id);


                        }
                    });
            }
 </script>
 {{-- <script>
         function recupererprojet_id(id_projet){
            //alert(id_projet);
            document.getElementById("projet_id").setAttribute("value", id_projet);

    }
    function statuer_sur_lanalyse_du_pca(){
        $(function(){
            var projet_id= $("#projet_id").val();
            var raison= $("#raison_du_rejet").val();
            //alert(projet_id)
            var url = "{{ route('pca.valider_analyse') }}";
            $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, raison:raison} ,
                error:function(){alert('error');},
                success:function(){
                    $('#modal-confirm-rejet').hide();
                    //window.location=document.referrer;
                    location.reload();
                }
            });
            });
    }
    function repecher_le_pca(){
        $(function(){
            var projet_id= $("#projet_id_repecher").val();
            var raison_repeche= $("#raison_repeche").val();
            var url = "{{ route('pca.repecher') }}";
            $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, raison_repeche:raison_repeche} ,
                error:function(){alert('error');},
                success:function(){
                    $('#modal-confirm-rejet').hide();
                    location.reload();
                }
            });
            });
    }
    function save_decision_comite(avis){
        var projet_id= $("#projet_comite").val();
        var observation= $("#observation").val();
        var type= $("#champ_decision_comite").val();
        var url = "{{ route('pca.savedecisioncomite') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis, type:type} ,
                error:function(){alert('error');},
                success:function(){
                    $('#modal-confirm-rejet').hide();
                    location.reload();
                    //window.location=document.referrer;
                }
            });
    }
    function pca_put_liste_dattente(){
        var projet_id= $("#projet_liste_dattente").val();
        var observation= $("#observation_liste_dattente").val();
        var url = "{{ route('pca.liste_dattente') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation} ,
                error:function(){alert('error');},
                success:function(){
                    $('#modal-confirm-rejet').hide();
                    window.location=document.referrer;
                }
            });
    }
    function save_pca_chefdezone(avis){
        var projet_id= $("#projet_chef_de_zone").val();
        var type = $("#champ_avis_chef_zone").val();
        var observation= $("#observation_avis_chefdezone").val();
        var url = "{{ route('pca.save_devis_chefdezone') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis,type:type} ,
                error:function(){alert('error');},
                success:function(){
                    window.location=document.referrer;
                }
            });
    }
    function save_avis_ugp(avis){
        var projet_id= $("#projet_avis_ugp").val();
        var type= $("#champ_avis_chef_projet").val();
        var observation= $("#observation_avis_ugp").val();
        var url = "{{ route('pca.save_avis_ugp') }}";
        $.ajax({
                url: url,
                type:'GET',
                data: {projet_id: projet_id, observation:observation, avis:avis, type:type} ,
                error:function(){alert('error');},
                success:function(){
                  //  $('#modal-confirm-rejet').hide();
                    window.location=document.referrer;
                }
            });

    }
 </script> --}}
    
    

