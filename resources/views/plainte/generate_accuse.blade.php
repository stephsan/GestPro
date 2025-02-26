@extends('layouts.frontend')
@section('content')
<div class="row">
  <div style="border:solid 1px black; margin-left:20%; margin-top:20px;" class="col-md-8" >
      <div class="row" style="border-bottom: solid 1px black; text-align:center; padding-top:10px;">
          <h2>Générer l'accusé d'enregistrement de votre plainte</h2>

      </div>
      <div class="row" style="font-size:22px; text-align:justify; padding:20px; color:rgb(48, 50, 48)">
          <p style="color: red;   ">Votre plainte a été enregistrée sous le numéro {{ $plainte->num_plainte }} </p>
          
      </div>
      <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <a class="btn btn-warning elementor-button" href="{{ route('index') }}">Terminer</a>
            <a class="btn btn-success elementor-button" href="{{ route('plainte.generate_accuse',$plainte) }}">Génerer votre accusé</a>
        </div>
    </div>
      
 
  </div>
</div>
 
@endsection
@section('modal')

<div id="modal-create-plainte"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="padding:15px;">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title"><i class="fa fa-print" ></i> Enregistrer une plainte</h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
          </div>
        <div class="modal-body">
          <div class="row">
            <div style="border:solid 1px black; margin-left:15%; margin-top:20px;" class="col-md-9" >
                <div class="row" style="border-bottom: solid 1px black; text-align:center; padding-top:10px;">
                    <h2>Informations Importantes sur la Gestion des Plaintes</h2>
        
                </div>
                <div class="row" style="font-size:22px; text-align:justify; padding:20px; color:rgb(48, 50, 48)">
                    <p style="color: red;   ">Les plaintes liées aux allégations d’exploitations sexuelles, abus sexuels, harcèlements sexuels (EAS/HS) et violence contre les enfants ne sont pas recevables via ce canal. Prière de contacter le projet ECOTEC au numéro vert 80 00 13 67.</p>
                    <p>Le formulaire est conçu pour l’enregistrement des plaintes, doléances, propositions, demande d’information en lien avec le projet ECOTEC. Les types de plaintes recevables via ce canal sont les suivants : </p>
                    <p style="padding-left:45px;">
                      <span style="font-weight: bold; ">-	Les demande d’informations ou doléances :</span> critères d’éligibilité au programme entreprendre et au fonds de partenariat, processus de sélection, composition des dossiers, opportunités offertes par le projet, demandes d’aide, etc.
                    </p>
                    <p style="padding-left:45px;">
                      <span style="font-weight: bold; ">- Plaintes ou réclamations liées à la gestion environnementale et sociale du projet : </span> non-respect des mesures environnementales et sociales par les promoteurs et les entreprises des travaux ; conflits de propriété, etc. 
                     </p>
                     <p style="padding-left:45px;">
                      <span style="font-weight: bold; ">-	Plaintes liées aux travaux de génie civil et prestations : </span> qualité des travaux, non-respect des clauses contractuelles, mauvais comportement des travailleurs des entreprises, des sous-traitants, plainte sur le processus de sélection des bénéficiaires et le traitement administratif des dossiers ; non-respect des us et coutumes, dommages matériels sur les biens et les personnes occasionnés durant les travaux, etc.  
                     </p>
                </div>
                  <a class="btn btn-danger elementor-button" style="margin-left:40%"   data-toggle="modal" data-target="#modal-create-plainte" href="#">ENREGISTRER LA PLAINTE</a>
        
            </div>
        </div>
    </div>
       
      </div>
  </div>
</div>

@endsection

@section('modal')




@endsection
