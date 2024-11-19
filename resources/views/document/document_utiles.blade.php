@extends('layouts.frontend')
@section('document','active')
@section('content')
        <div class="section-title">
            <h3>Liste des documents utiles a télécharger</h3>
        </div>
      <div class="block">
     
        <div class="row table-responsive">
            <table id='document'>
                <thead>
                    <tr>
                        <th>Categorie</th>
                        <th>Titre</th>
                        <th>Telecharger</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docs as $doc )
                        <tr>
                            <td>{{ getlibelle($doc->categorie_id) }}</td>
                            <td class="titre_doc">{{ $doc->titre }}</td>
                            <td>
                                <a href="{{ route('telechargerdocument',$doc)}}"title="télécharger" class="btn btn-md btn-success"  target="_blank"><i class="fa fa-download"></i> </a>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
                
            </table>
        </div>
        </div>
        <!-- END Progress Bar Wizard Content -->
@endsection