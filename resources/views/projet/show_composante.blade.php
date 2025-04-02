@extends('./layouts/base')
@section('title')
@section('fp_mpme_existante', 'show')
@section('mpme_existant', 'active')
@endsection
@section('css')
@endsection
@section('content')
<div class="pagetitle">
        <h1 class="text-success">Composante</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Composante</li>
                <li class="breadcrumb-item active text-dark">Détails</li>
            </ol>
        </nav>
<div class="row">
<div class="col-md-6 offset-md-3">
@can('donner_lavis_du_ses', Auth::user())
            <nav>
                <button type="button" class="btn btn-success">
                    <a href="#modal-activite" data-toggle="modal"  data-toggle="tooltip" title="Ajouter une composante au projet" class="text-white"><i class="bi bi-plus-square"></i> Ajouter une activite </a>
                </button>
            </nav>
            <nav>
                <button type="button" class="btn btn-success">
                    <a href="#modal-activite" data-toggle="modal"  data-toggle="tooltip" title="Ajouter une composante au projet" class="text-white"><i class="bi bi-plus-square"></i> Retour</a>
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
            <label>Libelle composante:</label>
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$composante->denomination}}</label>
            </div>
        </div>   
    </div>
</div>
<hr>

<div class="row">
    <nav>
        <button type="button" class="btn btn-success">
            <a  href="#modal-add-activite" data-toggle="modal"  data-toggle="tooltip" title="Donner l'avis du SES" class="text-white"><i class="bi bi-plus-square"></i> Ajouter une activité </a>
        </button>
        <button type="button" class="btn btn-danger" style="float: right;">
            <a  href="#" data-toggle="modal"  data-toggle="tooltip" title="Retourner aux details du projet" class="text-white" onclick="history.back()"><i class="bi bi-arrow-return-left"></i> Retour </a>
        </button>
    </nav>
  
    <table class="table table-vcenter table-condensed table-bordered  valdetail"   >
        <thead>
        <h4>Les activités de la composantes </h4>
                <tr>
                    <th>N°</th>
                    <th>Code Activité</th>
                    <th>libelle</th>
                    <th>Actions</th>
                </tr>
          </thead>
          <tbody id="tbadys">
    @foreach($composante->activites as $key => $activite)
    <tr>
            <td>
            {{ $key + 1 }}
            </td>
                <td>
                    {{getlibelle($activite->categorie)}}
                </td>
                 <td>
                    {{$activite->code_activite}}
                </td>
                <td>
                    {{$activite->libelle}}
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <a  href="#modal-edit-activite" data-toggle="tooltip" data-toggle="modal" title="Edit" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                    </div>
                </td>
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
<div id="modal-add-activite" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title"> <p  style="margin-left:50px;text-align: center"></p>Ajouter une nouvelle activité</h2>
            </div>
            <div class="modal-body">
            <form method="post"  action="{{ route('activite.store') }}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="composante_id"  id='composante_id' value="{{ $composante->id }}">
                <div class="row">
                    <div class="form-group col-md-3" >
                        <label class="control-label " for="example-chosen">Categorie d'activité<span class="text-danger">*</span></label>
                            <select id="categoried_id"  name="categorie_id" class="form-control"  data-placeholder="Catégorie activité" style="width: 100%;" required>
                                <option></option>
                               @foreach ($categorie_activites as $categorie_activite)
                                <option value="{{ $categorie_activite->id}}"
                                    >{{ getlibelle($categorie_activite->id)}}</option>
                               @endforeach
                            </select> 
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Libellé de l'activité <span class="text-danger">*</span></label>
                                <div class="input-group" style ='width:100%'>
                                        <input id="libelle" type="text" class="form-control" name="libelle" value="{{ old('denomination') }}" required autofocus>
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
<div id="modal-edit-activite" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title"> <p  style="margin-left:50px;text-align: center"></p>Ajouter une nouvelle activité</h2>
            </div>
            <div class="modal-body">
            <form method="post"  action="{{ route('activite.store') }}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="composante_id"  id='composante_id' value="{{ $composante->id }}">
                <div class="row">
                    <div class="form-group col-md-3" >
                        <label class="control-label " for="example-chosen">Categorie d'activité<span class="text-danger">*</span></label>
                            <select id="categoried_id"  name="categorie_id" class="form-control"  data-placeholder="Catégorie activité" style="width: 100%;" required>
                                <option></option>
                               @foreach ($categorie_activites as $categorie_activite)
                                <option value="{{ $categorie_activite->id}}"
                                    >{{ getlibelle($categorie_activite->id)}}</option>
                               @endforeach
                            </select> 
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Libellé de l'activité <span class="text-danger">*</span></label>
                                <div class="input-group" style ='width:100%'>
                                        <input id="libelle" type="text" class="form-control" name="libelle" value="{{ old('denomination') }}" required autofocus>
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
    
    

