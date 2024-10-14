<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="{{public_path('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Synthese du dossier du comité</title>

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
        <div class="entete" style="margin-top:70px;"> Dossier de séance du comité<hr> </div>
        <div class="contenu">
            <table>
                <tr style="padding-top: 50px;">
                    <td style="width: 400px; border:1px solid black">Promoteur : {{ $preprojet->promoteur->nom }}  {{ $preprojet->promoteur->prenom }}</td>
                    <td style="width: 300px; border:1px solid black">Contacts : {{ $preprojet->promoteur->telephone_promoteur }} / {{ $preprojet->promoteur->mobile_promoteur }}</td>
                </tr>
            </table>
            <table>
                <tr >
                    <td style="width: 703px; border:1px solid black">Titre du projet : {{ $preprojet->titre_projet }} </td>

                </tr>
                <tr >
                    <td style="width: 703px; border:1px solid black">Resumé du projet : {{ $preprojet->description }} </td>

                </tr>
            </table>
            <table>
                <tr>
                
                </tr>
            </table>
            <table>
                <tr >
                    <td style="width: 350px; border:1px solid black">Secteur d'activité : {{ getlibelle($preprojet->secteur_dactivite) }}  </td>
                    <td style="width: 350px; border:1px solid black">Maillon d'activité : {{ getlibelle($preprojet->maillon_dactivite) }} </td>
                </tr>
            </table>
            <table>
                <tr >
                    <td style="width: 173px; border:1px solid black">Région : {{ getlibelle($preprojet->region) }}  </td>
                    <td style="width: 173px; border:1px solid black">Province : {{ getlibelle($preprojet->province) }} </td>
                    <td style="width: 174px; border:1px solid black">Commune : {{ getlibelle($preprojet->commune) }} </td>
                    <td style="width: 174px; border:1px solid black">Secteur/Village : {{ getlibelle($preprojet->secteur_village) }} </td>
                </tr>
            </table>
            <table>
                <tr >
                    <td style="width: 299px; border:1px solid black; color:red">Dossier N : {{ $preprojet->num_projet }}  </td>
                    <td style="width: 401px; border:1px solid black">Guichet du projet : {{ getlibelle($preprojet->guichet) }} </td>
                </tr>
            </table>
            <table>
                <tr >
                    <td style="width: 300px; border:1px solid black;">Coût total du projet : {{ format_prix($preprojet->cout_total) }}  </td>
                    <td style="width: 200px; border:1px solid black">Subvention ECOTEC/Guichet FP : <br> {{ format_prix($preprojet->apport_personnel) }} </td>
                    <td style="width: 197px; border:1px solid black">Contribution du promoteur : <br> {{ format_prix($preprojet->subvention_souhaite) }} </td>

                </tr>
            </table>
            
            <table>
                <tr >
                    <td style="width: 350px; border:1px solid black;">Crédit IFP :  {{ format_prix($preprojet->autre_financement) }}  </td>
                    <td style="width: 350px; border:1px solid black">Autre source de financement : <br> </td>

                </tr>
            </table>
            <table style="margin-top:20px;">
                <thead style="border: 1px solid black; background-color:rgb(9, 195, 133)">
                    <th>N</th>
                    <th>Critères</th>
                    <th>Barème</th>
                    <th>Note obtenue</th>
                </thead>
                @php
                    $i=0;
                @endphp
                @foreach ($evaluations as $evaluation)
                    @php
                        $i+=1;
                    @endphp
                    <tr >
                        <td style="width: 53px; border:1px solid black">{{ $i }}</td>
                        <td style="width: 535px; border:1px solid black;">{{ $evaluation->critere->libelle }}  </td>
                        <td style="width: 53px; border:1px solid black; text-align:center">{{ $evaluation->critere->ponderation }} </td>
                        <td style="width: 80px; border:1px solid black; text-align:center">{{ $evaluation->note }} </td>
                    </tr>
                @endforeach
            </table>
            <table>
                <tr style="background-color:rgb(9, 195, 133)">
                    <td  style="width: 593px; border:1px solid black; text-align:center;">TOTAL GENERAL</td>
                    <td  style="width: 135px; border:1px solid black; text-align:center;">{{ $preprojet->note_totale }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td  style="width: 493px; border:1px solid black; text-align:center;">Avis de l’équipe du Fonds de Partenariat</td>
                    <td  style="width: 235px; border:1px solid black; text-align:center;">{{ $preprojet->avis_de_lequipe }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td  style="width: 393px; border:1px solid black; text-align:center;">Commentaire de l'équipe de Fonds de Partenariat : {{ $preprojet->commentaires_de_lequipe }}</td>
                    <td  style="width: 335px; border:1px solid black; text-align:center;">Date, Signature et cachet du Fonds de Partenariat /Projet ECOTEC <br> <br> <br> <br> <br> <br> <br></td>
                </tr>
                <tr>
                    <td  style="width: 393px; border:1px solid black; text-align:center;">Avis du Comité de sélection :</td>
                    <td  style="width: 335px; border:1px solid black; text-align:center;"> {{ $preprojet->decision_du_comite }}</td>
                </tr>
                <tr>
                    <td  style="width: 393px; border:1px solid black; text-align:center;">Observations/instructions du Comité de sélection : <br> {{ $preprojet->commentaire_du_comite }}</td>
                    <td  style="width: 335px; border:1px solid black; text-align:center;"> Date, Signature et cachet du Président du Comité de sélection ECOTEC <br> <br> <br> <br> <br> <br> <br>
                    </td>
                </tr>
            </table>
        </div>
</body>
</html>

