@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الدول</h6>
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

        {{-- ################# من اجل اظهار رسالة بأنه تمت الاضافة################# --}}
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-white" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>
        {{-- #################  نهاية ################# --}}

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
                    <li class="breadcrumb-item"><a href="{{ route('countries.main') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('countries.update' , $countries->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">اسم الدولة</label>
                    <input type="text" class="form-controll" name="country_name"  value="{{$countries->country_name}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">رايط الصفحة</label>
                    <input type="text" class="form-controll" name="href"  value="{{$countries->href}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                    <input type="text" class="form-controll" name="keyword" value="{{$countries->keyword}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">علم الدولة</label>
                    <input type="file" name="country_flag" class="form-controll">
                    <img src="{{url('../public/uploading/' . $countries->country_flag)}}" alt="{{$countries->country_name}}">
                    {{-- @if ($errors->has('country_flag'))
                        <span class="text-danger"><strong>{{ $errors->first('country_flag') }}</strong></span>
                        <div class="alert alert-light" role="alert">
                            You should to be picture dimensions max_width:600,max_height:600
                        </div>
                    @endif --}}

                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">عنوان</label>
                    <input type="text" class="form-controll" name="title"  value="{{$countries->title}}">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlDes">وصف (meta)</label>
                    <textarea type="text" id="exampleFormControlDes" name="meta_descr" class="form-controll resizeForTextarea">{{$countries->meta_descr}}</textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="exampleFormControlTextarea1"> حالة الظهور اولا</label>
                    <input type="checkbox" name="show_status" value="1" {{($countries->show_status == 1?'checked': '')}}>
                </div> --}}


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>

    </main>

@endsection
