@extends('./layouts/base')
@section('title')
@section($type, 'show')
@section($statut, 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Souscription</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">{{ $titre }}</li>
                <li class="breadcrumb-item active text-dark">Lister</li>
            </ol>
        </nav>

        <nav>
            <button type="button" class="btn btn-success">
                <a href="#modal-import-evaluation" data-toggle="modal"  data-toggle="tooltip" title="Importer les notes d'évaluation" class="text-white"><i class="bi bi-plus-square"></i> Importer les note d'évaluation</a>
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
<table class="table  liste">
            <thead>
                <tr >
                    <th class="text-center">Numéro</th>
                    <th class="text-center" >Guichet</th>
                    <th class="text-center">Nom & prenom </th>
                    <th class="text-center">Contact </th>
                    <th class="text-center">Numéro dossier</th>
                    <th class="text-center" >Titre du projet</th>
                    <th class="text-center" >Secteur d'activité</th>
                    <th class="text-center" >Maillon d'activite</th>
                    <th class="text-center" >Region du projet</th>
                    <th class="text-center" >Statut du dossier</th>
                    <th class="text-center" >Eligibilité</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $i=0;
                @endphp
                @foreach ($preprojets as $preprojet)
                        @php
                           $i++;
                        @endphp
                    <tr class="text-danger">
                        <td 
                        class="text-center" style="width: 10%">{{ $i }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->guichet) }}</td>
                        <td class="text-center">{{ $preprojet->promoteur->nom }} {{ $preprojet->promoteur->prenom }} </td>
                        <td class="text-center">{{ $preprojet->promoteur->telephone_promoteur }}/{{ $preprojet->promoteur->mobile_promoteur }}</td>
                        <td class="text-center">{{ $preprojet->num_projet }}</td>
                        <td 
                        @if($preprojet->statut=='evaluation_rejetee')
                            style="background-color: red"
                            @elseif($preprojet->statut=='evaluation_validee')
                                style="background-color: #497956"
                        @endif
                        class="text-center">{{ $preprojet->titre_projet }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->secteur_dactivite) }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->maillon_dactivite) }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->region) }}</td>
                        <td class="text-center">
                            @isset($preprojet->statut)
                                {{$preprojet->statut }}
                            @else
                                Soumis
                            @endisset</td>
                        <td class="text-center">
                            @isset($preprojet->eligible)
                                {{$preprojet->eligible }}
                            @else
                                Non définie
                            @endisset</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('preprojet.details', $preprojet) }}?type_detail=analyser" data-toggle="tooltip" title="Analyser l'avant projet" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                                @if($preprojet->statut=='affectes_au_comite_de_selection')
                                    <a href="{{ route('preprojet.generer_doc_synthese_comite', $preprojet) }}?type_detail=analyser" data-toggle="tooltip" title="Générer la synthese du comité de l'avant projet" class="btn btn-xs btn-default"><i class="fa fa-print"></i></a>
                                @endif
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
<div id="modal-import-evaluation" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Importer les notes de l'évaluation</h2>
            </div>
            <div class="modal-body">
                <p>Sélectionnez un fichier Excel (.xlsx) pour importer les notes d'évaluation.<br><strong>Les colonnes : </strong></p>
                <form method="POST" action="{{ route('excel.chargerEvaluation') }}" enctype="multipart/form-data" >
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

