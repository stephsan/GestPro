@extends('./layouts/base')
@section('title')

@section($page, 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Projets</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">{{ $texte }}</li>
                <li class="breadcrumb-item active text-dark">Lister</li>
            </ol>
        </nav>
        
    </div>
   
<section class="section">
   
        <div class="row">
            <nav>
                <button type="button" class="btn btn-success">
                    <a href="#modal-add-projet" data-toggle="modal"  data-toggle="tooltip" title="Importer les notes d'évaluation" class="text-white"><i class="bi bi-plus-square"></i> Ajouter un projet</a>
                </button>
                <button type="button" class="btn btn-warning" style="float:right">
                    <a href="#modal-import-realisation" data-toggle="modal"  data-toggle="tooltip" title="Importer les réalisations" class="text-white"><i class="bi bi-plus-square"></i> Importer réalisations</a>
                </button>
               
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
<div class="table-responsive">
<table class="table liste" >
            <thead>
                <tr class="text-danger">
                    <th class="text-center">Numéro</th>
                    <th class="text-center" >Code du projet</th>
                    <th class="text-center" >Titre du projet</th>
                    <th class="text-center">Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $i=0;
                @endphp
                @foreach ($projets as $projet)
                        @php
                           $i++;
                        @endphp
                    <tr>
                        <td class="text-center" style="width: 10%">{{ $i }}</td>
                        <td class="text-center">{{ $projet->code_projet }}</td>
                        <td class="text-center">{{ $projet->denomination }}</td>
                        <td class="text-center">
                            @if ($projet->statut==0)
                                En cours
                                @else
                                Clos
                            @endif
                            

                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('projet.show', $projet) }}"data-toggle="tooltip"  title="Visuliser le PCA" class="btn btn-md btn-default" ><i class="fa fa-eye"></i></a> 
                                {{-- <a  href="#modal-completer-dossier" data-toggle="modal"  data-toggle="tooltip" title="Completer le dossier" class="btn btn-md btn-success" onclick="getprojet('{{ $projet->id }}')"><i class="fa fa-file"></i></a>
                                <a href="{{ route('pca.analyse', $projet) }}"data-toggle="tooltip"  title="Visuliser le PCA" class="btn btn-md btn-default" ><i class="fa fa-eye"></i></a> --}}
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
<div id="modal-add-projet" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-check"></i>Ajouter un  projet</h2>
            </div>
            <div class="modal-body">
        <form method="post"  action="{{route('projet.store')}}" class="form-horizontal form-bordered" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden"  class='projet_id' name="projet_id" value="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class=" control-label" for="name">Dénomination du projet <span class="text-danger">*</span></label>
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
                {{-- <div class="form-group col-md-5" >
                    <label class="control-label " for="example-chosen">Type de document<span class="text-danger">*</span></label>
                        <select id="type_document"  name="type_document" class="select-select2"  data-placeholder="Type_document" style="width: 100%;" required>
                            <option></option>
                           @foreach ($projet_piecejointes_evaluations as $projet_piecejointes_evaluation)
                            <option value="{{ $projet_piecejointes_evaluation->id}}"
                                >{{ getlibelle($projet_piecejointes_evaluation->id)}}</option>
                           @endforeach
                        </select> 
                </div>
                <div class="col-md-7">
                    <div class="form-group{{ $errors->has('document_joint') ? ' has-error' : '' }}">
                        <label class="control-label" for="document_joint">Joindre le document <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="document_joint" id="" accept=".pdf, .jpeg, .png"   placeholder="Charger la grille d'évaluation" required>
                        @if ($errors->has('document_joint'))
                            <span class="help-block">
                                <strong>{{ $errors->first('document_joint') }}</strong>
                            </span>
                            @endif
                    </div>
                </div> --}}
            </div>
            <div class="row">
                    
            </div>
            </div>
                 
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <a href="#" class="btn btn-sm btn-warning"  data-dismiss="modal"><i class="fa fa-repeat"></i> Annuler</a>
                        <button type="submit" class="btn btn-sm btn-success " ><i class="fa fa-arrow-right"></i> Valider</button>
                    </div>
                </div>
            </form>      
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-import-realisation" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Importer les realisations</h2>
            </div>
            <div class="modal-body">
                <p>Sélectionnez un fichier Excel (.xlsx) pour importer les réalisations.<br><strong>Les colonnes : </strong></p>
                <form method="POST" action="{{ route('realisation.import') }}" enctype="multipart/form-data" >
                    @csrf
                    <input type="file" name="fichier" required>
                    <button type="submit" >Importer</button>
                </form>   
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
@endsection

<script>
    function getprojet(valeur){
       $('.projet_id').val(valeur);
    }
    function delConfirm(id){
            //alert(id);
            document.getElementById("id_table").setAttribute("value", id);

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

