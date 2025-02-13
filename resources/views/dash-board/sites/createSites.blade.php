@extends('dash-board.layout.navabr&footer')

@section('content')
    @include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الشركات</h6>
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
            <form action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>العضو</label>
                <select style="width: 200px" class="form-cdontrol mb-2" id="user_id" name="user_id">
                    <option value="">أختر العضو</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                <br>
                <select style="width: 200px" class="form-cdontrol mb-2" id="city_id" name="city_id">
                    <option value="">أختر المحافظة</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                <br>
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
                    <input type="text" id="latitude" name="latitude" class="form-controll">
                </div>
                <div class="form-group" style="width: 200px">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-controll">
                </div>
                <!-- Map end -->
                <h4>التصنيفات:</h4>
                <select style="width: 200px" class="form-cdontrol" id="category" name="category">
                    <option value=" ">أختر التصنيف</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                    @endforeach
                </select>
                <h4>التصنيفات الفرعية:</h4>
                <select style="width:200px;" class="form-cdontrol" name="subcategory" id="subcategory">
                    <option value=" ">--بدون الاب--</option>
                </select>





                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">اسم الشركة</label>
                        <input type="text" class="form-controll" name="site_name">
                    </div>

                    <div class="col">
                        <label for="exampleFormControlInput1">رابط الشركة</label>

                        <input type="text" class="form-controll" name="href" placeholder="https://example.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">عنوان</label>
                        <input type="text" class="form-controll" name="title">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label><strong>نبذة :</strong></label>
                        <textarea class="ckeditor form-controll" name="description"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>مقال ذو صلة :</strong></label>
                        <textarea class="ckeditor form-controll" name="articale"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>كود الفيديو:</strong></label>
                        <textarea class="form-controll" name="video"></textarea>
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                        <input type="text" class="form-controll" name="keyword" placeholder="مثل:رياضة,ترفيه,اخبار">
                    </div>
                    <div class="col">
                        <label for="tags">تاغات (يجب فصل بفاصلة عن كل تاغ)</label>
                        <input type="text" id="tags" class="form-controll" name="tags" placeholder="تاغات"
                            data-role="tagsinput">

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-labell ">شعار الشركة</label>
                        <input type="file" name="logo" class="form-controll">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="">رقم الجوال</label>
                        <input type="text" class="form-controll" name="mobile_number">
                    </div>
                    <div class="col">
                        <label for="">رقم الهاتف</label>
                        <input type="text" class="form-controll" name="phone_number">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">facebook</label>
                        <input type="text" class="form-controll" name="facebook" placeholder="https://facebook.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">twitter</label>
                        <input type="text" class="form-controll" name="twitter" placeholder="https://twitter.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">instagram</label>
                        <input type="text" class="form-controll" name="instagram" name="instagram"
                            placeholder="https://instagram.com">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">snapchat</label>
                        <input type="text" class="form-controll" name="snapchat" placeholder="https://snapchat.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">youtube</label>
                        <input type="text" class="form-controll" name="youtube" placeholder="https://youtube.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">telegram</label>
                        <input type="text" class="form-controll" name="telegram" placeholder="https://telegram.com">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">android_link</label>
                        <input type="text" class="form-controll" name="android"
                            placeholder="https://playstore.example..">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">ios_link</label>
                        <input type="text" class="form-controll" name="ios"
                            placeholder="https://appstore.example..">
                    </div>


                    <div class="form-check mt-3 mb-3">
                        <label for="flexCheckall_sites">
                            الأفضلية
                        </label>
                        <input class="form-controll" name="priority" type="number" id="flexCheckall_sites">

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
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
                        $('#subcategory').append(
                            '<option value = ""> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = ""> -- لا شيئ --</option>');
                        $.each(data.supcategories[0].supcategories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.category_name + '</option>'
                            );
                            console.log(subcategory.category_name);
                        });
                        console.log(data);
                    }
                })
            });

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

                    // if (selcity == value.id) {
                    // 	$("#city").append('<option selected value="' + value.id + '">' + value.name_ar + '</option>');

                    // } else {
                    $("#subcity").append('<option value="' + value.id + '">' + value.subname + '</option>');
                    //}
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
    <script src="{{ url('js/add-location.js') }}"></script>
@endsection
<!-- Map end -->
