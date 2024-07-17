<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ECOTEC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('frontend/img/MEBF.JPG')}}" rel="icon">
  <link href="{{asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{asset('frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  <!-- <link rel="stylesheet" href="{{asset('wizard/css/style.css')}}"> -->

 
  

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link href="{{asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  {{-- <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet"> --}}
  <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
  {{-- <link rel="stylesheet" href="{{asset('formulaire/css/bootstrap.min.css')}}">   --}}
 {{-- <link rel="stylesheet" href="{{asset('formulaire/css/main.css')}}">
 
 <link rel="stylesheet" href="{{asset('formulaire/css/plugins.css')}}"> --}}
 {{-- <link rel="stylesheet"  href="{{asset('css/css-brave/bootstrap.min.css')}}"> --}}
{{--  --}}
{{-- <link rel="stylesheet" href="{{asset('formulaire/css/main.css')}}"> --}}
  <link rel="stylesheet"  href="{{asset('css/css-brave/main.css')}}">
  <link rel="stylesheet"  href="{{asset('css/css-brave/bootstrap.min.css')}}">
  <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">

<link href="{{asset('css/css-brave/plugins.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('frontend/themes.css')}}">
  <script src="{{ asset("css/css-brave/modernizr.min.js") }}"></script>
 

  <!-- Formulaire -->
  
 
  

  <!-- =======================================================
  * Template Name: BizLand
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com"> infoecotec@me.bf</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+226 70000000</span></i>
      </div>
      {{-- <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div> --}}
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class=" container position-relative d-flex align-items-center justify-content-between">

      {{-- <h1 class="logo"><a href="index.html">PARGFM<span>.</span></a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
    <a href="index.html" class="logo"><img src="{{asset('frontend/img/logo-ecotec.jpg')}}" alt=""></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{route('index')}}">Accueil</a></li>
          <li><a class="nav-link scrollto" data-toggle="modal"  data-target="#modal-comment-souscrire" href="#modal-comment-souscrire">Comment Postuler</a></li>
          {{-- <button type="button"  class="btn-get-started scrollto" data-toggle="modal" class="btn-get-started scrollto" data-target="#modal-choix-option"> Programme Entreprendre</button> --}}
          <li><a class="nav-link scrollto" data-toggle="modal" data-target="#modal-programme-entreprendre" href="#">Programme Entreprendre</a></li>
          <li><a class="nav-link scrollto" data-toggle="modal" data-target="#modal-programme-fond-de-partenariat" href="#">Fonds de Partenariat</a></li>

          {{-- <li class="dropdown"><a href="#"><span>Fonds de Partenariat</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Au Statups</a></li>
              <li><a href="#">MPME existants</a></li>
              <li><a href="#">Entreprenariat Vert</a></li>
            </ul>
          </li> --}}
          <li><a class="nav-link scrollto " href="#portfolio">Poursuivre</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Créer un compte</a></li>
          <li><a class="nav-link scrollto " href="{{ route('login') }}">Se Connecter</a></li>
          <!-- <li><a class="nav-link scrollto" href="#team">Team</a></li> -->
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
<!-- ======= Hero Section ======= -->
