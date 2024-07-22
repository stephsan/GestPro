 <!-- ======= Footer ======= -->
 <br><br>
 <footer id="footer">



<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-5 col-md-6 footer-contact">
        <h3>ECOTEC<span>.</span></h3>
        <p>
        132, Avenue de Lyon 11 BP 379 Ouagadougou 11 | Burkina Faso <br>
          <strong>Phone:</strong> +226 25 39 80 60<br>
          <strong>Email:</strong> info@me.bf<br>
        </p>
      </div>

      <div class="col-lg-6 col-md-6 footer-links">
        <h4>Liens Utiles</h4>
        <ul>
        <li><i class="bx bx-chevron-right"></i> <a href="#">Accueil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://burkinatextile.bf/" target="_blank" >Burkina Textile</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://me.bf/" target="_blank" >MEBF</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://creerentreprise.me.bf/" target="_blank" >E-création</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://www.cci.bf" target="_blank" >CCI-BF</a></li>
        </ul>
      </div>

      <!-- <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
        </ul>
      </div> -->

      <!-- <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Social Networks</h4>
        <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
        <div class="social-links mt-3">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div> -->

    </div>
    <div class="container py-4">
  <div class="copyright">
  <center>&copy; Copyright <strong><span>MEBF</span></strong>. All Rights Reserved</center>
  </div>
</div>
  </div>
</div>
</footer>
@yield('modal')
<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="modal-complete-souscription" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Avertissement</h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
          </div>
          <div class="modal-body" >
              <div class="row">
                  <span> <p style="color: red;"> NB: Vous devez completer cette souscription dans un delais de 72 soit trois jours. Sinon code promoteur sera invalide. </p></span>
              </div>
          </div>
          <div class="modal-footer">
              <a href="{{ route('accueil') }}" class="btn btn-success">Ok</a>
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>
<div id="modal-comment-souscrire"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Procédure de souscription</h3>
          </div>
          <div class="modal-body" >
           <div class="row" style="text-align: justify;">
            <p>La souscription se fait en trois étapes à savoir :
              <ol>
                  <li style="color: red">Enregistrement des informations sur le promoteur</li>
                  <p> A cette étape, le promoteur ou le responsable est invité à remplir le formulaire, à prendre connaissance des conditions et obligations et à les accepter, pour pouvoir enregistrer les données.
                      A la fin de la première étape, un code promoteur est généré et envoyé à l'adresse email renseigné par le promoteur.
                      Ce code qui peut aussi être copié directement sur l’interface, sera utilisé pour poursuivre la souscription.</p>
                  <li style="color: red">Enrgistrement des informations sur l'entreprise</li>
                  <p>A cette étape, les données essentielles sur l’entreprise détenue/dirigée par le promoteur sont requises.</p>
                  <li style="color: red">Enregistrement des données sur l'idée de projet du promoteur</li>
                  <p>A cette étape, les précisions essentielles sur l’idée de projet portée par le promoteur sont requises.</p>
              </ol>
         </p>
         <p>
           NB : A la fin de chaque étape, vous pouvez continuer en cliquant sur le bouton Poursuivre ou Suspendre la souscription et revenir plus tard pour continuer en cliquant sur le bouton Poursuivre.
         </p>
         <p>
              Pour continuer la souscription, cliquer sur le lien Poursuivre , et la plateforme vous demandera de renseigner votre Code promoteur à travers une fenêtre. Renseigner le et valider.
         </p>
         <p>
          A la fin de la dernière étape, la plateforme vous permet de générer le récépissé de souscription en cliquant sur le bouton Générer le récépissé.
          Le récépissé généré vous sera présenté sur la plateforme et il sera également envoyé par email.
         </p>
           </div>
           <div class="row">
              <iframe width="674" height="379" src="https://www.youtube.com/embed/QV2ua08jARE" title="spot" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
           </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>


