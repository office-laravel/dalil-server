@extends('dash-board.layout.navabr&footer')
@section('content')
    @include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الصفحات الثابتة</h6>
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('categories.main') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!--<h4>الدولة:</h4>-->
                <!--<select style="width: 200px" class="form-cdontrol" id="countries" name="countries">-->
                <!--    <option value="">أختر الدولة</option>-->
                <!--    @foreach ($countries as $get_country)
    -->
                <!--        <option value="{{ $get_country->id }},{{ $get_country->show_status }}" {{ $category->country_id == $get_country->id ? 'selected' : '' }}>{{ $get_country->country_name }}</option>-->
                <!--
    @endforeach-->
                <!--</select>-->
                <h4>التصنيفات:</h4>
                <select style="width: 200px" class="form-cdontrol" id="category" name="category">
                    <option value="0">اختر التصنيف</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $category->parent_id == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                    @endforeach
                </select>

                <h4>التصنيفات الفرعية:</h4>
                <select style="width:200px;" class="form-cdontroll" name="subcategory" id="subcategory">
                    <option value="0">--اختر التصنيف الفرعي--</option>
                    @foreach ($categories as $val)
                        @foreach ($val->supcategories as $key => $index)
                            <option value="{{ $index->id }}" {{ $index->id == $category->id ? 'selected' : '' }}>
                                {{ $index->category_name }}</option>
                        @endforeach
                    @endforeach
                </select>

                <div class="form-group">
                    <label for="exampleFormControlInput1">اسم التصنيف</label>
                    <input type="text" class="form-controll" name="category_name"
                        value="{{ $category->category_name }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">رابط الصفحة</label>
                    <input type="text" class="form-controll" name="href" value="{{ $category->href }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">كلمات مفتاحية</label>
                    <input type="text" class="form-controll" name="keywords" value="{{ $category->keywords }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">عنوان</label>
                    <input type="text" class="form-controll" name="title" value="{{ $category->title }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">حالة الظهور</label>
                    <input type="hidden" name="visible_status" value="0">
                    <input type="checkbox" name="visible_status" value="1"
                        {{ $category->visible_status == 1 ? 'checked' : '' }}>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image" class="form-labell ">صورة</label>
                    <input type="file" name="image" class="form-controll">
                    <img src="{{ url('/public/PicCate/' . $category->image) }}" width="100px" height="70px"
                        alt="">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="icon" class="form-labell ">ايقونة</label>
                    <input type="file" name="icon" class="form-controll">
                    <img src="{{ url('/PicCate/icon/' . $category->icon) }}" width="50px" alt="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>

    </main>

@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#countries').on('change', function() {
                var country_id = this.value;
                console.log(country_id);
                $.ajax({
                    url: "{{ route('getcate') }}",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#category').empty();
                        $('#category').append('<option disabled> أختر التصنيف  </option>');
                        $('#category').append('<option value = "0"> -- لا شيئ --</option>');
                        $.each(data, function(key, value) {
                            console.log(data[0].category_name);
                            $('#category').append('<option value="' + value.id + '">' +
                                value.category_name + '</option>');
                        });
                        console.log(data[0].category_name);
                    }
                })
            });
            $('#category').on('change', function(e) {
                var cat_id = e.target.value;
                console.log(cat_id);
                $.ajax({
                    url: "{{ route('supcate') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        // $('#subcategory').append('<option> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = ""> -- بدون اب --</option>');
                        $.each(data.supcategories[0].supcategories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '"selected>' + subcategory.category_name +
                                '</option>');
                        })
                        console.log(data);
                    }
                })
            });
        });
    </script>
@endsection
