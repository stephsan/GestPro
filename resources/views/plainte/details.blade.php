@extends('./layouts/base')
@section('title')
@section('plaintes', 'show')
{{-- @section('mpme_existant', 'active') --}}
@endsection
@section('css')
@endsection
@section('content')
<div class="pagetitle">
        <h1 class="text-success">Plainte</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Plainte</li>
                <li class="breadcrumb-item active text-dark">Visuliser</li>
            </ol>
        </nav>
<div class="row" >
<div class="col-md-6 offset-md-3">
@can('visualiser_une_plainte', Auth::user())
    @if($plainte->statut =='enregistré')
        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-receive-plainte" data-toggle="modal"  data-toggle="tooltip" title="Recevoir la plainte" class="text-white"><i class="bi bi-plus-square"></i> Recevoir la plainte </a>
            </button>
            <button type="button" class="btn btn-danger">
                <a href="#modal-archiver-plainte" data-toggle="modal"  data-toggle="tooltip" title="archiver la plainte" class="text-white"><i class="bi bi-plus-square"></i> Archiver la plainte </a>
            </button>
        </nav>
    @endif
    @if($plainte->statut =='en_cours')
        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-resolve-plainte" data-toggle="modal"  data-toggle="tooltip" title="Plaintes résolues" class="text-white"><i class="bi bi-plus-square"></i> PLainte résolue </a>
            </button>
            <button type="button" class="btn btn-danger">
                <a href="#modal-archiver-plainte" data-toggle="modal"  data-toggle="tooltip" title="archiver la plainte" class="text-white"><i class="bi bi-plus-square"></i> Archiver la plainte </a>
            </button>
        </nav>
    @endif
@endcan
</div>

</div>
</div>
<hr>
<section class="section" >
    <div class="row" >
        <div class="col-lg-12">
<div class="card">
<div class="row" style="padding: 20px;">
    <div class="col-md-7" style="margin-left:15px;">
                <div class="form-group row">
                    <div class="col-md-4">
                    <label>Numero de plainte:</label>
                    </div>
                    <div class="col-sm-7 mb-3 mb-sm-0">
                    <label class="fb"> <p style="font-weight: 600; color:red;">{{$plainte->num_plainte}}</p></label>
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-md-4">
                      <label>Nom & Prénom du plaignant :</label>
                    </div>
                    <div class="col-sm-7 mb-3 mb-sm-0">
                      <label class="fb"> {{$plainte->nom}} {{$plainte->prenom}}</label>
                    </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-4">
                        <label>Sexe du plaignant :</label>
                      </div>
                      <div class="col-sm-7 mb-3 mb-sm-0">
                        <label class="fb"> @if($plainte->sexe==1)
                            Masculin
                        @else
                            Féminin
                        @endif
                     </label>
                      </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label>contact:</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> {{ $plainte->telephone }} / {{ $plainte->email }} </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Objet:</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> <p style="text-align:justify">{{ $plainte->objet }}</p> </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                  <label> Solution Préconisee:</label>
                </div>
                <div class="col-sm-7 mb-3 mb-sm-0">
                  <label class="fb"> <p style="text-align: justify;">{{ $plainte->solution_preconisee }} </p></label>
                </div>
            </div>
    </div>
    <div class="col-md-4">
    @if($plainte->categorie)
        <div class="form-group row" >
            <div class="col-md-9">
            <label>Catégorie de la plainte:</label>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$plainte->categorie}}</label>
            </div>
        </div>
    @endif
        <div class="form-group row" >
            <div class="col-md-9">
            <label>Statut plainte:</label>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0" style="color: red">
            <label class="fb"> {{$plainte->statut}}</label>
            </div>
        </div>
        @if($plainte->statut=='resolue')
            <div class="form-group row" >
                <div class="col-md-9">
                <label>Commentaire resolution:</label>
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0" style="color: red">
                    <label class="fb" style="text-align: justify;"> {{$plainte->commentaire_resolve}}</label>
                </div>
            </div>
        @endif
    </div>
</div>  
<div class="row">
        <div class="col-md-10">

        </div>
        <div class="col-md-2">
            <nav>
                <button type="button" class="btn btn-danger">
                    <a onclick="window.history.back();"    title="archiver la plainte" class="text-white"><i class="bi bi-plus-square"></i> Fermer </a>
                </button>
            </nav>
        </div>
</div>    
</div>
</div>
</div>
</section>
@endsection
@section('modal_part')
<div id="modal-receive-plainte" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i> Recevoir la plainte (categoriser la plainte avant la validation)</h2>
            </div>
            <div class="modal-body">
        <form method="post"  action="{{route('plainte.qualifier')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id='plainte_id_receive' name="plainte_id" value="{{ $plainte->id }}">
            <div class="row" style="padding: 15px;">
                    @foreach ($plainte_categories as $plainte_categorie)
                    <div class="row">
                        <label><input type="radio" name='categorie_plainte' value="{{ $plainte_categorie->id }}" required> {{ getlibelle($plainte_categorie->id) }}</label>
                    </div>  
                    @endforeach
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
<div id="modal-resolve-plainte" class="modal fade" aria-labelledby="alertModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-times" ></i> Plaintes resolues</h3>
            </div>
            <form method="post"  action="{{route('plainte.resolue')}}" class="form-horizontal form-bordered">
                {{ csrf_field() }}
                <input type="hidden" name="plainte_id" id="invest_id_resolve" value="{{ $plainte->id }}">
            <div class="row">
                <div class="form-group">
                    <label for="">Entrez un commentaire :</label>
                    <textarea id="commantaire_resolve" name="commentaire_resolve" placeholder="Observation" required  cols="60" rows="10" onchange="activerbtn('btn_desactive','commantaire_resolve')" aria-describedby="helpId"></textarea>
                  </div>
            </div>
                <div class="form-group form-actions">
                    <div class="text-right">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-md btn-success btn_desactive" disabled>Enregistrer</button>
                    </div>
                </div>
        </form>
            </div>
            
        </div>
 </div>
<div id="modal-archiver-plainte" class="modal fade" aria-labelledby="alertModalLabel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding:15px;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-times" ></i> Archiver la plainte</h3>
            </div>
            <form method="post"  action="{{route('plainte.qualifier')}}" class="form-horizontal form-bordered">
                {{ csrf_field() }}
            <div class="row">
                <input type="hidden" name="plainte_id" id="invest_id_rejet" value="{{ $plainte->id }}">
            <p style="color: red; font-size:22px;">Voulez-vous rendre cette plainte non-recevable en l'archivant ??</p>
            </div>
                <div class="form-group form-actions">
                    <div class="text-right">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-md btn-success" >Archiver</button>
                    </div>
                </div>
        </form>
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
    
    

