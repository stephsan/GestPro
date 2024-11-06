@extends('./layouts/base')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
<div class="pagetitle">
        <h1 class="text-success">Coachs liste</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Administration</li>
                <li class="breadcrumb-item active text-dark">Coachs</li>
            </ol>
        </nav>
        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-create-coach" data-toggle="modal"  data-toggle="tooltip" title="Nouveau" class="text-white"><i class="bi bi-plus-square"></i> Nouveau</a>
            </button>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
<div class="table-responsive">
<table class="table liste">
    <thead>
        <tr>
            <th>N</th>
            <th>Nom & Prénom</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
</thead>
<tbody>
            @php
                $i=0
            @endphp
    @foreach($coachs as $coach)
            @php
                $i+=1;
            @endphp
        <tr>
            <td>{{ $i }}</td>
            <td>{{$coach->nom}} {{$coach->prenom}}</td>
            <td>{{$coach->contact}}</td>
            <td class="text-center">
                    <div class="btn-group">
                     {{-- @can('role.update', Auth::user()) --}}
                        <a  href="#modal-edit-coach" onclick="edit_coach({{ $coach->id }});"   data-toggle="modal" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                    {{-- @endcan --}}
                  
                    </div>
            </td>
        </tr>
    @endforeach
</tbody>
    </table>
</div>
</div>
</div></div></div></section>
@endsection
@section('modal_part')
<div id="modal-create-coach" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Enregistrer un Coach</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('coach.store')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Nom<span class="text-danger">*</span></label>
                            
                                <div class="input-group" style ='width:100%'>
                                        <input id="name" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                                @endif
                            
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Contact<span class="text-danger">*</span></label>
                            
                                <div class="input-group" style ='width:100%'>
                                        <input id="name" type="text" class="form-control" name="contact" value="{{ old('contact') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                                @endif
                            
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Prénom<span class="text-danger">*</span></label>
                            
                                <div class="input-group" style ='width:100%'>
                                        <input id="name" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="{{ route('coach.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-sucess"><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-edit-coach" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier un Coach</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('coach.enremodif')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="coach" id="coach_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Nom<span class="text-danger">*</span></label>
                                <div class="input-group" style ='width:100%'>
                                        <input id="nom_coach" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class=" control-label" for="name">Contact<span class="text-danger">*</span></label>
                                <div class="input-group" style ='width:100%'>
                                        <input id="contact_coach" type="text" class="form-control" name="contact" value="{{ old('contact') }}" required autofocus>
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                </div>
                                @if ($errors->has('contact'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                                @endif
                            
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label" for="name">Prénom<span class="text-danger">*</span></label>
                            
                                <div class="input-group" style ='width:100%'>
                                     <input id="prenom_coach" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}"  required autofocus>
                                </div>
                                @if ($errors->has('prenom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('prenom') }}</strong>
                                </span>
                                @endif
                        </div>
                   
                    
                </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="{{ route('coach.index') }}" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-sucess"><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
                    

                </form>
            </div>
        </div>
    </div>
</div>
    <div id="modal-confirm-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Confirmation</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                            <input type="hidden" name="id_table" id="id_table">
                                <p>Voulez-vous vraiment Supprimer ce role ??</p>
                            <div class="form-group form-actions">
                                <div class="text-right">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="supp_id();">OUI</button>
                                </div>
                            </div>

                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
    </div>

@endsection
<script>
    function confirmDeletion(articleId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce critere ?')) {
            // Si l'utilisateur confirme, soumettre le formulaire
            document.getElementById('delete-form-' + articleId).submit();
        }
    }
</script>
<script>
    function edit_coach(id){
                var id=id;
                var url = "{{ route('coach.modif') }}";
                $.ajax({
                    url: url,
                    type:'GET',
                    dataType:'json',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(data){
                        $("#coach_id").val(data.id);
                       $("#nom_coach").val(data.nom);
                       $("#prenom_coach").val(data.prenom);
                       $("#contact_coach").val(data.contact);
                    }
                });
        }
</script>

    <script>

    function detailUser(id){
                var id=id;

                $.ajax({
                    url: url,
                    type:'GET',
                    dataType:'json',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(data){
                        $("#nom_user").text(data.nomUser);
                        $("#prenom_user").text(data.prenomUser);
                        $("#email_user").text(data.emailUser);
                        $("#telephone_user").text(data.telephone);
                        $("#login_user").text(data.login);
                    }
                });
        }
        function idstatus (id){
            var id= id;

            $.ajax({
                url: url,
                type:'GET',
                data: {id: id} ,
                error:function(){alert('error');},
                success:function(){
                }

            });
        }
        function delConfirm (id){
            //alert(id);
            $(function(){
                //alert(id);
                document.getElementById("id_table").setAttribute("value", id);
            });

        }

        function recu_id(){
            //var id= document.getElementById('id_table').value;
            $(function(){
                var id= $("#id_table").val();

                //alert(id);
                $.ajax({
                    url: url,
                    type:'GET',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(){
                        $('#modal-user-reinitialise').hide();
                        location.reload();

                    }
                });
            });
        }

        function supp_id(){
            $(function(){
                var id= $("#id_table").val();

                //alert(id);
                $.ajax({
                    url: url,
                    type:'GET',
                    data: {id: id} ,
                    error:function(){alert('error');},
                    success:function(){
                        $('#modal-confirm-delete').hide();
                        location.reload();

                    }
                });
            });
        }
    </script>


