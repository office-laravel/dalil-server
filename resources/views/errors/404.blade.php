<?php 
use App\Models\sitting;
  $Settings = sitting::first();
  ?>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/> 
    {{-- @foreach ( $mainarr['headerlist'] as $headrow )
    {{ Str::of($headrow['value1'])->toHtmlString()}}    
  @endforeach --}}
  <link href="{{ url('/public/uploading/' . $Settings->favicon) }}" rel="icon">  
  <title>
    {{$Settings->nameWebsite}} @yield('page-title')
  </title> 
   
    <!-- Bootstrap CSS -->
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom styles -->
   
        <!-- Map -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
    
        <link rel="stylesheet" href="{{ url('/public/assets/site/css/map.css') }}">
        <link rel="stylesheet" href="{{ url('/public/assets/site/css/style_product.css') }}" />
            @yield('map-css')
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/styles.css') }}" />
    
    @yield('css')
  </head>
  <body>

    <!-- قائمة الأعلى -->
    <nav class="navbar navbar-expand-lg navbar-light bg-style">
      <div class="container">
     
        <a  class="navbar-brand"  href="{{ url('/') }}"><img src="{{ url('/public/upload/logo_waslat.png') }}" width="50px" height="50px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            @if (Auth::check())
            <li  class="nav-item dropdown " >
                <a  class="nav-link dropdown-toggle nav-link-pad" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span> مرحبا بك يا {{ Auth::guard()->user()->name }}</span></a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="{{ route('mainPageSetting.userr',Auth::guard()->user()->name) }}">حسابي</a>
                    <a class="dropdown-item" href="{{ route('pageme.user',Auth::guard()->user()->name) }}">مواقعي</a>
                    <a class="dropdown-item" href="{{ route('logoutu') }}"    >تسجيل خروج</a>
            
                  </div>
            </li>
          
            @else
            <li class="nav-item  ">
                <a class="nav-link  nav-link-pad" href="{{ url('/package/all') }}">اشتراك </a>
            </li>
               <li class="nav-item">
                <a class="nav-link  nav-link-pad" href="{{ route('loginu') }}">تسجيل دخول</a>
              </li>

              
              {{-- <li class="nav-item">
                <a class="nav-link nav-link-pad" href="/auth/google">
                  التسجيل عن طريق البريد الإلكتروني
                </a>
              </li> --}}
                          @endif
         
                {{-- start lang--}}
             
                  
             
          
          
           {{-- end lang--}}


          </ul>
        </div>
      </div>
    </nav>



    <div class="container text-center mt-5 mb-4" style="width:50%;background: #fff;
    padding: 35px;">
        <h1>404</h1>
        <p>الصفحة التي تبحث عنها غير موجودة...</p>
        <a href="{{url('/')}}" class="btn  " style="background-color: #fdc93a">الرجوع الى الصفحة الرئيسية</a>
    </div>


















  <!-- قائمة سفلية -->
  <div class="fixed-bottom">
    <div class="bottom-nav-container ">
      <nav class="navbar navbar-light">
        <ul class="navbar-nav d-flex flex-row justify-content-between w-100">
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ url('/') }}"><i class="fas fa-home icon-style"></i><br><span>الرئيسية</span></a>
          </li>        
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ url('/package/all') }}"><i class="fa fa-sitemap icon-style"></i><br><span>الباقات</span></a>
          </li>         
          @if (Auth::check())
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ route('mainPageSetting.userr',Auth::guard()->user()->name) }}"><i class="fas fa-user icon-style"></i><br><span>حسابي</span></a>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
  
  <!-- Bootstrap core JavaScript و JQuery-->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
 
  <script src="{{ url('/public/assets/site/js/jquery-3.7.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>

  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{ url('/public/ckeditor/ckeditor.js') }}"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>


  @if (session('success'))
    <script>
        swal("{{ session('success') }}");
    </script>
    @endif
    @if (session('pass'))
    <script>
        swal("تمت العملية بنجاح", "بامكانك الدخول الى حسابك", "success");
    </script>
    @endif
  
  @yield('js')
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
  

  
