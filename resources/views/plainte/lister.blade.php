@extends('./layouts/base')
@section('title')
@section($type, 'show')
@section($statut, 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Plaintes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Plaintes</li>
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
<table class="table liste ">
            <thead>
                <tr>
                    <th class="text-center">N</th>
                    <th class="text-center">Numéro de la plainte</th>
                    <th class="text-center">Nom & prenom du plaignant</th>
                    <th class="text-center">Sexe </th>
                    <th class="text-center">Localités </th>
                    <th class="text-center">Contacts </th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tbadys">
                @php
                  $i=0;
                @endphp
                @foreach ($plaintes as $plainte)
                        @php
                           $i++;
                        @endphp
                    <tr>
                        <td class="text-center" style="width: 10%">{{ $i }}</td>
                        <td class="text-center">{{ $plainte->num_plainte }} </td>
                        <td class="text-center">{{ $plainte->nom }} {{ $plainte->prenom }} </td>
                        <td class="text-center">
                            @empty($plainte->sexe)
                                        Informations non disponible
                                    @endempty
                                    @if($plainte->sexe==1)
                                        Masculin
                                    @else
                                        Féminin
                                    @endif
                        </td>
                        <td class="text-center">{{ $plainte->telephone }} / {{ $plainte->email }} </td>
                        <td class="text-center">{{ getlibelle($plainte->region) }}/{{ getlibelle($plainte->province) }} / {{ getlibelle($plainte->commune) }} / {{ getlibelle($plainte->secteur_village) }}</td>
                        <td class="text-center">
                        @can('visualiser_une_plainte', Auth::user())
                            <div class="btn-group">
                                <a href="{{ route('plainte.details', $plainte)}}?type_detail=visualiser" data-toggle="tooltip" title="Details" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                            </div>
                        @endcan
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

