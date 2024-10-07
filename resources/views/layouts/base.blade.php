<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ECOTEC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- Favicons -->
    <link href="{{asset('frontend/img/logo-ecotec.jpg')}}" rel="icon">
    <link href="{{asset('img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('/theme/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('/theme/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('/theme/vendor/simple-datatables/style.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{asset('css/css-brave/plugins.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="{{ asset('css/sweetAlert/sweetalert2.all.min.js') }}"></script>

    <link href="{{ asset('css/sweetAlert/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=" https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    @yield('css')
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


  @livewireStyles
</head>

<body>

  <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center justify-content-between">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <!--<img src="{{asset('img/logo-dgi-final.png')}}" alt="Logo">-->
            <!--<img src="{{asset('img/armoirie_bf.png')}}" alt="Logo">-->
            <span class="d-none d-lg-block custom-text-success p-size18">ECOTEC-BF</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn text-success"></i>
    </div><!-- End Logo -->
    <div class="d-flex justify-content-center mx-5">
      <span class="text-success">Système de gestion integrée des bénéficaires</span>
    </div>
    <nav class="header-nav ms-1">
      <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->email}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>Mon Profil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i>
                        Se Deconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
     @can('lister_souscription_fp', Auth::user())
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Tableau de bord FP</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Tableau de bord PE</span>
            </a>
        </li>
    @endcan
        @can("consultation")
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ca" data-bs-toggle="collapse" href="#">
                    <i class="bi-currency-exchange"></i><span>Traitement</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ca" class="nav-content collapse {{-- {{ setMenuActive('consultation.indicateurs.catva') || setMenuActive('consultation.indicateurs.caBilan') ? 'show':'' }} --}} {{ $active =='catva' || $active =='caBilan' || $active =='caDetail' || $active == 'certificationCa' || $active =='certificationCa' ? 'show':'' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="#" class="nav-link {{-- {{ setMenuActive('consultation.indicateurs.catva') }}" --}} {{ $active =='catva' ? 'active':'' }}">
                            <i class="bi bi-circle"></i><span>Menu 1</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link {{-- {{ setMenuActive('consultation.indicateurs./* catva */') }}" --}} {{ $active =='caBilan' ? 'active':'' }}">
                            <i class="bi bi-circle"></i><span>Menu 2</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
       @endcan
@can('lister_souscription_pe', Auth::user())
<p>Programme Entreprendre</p>
<hr>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#pe_startup" data-bs-toggle="collapse" href="#">
        <i class="bi-currency-exchange"></i><span>Startups</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pe_startup" class="nav-content collapse  @yield('pe_startup')"
        data-bs-parent="#sidebar-nav">
    @can('lister_souscription_pe', Auth::user())
        <li>
            <a href="{{ route('preprojet.lister_pe') }}?type_entreprise=startup" class="nav-link @yield('pe_enregistre') ">
                <i class="bi bi-circle"></i><span>Avant-projets enregistrées</span>
            </a>
        </li>
    @endcan
    @can('lister_avant_projet_a_evaluer_pe', Auth::user())
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?statut=a_evaluer&type_entreprise=startup" class="nav-link @yield('pe_a_analyser') ">
                <i class="bi bi-circle"></i><span>Avant-projets a analyser</span>
            </a>
        </li>
    @endcan
    @can('lister_avant_projet_a_evaluer_pe', Auth::user())
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?statut=eligible&type_entreprise=startup" class="nav-link @yield('pe_eligible') ">
                <i class="bi bi-circle"></i><span>Avant-projets éligibles</span>
            </a>
        </li>
    @endcan
    @can('lister_avant_projet_a_evaluer_pe', Auth::user())
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?statut=ineligible&type_entreprise=startup" class="nav-link @yield('pe_ineligible') ">
                <i class="bi bi-circle"></i><span>Avant-projets inéligibles</span>
            </a>
        </li>
    @endcan
    @can('lister_avant_projet_evalues_pe', Auth::user())
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?statut=evalues&type_entreprise=startup"  class="nav-link @yield('pe_evalues') ">
                <i class="bi bi-circle"></i><span>Avant-projets évalués</span>
            </a>
        </li>
    @endcan
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?statut=soumis_au_comite&type_entreprise=startup" class="nav-link @yield('pe_soumis_au_comite') ">
                <i class="bi bi-circle"></i><span>Avant-projets soumis au comité</span>
            </a>
        </li>
        @can('lister_avant_projet_selectionne_pe', Auth::user())
            <li>
                <a href="{{ route('preprojet_pe.selected') }}?type_entreprise=startup" class="nav-link @yield('pe_selectionne_par_le_comite') ">
                    <i class="bi bi-circle"></i><span>Avant-projets sélectionnés</span>
                </a>
            </li>
        @endcan
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#pe_mpme_existante" data-bs-toggle="collapse" href="#">
        <i class="bi-currency-exchange"></i><span>Entreprises existantes</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    {{-- <ul id="pe_mpme_existante" class="nav-content collapse  @yield('pe_mpme_existante')"
        data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('preprojet.lister_fp') }}?type_entreprise=entreprise_existante" class="nav-link @yield('fp_enregistre') ">
                <i class="bi bi-circle"></i><span>Avant-projets enregistrées</span>
            </a>
        </li>
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?type_entreprise=entreprise_existante&statut=a_evaluer" class="nav-link @yield('fp_a_evaluer') ">
                <i class="bi bi-circle"></i><span>Avant-projets a analyser</span>
            </a>
        </li>
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?type_entreprise=entreprise_existante&statut=eligible" class="nav-link @yield('fp_eligible') ">
                <i class="bi bi-circle"></i><span>Avant-projets éligibles</span>
            </a>
        </li>

        <li>
            <a href="{{ route('preprojetpe.traitement') }}?type_entreprise=entreprise_existante&statut=evalues" class="nav-link @yield('fp_evalues') ">
                <i class="bi bi-circle"></i><span>Avant-projets évalués</span>
            </a>
        </li>
        <li>
            <a href="{{ route('preprojetpe.traitement') }}?type_entreprise=entreprise_existante&statut=soumis_au_comite" class="nav-link @yield('fp_soumis_au_comite') ">
                <i class="bi bi-circle"></i><span>Avant-projets soumis au comité</span>
            </a>
        </li>
        <li>
            <a href="{{ route('preprojet.save_decision_du_comite') }}?type_entreprise=entreprise_existante" class="nav-link @yield('fp_selectionne_par_le_comite') ">
                <i class="bi bi-circle"></i><span>Avant-projets sélectionnés</span>
            </a>
        </li>
    </ul> --}}
