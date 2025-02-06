@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الاعلانات</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

                    <ul class="navbar-nav me-auto ms-0 justify-content-end">

                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{route('admin.logout')}}"
                                class="nav-link text-body font-weight-bold px-0 logout">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">تسجيل خروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <!-- End Navbar -->

        {{-- لوحة ادخال الاعلانات --}}

        <form method="POST" action="{{ route('setAdd') }}" class=" m-5  shadow ">
            @csrf
            @if (!empty(session('msg')))
                <div class="row backgroundW p-4  ">
                    <div class="alert" style="background-color: #42424a ">
                        <ul>
                            <li style="color:white" class="">{{ session('msg') }}</li>
                        </ul>
                    </div>
                </div>
            @endif
            {{-- ارسال الأخطاء --}}
            <div class="row backgroundW p-4  ">

                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">ضمن وسم Head</label>
                    <textarea type="text" id="Description" name="setHead" class="form-controll resizeForTextarea">
@isset($Adds)
{{ $Adds->atHead }}
@endisset
</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">أعلى محتوى الصفحة</label>
                    <textarea type="text" id="Description" name="setTop" class="form-controll resizeForTextarea">
@isset($Adds)
{{ $Adds->atTop }}
@endisset
</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">منتصف القائمة الجانبية</label>
                    <textarea type="text" id="Description" name="setCenter" class="form-controll resizeForTextarea">
@isset($Adds)
{{ $Adds->atRight }}
@endisset
</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">في المزيد من الاختبارات</label>
                    <textarea type="text" id="Description" name="otherSite" class="form-controll resizeForTextarea">
@isset($Adds)
{{ $Adds->otherSite }}
@endisset
</textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark" style="background-color:#42424a">حفظ</button>
                </div>
        </form>
        </div>

        {{-- نهاية لوحة ادخال الاعلانات --}}
        </div>
    </main>
@endsection
