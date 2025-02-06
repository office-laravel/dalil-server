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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('SitesWait') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            
            <form action="{{ route('update.waitingSites' , $sites->id) }}" method="POST">
                @csrf


                <h4>الدولة:</h4>
                <select style="width: 200px" class="form-cdontrol" id="countries" name="countries_id">
                    <option value="">أختر الدولة</option>
                    <option value="0" {{$sites->countries_id == 0  ? 'selected' : ''}}>اظهار بكل الدول</option>
                    @foreach ($countries as $get_country)
                        <option value="{{$get_country->id}}"{{$sites->countries_id == $get_country->id  ? 'selected' : ''}}>{{$get_country->country_name}}</option>
                    @endforeach
                </select>
                <h4>التصنيفات:</h4>
                <select style="width: 200px" class="form-cdontrol" id="category" name="category">
                    <option value="0">أختر التصنيف</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" {{$sites->category_id == $item->id  ? 'selected' : ''}}>{{ $item->category_name }}</option>
                    @endforeach
                </select>
                <h4>التصنيفات الفرعية:</h4>
                <select style="width:200px;" class="form-cdontrol" name="subcategory" id="subcategory">
                    <option value="0">--بدون الاب--</option>
                    @foreach ($scategories as $item)
                        <option value="{{ $item->id }}" {{$sites->subcategories == $item->id  ? 'selected' : ''}}>{{ $item->category_name }}</option>
                    @endforeach
                </select>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">اسم الموقع</label>
                        <input type="text" class="form-controll" name="site_name" value="{{$sites->site_name}}">
                    </div>
                    {{-- <div class="col">
                        <label for="">Tags:</label>
                        @foreach ($tags as $tag )
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
                        <input type="text" class="form-controll" name="href" value="{{$sites->href}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">عنوان</label>
                        <input type="text" class="form-controll" name="title" value="{{$sites->title}}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label><strong>نبذة :</strong></label>
                        <textarea class="ckeditor form-controll" name="description" >{{$sites->description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>مقال ذو صلة :</strong></label>
                        <textarea class="ckeditor form-controll" name="articale">{{$sites->articale}}</textarea>
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">كلمات المفتاحية</label>
                        <input type="text" class="form-controll" name="keyword" value="{{$sites->keyword}}">
                    </div>
                    <div class="col">
                        <label for="tags">تاغات (يجب فصل بفاصلة عن كل تاغ)</label>
                            <input type="text" id="tags" class="form-controll" value="@isset($sites)@foreach ($sites->tags as $tag ) {{','.$tag->name}} @endforeach @endisset" name="tags" placeholder="تاغات" data-role="tagsinput"><!--data-role="tagsinput"-->
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">facebook</label>
                        <input type="text" class="form-controll" name="facebook" value="{{$sites->facebook}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">twitter</label>
                        <input type="text" class="form-controll" name="twitter"  value="{{$sites->twitter}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">instagram</label>
                        <input type="text" class="form-controll" name="instagram" name="instagram"  value="{{$sites->instagram}}">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">snapchat</label>
                        <input type="text" class="form-controll" name="snapchat" value="{{$sites->snapchat}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">youtube</label>
                        <input type="text" class="form-controll" name="youtube" value="{{$sites->youtube}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">telegram</label>
                        <input type="text" class="form-controll" name="telegram" value="{{$sites->telegram}}">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <label for="exampleFormControlInput1">android_link</label>
                        <input type="text" class="form-controll" name="android"
                        value="{{$sites->android}}">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">ios_link</label>
                        <input type="text" class="form-controll" name="ios" value="{{$sites->ios}}">
                    </div>
                    
                    <div class="form-check mt-3 mb-3">
                        <label for="flexCheckall_sites">
                         الأفضلية
                        </label>
                        <input class="form-controll" name="priority" type="number" id="flexCheckall_sites" value="{{$sites->priority}}">
                        
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">موافق</button>
                    <a href="{{ route('destroy.waitingSites', ['id' => $sites->id]) }}" class="btn btn-danger btn-small"><i
                                                        class="fa-solid fa-trash-can" style="margin-left:.5rem"></i>حذف</a>
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
            // $('#countries').on('change', function() {
            //     var country_id = this.value;
            //     console.log(country_id);
            //     $.ajax({
            //         url: "{{ route('getcate') }}",
            //         type: "POST",
            //         data: {
            //             country_id: country_id
            //         },
            //         dataType : 'json',
            //         success: function(data) {
            //             $('#category').empty();
            //             $('#category').append('<option disabled> أختر التصنيف  </option>');
            //             $('#category').append('<option value = "0"> -- لا شيئ --</option>');
            //             $.each(data, function(key , value) {
            //                 console.log(data[0].category_name);
            //                 $('#category').append('<option value="' + value.id + '">' + value.category_name + '</option>');
            //             });
            //             console.log(data[0].category_name);
            //         }
            //     })
            // });
            $('#category').on('change', function(e) {
                var cat_id = e.target.value;
                console.log(cat_id);
                $.ajax({
                    url: "{{ route('supcate') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    dataType : 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        // $('#subcategory').append('<option> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = "0"> -- بدون اب --</option>');
                        $.each(data.supcategories[0].supcategories, function(index,
                        subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '"selected>' + subcategory.category_name + '</option>');
                        })
                        console.log(data);
                    }
                })
            });
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
    .bootstrap-tagsinput input{
        padding: 10px;
    }
</style>

@endsection




