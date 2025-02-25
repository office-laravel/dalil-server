<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('../public/dashboard/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('../public/dashboard/img/favicon.png') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link id="pagestyle" href="{{ url('dashboard/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">


    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/map.css') }}">
    <!-- Map End -->

    <title>
        لوحة التحكم

    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <!--<link href="{{ url('dashboard/css/nucleo-icons.css') }}" rel="stylesheet" />-->
    <!--<link href="{{ url('dashboard/css/nucleo-svg.css') }}" rel="stylesheet" />-->
    <!-- Font Awesome Icons -->
    <!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('/public/dashboard/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/public/css/asw.css') }}">
</head>

<body class="g-sidenav-show rtl bg-gray-200">


    @yield('content')



    <!--<div class="fixed-plugin">-->
    <!--    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" style="background-color:#42424a">-->
    <!--        <i class="material-icons py-2" style="color:#fff">settings</i>-->
    <!--    </a>-->
    <!--    <div class="card shadow-lg">-->
    <!--        <div class="card-header pb-0 pt-3">-->
    <!--            <div class="float-end">-->
    <!--                <h5 class="mt-3 mb-0">Material UI Configurator</h5>-->
    <!--                <p>See our dashboard options.</p>-->
    <!--            </div>-->
    <!--            <div class="float-start mt-4">-->
    <!--                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">-->
    <!--                    <i class="material-icons">clear</i>-->
    <!--                </button>-->
    <!--            </div>-->
    <!-- End Toggle Button -->
    <!--        </div>-->
    <!--        <hr class="horizontal dark my-1">-->
    <!--        <div class="card-body pt-sm-3 pt-0">-->
    <!-- Sidebar Backgrounds -->
    <!--            <div>-->
    <!--                <h6 class="mb-0">Sidebar Colors</h6>-->
    <!--            </div>-->
    <!--            <a href="javascript:void(0)" class="switch-trigger background-color">-->
    <!--                <div class="badge-colors my-2 text-end">-->
    <!--                    <span class="badge filter bg-gradient-primary active" data-color="primary"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                    <span class="badge filter bg-gradient-dark" data-color="dark"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                    <span class="badge filter bg-gradient-info" data-color="info"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                    <span class="badge filter bg-gradient-success" data-color="success"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                    <span class="badge filter bg-gradient-warning" data-color="warning"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                    <span class="badge filter bg-gradient-danger" data-color="danger"-->
    <!--                        onclick="sidebarColor(this)"></span>-->
    <!--                </div>-->
    <!--            </a>-->
    <!-- Sidenav Type -->
    <!--            <div class="mt-3">-->
    <!--                <h6 class="mb-0">Sidenav Type</h6>-->
    <!--                <p class="text-sm">Choose between 2 different sidenav types.</p>-->
    <!--            </div>-->
    <!--            <div class="d-flex">-->
    <!--                <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"-->
    <!--                    onclick="sidebarType(this)">Dark</button>-->
    <!--                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"-->
    <!--                    onclick="sidebarType(this)">Transparent</button>-->
    <!--                <button class="btn bg-gradient-dark px-3 mb-2 me-2" data-class="bg-white"-->
    <!--                    onclick="sidebarType(this)">White</button>-->
    <!--            </div>-->
    <!--            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>-->
    <!-- Navbar Fixed -->
    <!--            <div class="mt-3 d-flex">-->
    <!--                <h6 class="mb-0">Navbar Fixed</h6>-->
    <!--                <div class="form-check form-switch me-auto my-auto">-->
    <!--                    <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed"-->
    <!--                        onclick="navbarFixed(this)">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <hr class="horizontal dark my-3">-->
    <!--            <div class="mt-2 d-flex">-->
    <!--                <h6 class="mb-0">Light / Dark</h6>-->
    <!--                <div class="form-check form-switch me-auto my-auto">-->
    <!--                    <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="dark-version"-->
    <!--                        onclick="darkMode(this)">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <hr class="horizontal dark my-sm-4">-->
    <!--            <a class="btn bg-gradient-info w-100"-->
    <!--                href="https://www.creative-tim.com/product/material-dashboard">Free Download</a>-->
    <!--            <a class="btn btn-outline-dark w-100"-->
    <!--                href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View-->
    <!--                documentation</a>-->
    <!--            <div class="w-100 text-center">-->
    <!--                <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard"-->
    <!--                    data-icon="octicon-star" data-size="large" data-show-count="true"-->
    <!--                    aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>-->
    <!--                <h6 class="mt-3">Thank you for sharing!</h6>-->
    <!--                <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard"-->
    <!--                    class="btn btn-dark mb-0 me-2" target="_blank">-->
    <!--                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet-->
    <!--                </a>-->
    <!--                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard"-->
    <!--                    class="btn btn-dark mb-0 me-2" target="_blank">-->
    <!--                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share-->
    <!--                </a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->



    <!--   Core JS Files   -->

    {{-- <script src="{{ url('../public/dashboard/js/core/popper.min.js') }}"></script> --}}
    <script src="{{ url('/public/dashboard/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('/public/dashboard/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('/public/dashboard/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('/public/dashboard/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ url('/public/js/appdrop.js') }}"></script>
    <!-- Map -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    <!-- Map end -->
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('public/dashboard/js/material-dashboard.min.js?v=3.0.2') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>


    @yield('script')
    <script>
        //Map
        var token = '{{ csrf_token() }}';
        //Map end
    </script>
    <!--  Map -->
    @yield('map-js')
    <!--  Map end -->
</body>

</html>
<style>
    /*@font-face {*/
    /*    font-family: NotoKufiArabic;*/
    /*    src: url({{ url('../public/fonts/NotoKufiArabic-VariableFont_wght.ttf') }});*/
    /*}*/
</style>
<style>
    .g-sidenav-show.rtl .sidenav.slide-in {
        transform: translateX(0);
    }
</style>
<script>
    const icon = document.querySelector('#iconNavbarSidenav');
    icon.addEventListener('click', function() {
        const sidenav = document.querySelector('#sidenav-main');
        sidenav.classList.toggle('slide-in');
    });
</script>
@yield('style')
