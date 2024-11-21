@extends('./layouts/base')
@section('title')
@section('fp_mpme_existante', 'show')
@section('fp_enregistre', 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Souscription</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Liste des souscription au fonds de partenariat {{ $type }}</li>
                <li class="breadcrumb-item active text-dark">Lister</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
<div class="table-responsive">
<table class="table liste" >
            <thead>
                <tr class="text-danger">
                    <th class="text-center">Numéro</th>
                    <th class="text-center" >Guichet</th>
                    <th class="text-center">Nom & prenom </th>
                    <th class="text-center">Sexe </th>
                    <th class="text-center">Numéro dossier</th>
                    <th class="text-center">Contact </th>
                    <th class="text-center">Titre du projet</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Secteur d'activité</th>
                    <th class="text-center">Maillon d'activite</th>
                    <th class="text-center">Region du projet</th>
                    <th class="text-center">Cout total du projet</th>
                    <th class="text-center">Subvention Sollicitée</th>
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
                    <tr>
                        <td class="text-center" style="width: 10%">{{ $i }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->guichet) }}</td>
                        <td class="text-center">{{ $preprojet->promoteur->nom }} {{ $preprojet->promoteur->prenom }} </td>
                        <td class="text-center">
                            @empty($preprojet->promoteur->genre)
                                        Informations non disponible
                                    @endempty
                                    @if($preprojet->promoteur->genre==1)
                                        Féminin
                                    @else
                                        Masculin
                                    @endif
                        </td>
                        <td class="text-center">{{ $preprojet->promoteur->telephone_promoteur }}/{{ $preprojet->promoteur->mobile_promoteur }}</td>
                        <td class="text-center">{{ $preprojet->num_projet }}</td>
                        <td class="text-center">{{ $preprojet->titre_projet }}</td>
                        <td class="text-center">{{ $preprojet->note_totale }}</td>

                        <td class="text-center">{{ getlibelle($preprojet->secteur_dactivite) }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->maillon_dactivite) }}</td>
                        <td class="text-center">{{ getlibelle($preprojet->region) }}</td>
                        <td class="text-center">{{format_prix($preprojet->cout_total) }}</td>
                        <td class="text-center">{{ $preprojet->subvention_souhaite }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('preprojet.details', $preprojet) }}?type_detail=visualiser" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
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

