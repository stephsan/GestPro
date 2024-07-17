@extends('layouts.frontend')
@section('content')
<section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1><p class="titre-entete1">Bienvenue sur le portail de souscription de <span>ECOTEC</span></p> </h1>
   <h3 class="titre-entete"> <center>PROJET D’APPUI À L’ENTREPRENARIAT, AU DEVELOPPEMENT DES COMPETENCES ET À L’ADOPTION TECHNOLOGIQUE </center></h3> 
      <div class="d-flex" >
        {{-- <button type="button"  class="btn-get-started scrollto" data-toggle="modal" class="btn-get-started scrollto" data-target="#modal-choix-option"> S'inscrire</button> --}}
        <div class="col-md-10" style="margin : auto; display: block;" >
          {{-- <a href="" data-toggle="modal" class=" btn-get-started scrollto" >S'incrire au Programme Entreprendre</a>
          <a href="" data-toggle="modal" class="btn-get-started scrollto"  style="margin-left:6px;">S'incrire au Fonds de Partenariat</a> --}}
        </div>
        
      </div>
    </div>
  </section><!-- End Hero -->
    <!-- ======= Featured Services Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        {{-- <div class="section-title">
          <h3>Les liens de <span>Souscription</span></h3>
          <p>Choisir un la rubrique aui vous concerne.</p>
        </div> --}}

        <div class="row">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box" style=" box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.3);">
              <span class="advanced">Startup</span>
              <h3> Programme entreprendre</h3>
              {{-- <h2>Programme entreprendre</h2> --}}
              <ul>
                <li>Entreprise en démarrage</li>
                <li>Vous souhaitez bénéficier d'un renforcement de capacité</li>
              </ul>
              <div class="btn-wrap">
                <a class="btn-buy" data-toggle="modal" data-target="#modal-programme-entreprendre-startup" href="#">S'inscrire</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box" style=" box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.3);">
              <span class="advanced">MPME Existant</span>
              <h3>Programme entreprendre</h3>
              <ul>
                <li>Entreprise Existante</li>
                <li>Vous souhaitez bénéficier d'un renforcement de capacité</li>
              </ul>
              <div class="btn-wrap">
                <a class="btn-buy" data-toggle="modal" data-target="#modal-programme-entreprendre-MPMEExistant" href="#">S'inscrire</a>
                {{-- <a class="btn-buy" data-toggle="modal" data-target="#modal-programme-entreprendre-MPMEExistan" href="#">S'inscrire</a> --}}
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box" style=" box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.3);">
              <span class="advanced">Startup</span>
              <h3>Fonds de partenariat</h3>
              {{-- <h4><sup>$</sup>29<span> / month</span></h4> --}}
              <ul>
                <li>Entreprise en démarrage</li>
                <li>Vous souhaitez bénéficier d'un financement</li>
              </ul>
              <div class="btn-wrap">
                <a class="btn-buy" data-toggle="modal" data-target="#modal-fond-partenariat-startup" href="#">S'inscrire</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box" style=" box-shadow: 6px 6px 18px 0px rgba(0,0,0,0.3);">
              <span class="advanced">MPME Existante</span>
              <h3>Fonds de partenariat</h3>
              {{-- <h4><sup>$</sup>49<span> / month</span></h4> --}}
                <ul>
                  <li>Entreprise Existante</li>
                  <li>Vous souhaitez bénéficier d'un financement</li>
                </ul>
              <div class="btn-wrap">
                <a class="btn-buy" data-toggle="modal" data-target="#modal-fond-partenariat-MPMEExistant" href="#">S'inscrire</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">
      <div class="section-title">
      <h3>Comment s'inscrire ?</h3>
      </div>
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Etape 1</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Etape 2</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Etape 3</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Etape 4</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

        </div>

      </div>
      
    </section><!-- End Featured Services Section -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <!-- <h2>Services</h2> -->
          <h3>OBJECTIFS</h3>
          <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Renforcer les capacités des PME et l’adoption des technologies </a></h4>
              <p>Renforcer les capacités des PME et l’adoption des technologies</p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Améliorer l’environnement des affaires et le développement des PME </a></h4>
              <p>Améliorer l’environnement des affaires et le développement des PME </p>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Améliorer l’accès des PME au financement et aux investissements verts </a></h4>
              <p>Améliorer l’accès des PME au financement et aux investissements verts </p>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4><a href="">Développer une main-d’œuvre productive et entreprenante</a></h4>
              <p>Développer une main-d’œuvre productive et entreprenante</p>
            </div>
          </div>
        </div>

      </div>
    </section>
    <div class="section-title">
      <h3>QUELQUES RESULTATS ATTENDUS</h3>
      </div>
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="1300" data-purecounter-duration="1" class="purecounter"></span>
              <p>Entrepreneurs/entreprises participant au Programme de renforcement des capacités </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="750" data-purecounter-duration="1" class="purecounter"></span>
              <p>Entrepreneurs/entreprises ayant bénéficiés du Fonds de partenariat </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="8000000000" data-purecounter-duration="1" class="purecounter">FCFA</span>
              <p> De co-investissements privés mobilisé par le Fonds de partenariat </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="800" data-purecounter-duration="1" class="purecounter"></span>
              <p>Entreprises ayant bénéficiés d’un nouveau prêt d’une Institution Financière Participante</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Clients Section ======= -->
    <!-- <section id="clients" class="clients section-bg">
      <div class="container" data-aos="zoom-in">

        <div class="row">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-1.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-2.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-3.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-4.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-5.png')}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('frontend/img/clients/client-6.png')}}" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section> -->
    <!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    

    <!-- ======= Testimonials Section ======= -->
    <div class="section-title">
          <!-- <h2>Services</h2> -->
          <h3>PARTENAIRES</h3>
          <!-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
    </div>
    <section id="testimonials" class="testimonial">
      <div class="container" data-aos="zoom-in">

        
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
              <div class="swiper-slide" >
                  <div class="testimonial-item">
                    <img src="{{ asset('/img/armoirie_bf.png') }}" width="150"   class="testimonial-img" alt="">
                    <h3>L'Etat du Burkina Faso</h3>
                    <h4>Partenaire</h4>
                  </div>
              </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('/img/MEBF.png') }}" width="150" class="testimonial-img" alt="">
                <h3>MEBF</h3>
                <h4>Chargé de l'exécution</h4>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset('img/bm_logo.png') }}" width="150" class="testimonial-img" alt="">
                <h3>La Banque Mondiale</h3>
                <h4>Partenaire techique et financier</h4>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

   

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h3>CONTACTS</h3>
          <!-- <h3><span>Contact Us</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> -->
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Notre Adresse</h3>
              <p>132, Avenue de Lyon 11 BP 379 Ouagadougou 11 | Burkina Faso</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Envoyez-nous un mail</h3>
              <p>info@me.bf</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Contactez Nous</h3>
              <p>+226 25 39 80 60</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6 ">
          <iframe class="mb-4 mb-lg-0" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen src="https://www.google.com/maps/d/embed?mid=1lFCRo-rt3nydWg2R9hqp_6QDKdk&ehbc=2E312F" width="640" height="480"></iframe>
            <!-- <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe> -->
          </div>

          <div class="col-lg-6">
            <form action="{{ route("contact") }}" method="post" role="form" class="php-email-form">
              @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label for="nom">Votre nom</label>
              <input type="text" name="nom" class="form-control" id="nom" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nom">Votre Numéro de Téléphone</label>
              <input type="text" name="telephone" class="form-control" id="nom" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name">Votre Email</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
          <div class="form-group col-md-6">
              <label for="name">Votre Zone/Region</label>
              <select id="zone" class="select-select2" data-placeholder="Selectionnez votre zone"  name="region" style="width: 100%;">
                <option></option>
                <option value="centre">Centre</option>
                <option value="nord">Nord</option>
                <option value="hauts bassin">Hauts bassins</option>
                <option value="boucle du mouhoun">Boucle du Mouhoun</option>
            </select>
          </div>
        </div>
          <div class="form-group">
            <label for="name">Objet</label>
            <input type="text" class="form-control" name="subject" id="subject" required>
          </div>
          <div class="form-group">
            <label for="name">Message</label>
            <textarea class="form-control" name="message" rows="10" required></textarea>
          </div>
          <div class="g-recaptcha" data-sitekey="6Lfkm9MiAAAAAGeYLF8Ls17qhJAJpQ7R3Q0UAV_n"></div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Votre Message a été envoyé avec succès. Merci!</div>
          </div>
          <div class="text-center"><button type="submit">Envoyer Message</button></div>
        </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
  @endsection
@section('modal')


<div id="modal-choix-option"class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="float: right !important;">&times;</button>
              <h3 class="modal-title"><i class="gi gi-pen" ></i>Choisir le programme auquel vous souhaitez souscrire</h3>
          </div>
          <div class="modal-body" >

            <a href="" data-toggle="modal" class="btn btn-success" >Programme Entreprendre</a>
            <a href="" data-toggle="modal" class="btn btn-success" >Fonds de Partenariat</a>
              
          </div>
          <div class="modal-footer">
              <button type="button"class="btn btn-sm btn-primary" data-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>
@endsection

@section('modal')




@endsection  