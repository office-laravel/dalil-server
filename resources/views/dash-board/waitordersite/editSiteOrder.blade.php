@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">المواقع</h6>
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
                    {{ $message }}
                </div>
            @endif
        </div>

        @if (count($errors) > 0)

            <ul>
                @foreach ($errors->all() as $item)
                    <li class="text-danger">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

        @endif

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('sites.order') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('update.order.site' , $orderById->id) }}" method="POST">
                @csrf

                <div class="form-row mb-2">
                    {{-- <div class="col">
                        <label for="exampleFormControlInput1">اسم الموقع</label>
                        <input type="text" class="form-controll" name="site_name" value="{{$sites->site_name}}">
                    </div> --}}

                    <div class="col-md-12 mb-3">
                        <label><strong>نبذة :</strong></label>
                        <textarea class="ckeditor form-controll" name="description" >{{$orderById->description}}</textarea>
                    </div>
                </div>

                <div class="form-row row mb-2">
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="facebook" class="form-label text-black">فيسبوك</label>
                        <input type="text" class="form-controll facebook" value="{{$orderById->facebook}}" name="facebook" id="facebook">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="telegram" class="form-label text-black">قناة تلجرام</label>
                        <input type="text" class="form-controll telegram" value="{{$orderById->telegram}}" name="telegram" id="telegram">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="twitter" class="form-label text-black">تويتر</label>
                        <input type="text" class="form-controll twitter" value="{{$orderById->twitter}}" name="twitter" id="twitter">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="instagram" class="form-label text-black">صفحة
                            انستاغرام</label>
                        <input type="text" class="form-controll instagram" value="{{$orderById->instagram}}" name="instagram" id="instagram">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="youtube" class="form-label text-black">قناة يوتيوب</label>
                        <input type="text" class="form-controll youtube" value="{{$orderById->youtube}}" name="youtube" id="youtube">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="snapchat" class="form-label text-black">سناب تشات</label>
                        <input type="text" class="form-controll snapchat" value="{{$orderById->snapchat}}" name="snapchat" id="snapchat">
                    </div>
                    <div class="mb-3 col-sm-12 col-md-4">
                        <label for="linkedin" class="form-label text-black">LinkedIn</label>
                        <input type="text" class="form-controll linkedin" value="{{$orderById->LinkedIn}}" name="linkedin" id="linkedin">
                    </div>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>

    </main>

@endsection





