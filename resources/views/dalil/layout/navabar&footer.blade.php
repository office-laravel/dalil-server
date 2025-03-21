<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if (isset($getMeta_descr_getcountry))
    <meta name="description"
        content="@isset($getMeta_descr_getcountry->meta_descr){{ $getMeta_descr_getcountry->meta_descr }}@endisset">
    @elseif (isset($getMetaDescr))
    <meta name="description" content="@isset($getMetaDescr){{ $getMetaDescr->description }}@endisset">
    @else
    <meta name="description" content="@isset($Settings){{ $Settings->Description }}@endisset">
    @endif
    @if (isset($getMeta_descr_getcountry))
    <meta property="og:description"
        content="@isset($getMeta_descr_getcountry){{ $getMeta_descr_getcountry->meta_descr }}@endisset">
    @elseif (isset($getMetaDescr))
    <meta property="og:description" content="@isset($getMetaDescr){{ $getMetaDescr->description }}@endisset">
    @else
    <meta property="og:description" content="@isset($Settings){{ $Settings->Description }}@endisset">
    @endif
    <meta property="og:url" content="@isset($Settings){{ $Settings->linkWebsite }}@endisset">
    @if (isset($Settings))
    <meta name="keywords" content="@isset($Settings){{ $Settings->Keywords }}@endisset">
    @endif
    @isset($Settings->socialMidialinkden)
    <meta property="og:url" content="{{ $Settings->socialMidialinkden }}" />
    @endisset
    @isset($Settings->socialMidiaYoutube)
    <meta property="og:url" content="{{ $Settings->socialMidiaYoutube }}" />
    @endisset
    @isset($Settings->socialMidiaInstagram)
    <meta property="og:url" content="{{ $Settings->socialMidiaInstagram }}" />
    @endisset
    @isset($Settings->socialMidiaFacebook)
    <meta property="og:url" content="{{ $Settings->socialMidiaFacebook }}" />
    @endisset
    @isset($Settings->socialMidiaTelegram)
    <meta property="og:url" content="{{ $Settings->socialMidiaTelegram }}" />
    @endisset
    @isset($Settings->favicon)
    <link rel="icon" type="image/x-icon" href="{{ url('/public/uploading/' . $Settings->favicon) }}">
    @endisset
    @isset($Settings->favicon)
    <meta property="og:image" content="{{ url('/public/uploading/' . $Settings->favicon) }}">
    @endisset
    <!-- Bootstrap CSS -->
    <link rel=dns-prefetch>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/all.css') }}" />
    <script defer src="{{ url('/public/FrontStyle/css/js/all.js') }}"></script> <!--load all styles -->
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/styleNew.css') }}">
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/styleMainIndex.css') }}">
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/dalil_style.css') }}">

    <!-- Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">

    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/map.css') }}">
    <link rel="stylesheet" href="{{ url('/public/FrontStyle/css/style_product.css') }}" />
        @yield('map-css')
    <!-- Map End -->
    <title>
        @if (isset($Settings) &&
        empty($titleNewSites) &&
        empty($titleSearch) &&
        empty($titleVisit) &&
        empty($titleNewsMeta) &&
        empty($country) &&
        empty($getMeta) &&
        empty($getTagTitle) &&
        empty($getTitle_About) &&
        empty($getCountryNameofSubCat->country_name) &&
        empty($getCountryNameofSubCat) &&
        empty($tagSam->name))
        {{ $Settings->nameWebsite }}
        @elseif (isset($country) && isset($Settings))
        وصلات {{ $country->country_name }}..{{ $country->title }}
        @elseif(isset($getMeta) && isset($Settings))
        @if ($getMeta->parent_id == 0)
        وصلات {{ $getCountryNameofSubCat->country_name }} - {{ $getMeta->category_name }}
        @endif
        @elseif (isset($getTagTitle))
        {{ $getTagTitle->site_name }}
        @elseif (isset($getTitle_About))
        {{ $getTitle_About->title }}
        @elseif (isset($tagSam))
        {{ $tagSam->name }}
        @elseif (isset($titleNewsMeta))
        {{ $titleNewsMeta->title }}
        @elseif (isset($titleVisit))
        {{ $titleVisit }}
        @elseif (isset($titleSearch))
        {{ $titleSearch }}
        @elseif (isset($titleNewSites))
        {{ $titleNewSites }}
        @else
        {{ 'وصلات - مفضلتي' }}
        @endif
    </title>
    @isset($adds)
    {!! $adds->atHead !!}
    @endisset
