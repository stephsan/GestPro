<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="{{public_path('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Accusé d'enregistrement de plainte</title>

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
        <div class="entete" style="margin-top:100px;"> Accusé d'enregistrement de plainte <hr> </div>
        <p class="contenu"><strong> Numero de plainte : </strong></p> <p class="contenu" > {{ $plainte->num_plainte }} </p> <br>
        <p class="contenu"><strong> Nom & prénom du plaignant : </strong></p> <p class="contenu" > {{ $plainte->nom }} {{ $plainte->prenom }} </p> <br>
        <p class="contenu"> <strong>Date d'enregistrement : </strong></p> <p class="contenu" > {{ $plainte->created_at }}</p> <br>
        <p>Votre plainte a été enregistrée avec succès. Elle sera traitée par les gestionnaires des plaintes qui vous contacteront pour la suite à donner.</p> <br>
        <p>En cas de besoin, veuillez contacter le numéro vert 80 00 13 67.</p> <br>

        <img src="data:image/png;base64, {!! $qrcode !!}">
</body>
</html>

