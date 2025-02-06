@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">المواقع المثبتة</h6>
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

        <div class="container">
            @if ($message = Session::get('success'))
            <div class="alert alert-white" role="alert">
                {{$message}}
            </div>

            @endif
        </div>

        @if (count($errors) > 0)

        <ul>
            @foreach ($errors->all() as $item)
                <li class="text-danger">
                    {{$item}}
                </li>
            @endforeach
        </ul>

        @endif

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('fixedsites.main')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('fixedsites.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <h4>الدولة:</h4>
                <select style="width: 200px" class="form-cdontrol" id="countries" name="countries">
                    <option value="">أختر الدولة</option>
                    @foreach ($countries as $get_country)
                        <option value="{{$get_country->id}},{{$get_country->show_status}}">{{$get_country->country_name}}</option>
                    @endforeach
                </select>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">اسم الموقع</label>
                    <input type="text" name="site_name" placeholder="ادخل اسم الموقع" class="form-controll">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">رابط الموقع</label>
                    <input type="text" name="href" placeholder="ادخل رابط الموقع" class="form-controll">

                </div>

                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">صورة</label>
                    <input type="file" name="photo"  class="form-controll">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-dark" style="background-color:#42424a">حفظ</button>
                </div>
            </form>
        </div>

    </main>

  @endsection
