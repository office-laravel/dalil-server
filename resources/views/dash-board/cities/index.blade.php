@extends('dash-board.layout.navabr&footer')
@section('content')
@include('dash-board.layout.sidebar')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">مدن</h6>
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

    {{-- <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-white" role="alert">
                {{ $message }}
            </div>
        @endif
    </div> --}}

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
                <h4>مدن</h4>
                <a href="{{route('city.create')}}" class="btn btn-success">اضافة مدن</a>
            </div><br><br>

            {{-- <div class="btn-group">
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
                            href="{{ route('categories.main') }}">
                            <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                        </a>
                        @foreach ($country_names as $get_country)
                        <a class="text-decoration-none text-dark mb-1"
                                href="{{route('getCateCount' , [$get_country->id])}}" >
                        <li id="eee" style="text-align: right">
                                {{$get_country->country_name}}

                            </li></a>
                        @endforeach

                    </ul>

                </div>

            </div> --}}
        </div>


        <div class="table-responsive">

            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">الدولة</th>
                        <th scope="col">مدينة</th>
                        <th scope="col">رابط المدينة</th>
                        <th scope="col">عمليات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cities as $item)


                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->country->country_name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->href}}</td>

                            <td>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <a href="{{route('city.edit' , $item->id)}}" ><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                    <div class="col-sm">
                                            <a href="{{route('city.delete', ['id' => $item->id])}}"><i class="fa-solid fa-trash-can"></i></a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>

</main>



@endsection