<div id="modal-programme-entreprendre-MPMEExistant"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="padding:15px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Souscription au Programme Entreprendre  - MPME Existante</h3>
          </div>
          <center><img src="{{ asset('img/oups.jpg') }}" width="300" alt=""></center>
          <center><p style="color:brown; font-size:18px; font-weight:600;">La Souscription au programme entreprendre n'est pas encore ouverte</p></center>

         {{--  <div class="modal-body" >

            <a href="{{ route('fp.create.personne') }}?type_entreprise=MPMEExistant"  class="btn btn-success" >Souscrire</a>
            <a href="" data-toggle="modal" onclick="cacher('forme_search')" class="btn btn-success" >Poursuivre ma souscription</a>
          </div>
          <form action="{{ route('fp.search') }}" method="post" id='forme_search' style="display: none">
            @csrf
          <div class="row">
              <div class="form-group">
                <div class="offset-md-1 col-md-10">
                <input class="form-control" type="hidden" name="type_PE" value="MPMEExistant">
                 <label class=" control-label" for="code_promoteur" >Renseigner le code promoteur  <span class="text-danger">*</span></label>
                  <input id="code_promoteur_type_PE" class="form-control" type="text" name="code_promoteur" onchange="chercher_code('code_promoteur_type_FP','poursuivre')">
                  <p style="display: none; color:brown;" class="message_code_invalide">Code promoteur invalide</p>
                  <button style="display: none;" type="submit" class="btn btn-success col-md-2 poursuivre">Poursuivre</button>
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
      </div>
        </form> --}}
        <div class="modal-footer">
          <button type="button"class="btn btn-sm btn-danger" data-dismiss="modal">Fermer</button>
        </div>
          </div>
          
      </div>
  </div>

<div id="modal-programme-entreprendre-startup"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="padding:15px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Souscription au Programme Entreprendre  - Guichet Startup</h3>
          </div>
          <center><img src="{{ asset('img/oups.jpg') }}" width="300" alt=""></center>
          <center><p style="color:brown; font-size:18px; font-weight:600;">La Souscription au programme entreprendre n'est pas encore ouverte</p></center>

         {{-- <div class="modal-body" >
            <a href="{{ route('fp.create.personne') }}?type_entreprise=startup"  class="btn btn-success" >Souscrire</a>
            <a href="" data-toggle="modal" onclick="cacher('forme_search')" class="btn btn-success" >Poursuivre ma souscription</a>
          </div>
           <form action="{{ route('fp.search') }}" method="post" id='forme_search' style="display: none">
            @csrf
          <div class="row">
              <div class="form-group">
                <div class="offset-md-1 col-md-10">
                <input class="form-control" type="hidden" name="type_PE" value="startup">
                 <label class=" control-label" for="code_promoteur" >Renseigner le code promoteur  <span class="text-danger">*</span></label>
                  <input id="code_promoteur_type_PE" class="form-control" type="text" name="code_promoteur" onchange="chercher_code('code_promoteur_type_FP','poursuivre')">
                  <p style="display: none; color:brown;" class="message_code_invalide">Code promoteur invalide</p>
                  <button style="display: none;" type="submit" class="btn btn-success col-md-2 poursuivre">Poursuivre</button>
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
      </div>
        </form> --}}
          <div class="modal-footer">
            <button type="button"class="btn btn-sm btn-danger" data-dismiss="modal">Fermer</button>
        </div>
          </div>
          
      </div>
  </div>
<div id="modal-fond-partenariat-startup"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="padding:15px;">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Souscription au fond de partenariat - Guichet Startup </h3>
          </div>
          <div class="modal-body" >
            <a href="{{ route('fp.create.personne') }}?type_entreprise=startup"  class="btn btn-success" >Souscrire</a>
            <a href="" data-toggle="modal" onclick="cacher('forme_search')" class="btn btn-success" >Poursuivre ma souscription</a>
          </div>
          <form action="{{ route('fp.search') }}" method="post" id='forme_search' style="display: none">
            @csrf
          <div class="row">
              <div class="form-group">
                <div class="offset-md-1 col-md-10">
                <input class="form-control" type="hidden" name="type_FP" value="startup">
                <input class="form-control" type="hidden" name="type_FP" value="startup">
                 <label class=" control-label" for="code_promoteur" >Renseigner le code promoteur  <span class="text-danger">*</span></label>
                  <input id="code_promoteur_type_FP" class="form-control" type="text" name="code_promoteur" onchange="chercher_code('code_promoteur_type_FP','poursuivre')">
                  <p style="display: none; color:brown;" class="message_code_invalide">Code promoteur invalide</p>
                  <button style="display: none;" type="submit" class="btn btn-success col-md-2 poursuivre">Poursuivre</button>
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
      </div>
        </form>
          </div>
          
      </div>
  </div>

