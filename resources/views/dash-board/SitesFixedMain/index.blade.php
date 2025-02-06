@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">مواقع مثبتة الرئيسية</h6>
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
                    <h4>مواقع مثبتة الرئيسية</h4>
                    <a href="{{ route('fixedsitesmain.create') }}" class="btn btn-success">اضافة موقع</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">اسم الموقع</th>
                            <th scope="col">رابط الموقع</th>
                            <th scope="col">صورة</th>
                            <th scope="col">عمليات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($fixedsitestmain as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->link }}</td>
                                <td><img src="{{ url('../public/uploading/' . $item->img) }}" alt=""
                                        class="img-tumbnail"></td>

                                <td>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('fixedsitesmain.edit', $item->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>

                                        <div class="col-sm">
                                            <a href="{{ route('fixedsitesmain.destroy', ['id' => $item->id]) }}"><i
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
                    </tbody>
                </table>
            </div>
        </div>

    </main>

@endsection
