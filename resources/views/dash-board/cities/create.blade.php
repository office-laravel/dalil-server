@extends('dash-board.layout.navabr&footer')
@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">اضافة مدن</h6>
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
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown ps-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
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

        @if ($errors->all())
            <div class="container">
                <div class="alert row" style="background-color:#42424a ">
                    <ul style="color:white">
                        انتبه !!!
                        @foreach ($errors->all() as $error)
                            <li style="color:white ;font-family: Arabic;" class=>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('city.all') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('city.store') }}" method="POST" >
                @csrf

                <select style="width:100%;overflow-y: scroll; padding:5px;" class="form-cdontroll" id="country_id"
                    name="country_id">
                    <option value="" selected disabled>أختر الدولة</option>
                    @foreach ($country as $val)
                        <option value="{{ $val->id }}">
                            {{ $val->country_name }}
                        </option>
                    @endforeach
                </select>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">اسم المدينة</label>
                    <input type="text" name="name" placeholder="ادخل اسم المدينة" class="form-controll">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">رابط المدينة</label>
                    <input type="text" name="href" placeholder="رابط المدينة" class="form-controll">
                </div>
                {{--<div class="col-md-12 mb-3">
                    <label><strong> المحتوى النصي(وصف):</strong></label>
                    <textarea class="ckeditor form-controll" name="description"></textarea>
                </div>--}}

                
                <div class="col-12">
                    <button type="submit" class="btn btn-dark" style="background-color:#42424a">حفظ</button>
                </div>
            </form>
        </div>

    </main>

@endsection
<style>
    .styleFile {
        position: absolute;
        display: none;
        width: 0.1px;
    }
</style>
