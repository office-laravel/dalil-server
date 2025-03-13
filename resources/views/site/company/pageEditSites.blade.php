@extends('site.layouts.layout')

@section('content')
<div class="container" style="height: auto !important; margin-bottom:10px ;">
<div   >
    <div class="title-breadcrumb m sec">
      
        <a href="{{ route('pageme.user', Auth::check() ? Auth::user()->en_name : '') }}"
            style="text-decoration: none;">
            مواقعي 
        </a> /
        <span  >
            تعديل الشركة
        </span>
    </div>
</div>
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

    <div class="container" style="height: auto !important; margin-bottom:100px ;">
        <section class="info-company mt-5">
            <div style="text-align: right">

                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li class="text-danger">
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            
                <form action="{{ route('update-sites.user', $site->id) }}" class="p-2 form-create-user" id="form-update-site" style="background-color: white"
                    method="POST"  enctype="multipart/form-data">
                    @csrf

                    <h4   style="margin:20px 0px;border-bottom: 1px solid #dee2e6;"> بيانات الشركة:</h4>
                   
                    <select style="width: 200px; appearance: auto;"   class="form-control mb-2  " id="city_id" name="city_id" {{ $subscribe->city==1?'':'disabled' }} >
                        <option value="">أختر المحافظة</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $site->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                 
                    <select style="width: 200px ;appearance: auto;" class="form-control mb-2 form-content" id="subcity" name="subcity" {{ $subscribe->city==1?'':'disabled' }} >
                        <option value="">أختر المدينة</option>
                    </select>
                    <!-- Map -->
                    <!-- خريطة Leaflet -->
                    <div class="map-out-cls">
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>
                    <div class="form-group form-content" style="width: 200px">
                        <label>خط العرض / Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $site->latitude }}" {{ $subscribe->maploc==1?'':'disabled' }} >
                    </div>
                    <div class="form-group form-content" style="width: 200px">
                        <label>خط الطول / Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control"  value="{{ $site->longitude }}" {{ $subscribe->maploc==1?'':'disabled' }}>
                    </div>
                    <!-- Map end -->
                    <h4 class="form-content">التصنيفات:</h4>
                    <select style="width: 200px;appearance: auto;" class="form-control mb-2" id="category" name="category" {{ $subscribe->category==1?'':'disabled' }}>
                        <option value=" ">أختر التصنيف</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{ $site->category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    <h4 class="form-content">التصنيفات الفرعية:</h4>
                    <select style="width:200px; appearance: auto;" class="form-control" name="subcategory" id="subcategory"  {{ $subscribe->subcategories==1?'':'disabled' }}>
                        <option value=" ">--بدون الاب--</option>
                       
                    </select>
                    <div class="form-row mb-2">
                        <div class="col mb-3 form-content ">
                            <label for="exampleFormControlInput1">اسم الشركة</label>
                            <input type="text" class="form-control mt-2" name="site_name" value="{{ $site->site_name }}">
                        </div>

                        <div class="col mb-3 form-content">
                            <label for="exampleFormControlInput1">رابط الشركة</label>
                            <input type="text" class="form-control mt-2" name="href"  value="{{ $site->href }}" {{ $subscribe->href==1?'':'disabled' }}
                                placeholder="https://example.com">
                        </div>
                        <div class="col mb-3 form-content">
                            <label for="exampleFormControlInput1">عنوان</label>
                            <input type="text" class="form-control mt-2" name="title" value="{{ $site->title }}"  {{ $subscribe->title==1?'':'disabled' }}>
                        </div>

                        <div class="col-md-12 mb-3 form-content">
                            <label><strong>نبذة :</strong></label>
                            <textarea class="ckeditor form-control" name="description" {{ $subscribe->description==1?'':'disabled' }}>{{ $site->description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3 form-content">
                            <label><strong>مقال ذو صلة :</strong></label>
                            <textarea class="ckeditor form-control" name="articale"  {{ $subscribe->articale==1?'':'disabled' }}>{{ $site->articale }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3 form-content">
                            <label><strong>كود الفيديو:</strong></label>
                            <textarea class="form-control" name="video"  {{ $subscribe->video==1?'':'disabled' }} >{{ $site->video }}</textarea>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                            <input type="text" class="form-control mt-2" name="keyword" value="{{ $site->keyword }}"
                                placeholder="مثل:رياضة,ترفيه,اخبار" {{ $subscribe->keyword==1?'':'disabled' }}>
                        </div>
                        <div class="col-md-12 mb-3 form-content">
                            <label for="Description" class="form-labell ">شعار الشركة</label>
                            <input type="file" name="logo" class="form-control mt-2"  {{ $subscribe->logo==1?'':'disabled' }}>
                            <img src="  {{ $subscribe->logo == 1 && $site->logo ? url('public/picCompany/' . $site->logo) : url('public/picCompany/' . 'default.webp') }}" width="80px" height="80px"
                          
                            alt="" />
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col form-content">
                            <label for="">رقم الجوال</label>
                            <input type="text" class="form-control mt-2" name="mobile_number"   value="{{ $site->mobile_number }}" {{ $subscribe->mobile_number==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="">رقم الهاتف</label>
                            <input type="text" class="form-control mt-2" name="phone_number"   value="{{ $site->phone_number }}" {{ $subscribe->phone_number==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">facebook</label>
                            <input type="text" class="form-control" name="facebook"
                                placeholder="https://facebook.com" value="{{ $site->facebook }}"  {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">twitter</label>
                            <input type="text" class="form-control mt-2" name="twitter"
                                placeholder="https://twitter.com"  value="{{ $site->twitter }}" {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">instagram</label>
                            <input type="text" class="form-control mt-2" name="instagram" name="instagram"
                                placeholder="https://instagram.com" value="{{ $site->instagram }}" {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">snapchat</label>
                            <input type="text" class="form-control mt-2" name="snapchat"
                                placeholder="https://snapchat.com" value="{{ $site->snapchat }}" {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">youtube</label>
                            <input type="text" class="form-control mt-2" name="youtube"
                                placeholder="https://youtube.com" value="{{ $site->youtube }}" {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">telegram</label>
                            <input type="text" class="form-control mt-2" name="telegram"
                                placeholder="https://telegram.com" value="{{ $site->telegram }}" {{ $subscribe->social==1?'':'disabled' }}>
                        </div>
                    </div>

                    <div class="form-row mb-2">
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">android_link</label>
                            <input type="text" class="form-control" name="android" value="{{ $site->android }}" {{ $subscribe->android==1 ?'':'disabled' }}
                                placeholder="https://playstore.example.." >
                        </div>
                        <div class="col form-content">
                            <label for="exampleFormControlInput1">ios_link</label>
                            <input type="text" class="form-control mt-2" name="ios" value="{{ $site->ios }}"  {{ $subscribe->ios==1 ?'':'disabled' }}
                                placeholder="https://appstore.example..">
                        </div>

                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary button-submit"
                           >حفظ</button>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection
 
@section('css')
    <!-- #region -->
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
@endsection
<!-- Map -->
@section('map-js')
    <script src="{{ url('public/assets/site/js/add-location.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var subcityurl = "{{ url('subcity/ItemId') }}";
        var selsubcity = "{{ $site->subcity_id }}";
        var selsubcat = "{{ $site->subcategories }}";
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
            function getSubCategories(cat_id) {
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
                                if(selsubcat==subcategory.id){
                                    $('#subcategory').append('<option selected value="' + subcategory
                                .id + '" >' + subcategory.category_name + '</option>'
                            );
                                }else{
                                    $('#subcategory').append('<option value="' + subcategory
                                .id + '" >' + subcategory.category_name + '</option>'
                            );
                                }
                          
                            //  console.log(subcategory.category_name);
                        });
                        // console.log(data);
                    }
                });
            }
            var cat_id = $('#category').find(":selected").val();
            getSubCategories(cat_id);

            $('#city_id').on('change', function(e) {
                var option = $(this).find(":selected").val();
                getcities(option);

            });
            var option = $('#city_id').find(":selected").val();
            getcities(option);

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
<!-- Map end -->