</li>
    @endcan

@can('lister_souscription_fp', Auth::user())
<p>Fonds de partenariat</p>
    <hr>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#startup_fp" data-bs-toggle="collapse" href="#">
            <i class="bi-currency-exchange"></i><span>Startups</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        {{-- <ul id="startup_fp" class="nav-content collapse  @yield('startup_fp')"
            data-bs-parent="#sidebar-nav">
        @can('lister_souscription_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.lister_fp') }}?type_entreprise=startup" class="nav-link @yield('fp_enregistre') ">
                    <i class="bi bi-circle"></i><span>Avant-projets enregistrées</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_a_evaluer_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=startup&statut=a_evaluer" class="nav-link @yield('fp_a_evaluer') ">
                    <i class="bi bi-circle"></i><span>Avant-projets a évalués</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_evalues_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=startup&statut=evalues" class="nav-link @yield('fp_evalues') ">
                    <i class="bi bi-circle"></i><span>Avant-projets évalués</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_soumis_au_comite_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=startup&statut=soumis_au_comite" class="nav-link @yield('fp_soumis_au_comite') ">
                    <i class="bi bi-circle"></i><span>Avant-projets soumis au comité</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_selectionnes_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.selected') }}?type_entreprise=startup" class="nav-link @yield('fp_selectionne_par_le_comite') ">
                    <i class="bi bi-circle"></i><span>Avant-projets sélectionnés</span>
                </a>
            </li>
        @endcan
        </ul> --}}
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#fp_mpme_existante" data-bs-toggle="collapse" href="#">
            <i class="bi-currency-exchange"></i><span>Entreprises existantes</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="fp_mpme_existante" class="nav-content collapse  @yield('fp_mpme_existante')"
            data-bs-parent="#sidebar-nav">
         @can('lister_souscription_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.lister_fp') }}?type_entreprise=entreprise_existante" class="nav-link @yield('fp_enregistre') ">
                    <i class="bi bi-circle"></i><span>Avant-projets enregistrées</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_a_evaluer_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=entreprise_existante&statut=a_evaluer" class="nav-link @yield('fp_a_evaluer') ">
                    <i class="bi bi-circle"></i><span>Avant-projets a analyser</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_a_evaluer_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=entreprise_existante&statut=eligible" class="nav-link @yield('fp_eligible') ">
                    <i class="bi bi-circle"></i><span>Avant-projets éligibles</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_ineligible', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=entreprise_existante&statut=ineligible" class="nav-link @yield('fp_ineligible') ">
                    <i class="bi bi-circle"></i><span>Avant-projets inéligibles</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_evalues_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=entreprise_existante&statut=evalues" class="nav-link @yield('fp_evalues') ">
                    <i class="bi bi-circle"></i><span>Avant-projets évalués</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_soumis_au_comite_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.traitement') }}?type_entreprise=entreprise_existante&statut=soumis_au_comite" class="nav-link @yield('fp_soumis_au_comite') ">
                    <i class="bi bi-circle"></i><span>Avant-projets soumis au comité</span>
                </a>
            </li>
        @endcan
        @can('lister_avant_projet_selectionnes_fp', Auth::user())
            <li>
                <a href="{{ route('preprojet.selected') }}?type_entreprise=entreprise_existante" class="nav-link @yield('fp_selectionne_par_le_comite') ">
                    <i class="bi bi-circle"></i><span>Avant-projets sélectionnés</span>
                </a>
            </li>
        @endcan
        </ul>
    </li>