<div id="modal-fond-partenariat-MPMEExistant"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" style="padding:15px;">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Souscription au fond de partenariat - Guichet MPME Existante</h3>
          </div>
          <div class="modal-body" >
            <a href="{{ route('fp.create.personne') }}?type_entreprise=MPMEExistant"  class="btn btn-success" >Souscrire</a>
            <a href="" data-toggle="modal" onclick="cacher('forme_search_mpmeexistante')" class="btn btn-success" >Poursuivre ma souscription</a>
          </div>
          <form action="{{ route('fp.search') }}" method="post" id='forme_search_mpmeexistante' style="display: none">
            @csrf
          <div class="row">
              <div class="form-group">
                <div class="offset-md-1 col-md-10">
                <input class="form-control" type="hidden" name="type_FP" value="MPMEExistant">
                
                 <label class=" control-label" for="code_promoteur" >Renseigner le code promoteur  <span class="text-danger">*</span></label>
                  <input id="code_promoteur_MPME_existe" class="form-control" type="text" name="code_promoteur" onchange="chercher_code('code_promoteur_MPME_existe','poursuivre')">
                  <p style="display: none; color:brown;" class="message_code_invalide">Code promoteur invalide</p>
                  <button style="display: none;" type="submit" class="btn btn-success col-md-2 poursuivre">Poursuivre</button>
                </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button"class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
        </div>
        </form>
          
      </div>
  </div>
</div>
<div id="modal-programme-entreprendre"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" style="padding:15px;">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Description du programme entreprendre</h3>
          </div>
          <div class="modal-body" >
           <div class="row" style="text-align: justify;">
            <p>Le Programme Entreprendre et de renforcement des capacités des entreprises ou « Programme Entreprendre », 
              fournira une formation de groupe et une assistance technique. 
              Le programme permettra de mettre à niveau des chaînes de valeur et des grappes industrielles précises.
              Le Programme Entreprendre améliorera des chaînes de valeur et des groupes d’industries spécifiques à travers deux volets :
              <ol>
                  <li style="color: red">Compétences et mentalité entrepreneuriales</li>
                  <p> Le premier volet contribuera à développer les capacités et l’esprit d’entreprise, à l’aide d’une combinaison de formation et de coaching</p>
                  <li style="color: red">Adoption de technologies et capacités de production </li>
                  <p>Le deuxième volet fournira des conseils et des services d’appui aux entreprises en groupe, afin de soutenir l’adoption de technologies,
                     les pratiques de gestion et l’accès au marché, en mettant l’accent sur les certifications environnementales et de qualité,
                     y compris les pratiques commerciales écologiques et durables : mise en œuvre de stratégies d’économie circulaire et adoption de mesures de continuité des activités (résilience). </p>
                     <div class="text-center" style="margin-top:10px">
                      <a href="{{ route('fp.create.personne') }}?programme=PE&type_entreprise=MPMEExistant"  class="btn btn-success" >Souscrire en MPME Existant</a>
                      <a href="{{ route('fp.create.personne') }}?programme=PE&type_entreprise=startup"  class="btn btn-success" >Souscrire en Startup</a>
                  </div>
              </ol>
         </p>
         <p>
          
         </p>
         
         </p>
           </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>
