<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="{{public_path('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Recépissé</title>

    <style type="text/css">
    body{
        font-family: "Times New Roman", Times, serif;
        font-size: 14px;
    }
        .enteteGauche{
            float: left;
            width: 40%;
            text-align: center;
        }
        .entetedroite{
            float: right;
            width: 40%;
            text-align: center;
        }
        .entete{
            margin-top:90px;
            text-align: center;
            color:rgb(10, 138, 40);
            font-weight: blod;
            margin-bottom: 55px;
        }
        .titre{
            position:relative;
            margin-left:20px;
            width:50%;
            border:solid 2px black;
            padding-right:10px;
            text-align:center;

        }
        .contenu{
            position:relative;
            margin-right:20px;
            width:40%;
            text-align:center;
            padding-left:10px;
            display:inline-block;
            text-align: left;

        }
    </style>
</head>
<body>

        {{-- <div class="enteteGauche" >MEBF <br> ----------- <br> Projet ECOTEC </div> --}}
        <img class="enteteGauche" src="{{ public_path('frontend/img/MEBF.jpg') }}" style="width: 80px; height: 80px; margin-right:10px;">
       <img class="entetedroite" src="{{ public_path('frontend/img/logo-ecotec.jpg') }}" style="width: 70px; height: 70px; ">
        {{-- <div class="enteteGauche"><img style="width: 130;" src="{{ public_path('frontend/img/logo-ecotec.jpg')}} " alt="Logo Burkina Textile"></div> --}}

        {{-- <div class="entetedroite">Burkina Faso <br> -----------  <br> Unité-Progres-Justice </div> --}}
        <div class="entete" style="margin-top:100px;"> Code promoteur {{ $promoteur->code_promoteur }} <hr> </div>
        <p class="contenu"><strong> Numero de dossier : </strong></p> <p class="contenu" > {{ $preprojet->num_projet }} </p> <br>
        <p class="contenu"><strong> Destinataire : </strong></p> <p class="contenu" > {{ $promoteur->nom }} {{ $promoteur->prenom }} </p> <br>
        <p class="contenu"> <strong>Numero d'identité : </strong></p> <p class="contenu" > {{ $promoteur->numero_identite }} du {{ $promoteur->date_etabli_identite }}</p> <br>
        <p class="contenu"><strong> Télephone du promoteur : </strong></p> <p class="contenu"> {{ $promoteur->telephone_promoteur }} / {{ $promoteur->mobile_promoteur }}</p> <br>
        <p class="contenu"> <strong>Email: </strong></p> <p class="contenu">{{ $promoteur->email_promoteur  }} </p> <br>
        <p class="contenu"><strong> Programme : </strong></p> <p class="contenu" > Fonds de Partenariat </p> <br>
        <p class="contenu"><strong> Guichet : </strong></p> <p class="contenu" > {{ getlibelle($preprojet->guichet) }}</p> <br>
        <p class="contenu"> <strong>Catégorie : </strong></p> <p class="contenu">
            @if($preprojet->entreprise_id ==null)
              Startup 
            @else
              MPME Existante
            @endif                                                                 
        </p> <br>
        <br> 
        <p>Promoteur a souscrit sur la plateforme du projet ECOTEC avec l'idée de projet<span style="font-weight: bold;"> {{ $preprojet->titre_projet }}</span> dans le domaine de <span style="font-weight: bold;">  {{ getlibelle($preprojet->secteur_dactivite) }}  </span> et le maillon <span style="font-weight: bold;"> {{ getlibelle($preprojet->maillon_dactivite) }} </span>.</span> </p> <br>
        <p><span style="width: 40%; float: right;">Fait le : <span style="font-weight: bold;">{{ date("d-m-Y") }}</span> </span></p> <br>
        <p style="font-size: x-small;  text-align: justify;">Ce récépissé constitue la preuve que le promoteur a pris connaissance des conditions d'interventions du fond de partenariat du projet ECOTEC auxquelles il souscrit entièrement notamment le processus de selection des bénéficiaires.</p>
        <p style="font-size: x-small;"> Pour toute information contactez nos antennes<br> NB: Ce récépissé constitue une preuve de depôt de dossier aux activités du projet ECOTEC.</p>
        {{-- <p style="margin-top: 60px">{{ $qrcode }}</p> --}}
        <img src="data:image/png;base64, {!! $qrcode !!}">
</body>
</html>

