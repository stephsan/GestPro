<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Callbacks</title>
  <link rel="stylesheet" href="{{asset('wizard/dist/jquery-steps.css')}}">
  <!-- Demo stylesheet -->
  <link rel="stylesheet" href="{{asset('wizard/css/style.css')}}">
</head>
<body>

  <div class="step-app" id="demo">
    <ul class="step-steps">
      <li data-step-target="step1">Identification</li>
      <li data-step-target="step2">Projet</li>
      <li data-step-target="step3">Coût</li>
      <li data-step-target="step4">Step 4</li>
      <li data-step-target="step5">Step 5</li>
    </ul>
    <div class="step-content">
      <div class="step-tab-panel" data-step="step1">
      <div class="col-lg-6">
                <!-- <h3> Identification</h3> -->
                                <div class="form-group">
                                    <label class="control-label" for="val_username">Nomhh(<span class="text-danger">*</span>)</label>
                                        <div class="input-group">
                                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom.." required>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="val_username">Prenom (<span class="text-danger">*</span>)</label>
                                        <div class="input-group">
                                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Votre prenom.." required>
                                            <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                        </div>
                                </div>
            </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Etablissement fréquenté (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <input type="text" id="etablissement" name="etablissement" class="form-control" placeholder="Votre établissement.." required>
                                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Classe (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <!-- <input type="text" id="classe" name="classe" class="form-control" placeholder="Votre classe.." required> -->
                                                <select name="classe" id="sexe" class="form-control" required>
											<option value="">Choisir</option>
											<option value="CP1">CP1</option>
											<option value="CP2">CP2</option>
                                            <option value="CE1">CE1</option>
											<option value="CE2">CE2</option>

											</select>
                                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                            </div>
                                    </div> 
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="val_username">Date de naissance (<span class="text-danger">*</span>)</label>
                                            <div class="input-group">
                                                <input type="date" id="date_naissance" min="2008-01-01" max="2014-12-31" name="date_naissance" class="form-control" required>
                                                <span class="input-group-addon"><i class="gi gi-calendar"></i></span>
                                            </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-label" for="val_skill">Sexe (<span class="text-danger">*</span>)</label>
                                            <select id="sexe" name="sexe" class="form-control" required>
                                                <option value=""></option>
                                                <option value="M">Masculin</option>
                                                <option value="F">Feminin</option>
                                            </select>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">L'enfant a t-il dejà participé à la colonie? (<span class="text-danger">*</span>)</label>
                                            <select id="niveau" name="niveau" class="form-control"  title="Le champs est obligatoire" required>
                                                <option value=""></option>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                    </div> 
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Région (<span class="text-danger">*</span>)</label>
                                            <select id="region" name="region" class="form-control"  title="Le champs region est obligatoire"  value="{{old("region")}}" onchange="changeValue('region', 'province', {{ env('PARAMETRE_ID_PROVINCE') }});" required>
                                            <option value="">Choisir</option>
                                                
                                            </select>
                                    </div> 
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Province (<span class="text-danger">*</span>)</label>
                                            <select id="province" name="province" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .."  onchange="changeValue('province', 'commune', {{ env('PARAMETRE_ID_COMMUNE') }});" required>
                                            <option value="">Choisir</option>
                                               
                                            </select>
                                    </div> 
                                    <!-- <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Comune (<span class="text-danger">*</span>)</label>
                                            <select id="commune" name="commune" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .." onchange="changeValue('commune', 'arrondissement', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" required>
                                            <option value="">Choisir</option>
                                            
                                            </select>
                                    </div> -->
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                
                                        <label class="form-label" for="val_skill">Commune (<span class="text-danger">*</span>)</label>
                                            <select id="commune" name="commune" class="form-control"  title="Le champs region est obligatoire" data-placeholder="Choisir votre residence .." onchange="changeValue('commune', 'arrondissement', {{ env('PARAMETRE_ID_ARRONDISSEMENT') }});" required>
                                            <option value="">Choisir</option>
                                           
                                            </select>
                                    </div>
                                    
                                </div>
      </div>
      <div class="step-tab-panel" data-step="step2">
        <h3>Tab2</h3>
        <form name="frmInfo" id="frmInfo">
          First name:<br>
          <input type="text" name="txtFirstName" required>
          <br> Last name:<br>
          <input type="text" name="txtLastName" required>
        </form>
      </div>
      <div class="step-tab-panel" data-step="step3">
        <h3>Tab3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus facere porro iste quas numquam officia totam facilis suscipit, expedita rem quod, fugiat quo, veniam voluptate ut autem quia qui amet necessitatibus perferendis dignissimos ipsa doloremque. Necessitatibus delectus voluptatem unde. Architecto animi unde nostrum tenetur, doloremque distinctio, porro officiis dicta similique omnis quos odit ducimus minima ea quas facilis quod. Natus adipisci consequuntur sapiente alias culpa fugit tenetur, doloribus? Magni ipsum dolor debitis beatae quo, dicta voluptas veritatis, quos. Iusto quisquam doloribus laboriosam esse, dicta, odio facilis eligendi explicabo sequi accusamus a iste minus alias. Nisi sed laborum, aut maiores beatae aliquam voluptatum est enim impedit delectus blanditiis, neque sint nemo deleniti a quaerat voluptatem harum! Laboriosam assumenda, ullam iure. Corrupti maxime perferendis facilis ipsum, eius excepturi commodi consectetur, velit nobis reiciendis, ipsam! Maiores possimus tempore vel doloremque in facilis qui quos molestias. Culpa eius magnam repellat, ad eaque. Possimus, voluptatem.</p>
      </div>
      <div class="step-tab-panel" data-step="step4">
        <h3>Tab4</h3>
        <form name="frmLogin" id="frmLogin">
          Email address:<br>
          <input type="text" name="txtEmail" required>
          <br> Password:<br>
          <input type="text" name="txtPassword" required>
        </form>
      </div>
      <div class="step-tab-panel" data-step="step5">
        <h3>Tab5</h3>
        <form name="frmMobile" id="frmMobile">
          Mobile No:<br>
          <input type="text" name="txtMobileNum" required>
        </form>
      </div>
    </div>
    <div class="step-footer">
      <button data-step-action="prev" class="step-btn">Previous</button>
      <button data-step-action="next" class="step-btn">Next</button>
      <button data-step-action="finish" class="step-btn">Finish</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="{{asset('wizard/dist/jquery-steps.js')}}"></script>
  <script>
    var frmInfo = $('#frmInfo');
    var frmInfoValidator = frmInfo.validate();

    var frmLogin = $('#frmLogin');
    var frmLoginValidator = frmLogin.validate();

    var frmMobile = $('#frmMobile');
    var frmMobileValidator = frmMobile.validate();

    $('#demo').steps({
      onChange: function (currentIndex, newIndex, stepDirection) {
        // step2
        if (currentIndex === 1) {
          if (stepDirection === 'forward') {
            return frmInfo.valid();
          }
          if (stepDirection === 'backward') {
            frmInfoValidator.resetForm();
          }
        }
        // step4
        if (currentIndex === 3) {
          if (stepDirection === 'forward') {
            return frmLogin.valid();
          }
          if (stepDirection === 'backward') {
            frmLoginValidator.resetForm();
          }
        }
        // step5
        if (currentIndex === 4) {
          if (stepDirection === 'forward') {
            return frmMobile.valid();
          }
          if (stepDirection === 'backward') {
            frmMobileValidator.resetForm();
          }
        }
        return true;
      },
      onFinish: function () {
        alert('Wizard Completed');
      }
    });
  </script>
</body>
</html>
