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
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('sites.main') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('sites.update', $sites->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>العضو</label>
                <select style="width: 200px" class="form-cdontrol mb-2" id="user_id" name="user_id">
                    <option value="">أختر العضو</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $sites->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->email }}</option>
                    @endforeach
                </select>
                <br>
                <label>المحافظة</label>
                <select style="width: 200px" class="form-cdontrol mb-2" id="city_id" name="city_id">
                    <option value="">أختر المحافظة</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $sites->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}</option>
                    @endforeach
                </select>
                <br>
                <label>المدينة</label>
                <select style="width: 200px" class="form-cdontrol mb-2" id="subcity" name="subcity">
                    <option value="">أختر المدينة</option>
                </select><br>
                <!-- Map -->
                <!-- خريطة Leaflet -->
                <div class="map-out-cls">
                    <div id="map" style="height: 400px; width: 100%;" class="map-cls"></div>
                </div>
                <div class="form-group" style="width: 200px">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="latitude" value="{{ $sites->latitude }}"
                        class="form-controll">
                </div>
                <div class="form-group" style="width: 200px">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="longitude" value="{{ $sites->longitude }}"
                        class="form-controll">
                </div>
                <!-- Map end -->
                <h4>التصنيفات:</h4>
                <select style="width: 200px" class="form-cdontrol" id="category" name="category">
                    <option value="0">أختر التصنيف</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $sites->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                    @endforeach
                </select>
                <h4>التصنيفات الفرعية:</h4>
                <select style="width:200px;" class="form-cdontrol" name="subcategory" id="subcategory">
                    <option value="0">--بدون الاب--</option>
                    @foreach ($scategories as $item)
                        <option value="{{ $item->id }}" {{ $sites->subcategories == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                    @endforeach
                </select>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">اسم الموقع</label>
                        <input type="text" class="form-controll" name="site_name" value="{{ $sites->site_name }}">
                    </div>
                    {{-- <div class="col">
                        <label for="">Tags:</label>
                        @foreach ($tags as $tag)
                            <input type="checkbox" name="name[]"
                                value="{{$tag->id}}"

                                @foreach ($sites->tags as $item_tag)
                                    @if ($tag->id == $item_tag->id)
                                        checked
                                    @endif
                                @endforeach
                            >
                            <label for="">{{$tag->name}}</label>
                        @endforeach

                    </div> --}}

                    <div class="col">
                        <label for="exampleFormControlInput1">رابط الموقع</label>
                        <input type="text" class="form-controll" name="href" value="{{ $sites->href }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">عنوان</label>
                        <input type="text" class="form-controll" name="title" value="{{ $sites->title }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label><strong>نبذة :</strong></label>
                        <textarea class="ckeditor form-controll" name="description">{{ $sites->description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>مقال ذو صلة :</strong></label>
                        <textarea class="ckeditor form-controll" name="articale">{{ $sites->articale }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>كود الفيديو:</strong></label>
                        <textarea class="form-controll" name="video">{{ $sites->video }}</textarea>
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                        <input type="text" class="form-controll" name="keyword" value="{{ $sites->keyword }}">
                    </div>
                    <div class="col">
                        <label for="tags">تاغات (يجب فصل بفاصلة عن كل تاغ)</label>
                        <input type="text" id="tags" class="form-controll"
                            value="@isset($sites)@foreach ($sites->tags as $tag) {{ ',' . $tag->name }} @endforeach @endisset"
                            name="tags" placeholder="تاغات" data-role="tagsinput"><!--data-role="tagsinput"-->
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-labell ">شعار الشركة</label>
                        <input type="file" name="logo" class="form-controll">
                        <img src="{{ url('public/picCompany/' . $sites->logo) }}" width="80px" height="80px"
                            alt="" />
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="">رقم الجوال</label>
                        <input type="text" class="form-controll" name="mobile_number"
                            value="{{ $sites->mobile_number }}">
                    </div>
                    <div class="col">
                        <label for="">رقم الهاتف</label>
                        <input type="text" class="form-controll" name="phone_number"
                            value="{{ $sites->phone_number }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">facebook</label>
                        <input type="text" class="form-controll" name="facebook" value="{{ $sites->facebook }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">twitter</label>
                        <input type="text" class="form-controll" name="twitter" value="{{ $sites->twitter }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">instagram</label>
                        <input type="text" class="form-controll" name="instagram" name="instagram"
                            value="{{ $sites->instagram }}">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">snapchat</label>
                        <input type="text" class="form-controll" name="snapchat" value="{{ $sites->snapchat }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">youtube</label>
                        <input type="text" class="form-controll" name="youtube" value="{{ $sites->youtube }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">telegram</label>
                        <input type="text" class="form-controll" name="telegram" value="{{ $sites->telegram }}">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">android_link</label>
                        <input type="text" class="form-controll" name="android" value="{{ $sites->android }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">ios_link</label>
                        <input type="text" class="form-controll" name="ios" value="{{ $sites->ios }}">
                    </div>

                    <div class="form-check mt-3 mb-3">
                        <label for="flexCheckall_sites">
                            الأفضلية
                        </label>
                        <input class="form-controll" name="priority" type="number" id="flexCheckall_sites"
                            value="{{ $sites->priority }}">

                    </div>
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
        var subcityurl = "{{ url('subcity/ItemId') }}";
        var selsubcity = "{{ $sites->subcity_id }}";
        $(document).ready(function() {
            $('#countries').on('change', function() {
                var country_id = this.value;
                console.log(country_id);
                $.ajax({
                    url: "{{ route('getcities') }}",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#cities').empty();
                        // $('#cities').append('<option disabled> أختر المدينة  </option>');
                        $('#cities').append('<option value = "0"> -- لا شيئ --</option>');
                        $.each(data.getCities, function(key, value) {
                            // console.log(data.getCities);
                            $('#cities').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                        // console.log(data[0].name);
                    }
                })
            });

            // *****************************************************************//
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
                        $('#subcategory').append('<option value = "0"> -- بدون اب --</option>');
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
            var option = $(this).find(":selected").val();
            getcities(option);
            //Map
            $('#city_id').on('change', function(e) {
                var option = $(this).find(":selected").val();
                getcities(option);
            });

            function getcities(option) {
                var newurl = subcityurl;
                newurl = newurl.replace("ItemId", option);

                $.ajax({
                    url: newurl,
                    type: "GET",
                    //	contentType: false,
                    //	processData: false,
                    //contentType: 'application/json',
                    success: function(data) {
                        if (data.length == 0) {} else {
                            fillCities(data);
                        }

                    },
                    error: function(errorresult) {

                    }
                });
            }

            function fillCities(data) {
                var choose = "اختر المدينة ..."
                $("#subcity").html('<option title="" value="0" >' + choose + '</option>');
                $.each(data, function(key, value) {

                    if (selsubcity == value.id) {
                        $("#subcity").append('<option selected value="' + value.id + '">' + value.subname +
                            '</option>');

                    } else {
                        $("#subcity").append('<option value="' + value.id + '">' + value.subname +
                            '</option>');
                    }
                }); // close each()
            }

            //end map
        });
    </script>
@endsection

@section('style')
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .bootstrap-tagsinput input {
            padding: 10px;
        }
    </style>
@endsection
<!-- Map -->
@section('map-js')
    <script>
        var com_lat = {{ $sites->latitude }};
        var com_lang = {{ $sites->longitude }};
    </script>
    <script src="{{ url('public/js/add-location.js') }}"></script>
@endsection
<!-- Map end -->
