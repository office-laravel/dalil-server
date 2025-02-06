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
                <div class="form-group btn-create">
                    <h4>الدول</h4>
                    <a href="{{ route('countries.create') }}" class="btn btn-success">اضافة الدولة</a>
                </div>
            </div>
            <div class="btn-group">
                    <label for="">فلترة الدول:</label>
                    <button class="dropdown-toggle tgle" id="bbb" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">

                        @if(isset($country_namess))
                            {{$country_namess->country_name}}
                        @else
                        رئيسية
                        @endif
                    </button>

                    <div class="dropdown-menu">
                        <ul class="listt" id ="drop_list">
                            <a class="text-decoration-none text-dark mb-1"
                                href="{{ route('countries.main') }}">
                                <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                            </a>
                            @foreach ($country_names as $get_country)
                            <a class="text-decoration-none text-dark mb-1"
                                    href="{{route('getCitiesCounttry' , [$get_country->id])}}" >
                            <li id="eee" style="text-align: right">
                                    {{$get_country->country_name}}

                                </li></a>
                            @endforeach

                        </ul>

                    </div>

                    </div>
                    @isset($showallcountries)
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">اسم الدولة</th>
                            <th scope="col">رابط الدولة</th>
                            <th scope="col">علم الدولة</th>
                            <th scope="col">عنوان</th>
                            {{-- <th scope="col">حالة ظهور اولا</th> --}}
                            <th scope="col">عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($showallcountries)
                        @forelse ($showallcountries as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->country_name }}</td>
                                <td>{{ $item->href }}</td>
                                <td><img src="{{ url('../public/uploading/' . $item->country_flag) }}" alt=""
                                        class="img-tumbnail"></td>
                                <td>{{ $item->title }}</td>
                                {{-- <td>{{ $item->show_status }}</td> --}}

                                <td>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('countries.edit', $item->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>

                                        <div class="col-sm">
                                            <a href="{{ route('countries.destroy', ['id' => $item->id]) }}"><i
                                                    class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                        <tr>
                            <td colspan="7" style="text-align:center;">لايوجد بيانات لعرضها</td>
                        </tr>
                        @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>
            @endisset
            @isset($cities_show)
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">اسم المدينة</th>
                                <th scope="col">رابط المدينة</th>
                                {{-- <th scope="col">عمليات</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities_show as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->href }}</td>
    
                                    {{-- <td style="width: 50px">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="{{ route('city.edit', $item->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div class="col-sm">
                                                <a href="{{ route('city.destroy', ['id' => $item->id]) }}"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>
    
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endisset
                
            @if(isset($cities_show))
            {!! $cities_show->appends(['sort' => 'votes'])->links() !!}
            @endif
        </div>

    </main>

@endsection
