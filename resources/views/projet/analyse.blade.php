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
                <li class="breadcrumb-item active text-dark">Visualiser</li>
            </ol>
        </nav>
<div class="row">
<div class="col-md-6 offset-md-3">
@can('donner_lavis_du_ses', Auth::user())
       
            <nav>
                <button type="button" class="btn btn-success">
                    <a href="#modal-composante" data-toggle="modal"  data-toggle="tooltip" title="Ajouter une composante au projet" class="text-white"><i class="bi bi-plus-square"></i> Ajouter les composantes </a>
                </button>
            </nav>
      
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
    
        <div class="form-group row" >
            <div class="col-md-4">
            <label>Dénomination du projet :</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$projet->denomination}}</label>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-4">
            <label>Taux physique :</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0">
            <label class="fb"> {{ $projet->taux_physique }}</label>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-4">
            <label>Taux financier :</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0">
            <label class="fb"> {{ $projet->taux_financier }}</label>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-md-4">
            <label>Taux de décaissement :</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0">
            <label class="fb"> {{ $projet->taux_decaissement}}</label>
            </div>
        </div>
 
              
    </div>
</div>
<hr>

<div class="row">
    <nav>
        <button type="button" class="btn btn-success">
            <a  href="#modal-composantes" data-toggle="modal"  data-toggle="tooltip" title="Donner l'avis du SES" class="text-white"><i class="bi bi-plus-square"></i> Ajouter les composantes </a>
        </button>
    </nav>
    <table class="table table-vcenter table-condensed table-bordered  valdetail"   >
        <thead>
        <h4>Les composantes du projet</h4>
                <tr>
                    <th>N°</th>
                    <th>Code composante</th>
                    <th>Denomination</th>
                    <th>Taux physique</th>
                    <th>Actions</th>
                </tr>
          </thead>
          <tbody id="tbadys">
    @foreach($projet->composantes as $key => $composante)
    <tr>
            <td>
            {{ $key + 1 }}
            </td>
                 <td>
                    {{$composante->code_composante}}
                </td>
                <td>
                    {{$composante->denomination}}
                </td>
                <td>
                    {{ $composante->taux_physique }}
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="{{ route('composante.show', $composante) }}"data-toggle="tooltip"  title="Visuliser le PCA" class="btn btn-md btn-default" ><i class="fa fa-eye"></i></a> 
                        
                    </div>
    <td>
   
</td>

</tr>
@endforeach
</tbody>
</table>
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
                        {{-- <select id="categorie_invest"  name="designation" class="form-control" onchange="afficher();" data-placeholder="formalisée?" style="width: 100%;" required>
                            <option></option>
                           @foreach ($categorie_investissements as $categorie_investissment)
                            <option value="{{ $categorie_investissment->id}}"
                                >{{ getlibelle($categorie_investissment->id)}}</option>
                           @endforeach
                        </select> --}}
                </div>
                 <div class="col-md-3" >
                    <div class="form-group">
                        <label class="control-label" for="example-username"> Montant</label>
                            <input type="text" id="montant_invest" name="cout"  min="0" class="form-control" placeholder="Montant ..." text="Valeur depassé" required >
                    </div>
                    {{-- @if ($errors->has('cout'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cout') }}</strong>
                    </span>
                    @endif --}}
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
<div id="modal-composantes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title"> <p  style="margin-left:50px;text-align: center"></p>Ajouter une nouvelle composante au projet</h2>
            </div>
            <div class="modal-body">
            <form method="post"  action="{{ route('composante.store') }}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="projet_id"  id='projet_id' value="{{ $projet->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Libellé de la composante <span class="text-danger">*</span></label>
                                <div class="input-group" style ='width:100%'>
                                        <input id="libelle" type="text" class="form-control" name="denomination" value="{{ old('denomination') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('denomination'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('denomination') }}</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                
            <div class="form-group form-actions" style="margin-top: 15px;">
                <div class="text-right">
                    <button type="reset" class="btn btn-sm btn-warning" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-sm btn-success">Valider</button>
                </div>
            </div>
        </form>
        </div>
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
        if(type=="decision_aneve")
            $('#entete_decision').text("Enregistrer la décision finala de l'ANEVE");
        else
            $('#entete_decision').text("Enregistrer l'avis de spécialiste en sauvegarde environnementale");

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
        var projet_id= $("#projet_avis_ses").val();
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
                    var url = "{{ route('composante.modif') }}";
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
    
    

