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
                        <a href="{{ route('sites.main') }}">الشركات</a>/
                        <a href="{{ route('sites.edit', $site->id) }}">{{ $site->site_name }}</a>/
                        <a href="{{ url('admin/product/all', $site->id) }}">المنتجات</a>/
                        <span>منتج جديد</span>
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

                    <h5 class="head-search-sitess">اضافة منتج </h5>
                    <div class="fetchD" style="display: contents;">
                        <form action="{{ url('admin/product/store') }}" method="POST" id="form-product"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">اسم المنتج</label>
                                    <input type="text" class="site form-controll" id="name" name="name"
                                        value="" aria-describedby="textHelp">
                                    <div id="name-error" class="invalid-feedback"></div>

                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">النوع</label>
                                    <select class="form-controll" id="type" name="type">
                                        <option value="0">اختر النوع</option>
                                        <option value="p">منتج مادي
                                        </option>
                                        <option value="s">خدمة</option>
                                    </select>
                                    <div id="type-error" class="invalid-feedback"></div>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <label><strong>الوصف </strong></label>
                                    <textarea class="ckeditor form-controll" name="description"></textarea>
                                </div>
                                <div class="mb-3" style="width: 50%">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="text" class="site form-controll" id="price" name="price"
                                        value="" aria-describedby="textHelp">
                                    <div id="price-error" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3" style="width: 25%">
                                    <label for="currency" class="form-label">العملة</label>
                                    <input type="text" class="site form-controll" id="currency" name="currency"
                                        value="" aria-describedby="textHelp">
                                    <div id="currency-error" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">الوحدة</label>
                                    <input type="text" class="site form-controll" id="unit" name="unit"
                                        value="" aria-describedby="textHelp" placeholder="قطعة">
                                    <div id="price-error" class="invalid-feedback"></div>

                                </div>
                                <div class="mb-3">
                                    <label for="sequence" class="form-label">الترتيب</label>
                                    <input type="text" class="site form-controll" id="sequence" name="sequence"
                                        value="" aria-describedby="textHelp" placeholder="1">
                                    <div id="sequence-error" class="invalid-feedback"></div>

                                </div>
                                <div style="width:300px;">
                                    <label for="image" class="form-labell ">صورة المنتج</label>
                                    <input type="file" name="image" id="image" class="form-controll mt-2">

                                </div>
                                <div style="width:300px;padding:20px;">
                                    <img src="" style="padding: 5px;border:1px solid #ced4da" width="100px;"
                                        id="imgshow">

                                </div>
                                <input type="hidden" name="site_id" value="{{ $site->id }}">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-submit "
                                        style="padding-left:40px;padding-right: 40px">حفظ</button>
                                    <button type="button" class="btn btn-secondary">الغاء الامر</button>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>


            </div>


        </div>

    </main>





@endsection

@section('map-js')
    <script src="{{ url('js/product.js') }}"></script>
@endsection





@section('map-js')
@endsection
