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

                        <a href="{{ url('admin/package/all') }}">الباقات</a>/
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

                    <h5 class="head-search-sitess">تعديل باقة </h5>
                    <div class="fetchD" style="display: contents;">
                        <form action="{{ url('admin/package/update', $package->id) }}" method="POST" id="form-product"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">اسم الباقة</label>
                                    <input type="text" class="site form-controll" id="name" name="name"
                                        value="{{ $package->name }}" aria-describedby="textHelp">
                                    <div id="name-error" class="invalid-feedback"></div>

                                </div>
                                <div class="mb-3">
                                    <label for="code" class="form-label">الرمز </label>
                                    <input type="text" class="site form-controll" id="code" name="code"
                                        value="{{ $package->code }}" aria-describedby="textHelp">
                                    <div id="code-error" class="invalid-feedback"></div>



                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="href" name="href"
                                            value="{{ $package->href }}" @if ($package->href == '1') checked @endif>
                                        <label class="custom-control-label" for="href"
                                            style="padding-right: 8px;font-size: 20px;" id="href_lbl">رابط
                                            الشركة</label>
                                        <div id="href-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="category" name="category"
                                            value="{{ $package->category }}"
                                            @if ($package->category == '1') checked @endif>
                                        <label class="custom-control-label" for="category"
                                            style="padding-right: 8px;font-size: 20px;" id="category_lbl">التصنيف</label>
                                        <div id="href-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="subcategories"
                                            name="subcategories" value="{{ $package->subcategories }}"
                                            @if ($package->subcategories == '1') checked @endif>
                                        <label class="custom-control-label" for="subcategories"
                                            style="padding-right: 8px;font-size: 20px;" id="subcategories_lbl">التصنيف
                                            الفرعي</label>
                                        <div id="subcategories-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="title"
                                            name="title" value="{{ $package->title }}"
                                            @if ($package->title == '1') checked @endif>
                                        <label class="custom-control-label" for="title"
                                            style="padding-right: 8px;font-size: 20px;" id="title_lbl">العنوان</label>
                                        <div id="title-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="description"
                                            name="description" value="{{ $package->description }}"
                                            @if ($package->description == '1') checked @endif>
                                        <label class="custom-control-label" for="description"
                                            style="padding-right: 8px;font-size: 20px;" id="description_lbl">نبذة </label>
                                        <div id="description-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="articale"
                                            name="articale" value="{{ $package->articale }}"
                                            @if ($package->articale == '1') checked @endif>
                                        <label class="custom-control-label" for="articale"
                                            style="padding-right: 8px;font-size: 20px;" id="articale_lbl">مقال ذو صلة
                                        </label>
                                        <div id="articale-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="video"
                                            name="video" value="{{ $package->video }}"
                                            @if ($package->video == '1') checked @endif>
                                        <label class="custom-control-label" for="video"
                                            style="padding-right: 8px;font-size: 20px;" id="video_lbl">كود الفيديو
                                        </label>
                                        <div id="video-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="keyword"
                                            name="keyword" value="{{ $package->keyword }}"
                                            @if ($package->keyword == '1') checked @endif>
                                        <label class="custom-control-label" for="keyword"
                                            style="padding-right: 8px;font-size: 20px;" id="keyword_lbl">كلمات المفتاحية
                                        </label>
                                        <div id="keyword-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="logo"
                                            name="logo" value="{{ $package->logo }}"
                                            @if ($package->logo == '1') checked @endif>
                                        <label class="custom-control-label" for="logo"
                                            style="padding-right: 8px;font-size: 20px;" id="logo_lbl">شعار الشركة
                                        </label>
                                        <div id="logo-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="mobile_number"
                                            name="mobile_number" value="{{ $package->mobile_number }}"
                                            @if ($package->mobile_number == '1') checked @endif>
                                        <label class="custom-control-label" for="mobile_number"
                                            style="padding-right: 8px;font-size: 20px;" id="mobile_number_lbl">رقم الجوال
                                        </label>
                                        <div id="mobile_number-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="phone_number"
                                            name="phone_number" value="{{ $package->phone_number }}"
                                            @if ($package->phone_number == '1') checked @endif>
                                        <label class="custom-control-label" for="phone_number"
                                            style="padding-right: 8px;font-size: 20px;" id="phone_number_lbl">رقم الهاتف
                                        </label>
                                        <div id="phone_number-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="social"
                                            name="social" value="{{ $package->social }}"
                                            @if ($package->social == '1') checked @endif>
                                        <label class="custom-control-label" for="social"
                                            style="padding-right: 8px;font-size: 20px;" id="social_lbl">عناوين وسائل
                                            التواصل الاجتماعي </label>
                                        <div id="social-error" class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="android"
                                            name="android" value="{{ $package->android }}"
                                            @if ($package->android == '1') checked @endif>
                                        <label class="custom-control-label" for="android"
                                            style="padding-right: 8px;font-size: 20px;" id="android_lbl">رابط تطبيق
                                            الاندرويد </label>
                                        <div id="android-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="ios"
                                            name="ios" value="{{ $package->ios }}"
                                            @if ($package->ios == '1') checked @endif>
                                        <label class="custom-control-label" for="ios"
                                            style="padding-right: 8px;font-size: 20px;" id="ios_lbl">رابط تطبيق الايفون
                                        </label>
                                        <div id="ios-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="city"
                                            name="city" value="{{ $package->city }}"
                                            @if ($package->city == '1') checked @endif>
                                        <label class="custom-control-label" for="city"
                                            style="padding-right: 8px;font-size: 20px;" id="city_lbl">تحديد المحافظة
                                            والمدينة </label>
                                        <div id="city-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="map"
                                            name="map" value="{{ $package->maploc }}"
                                            @if ($package->maploc == '1') checked @endif>
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
                                    <input class="form-controll" name="sites_count" type="number" id="sites_count"
                                        value="{{ $package->sites_count }}">

                                </div>
                                <div class="form-check mt-3 mb-3">
                                    <label for="products_count">
                                        عدد المنتجات لكل موقع
                                    </label>
                                    <input class="form-controll" name="products_count" type="number" id="sites_count"
                                        value="{{ $package->products_count }}">

                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="is_free"
                                            name="is_free" value="{{ $package->is_free }}"
                                            @if ($package->is_free == '1') checked @endif>
                                        <label class="custom-control-label" for="is_free"
                                            style="padding-right: 8px;font-size: 20px;" id="city_lbl">باقة مجانية</label>
                                        <div id="is_free-error" class="invalid-feedback"></div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="col-sm-8 custom-control custom-switch ">
                                        <input type="checkbox" class="custom-control-input" id="status"
                                            name="status" value="{{ $package->status }}"
                                            @if ($package->status == '1') checked @endif>
                                        <label class="custom-control-label" for="status"
                                            style="padding-right: 8px;font-size: 20px;" id="status_lbl">الباقة مفعلة
                                        </label>
                                        <div id="status-error" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                {{-- year - price section --}}
                                <div class="mb-3">
                                    <label for="year" class="form-label">المدة/سنة</label>
                                    <select class="form-controll" id="year" name="year">
                                        @foreach ($durations as $duration)
                                            <option value="{{ $duration->id }}"> {{ $duration->duration }}</option>
                                        @endforeach
                                    </select><span> - </span>
                                    <label for="price" class="form-label"
                                        style="padding-left:10px;padding-right: 10px">السعر</label>
                                    <input class="form-controll" name="price" id="price">
                                    <button type="button" class="btn btn-primary  " id="addRow-edit"
                                        style="padding:0px 10px;font-size: 18px; margin-bottom: 0px;">+</button>
                                    <div id="type-error" class="invalid-feedback"></div>

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
                                            @if ($package->durationspackages)
                                                @foreach ($package->durationspackages->sortBy('duration.duration') as $durationp)
                                                    <tr>
                                                        <td class="text-center" id="year- {{ $durationp->duration_id }}">
                                                            {{ $durationp->duration->duration }}</td>
                                                        <td class="text-center"> {{ $durationp->price }}</td>
                                                        <td class="editt">
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm edit-row-btn">تعديل</button>
                                                            <button type="submit" class="btn btn-danger btn-sm delete"
                                                                title="Delete">حذف</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <input name="year_price" type="hidden" id="year_price" value="">


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


    {{-- Modal edit --}}
    <div class="modal fade" id="edit-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="z-index:999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل السعر </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="container mt-2">
                    <ul id="edit_div_err"></ul>



                    <label for="year-edit" class="form-label" style="padding-left:10px;padding-right: 10px">المدة</label>
                    <span class="form-controll" name="year-edit" id="year-edit"></span>
                    <label for="price-edit" class="form-label"
                        style="padding-left:10px;padding-right: 10px">السعر</label>
                    <input class="form-controll text-center" name="price-edit" id="price-edit" style="width: 100px;">

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                    <button type="button" class="btn btn-primary " id="btn-modal-edit">تعديل</button>
                </div>

            </div>
        </div>
    </div>
    {{-- end-   Modal edit --}}


@endsection

@section('map-js')
    <script src="{{ url('public/dashboard/js/package/package.js') }}"></script>
@endsection





 
