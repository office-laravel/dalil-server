@extends('dash-board.layout.navabr&footer')

@section('content')
    @include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">
                        <a href="{{ route('sites.main') }}">لوحة التحكم</a>/

                        <a href="{{ url('admin/subscribe/all') }}">الاشتراكات</a>/
                        <span> تعديل</span>
                    </h6>
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
                            <a href="{{ route('admin.logout') }}" class="nav-link text-body font-weight-bold px-0 logout">
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
            <div class="container">


                <br>


                <div class="list-sitess-search">

                    <h5 class="head-search-sitess">تعديل اشتراك </h5>
                    <div class="fetchD" style="display: contents;">
                        <form action="{{ url('admin/subscribe/update', $subscribe->id) }}" method="POST" id="form-product"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- user section --}}
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">العضو</label>
                                    <select class="form-controll" id="user_id" name="user_id">
                                        <option value=""> اختر العضو</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == $subscribe->user_id ? 'selected' : '' }}>
                                                {{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- package section --}}
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">الباقة</label>

                                    <select class="form-controll" id="package_id" name="package_id">
                                        <option value="0"> اختر الباقة</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                {{ $package->id == $subscribe->package_id ? 'selected' : '' }}>
                                                {{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- year section --}}
                                <div class="mb-3">
                                    <label for="year" class="form-label">المدة/سنة</label>
                                    <select class="form-controll" id="year" name="year">

                                        <option value=""> اختر المدة</option>"

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">الحالة</label>

                                    <select class="form-controll" id="status" name="status">
                                        <option value="0"> اختر الحالة</option>                                        
                                            <option value="w"
                                                {{ $subscribe->status == 'w' ? 'selected' : '' }}>
                                                انتظار</option>
                                                <option value="a"
                                                {{ $subscribe->status == 'a' ? 'selected' : '' }}>
                                                موافق</option>
                                                <option value="r"
                                                {{ $subscribe->status == 'r' ? 'selected' : '' }}>
                                               مرفوض</option>
                                        
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-submit"
                                        style="padding-left:40px;padding-right: 40px">حفظ</button>
                                    <button type="button" class="btn btn-secondary">الغاء الامر</button>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
    </main>
@endsection

@section('map-js')
    <script>
        var token = '{{ csrf_token() }}';
        var durationurl = "{{ url('subscribeyears/ItemId') }}";
        var selyear = "{{ $subscribe->duration_package_id }}";
        var selpackage = "{{ $subscribe->package_id }}";
    </script>
    <script src="{{ url('public/dashboard/js/package/subscribe.js') }}"></script>
@endsection
 
