@extends('layouts.base')
@section('title')
@endsection
@section('administration', 'show')
@section('document', 'active')
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Administration</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Administration</li>
                <li class="breadcrumb-item active text-dark">Documents</li>
            </ol>
        </nav>

        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-create-document" data-toggle="modal"  data-toggle="tooltip" title="Nouveau" class="text-white"><i class="bi bi-plus-square"></i> Nouveau</a>
            </button>
        </nav>
    </div><!-- End Page Title -->

<section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
<div class="table-responsive">
    <table class="table liste">
        <thead>
                <tr>
                    <th>Categorie</th>
                    <th>Titre</th>
                    <th>Cible</th>
                    <th>Action</th>
                </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{getlibelle($document->categorie_id)}}</td>
                    <td>{{$document->titre}}</td>
                    <td>{{$document->cible}}</td>
                    <td class="text-center">
                            <div class="btn-group">
                             {{-- @can('document.update', Auth::user()) --}}
                             <a  href="#modal-edit-document" onclick="edit_document({{ $document->id }});"   data-toggle="modal" title="Modifier" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                            {{-- @endcan --}}
                            @can('document.delete',Auth::user())
                                <a href="#modal-confirm-delete" onclick="delConfirm({{ $role->id }});" data-toggle="modal" title="Supprimer" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                            @endcan
                            </div>
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
<div id="modal-create-document"  class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Enregistrer un document</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('documents.store')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label class="control-label" for="val_denomination">Titre du document<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="titre" name="titre" class="form-control" placeholder="Entrez le titre du document" value="{{old("titre")}}" required >
                            </div>
                            {{-- <p id="error" style="background-color: rgb(231, 179, 179); color">Une entreprise est déja enregistrée sous cette dénomination.Merci de changer le nom de l'entreprise pour pouvoir remplir les autres champs</p> --}}
                            @if ($errors->has('titre'))
                                        <span class="help-block text-danger">
                                                <strong> </strong>
                                        </span>
                                    @endif
                        
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} col-md-6">
                            <label class= "control-label" for="type">Catégorie du document<span class="text-danger">*</span></label>
                           
                                <select id="categorie" name="categorie" class="select-select2" data-placeholder="Choisir la rubrique d'entreprise" style="width: 100%;"  >
                                    <option ></option>
                                    @foreach ($docs_categories as $docs_categorie)
                                        <option value="{{ $docs_categorie->id }}">{{ $docs_categorie->libelle }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categorie'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('categorie') }}</strong>
                                </span>
                                @endif
                            
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} col-md-6">
                            <label class="control-label" for="type">Cible<span class="text-danger">*</span></label>
                           
                                <select id="cible" name="cible" class="select-select2" data-placeholder="Choisir la cible d'entreprise" style="width: 100%;"  >
                                    <option></option>
                                    <option value="public">Public</option>
                                    <option value="interne">Interne</option>
                                </select>
                                @if ($errors->has('cible'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cible') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label class=" control-label" for="docidentite">Joindre le document</label>
                                <input class="form-control" type="file" id="document" accept=".pdf, .jpeg, .png" name="document"  placeholder="Joindre le document" onchange="VerifyUploadSizeIsOK('docrccm');" required>
                                <span class="help-block" style="text-align: center; color:red;">
                                    Taille maximale autorirée :2MB
                                   </span>
                            @if ($errors->has('document'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                        </div> 
                    </div>
                
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="{{ route('critere.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-edit-document"  class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Modifier un document</h2>
            </div>
            <div class="modal-body">
                <form id="form-validation" method="POST"  action="{{route('document.storemodif')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="document_id" id="document_id">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label class="control-label" for="val_denomination">Titre du document<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="titre_u" name="titre" class="form-control" placeholder="Entrez le titre du document" value="{{old("titre")}}" required >
                            </div>
                            {{-- <p id="error" style="background-color: rgb(231, 179, 179); color">Une entreprise est déja enregistrée sous cette dénomination.Merci de changer le nom de l'entreprise pour pouvoir remplir les autres champs</p> --}}
                            @if ($errors->has('titre'))
                                        <span class="help-block text-danger">
                                                <strong> </strong>
                                        </span>
                                    @endif
                        
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} col-md-6">
                            <label class= "control-label" for="type">Catégorie du document<span class="text-danger">*</span></label>
                                <select id="categorie_u" name="categorie" class="select-select2" data-placeholder="Choisir la categorie du document" style="width: 100%;"  >
                                    <option ></option>
                                    @foreach ($docs_categories as $docs_categorie)
                                        <option value="{{ $docs_categorie->id }}">{{ $docs_categorie->libelle }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categorie'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('categorie') }}</strong>
                                </span>
                                @endif
                            
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} col-md-6">
                            <label class="control-label" for="type">Cible<span class="text-danger">*</span></label>
                           
                                <select id="cible_u" name="cible" class="select-select2" data-placeholder="Choisir la cible d'entreprise" style="width: 100%;"  >
                                    <option></option>
                                    <option value="public">Public</option>
                                    <option value="interne">Interne</option>
                                </select>
                                @if ($errors->has('cible'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cible') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label class=" control-label" for="docidentite">Joindre le document</label>
                                <input class="form-control" type="file" id="document" accept=".pdf, .jpeg, .png" name="document"  placeholder="Joindre le document" onchange="VerifyUploadSizeIsOK('docrccm');" required>
                                <span class="help-block" style="text-align: center; color:red;">
                                    Taille maximale autorirée :2MB
                                   </span>
                            @if ($errors->has('document'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                        </div> 
                    </div>
                
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="{{ route('critere.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Valider</button>
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
    <script>
        function edit_document(id){
                    var id=id;
                    var url = "{{ route('document.modif') }}";
                    $.ajax({
                        url: url,
                        type:'GET',
                        dataType:'json',
                        data: {id: id} ,
                        error:function(){alert('error');},
                        success:function(data){
                            console.log(data)
                            $("#document_id").val(data.id);
                            $("#categorie_u").val(data.categorie_id); 
                            $("#cible_u").val(data.cible); 
                            $("#titre_u").val(data.titre); 
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

@endsection

