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
                        <span> جديد</span>
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

                    <h5 class="head-search-sitess">اضافة اشتراك </h5>
                    <div class="fetchD" style="display: contents;">
                        <form action="{{ url('admin/subscribe/store') }}" method="POST" id="form-product"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- user section --}}
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">العضو</label>
                                    <select class="form-controll" id="user_id" name="user_id">
                                        <option value=""> اختر العضو</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"> {{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- package section --}}
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">الباقة</label>

                                    <select class="form-controll" id="package_id" name="package_id">
                                        <option value="0"> اختر الباقة</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"> {{ $package->name }}</option>
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
                                    <button type="submit" class="btn btn-primary btn-submit"
                                        style="padding-left:40px;padding-right: 40px">حفظ</button>
                                    <button type="button" class="btn btn-secondary">الغاء الامر</button>

                                </div>
                            </div>
                        </form>

                        <div class="row">

                            <div class="mb-3">
                                <label for="name" class="form-label">اسم الباقة</label>
                                <input type="text" class="site form-controll" id="name" name="name"
                                    value="" aria-describedby="textHelp">
                                <div id="name-error" class="invalid-feedback"></div>

                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">الرمز </label>
                                <input type="text" class="site form-controll" id="code" name="code"
                                    value="" aria-describedby="textHelp">
                                <div id="code-error" class="invalid-feedback"></div>



                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="href" name="href"
                                        value="1" checked>
                                    <label class="custom-control-label" for="href"
                                        style="padding-right: 8px;font-size: 20px;" id="href_lbl">رابط
                                        الشركة</label>
                                    <div id="href-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="category" name="category"
                                        value="1" checked>
                                    <label class="custom-control-label" for="category"
                                        style="padding-right: 8px;font-size: 20px;" id="category_lbl">التصنيف</label>
                                    <div id="href-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="subcategories"
                                        name="subcategories" value="1" checked>
                                    <label class="custom-control-label" for="subcategories"
                                        style="padding-right: 8px;font-size: 20px;" id="subcategories_lbl">التصنيف
                                        الفرعي</label>
                                    <div id="subcategories-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="title" name="title"
                                        value="1" checked>
                                    <label class="custom-control-label" for="title"
                                        style="padding-right: 8px;font-size: 20px;" id="title_lbl">العنوان</label>
                                    <div id="title-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="description"
                                        name="description" value="1" checked>
                                    <label class="custom-control-label" for="description"
                                        style="padding-right: 8px;font-size: 20px;" id="description_lbl">نبذة </label>
                                    <div id="description-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="articale" name="articale"
                                        value="1" checked>
                                    <label class="custom-control-label" for="articale"
                                        style="padding-right: 8px;font-size: 20px;" id="articale_lbl">مقال ذو صلة
                                    </label>
                                    <div id="articale-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="video" name="video"
                                        value="1" checked>
                                    <label class="custom-control-label" for="video"
                                        style="padding-right: 8px;font-size: 20px;" id="video_lbl">كود الفيديو
                                    </label>
                                    <div id="video-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="keyword" name="keyword"
                                        value="1" checked>
                                    <label class="custom-control-label" for="keyword"
                                        style="padding-right: 8px;font-size: 20px;" id="keyword_lbl">كلمات المفتاحية
                                    </label>
                                    <div id="keyword-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="logo" name="logo"
                                        value="1" checked>
                                    <label class="custom-control-label" for="logo"
                                        style="padding-right: 8px;font-size: 20px;" id="logo_lbl">شعار الشركة
                                    </label>
                                    <div id="logo-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="mobile_number"
                                        name="mobile_number" value="1" checked>
                                    <label class="custom-control-label" for="mobile_number"
                                        style="padding-right: 8px;font-size: 20px;" id="mobile_number_lbl">رقم الجوال
                                    </label>
                                    <div id="mobile_number-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="phone_number"
                                        name="phone_number" value="1" checked>
                                    <label class="custom-control-label" for="phone_number"
                                        style="padding-right: 8px;font-size: 20px;" id="phone_number_lbl">رقم الهاتف
                                    </label>
                                    <div id="phone_number-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="social" name="social"
                                        value="1" checked>
                                    <label class="custom-control-label" for="social"
                                        style="padding-right: 8px;font-size: 20px;" id="social_lbl">عناوين وسائل
                                        التواصل الاجتماعي </label>
                                    <div id="social-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="android" name="android"
                                        value="1" checked>
                                    <label class="custom-control-label" for="android"
                                        style="padding-right: 8px;font-size: 20px;" id="android_lbl">رابط تطبيق
                                        الاندرويد </label>
                                    <div id="android-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="ios" name="ios"
                                        value="1" checked>
                                    <label class="custom-control-label" for="ios"
                                        style="padding-right: 8px;font-size: 20px;" id="ios_lbl">رابط تطبيق الايفون
                                    </label>
                                    <div id="ios-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="city" name="city"
                                        value="1" checked>
                                    <label class="custom-control-label" for="city"
                                        style="padding-right: 8px;font-size: 20px;" id="city_lbl">تحديد المحافظة
                                        والمدينة </label>
                                    <div id="city-error" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="map" name="map"
                                        value="1" checked>
                                    <label class="custom-control-label" for="map"
                                        style="padding-right: 8px;font-size: 20px;" id="map_lbl">تحديد الاحداثيات
                                        على الخريطة </label>
                                    <div id="map-error" class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-check mt-3 mb-3">
                                <label for="sites_count">
                                    عدد المواقع
                                </label>
                                <input class="form-controll" name="sites_count" type="number" id="sites_count">

                            </div>
                            <div class="form-check mt-3 mb-3">
                                <label for="products_count">
                                    عدد المنتجات لكل موقع
                                </label>
                                <input class="form-controll" name="products_count" type="number" id="sites_count">

                            </div>

                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="is_free" name="is_free"
                                        value="1" checked>
                                    <label class="custom-control-label" for="is_free"
                                        style="padding-right: 8px;font-size: 20px;" id="city_lbl">باقة مجانية</label>
                                    <div id="is_free-error" class="invalid-feedback"></div>
                                </div>
                            </div>


                            <div class="mb-3">
                                <div class="col-sm-8 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        value="1" checked>
                                    <label class="custom-control-label" for="status"
                                        style="padding-right: 8px;font-size: 20px;" id="status_lbl">الباقة مفعلة
                                    </label>
                                    <div id="status-error" class="invalid-feedback"></div>
                                </div>
                            </div>


                            <div class="fetchD" style="display: contents;">
                                <table class="container table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px">المدة</th>
                                            <th scope="col" style="width: 10px">السعر </th>
                                            <th scope="col">تحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">

                                    </tbody>
                                </table>
                            </div>
                            <input name="year_price" type="hidden" id="year_price" value="">

                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection

@section('map-js')
    <script>
        var token = '{{ csrf_token() }}';
        var durationurl = "{{ url('subscribeyears/ItemId') }}";
        var selyear = "0";
    </script>
    <script src="{{ url('dashboard/js/package/subscribe.js') }}"></script>
@endsection
@section('map-js')
@endsection
