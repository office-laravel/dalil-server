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

  <script>
    $(document).ready(function() {    
      $(".navbar-toggler").click(function() {
        $("#sidebar").addClass("active");
      });    
      $("#closeSidebar").click(function() {
        $("#sidebar").removeClass("active");
      });      
    $(".has-submenu").click(function(e) {
      e.preventDefault();  
      $(this).next(".submenu").slideToggle();  
      $(this).find(".toggle-submenu").toggleClass("open");  
    });
    });
  </script>  
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
 
  