<div id="modal-programme-fond-de-partenariat"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content" style="padding:15px;">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Description du fonds de Partenariat</h3>
          </div>
          <div class="modal-body" >
           <div class="row" style="text-align: justify;">
            <p>Le Fonds de Partenariat pour l’adoption des technologies et la transformation verte de la composante 1 cofinancera les investissements dans les biens d’équipement, l’assistance technique pour soutenir l’adoption des technologies, l’innovation des entreprises et des produits, l’obtention de certifications des produits et d’accréditations de la qualité.
               Une partie du Fonds soutiendra des solutions vertes associées au passage à des sources d’énergie renouvelables, plus résistantes et à des solutions d’économie circulaire (EC).
               Les subventions seront attribuées sur une base concurrentielle selon les trois guichets suivants :
              <ol>
                  <li style="color: red">	Les petits sous-projets (jusqu’à 10 000 000 FCFA)</li>
                  <p> Les petits sous-projets (jusqu’à 10 000 000 FCFA) auront un ratio de subventions de 65 % et environ 550 sous-projets seront attribués avec une taille moyenne estimée à 4 000 000 FCFA). 
                    Les petits sous projets concernent les Entrepreneurs émergents (startup), micros et petites entreprises avec un CA ≤ à 50 millions F CFA et un coût du projet ≤ 15 millions F CFA ;</p>
                  <li style="color: red">	Les sous-projets standard (jusqu’à 50 000 000 FCFA) </li>
                  <p>Les sous-projets standard (jusqu’à 50 000 000 FCFA) auront un ratio de subvention de 50 %, en fonction des rendements sociaux et économiques attendus du sous-projets.
                     On estime que 150 sous-projets seront attribués avec un montant moyen de subvention estimé à 37 500 000 FCFA. 
                     Les sous-projets standard regroupent les MPME établies depuis au moins 2 ans avec un CA ≤ à 1 milliard F CFA et un coût du projet > à 15 millions et ≤ à 100 millions F CFA ;</p>
                  <li style="color: red">	Les sous-projets de transformation verte (jusqu’à 100 000 000 FCFA)</li>
                  <p>Les sous-projets de transformation verte (jusqu’à 100 000 000 FCFA) auront un ratio de subventions de 40 à 50 % des biens d’équipement et de 60 à 80 % pour l’assistance technique et la formation.
                     Les sous-projets se concentreront sur des solutions permettant d’intégrer les concepts d’énergie renouvelable et d’Economie Circulaire dans les chaînes de valeur et les réseaux de production locaux. On estime que 50 sous-projets seront attribués avec une subvention moyenne estimée à 75 000 000 FCFA.
                     Les sous-projets de transformation verte regroupent les MPME établies depuis au moins 3 ans avec un CA ≤ à 1 milliard F CFA. </p>
                     <div class="text-center" style="margin-top:10px">
                      <a href="{{ route('fp.create.personne') }}?programme=FP&&type_entreprise=MPMEExistant"  class="btn btn-success" >Souscrire en MPME Existant</a>
                      <a href="{{ route('fp.create.personne') }}?programme=FP&&type_entreprise=startup"  class="btn btn-success" >Souscrire en Startup</a>
                  </div>
              </ol>
         </p>
        
           </div>
           {{-- <div class="row">
              <iframe width="674" height="379" src="https://www.youtube.com/embed/QV2ua08jARE" title="spot" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
           </div> --}}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>
<div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i> Les obligations et conditions</h3>
          </div>
          <div class="modal-body" >
              <h4 class="sub-header">Conditions de participation</h4>
              <p style="line-height: 32px;"> -   respecter les principes de la loi islamique ; </p>
               <p style="line-height: 32px;">-	travailler avec les banques partenaires locales ; </p>
               <p style="line-height: 32px;"> -	accepter de formaliser l’entreprise si ce n’est pas encore le cas ;</p>
               <p style="line-height: 32px;"> -	suivre tout le processus de mise en œuvre du projet.</p>
              </p style="line-height: 32px;">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">J'ai lu les termes!</button>
          </div>
      </div>
  </div>