</head>

<body>
    <img class="bar-img" src="{{ url('/public/upload/bgnav.png') }}" alt="صورة " loading="lazy">
    <div class="bar-top"><i class="fa-solid fa-house bar-title"></i><span class="bar-title">عزيزي المستخدم </span>
        <span class="bar-text">لجعل تصفح الانترنت أسهل وأكثر أمانا ، اجعل وصلات .. الانترنت في صفحة واحدة صفحتك الرئيسية
            !</span>
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- <h1 class="logo">دليل</h1> --}}
                <img src="{{ url('/public/upload/logo_waslat.png') }}" alt="لوغو"
                    style="margin-right: 4rem;width:150px;height:50px;">
            </a>
            <button class="navbar-toggler" type="button" aria-label="button menu" data-bs-toggle="collapse"
                data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse edit" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Link</a>
                    </li> --}}
                </ul>
                <div class="main-nav" style="width: 12rem">
                    <div class="btn-group">

                        <button class="btn btn-sm dropdown-toggle" id="bbb" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            @if (isset($is_SetCountry))
                            <img src="{{ url('public/uploading/' . $is_SetCountry->country_flag) }}"
                                alt="{{ $is_SetCountry->country_name }}" style="margin-left:5px;width:16px;height:11px;"
                                loading="lazy">
                            {{ $is_SetCountry->country_name }}
                            @elseif (isset($selectCountry->country))
                            <img src="{{ url('public/uploading/' . $selectCountry->country->country_flag) }}"
                                alt="{{ $selectCountry->country->country_name }}"
                                style="margin-left:5px;width:16px;height:11px;" loading="lazy">
                            {{ $selectCountry->country->country_name }}
                            @else
                            اختر الدولة
                            @endif

                        </button>

                        <div class="dropdown-menu" style="z-index:999999;">
                            <ul class="list" id="drop_list">
                                @foreach ($country_names as $get_country)
                                <li id="eee">
                                    <img src="{{ url('public/uploading/' . $get_country->country_flag) }}"
                                        alt="{{ $get_country->country_name }}" style="margin-left:5px" loading="lazy">
                                    <a class="text-decoration-none text-dark mb-1"
                                        href="{{ route('reload', [$get_country->href]) }}">
                                        {{ $get_country->country_name }}</a>

                                </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>
                    <div class="span">
                        <span class="text-white" style="font-size: 13px">دليل المواقع السهولة والامان </span>
                    </div>





                </div>
                <div class="container datee">
                    
  

                    {{-- <div class="icon-barr">
                        <span class="icon-home">
                            @isset($get_about_waslat)
                            <a href="{{ route('about-dalil', [$get_about_waslat->href, $get_about_waslat->id]) }}">
                                <i class="fa-solid fa-house"></i>
                                اجعلنا صفحتك الرئيسية
                            </a>
                            @endisset
                        </span>
                    </div> --}}
                    <div class="icon-barr">
                        <span class="icon-home">
                            <a href="{{ route('create-sites.user') }}">
                                <i class="fa-solid fa-house"></i>
                                اضف موقعك
                            </a>
                        </span>
                        @if (Auth::check())
                        <div class="profile" id="clicked_pro" onclick="myFunction()">
                            <img src="{{ url('/public/upload/icon-person.png') }}" width="20" alt="">
                        </div>
                        @else
                        <span class="icon-home">
                            <a href="{{ route('loginu') }}">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                حسابي
                            </a>
                        </span>
                        @endif

                        <ul class="list-unstyled listli d-none" id="ul-list">
                            <li class="li"><a
                                    href="{{ route('mainPageSetting.userr', Auth::check() ? Auth::user()->en_name : '') }}"
                                    class="dropdown-item text-decoration-none"><span><i class="fa-solid fa-gear"
                                            style="margin-left:.5rem; margin-right:-0.5rem;"></i>إعدادات
                                        الحساب</span></a></li>
                            <hr style="margin:0;padding:0;">
                            <li class="li"><a
                                    href="{{ route('pageme.user', Auth::check() ? Auth::user()->en_name : '') }}"
                                    class="dropdown-item text-decoration-none"><span>
                                        <i class="fa-solid fa-file"
                                            style="margin-left:.5rem; margin-right:-0.5rem;"></i>صفحتي</span></a></li>
                            <li class="li"><a href="{{ route('logoutu') }}"
                                    class="dropdown-item text-decoration-none"><span><i
                                            class="fa-solid fa-right-from-bracket"
                                            style="margin-left:.5rem; margin-right:-0.5rem;"></i>خروج</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </nav>


    @yield('content')


    <div class="mt-1 p-4 bg text-white text-center footer">
        <div class="container l-wrap t-c d-inline-flex justify-content-center edit-footer">
            @isset($all_pinned_page)

            <ul class="box-fot no-hover">
                <li><a href="{{ route('news.all') }}">المقالات</a><b class="space"></b></li>
                     <li><a href="{{ route('user.package') }}">اشتراك</a><b class="space"></b></li>
                <li><a href="{{ route('new.site') }}">أحدث المواقع</a><b class="space"></b></li>
                <li><a href="{{ route('visits') }}">المواقع الأكثر زيارة</a><b class="space"></b></li>
                @foreach ($all_pinned_page as $get_pinned)
                <li><a href="{{ route('about-dalil', [$get_pinned->href]) }}">{{ $get_pinned->page_name }}</a><b
                        class="space"></b></li>
                @endforeach
            </ul>
            <br>



            @endisset
        </div>
        @php
        use App\Models\Sites;

        $countSites = Sites::count();
        $countVisits = Sites::select('views')->sum('views');

        @endphp
        <div class="visit_and_sites text-center d-flex flex-wrap justify-content-center" style="color:#777;">
            <p>عدد الزيارات : {{ $countVisits }}</p>
            <span class="me-1 mx-1"> | </span>
            <p>عدد المواقع: {{ $countSites }}</p>
        </div>
        <div style="color: #595959">
            {{ 'كل المعلومات المقدمة في موقع وصلات من روابط مواقع ، صور ، فيديو ، لوجوهات ، وأيقونات الخ ، بانها ملكاً
            للغير ولا تنتمى بأي شكل من الأشكال لملكية شركة السورية لخدمات الانترنت وموقع وصلات بإستثناء لوجو وأيقون
            وصلات.' }}
        </div>
    </div>




    <!-- Map -->
    <script src="{{ url('/public/js/jquery-3.7.1.min.js') }}"></script>
    {{--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    <!-- Map end -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="{{ url('/public/FrontStyle/css/js/script.js') }}"></script>
    {{--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script> --}}

    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    {{--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
    <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('/public/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>



    @if (session('success'))
    <script>
        swal("{{ session('success') }}");
    </script>
    @endif
    @if (session('pass'))
    <script>
        swal("تمت العملية بنجاح", "بامكانك الدخول الى حسابك", "success");
    </script>
    @endif
    <script>
        // let theBtn = document.querySelector("#bbb"),
        //         countries = document.querySelectorAll("#eee a");

        //         countries.forEach(country =>
        //             country.addEventListener("click", (targetCountry) =>
        //                 theBtn.innerHTML = country.innerHTML))
    </script>
    @yield('script')
    <script>
        function myFunction() {
            var element = document.getElementById("ul-list");
            element.classList.remove("d-none");
        }
    </script>
    <script>
        //Map
        var token = '{{ csrf_token() }}';
        //Map end
    </script>
    <!--  Map -->
    @yield('map-js')
    <!--  Map end -->
</body>

</html>
<style>
    .profile {
        margin-right: 1.5rem;
        margin-top: 0.4rem;
        cursor: pointer;
    }

    /* .profile img{
        width: 100%;
        height:100%;
    } */
    .listli {
        background-color: #fff;
        position: absolute;
        left: 10%;
        top: 100%;
        padding: 6;
        z-index: 999999;
        border: 1px solid #abab;
        display: none;
    }

    @media only screen and (max-width: 600px) {
        .datee p {
            text-align: start !important;
        }
    }
</style>