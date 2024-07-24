@extends("layouts.frontend")
@section('content')
@section('classfooter', 'footersearch')
<div class="block">
    @if(Session::has('success'))

    <div class="alert alert-success">

        {{Session::get('success')}}

    </div>

@endif

    <!-- Wizard with Validation Title -->
    <div class="block-title">
        <h2><strong>Enregistrement des données personnelles du promoteur </h2>
    </div>
    @if($promoteur->suscription_etape == 1)
        <p> Vous avez validé la prémière étape de la souscription.</p>
        <input type="hidden" name="entreprise" value="">
    @elseif($promoteur->suscription_etape == 2)
        <p> Vous avez validé la deuxième étape : l'enregistrement de votre entreprise</p>
    @else
        <p> Vous avez validé la troisième étape : l'enregistrement de votre idée de projet</p>
    @endif
         Votre code de suivi de la souscription est : {{ $promoteur->code_promoteur }}
         <p style="color: rgb(199, 38, 38)"> Bien vouloir garder ce code pour la suite. Ce code est envoyé dans votre boite mail. </p>
         <form action="{{ route("entreprise.creation") }}" method="post">
            @csrf
            <input type="hidden" name="promoteur_code" value="{{ $promoteur->code_promoteur }}">
             <input type="hidden" name="type_entreprise" value={{ $type_entreprise }}>
             <input type="hidden" name="programme" value={{ $programme }}>
                @if($promoteur->suscription_etape != 3)
                @if($promoteur->suscription_etape == 2)
                    <input type="hidden" name="entreprise" value="{{ $entreprise }}">
                    
                @endif
                   <input type="hidden" name="type_entreprise" value="{{ $type_entreprise }}">
                    <a href="#modal-complete-souscription" data-toggle="modal" class="btn btn-danger">Suspendre</a>
                   
                    <button type="submit" class="btn btn-success"> <span> <i class="hi hi-arrow-right"></i> </span> Poursuivre</button>
                {{-- @elseif($promoteur->suscription_etape != 3 &&  $type_entreprise=='startup')
                <form action="{{ route("entreprise.creation") }}" method="post">
                    @csrf
                    <a href="#modal-complete-souscription" data-toggle="modal" class="btn btn-danger">Suspendre</a>
                    <a href="{{ route('preprojet.creation') }}?code_promoteur={{ $promoteur->code_promoteur }}"  class="btn btn-success">Poursuivre</a> --}}
                @endif

                @if($promoteur->suscription_etape == 3)
                {{-- @if($nbre_ent_nn_traite >1 || $nbre_ent_nn_traite == 1 ) --}}
                    <p>Le Recépissé sera envoyé dans votre boite email.</p>
                    @if($programme=='FP')
                        <a href="{{ route("generer.recepisse", $promoteur) }}?programme=FP" class="btn btn-success">Generer le recépissé</a>
                    @elseif ($programme=='PE')
                        <a href="{{ route("generer.recepisse", $promoteur) }}?programme=PE" class="btn btn-success">Generer le recépissé</a>
                    @endif
                    
                    <hr>
                {{-- @endif --}}
                    {{-- @if($nbre_ent_nn_traite < 2 )
                    <a href="{{ route("secondEntreprise.store",$promoteur) }}" class="btn btn-warning">Souscrire à nouveau</a>
                    @endif --}}
                    <a href="{{ route("accueil") }}" class="btn btn-danger">Terminer</a>
                    @endif
                {{-- @if($promoteur->suscription_etape == 2)
                    <input type="hidden" name="entreprise" value="{{ $entreprise}}">
                @endif --}}
        </form>

</div>
@endsection
