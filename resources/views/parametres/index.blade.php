@extends('./layouts/base')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Administration</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Administration</li>
                <li class="breadcrumb-item active text-dark">parametres</li>
            </ol>
        </nav>

        <nav>
            <button type="button" class="btn btn-success">
                <a href="{{route('parametres.create')}}" class="text-white">
                    <i class="bi bi-plus-square"></i> Nouveau
                </a>
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
    <table class="table datatable">
            <thead>
                <tr>
                    <th class="text-center">Numéro</th>
                    <th class="text-center">libelle</th>
                    <th class="text-center" >Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                  $i=0;
                @endphp
                @foreach ($parametres as $parametre)
                        @php
                           $i++;
                        @endphp
                    <tr>
                        <td class="text-center" style="width: 10%">{{ $i }}</td>
                        <td class="text-center">{{ $parametre->libelle }} </td>
                        <td class="text-center">{{ $parametre->description }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('parametres.edit',$parametre) }}" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                <a  href="#modal-confirm-delete" onclick="delConfirm({{ $parametre->id }});" data-toggle="modal" title="Supprimer" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
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
    function supp_id(){
            var id= $("#id_table").val();

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
    }
    </script>

