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
            <div class="container">
                <div class="sear d-flex justify-content-center">
                <form id="searchthis" action="{{route('live_search.action')}}" style="display:inline;" method="get">

                    <input id="search" name="q" type="text" placeholder="ما الذي تبحث عنه؟" required="">
                    <!--<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>-->
                    <!--  -->
                </form>    
                </div>
                
                <div class="form-group btn-create">
                    <h4>المواقع</h4>
                    <br>
                    
                    <a href="{{ route('sites.create') }}" class="btn btn-success">اضافة موقع</a>
                    
                </div><br>
                <br>
                <div class="btn-group">
                    <label for="">تصفية:</label>
                    <button class="dropdown-toggle tgle" id="bbb" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @isset($country_namess)
                            {{$country_namess->country_name}}
                        @endisset
                    </button>

                    <div class="dropdown-menu">
                        <ul class="listt" id ="drop_list">
                            <a class="text-decoration-none text-dark mb-1"
                                href="{{ route('sites.main') }}">
                                <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                            </a>
                            @foreach ($country_names as $get_country)
                            <a class="text-decoration-none text-dark mb-1"
                                    href="{{route('getSitesCounttry' , [$get_country->id])}}" >
                            <li id="eee" style="text-align: right">
                                    {{$get_country->country_name}}

                                </li></a>
                            @endforeach

                        </ul>

                    </div>

                </div>
            </div>




            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">اسم الموقع</th>
                            <th scope="col">رابط الموقع</th>
                            <th scope="col">عنوان</th>
                            {{-- <th scope="col">وصف</th>
                            <th scope="col">الدولة</th>
                            <th scope="col">كلمات المفتاحية</th>
                            <th scope="col">تصنيفه (تصنيف الاب)</th>
                            <th scope="col">تصنيفات الفرعية</th>
                            <th scope="col">تاغات</th>
                            <th scope="col">facebook</th>
                            <th scope="col">twitter</th>
                            <th scope="col">instagram</th>
                            <th scope="col">snapchat</th>
                            <th scope="col">youtube</th>
                            <th scope="col">telegram</th>
                            <th scope="col">android_link</th>
                            <th scope="col">ios_link</th> --}}
                            <!--<th scope="col">عمليات</th>-->


                        </tr>
                    </thead>
                    <tbody class="tt">
                        
                        
                    </tbody>
                </table>
            </div>
        </div>

    </main>

@endsection