</div>



 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/plugins/jquery/jquery.min.js')}}"></script> --}}
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{asset('frontend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{ asset("frontend/plugins/bootstrap/js/bootstrap.min.js") }}"></script>  --}}

{{--  --}}
{{-- <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}

<script src="{{asset('frontend/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('frontend/vendor/aos/aos.js')}}"></script>
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  
<script src="{{asset('frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/vendor/waypoints/noframework.waypoints.js')}}"></script>
<script src="{{asset('frontend/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('js/js-brave/vendor/jquery.min.js')}}"></script>
<script src="{{asset("vendor/bootstrap.min.js") }}"></script>
<script src="{{asset('js/js-brave/app.js')}}"></script>
<script src="{{asset('js/js-brave/mon.js')}}"></script>
<script src="{{asset('js/js-brave/plugins.js')}}"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('js/js-brave/pages/formsWizard.js')}}"></script>
{{-- <script src="{{ asset("js/js-brave/vendor/bootstrap.min.js") }}"></script> --}}
  {{-- <script src="{{asset('js/js-brave/app.js')}}"></script> --}}
{{-- 
<script src="{{asset("vendor/bootstrap.min.js") }}"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> --}}





  {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="{{asset('wizard/dist/jquery-steps.js')}}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  
  <script src="{{asset('js/js-brave/pages/formsWizard.js')}}"></script> --}}
  {{-- <script src="{{ asset("js/js-brave/vendor/bootstrap.min.js") }}"></script> --}}
  
  <script>$(function(){ FormsWizard.init(); });</script>
  <script>
     $('.masked_phone').mask('99-99-99-99');
     $('.masked_cnib').mask('99999999999999999');

      function cacher(id_form){
        $('#'+id_form).toggle();
      }
  </script>
  <script>
      function checkchoice(programme,guichet){
          $('.programme').val(programme);
          $('.guichet').val(guichet);
      }
  </script>
  <script>
   function  afficherchampidentite(){
      type_identite= $("#type_identite_promoteur").val();
      if(type_identite==1){
        $("#champ_cnib").show();
        $("#numero_identite_passport").val('');
        $("#numero_identite_passport").prop('required',false);
        $("#numero_identite_cnib").prop('required',true);
        $('#champ_passport').hide();
      }
      else{
        $("#champ_cnib").hide();
        $("#numero_identite_cnib").val('');
        $("#numero_identite_cnib").prop('required',false);
        $("#numero_identite_passport").prop('required',true);
        $('#champ_passport').show();
      }
   }
  </script>
  <script>
    function controler_de_doublon_promotrice(champ_controle){
            var numero_identite= $("#numero_identite").val();
            var telephone_promoteur= $("#telephone_promoteur").val();
            var mobile_promoteur= $("#mobile_promoteur").val();
            var email_promoteur= $("#email_promoteur").val();
            var url="{{ route('souscription.control_doublon') }}"
            $.ajax({
                    url: url,
                    type: 'GET',
                    data: {numero_identite: numero_identite, 
                        telephone_promoteur:telephone_promoteur,
                         mobile_promoteur:mobile_promoteur, 
                         email_promoteur:email_promoteur
                        },
                    dataType: 'json',
                    error:function(data){alert("Erreur");},
                    success: function (data) {
                        console.log(data);
                         if(data){
                            
                            $(".message_doublon").show();
                            $(".code_promoteur").text(data.code_promoteur)
                            $("#"+champ_controle).val("")
                            $("#numero_identite").val("");
                         }
                         else{
                            $(".message_doublon").hide();
                            $("#valider").show();
                         }
                    }
            });  
       }
       function chercher_code(code_promoteur){
            var code_promoteur= $("#"+code_promoteur).val();
            var url= "{{ route('promoteur.search') }}"
            $.ajax({
                    url: url,
                    type: 'GET',
                    data: {code_promoteur: code_promoteur},
                    error:function(data){alert("Erreur");},
                    success: function (data) {
                        console.log(data);
                         if(data){
                            $(".poursuivre").show();
                            $(".message_code_invalide").hide();
                         }
                         else{
                          $(".poursuivre").hide();
                          $(".message_code_invalide").show();
                         }
                    }
            });  
       }
  </script>
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
  <script>
    function changeValue(parent, child, niveau)
        {
            var idparent_val = $("#"+parent).val();
            var id_param = parseInt(niveau);
            //alert(niveau);
            var url = '{{ route('valeur.selection') }}';
            $.ajax({
                    url: url,
                    type: 'GET',
                    data: {idparent_val: idparent_val, id_param:id_param, parent:parent},
                    dataType: 'json',
                    error:function(data){alert("Erreur");},
                    success: function (data) {
                        var options = '<option></option>';
                        for (var x = 0; x < data.length; x++) {
                            options += '<option value="' + data[x]['id'] + '">' + data[x]['name'] + '</option>';
                        }
                       $('#'+child).html(options);
                    }
            });
        }
  </script>

</body>

</html>