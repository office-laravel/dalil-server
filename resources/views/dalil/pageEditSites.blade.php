@extends('dalil.layout.navabar&footer')

@section('content')
    @include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:70%">
        @isset($adds->atTop)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>

    <div class="container">
        @if ($message = Session::get('msgsuccess'))
            <div class="alert alert-success text-center w-50 alert-dismissible fade show" role="alert"
                style="margin:0 auto;">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!--<div class="alert alert-success text-center w-50" role="alert" style="margin:0 auto;">-->
            <!--    {{ $message }}-->
            <!--</div>-->
        @endif
    </div>

    <div class="container mt-3 mb-2 family-font">
        <div class="row backgroundW p-4 m-3">
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $item)
                        <li class="text-danger">
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('update-sites.user', $site->id) }}" id="form-update-site" class="p-4 form-create-user"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: flex;justify-content: space-between;">
                    <p style="color:#6A0808;">
                        تعديل بيانات الشركة
                    </p>
                    <a href="{{ route('pageme.user', Auth::check() ? Auth::user()->en_name : '') }}"
                        style="text-decoration: none;">
                        مواقعي<i class="fa-solid fa-arrow-left mx-1"></i>
                    </a>

                </div>

                <select style="width: 200px" class="form-cdontrol mb-2" id="city_id" name="city_id">
                    <option value="">أختر المحافظة</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $site->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}</option>
                    @endforeach
                </select>
                <br>
                <select style="width: 200px" class="form-cdontrol mb-2" id="subcity" name="subcity">
                    <option value="">أختر المدينة</option>
                </select>
                <!-- Map -->
                <!-- خريطة Leaflet -->
                <div class="map-out-cls">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
                <div class="form-group" style="width: 200px">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $site->latitude }}">
                </div>
                <div class="form-group" style="width: 200px">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-control"
                        value="{{ $site->longitude }}">
                </div>
                <!-- Map end -->
                <h4>التصنيفات:</h4>
                <select style="width: 200px" class="form-cdontrol mb-2" id="category" name="category">
                    <option value=" ">أختر التصنيف</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $site->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                    @endforeach
                </select>
                <h4>التصنيفات الفرعية:</h4>
                <select style="width:200px;" class="form-cdontrol" name="subcategory" id="subcategory">
                    <option value=" ">--بدون الاب--</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $site->subcategories == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                    @endforeach
                </select>


                <div class="form-row mb-2">
                    <div class="col mb-3">
                        <label for="exampleFormControlInput1">اسم الشركة</label>
                        <input type="text" class="form-control mt-2" name="site_name" value="{{ $site->site_name }}">
                    </div>

                    <div class="col mb-3">
                        <label for="exampleFormControlInput1">رابط الشركة</label>
                        <input type="text" class="form-control mt-2" name="href" placeholder="https://example.com"
                            value="{{ $site->href }}">
                    </div>
                    <div class="col mb-3">
                        <label for="exampleFormControlInput1">عنوان</label>
                        <input type="text" class="form-control mt-2" name="title" value="{{ $site->title }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label><strong>نبذة :</strong></label>
                        <textarea class="ckeditor form-control" name="description">{{ $site->description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>مقال ذو صلة :</strong></label>
                        <textarea class="ckeditor form-control" name="articale">{{ $site->articale }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>كود الفيديو:</strong></label>
                        <textarea class="form-control" name="video">{{ $site->video }}</textarea>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col">
                        <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                        <input type="text" class="form-control mt-2" name="keyword"
                            placeholder="مثل:رياضة,ترفيه,اخبار" value="{{ $site->keyword }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="Description" class="form-labell ">شعار الشركة</label>
                        <input type="file" name="logo" class="form-control mt-2">
                        <img src="{{ url('picCompany/' . $site->logo) }}" width="80px" height="80px"
                            alt="" />
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col">
                        <label for="">رقم الجوال</label>
                        <input type="text" class="form-control mt-2" name="mobile_number"
                            value="{{ $site->mobile_number }}">
                    </div>
                    <div class="col">
                        <label for="">رقم الهاتف</label>
                        <input type="text" class="form-control mt-2" name="phone_number"
                            value="{{ $site->phone_number }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">facebook</label>
                        <input type="text" class="form-control" name="facebook" placeholder="https://facebook.com"
                            value="{{ $site->facebook }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">twitter</label>
                        <input type="text" class="form-control mt-2" name="twitter" placeholder="https://twitter.com"
                            value="{{ $site->twitter }}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">instagram</label>
                        <input type="text" class="form-control mt-2" name="instagram" name="instagram"
                            placeholder="https://instagram.com" value="{{ $site->instagram }}">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">snapchat</label>
                        <input type="text" class="form-control mt-2" name="snapchat" value="{{ $site->snapchat }}"
                            placeholder="https://snapchat.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">youtube</label>
                        <input type="text" class="form-control mt-2" name="youtube" value="{{ $site->youtube }}"
                            placeholder="https://youtube.com">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">telegram</label>
                        <input type="text" class="form-control mt-2" name="telegram" value="{{ $site->telegram }}"
                            placeholder="https://telegram.com">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">android_link</label>
                        <input type="text" class="form-control" name="android" value="{{ $site->android }}"
                            placeholder="https://playstore.example..">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">ios_link</label>
                        <input type="text" class="form-control mt-2" name="ios" value="{{ $site->ios }}"
                            placeholder="https://appstore.example..">
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"
                        style="background-color:#6A0808;border-color:#6A0808;">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container addss text-center" style="width:70%">
        @isset($adds->atRight)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
        @endisset
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var subcityurl = "{{ url('subcity/ItemId') }}";
        var selsubcity = "{{ $site->subcity_id }}";
        $(document).ready(function() {
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
                            '<option value=""> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = ""> -- لا شيئ --</option>');
                        $.each(data.supcategories[0].supcategories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.category_name + '</option>'
                            );
                            //  console.log(subcategory.category_name);
                        });
                        // console.log(data);
                    }
                })
            });

            //Map


            var option = $(this).find(":selected").val();
            getcities(option);

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
    </script>
@endsection

<!-- Map -->
@section('map-js')
    <script>
        var com_lat = {{ $site->latitude }};
        var com_lang = {{ $site->longitude }};
    </script>
    <script src="{{ url('js/add-location.js') }}"></script>
@endsection
<!-- Map end -->

<style>
    .family-font h4 {
        color: #6A0808 !important;
    }

    .figure,
    .list-inline-item,
    label,
    output {
        color: #6A0808 !important;
    }

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
<style>
    @media (max-width:768px) {
        .addss img {
            width: 100% !important;
        }
    }
</style>