@endcan
@can('gerer_critere', Auth::user())
        <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#ca" data-bs-toggle="collapse" href="#">
                    <i class="bi-currency-exchange"></i><span>Administration</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="ca" class="nav-content collapse @yield('administration')"
                    data-bs-parent="#sidebar-nav">
            @can('gerer_critere', Auth::user())
                    <li>
                        <a href="{{ route('critere.index') }}" class="nav-link @yield('critere')">
                            <i class="bi bi-circle"></i><span>Criteres</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('documents.index') }}" class="nav-link @yield('document')">
                            <i class="bi bi-circle"></i><span>Documents</span>
                        </a>
                    </li>
            @endcan
      @can('gerer_user', Auth::user())
                    <li>
                        <a href="{{ route('users.index') }}" class="nav-link @yield('user')">
                            <i class="bi bi-circle"></i><span>Utilisateur</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('role.index') }}" class="nav-link @yield('role')">
                            <i class="bi bi-circle"></i><span>Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}" class="nav-link @yield('permission')">
                            <i class="bi bi-circle"></i><span>Permissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('parametres.index') }}" class="nav-link @yield('parametre')">
                            <i class="bi bi-circle"></i><span>Parametres</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('valeurs.index') }}" class="nav-link @yield('valeur')">
                            <i class="bi bi-circle"></i><span>Valeurs</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- End Forms Nav -->
        @endcan
        @endcan
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main {{-- {{ $active =='administration'? 'dashboard-content-bg':'' }} --}}">
    @include('flash-message')
    @yield('content')
    <!-- Overlay -->
    <div id="overlay" class="overlay">
        <div class="loader"></div>
    </div>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer fixed-bottom">
    <div class="copyright text-dark">
        &copy; Tous droits reservés 2024
        <img src="{{asset('frontend/img/logo-ecotec.jpg')}}" alt="Logo" class="dgi-logo mx-2"/>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
 @yield('modal_part')
<!-- Vendor JS Files -->
<script src="{{asset('theme/vendor/apexcharts/apexcharts.min.js')}}"></script>
{{-- <script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
<script src="{{asset('theme/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('theme/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('theme/vendor/quill/quill.min.js')}}"></script>
{{-- <script src="{{asset('theme/vendor/simple-datatables/simple-datatables.js')}}"></script> --}}
<script src="{{asset('theme/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('theme/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('theme/js/main.js')}}"></script>
<script src="{{asset('jquery/jquery.min.js')}}"></script>

 <script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 
 <script src="{{asset('js/js-brave/vendor/jquery.min.js')}}"></script>
<script src="{{asset('js/js-brave/plugins.js')}}"></script>
<script src="{{asset('js/adminlte.min.js')}}"></script>

 <script src="{{ asset('js/js-brave/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/js-brave/gmaps.min.js') }}"></script>
<script src="{{ asset('js/js-brave/exporting.js') }}"></script>
<script src="{{ asset('js/js-brave/export-data.js') }}"></script>
   <script src="{{ asset('js/js-brave/datatables.js') }}"></script>
 {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script> 

    <script>
        $('.alert').delay(3000).slideUp(350);
           // $('.test').('hide')// or fade, css display however you'd like.
    </script>
    {{-- <script src="{{ asset('js/js-brave/app.js') }}"></script> --}}
    <script>

        $(function() {
                  $('.liste').DataTable({
                    dom: 'Bftip',
                    buttons: [
                
                {
                    extend: 'pdf',
                    text: 'Telecharger en pdf'
                },
                {
                    extend: 'excel',
                    text: 'Telecharger en excel'
                },
                
            ]
});

});
    </script>
<script>
function activerbtn(id_btn,id_champ){
        //alert('ok');
        var contenu_du_champ= $('#'+id_champ).val();

         if(contenu_du_champ==""){
           $('.'+id_btn).prop('disabled',true)
     }
        else{

         $('.'+id_btn).prop('disabled', false)
     }
    }
    
</script>

<script>
 $('.select-select2').select2();
    $(document).ready(function() {
      $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    })
 </script>
@yield('script')
<script>

  /*  document.getElementById('searchForm').onsubmit = function() {
        // Show the overlay
        document.getElementById('overlay').classList.add('overlay-active');
    };*/
</script>

@livewireScripts
</body>

</html>
