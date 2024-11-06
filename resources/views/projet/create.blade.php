@extends('./layouts/beneficiary_page')
@section('title')
@endsection
@section('css')
@endsection
@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="progress-wizard" action="{{ route('projet.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div id="progress-first" class="step">
                              <center><h3>Identification du projet</h3></center>
                                
                            <div class="row" style="margin-left: 2%">
                                
                                <div class="form-group col-md-4">
                                    <label class=" control-label" for="example-chosen">Selectionner le coach<span class="text-danger">*</span></label>
                                        <select id="region" name="banque_choisi"  value="{{old("region_promoteur")}}"  class="form-control select-select2"  data-placeholder="Selectionner la banque partenaire locale .." style="width: 80%;" required>
                                            <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                            @foreach ($coachs as $coach )
                                                    <option value="{{ $coach->id  }}" {{ old('banque_choisi') == $coach->id ? 'selected' : '' }}>{{ $coach->nom }}  {{ $coach->prenom }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label" for="example-username">Titre du projet</label>
                                            <input type="text" id="region" name="titre_du_projet" class="form-control" placeholder="Renseigner le titre du projet ..." required>
                                    </div>
                                    @if ($errors->has('entreprise'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('entreprise') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                {{-- <div class="form-group col-md-6">
                                    <label class=" control-label" for="example-chosen">Selectionner votre banque partenaire locale<span class="text-danger">*</span></label>
                                        <select id="region" name="banque_choisi"  value="{{old("region_promoteur")}}"  class="form-control select-select2"  data-placeholder="Selectionner la banque partenaire locale .." style="width: 80%;" required>
                                            <option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                            @foreach ($banques as $banque )
                                                    <option value="{{ $banque->id  }}" {{ old('banque_choisi') == $banque->id ? 'selected' : '' }}>{{ $banque->nom }}</option>
                                            @endforeach
                                        </select>
                                </div> --}}
                            </div>  
                            <div class="row">
                                <div class="col-md-5" style="margin-left:10px;">
                                    <div class="form-group">
                                        <label class=" control-label" for="example-bio">Objectifs du projet</label>
                                            <textarea id="example-progress-bio" name="objectifs" rows="5" maxlength="500" class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-email">Activités menées</label>
                                        <textarea id="example-progress-bio" name="activite_menee" rows="5"  maxlength="500"  class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-left:10px;">
                                    <div class="form-group">
                                        <label class=" control-label" for="example-bio">Atouts du promoteur ou de l’entreprise</label>
                                            <textarea id="example-progress-bio" name="atouts_entreprise" rows="5"  maxlength="500"  class="form-control" placeholder="De quels atouts que l’entreprise dispose pour conduire le projet (Qualification du personnel, expérience, niveau d’investissement disponible, surface financière, etc.) ? Quels sont ses forces ?  " required></textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-email">Caractère innovant du projet (produit ou technologie)  </label>
                                        <textarea id="example-progress-bio" name="innovations_apportes" rows="5" class="form-control"  maxlength="500"  placeholder="Qu’apportez-vous de nouveau avec ce projet ? En quoi est-il innovant ? " required></textarea>
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div id="progress-second" class="step">
                                <h2>Details du projet</h2>
                                
                            <div class="row">
                                <div class="col-md-5" style="margin-left:10px;">
                                    <div class="form-group">
                                        <label class=" control-label" for="example-bio">Objectifs du projet</label>
                                            <textarea id="example-progress-bio" name="objectifs" rows="5" maxlength="500" class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-email">Activités menées</label>
                                        <textarea id="example-progress-bio" name="activite_menee" rows="5"  maxlength="500"  class="form-control" placeholder="Décrire les activités du projet.." required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-left:10px;">
                                    <div class="form-group">
                                        <label class=" control-label" for="example-bio">Atouts du promoteur ou de l’entreprise</label>
                                            <textarea id="example-progress-bio" name="atouts_entreprise" rows="5"  maxlength="500"  class="form-control" placeholder="De quels atouts que l’entreprise dispose pour conduire le projet (Qualification du personnel, expérience, niveau d’investissement disponible, surface financière, etc.) ? Quels sont ses forces ?  " required></textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label" for="example-email">Caractère innovant du projet (produit ou technologie)  </label>
                                        <textarea id="example-progress-bio" name="innovations_apportes" rows="5" class="form-control"  maxlength="500"  placeholder="Qu’apportez-vous de nouveau avec ce projet ? En quoi est-il innovant ? " required></textarea>
                                    </div>
                                </div>
                            </div>
                            <h3>Plan  d'investissement de la premiere phase du projet</h3>
                            <div class="row" style="text-weight:bold;">
                                <span class="col-md-2">Categorie</span>
                                <span class="col-md-3">Coût</span>
                                <span class="col-md-3">Subvention</span>
                                <span class="col-md-3">Contrepartie</span>
                            </div>
                            <div class="field_wrapper2">
                                <div >
                                    <select class="col-md-2" name="designation[]"  class="select-select2" data-placeholder="designation" required>
                                            <option></option>
                                            @foreach ($categorie_investissments as  $categorie_investissment)
                                                <option value='{{ $categorie_investissment->id}}'>{{ getlibelle($categorie_investissment->id) }}</option>
                                            @endforeach
                                    </select> 
                                    <input class="col-md-3" type="text" name="cout[]"  value=""  placeholder="Le prix" id="cout0"  required />
                                    <input class="col-md-3" type="text" name="subvention[]"  value="" placeholder="Subvention demandée" id="sub0" required onChange="deux_somme_complementaire('sub0','apport0','cout0')"  />
                                    <input class="col-md-3" type="text" name="apport_perso[]" value=""  placeholder="Apport personne" id="apport0" required />
                                    <a href="javascript:void(0);" class="add_button2" title="Add field"><span><i class="fa fa-plus"></i></span></a>
                                </div>
                            </div>
                            <br>
                           
                            </div>
                            <div id="progress-third" class="step">
                                <div class="col-md-12">
                                    <h2>Joindre les documents</h2>
                                    <div class="form-group{{ $errors->has('plan_de_continute') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-4" for="plan_de_continute">Plan de Continuité des Activités  <span class="text-danger">*</span></label>
                                        <div class="input-group col-md-6">
                                            <input class="form-control col-md-6" type="file" name="plan_de_continute" id="plan_de_continute" accept=".pdf, .jpeg, .png"   placeholder="Joindre le plan de continuité des activité" required  onchange="VerifyUploadSizeIsOK('plan_de_continute');" >
                                            <span class="input-group-addon"><i class="gi gi-file"></i></span>
                                            <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('plan_de_continute')">Vider le champ</a></span>
                                        </div>
                                        @if ($errors->has('plan_de_continute'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('plan_de_continute') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('synthese_plan_de_continute') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-4" for="synthese_plan_de_continute">Synthèse du plan de continuité  <span class="text-danger">*</span></label>
                                        <div class="input-group col-md-6">
                                            <input class="form-control col-md-6" type="file" name="synthese_plan_de_continute" id="synthese_plan_de_continute" accept=".pdf, .jpeg, .png"   placeholder="Joindre la synthèse du plan de continuité des activité" required onchange="VerifyUploadSizeIsOK('synthese_plan_de_continute');">
                                            <span class="input-group-addon"><i class="gi gi-file"></i></span>
                                            <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('synthese_plan_de_continute')">Vider le champ</a></span>
                                        </div>
                                        @if ($errors->has('synthese_plan_de_continute'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('synthese_plan_de_continute') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('devis_des_investissements') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-4" for="devis_des_investissements">Devis des équipements et matériels à acquérir  <span class="text-success">*</span></label>
                                        <div class="input-group col-md-6">
                                            <input class="form-control col-md-6" type="file" name="devis_des_investissements" id="devis_des_investissements" accept=".pdf, .jpeg, .png"   placeholder="Joindre le dévis des équipements du plan d'investissement" onchange="VerifyUploadSizeIsOK('devis_des_investissements');" >
                                            <span class="input-group-addon"><i class="gi gi-file"></i></span>
                                            <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('devis_des_investissements')">Vider le champ</a></span>
                                        </div>
                                        @if ($errors->has('devis_des_investissements'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('devis_des_investissements') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('copie_document_foncier') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-4" for="copie_document_foncier">Copie PUH, titre foncier ou tout document foncier   <span class="text-success">*</span></label>
                                        <div class="input-group col-md-6">
                                            <input class="form-control col-md-6" type="file" name="copie_document_foncier" id="copie_document_foncier" accept=".pdf, .jpeg, .png"   placeholder="joindre une copie du document foncier si vous souhaiter faire un investissement de type construction" onchange="VerifyUploadSizeIsOK('copie_document_foncier');">
                                            <span class="input-group-addon"><i class="gi gi-file"></i></span>
                                            <span class="input-group-addon">
                                            <a href="#" class="empty_field" onclick="empty_input_file('copie_document_foncier')">
                                                Vider le champ
                                              </a></span>
                                           
                                        </div>
                                        @if ($errors->has('copie_document_foncier'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('copie_document_foncier') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('attestation_de_formation') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-4" for="attestation_de_formation">Joindre une copie de l'attestation de formation  <span class="text-danger">*</span></label>
                                        <div class="input-group col-md-6">
                                            <input class="form-control col-md-6" type="file" name="attestation_de_formation" id="attestation_de_formation" accept=".pdf, .jpeg, .png"   placeholder="Joindre une copie de l'attestation de formation BRAVE WOMEN"  onchange="VerifyUploadSizeIsOK('attestation_de_formation');" required>
                                            <span class="input-group-addon"><i class="gi gi-file"></i></span>
                                            <span class="input-group-addon"><a href="#" class="empty_field" onclick="empty_input_file('attestation_de_formation')">Vider le champ</a></span>
                                        </div>
                                        @if ($errors->has('attestation_de_formation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('attestation_de_formation') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <!-- END Third Step -->
                    
                            <!-- Form Buttons -->
                            <div class="form-group form-actions button_formulaire">
                                <div class="col-md-8 col-md-offset-4">
                                    <input type="reset" class="btn btn-sm btn-warning" id="back3" value="Back">
                                    <input id='tester' type="submit" class="btn btn-sm btn-success " id="next3" value="Next">
                                </div>
                            </div>
                            <!-- END Form Buttons -->
                        </form>
</div>
</div></div></div></section>
@endsection
@section('modal_part')

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
   // alert('okok');
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    //var fieldHTML = '<div><label for="">Ligne dinvestissement:</label> <select  name="designation[]" data-placeholder="designation" > <option></option> @foreach ($categorie_investissments as  $categorie_investissment)<option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id) }}</option>@endforeach </select> <input type="number" name="cout[]"  placeholder="cout" min="1000" required/> <input type="number" name="subvention[]"  min="1000" placeholder="Subvention demandée"  required/> <input type="number" name="apport_perso[]"  min="1000" placeholder="Apport personne" required />   <a href="javascript:void(0);" class="remove_button"><span> <i class="fa fa-minus"></i></a></div>';
    //var fieldHTML2 = '<div><input type="text" name="field_name1[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html
    var x = 0; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
       // alert('add');
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            var desi="desi"+x;
            var cout='cout'+x ;
            var fieldHTML = '<br><div> <select class="col-md-2"  name="designation[]"  data-placeholder="designation" > <option></option> @foreach ($categorie_investissments as  $categorie_investissment)<option value="{{ $categorie_investissment->id}}">{{ getlibelle($categorie_investissment->id) }}</option>@endforeach </select> <input class="col-md-3" type="text" name="cout[]"  placeholder="cout"  id="' + cout + '"  required/> <input  class="col-md-3" type="text" name="subvention[]"  placeholder="Subvention demandée" id="sub' + x +'"  onChange=deux_somme_complementaire("sub' + x +'","apport' + x +'","' + cout + '")  required/> <input class="col-md-3" type="text" name="apport_perso[]"   placeholder="Apport personne" id="apport' + x +'"   required />   <a href="javascript:void(0);" class="remove_button"><span> <i class="fa fa-minus"></i></a></div>';
            $(wrapper2).append(fieldHTML);
           
        }
    });
   // alert($('#cout1').val());
    $('#cout1').change(function(){
alert("The text has been changed.");
}); 
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script>
    function deux_somme_complementaire(montant1, montant2, somme){
    var valmontant1= $("#"+montant1).val();
    var valsomme= $("#"+somme).val();
    if(valsomme/2 != valmontant1 ){
      $("#tester").prop('disabled', true);
      alert("Attention le montant de la subvention ne doit pas être supérieur au coût du projet et la subvention doit être la moitié du coût total!!!");
      $("#"+montant1).val(' ');
      $("#"+somme).val(' ');
      $("#"+montant2).val(' ');
    }
    else{
       $("#tester").prop('disabled', false);
          var restant= valsomme - valmontant1;
          $("#"+montant2).val(restant);
          format_montant(montant2);
          format_montant(montant1);
          format_montant(somme);
    }
 
  }
</script>
@endsection
    


