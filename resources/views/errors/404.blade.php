<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($Settings))
<meta name="description" content="@isset($Settings){{$Settings->Description}}@endisset">
    @endif
<meta property="og:url" content="https://link.orasweb.com/">
    @if (isset($Settings))
<meta name="keywords" content="@isset($Settings){{ $Settings->Keywords }}@endisset">
    @endif


    @isset($Settings->socialMidialinkden)<meta property="og:url" content="{{ $Settings->socialMidialinkden }}" />@endisset
    @isset($Settings->socialMidiaYoutube)<meta property="og:url" content="{{ $Settings->socialMidiaYoutube }}" />@endisset
    @isset($Settings->socialMidiaInstagram)<meta property="og:url" content="{{ $Settings->socialMidiaInstagram }}" />@endisset
    @isset($Settings->socialMidiaFacebook)<meta property="og:url" content="{{ $Settings->socialMidiaFacebook }}" />@endisset
    @isset($Settings->socialMidiaTelegram)<meta property="og:url" content="{{ $Settings->socialMidiaTelegram }}" />@endisset
    <link rel="icon" type="image/x-icon" href="{{ url('../public/uploading/logozooozaaa.png') }}">
    <meta property="og:image" content="{{ url('../public/uploading/logozooozaaa.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <!--{{-- <link rel="stylesheet" type="text/css" href="style.css"> --}}-->
    {{-- <link rel="stylesheet" href="{{ asset('css/asw.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('../public/FrontStyle/css/styleMainIndex.css') }}">
    <link rel="stylesheet" href="{{ url('../public/FrontStyle/css/dalil_style.css') }}">

    <title>
@if(isset($Settings) && empty($country) && empty($getMeta) && empty($getTagTitle) && empty($getTitle_About) && empty($tagSam->name))
        {{ $Settings->nameWebsite }}
@elseif (isset($country) && isset($Settings))
         وصلات {{ $country->country_name }}..{{ $country->title }}
@elseif(isset($getMeta) && isset($Settings))
        @if ($getMeta->parent_id == 0)
        {{$Settings->nameWebsite}}-{{$getMeta->category_name}}
        @endif
@elseif (isset($getTagTitle))
        {{$getTagTitle->site_name}}
@elseif (isset($getTitle_About))
        {{$getTitle_About->title}}
@elseif (isset($tagSam))
        {{$tagSam->name}}

@endif
    </title>
</head>

<body>
    <img class="bar-img" src="{{ url('../public/upload/bgnav.png') }}" alt="">
    <div class="bar-top"><i class="fa-solid fa-house bar-title"></i><span class="bar-title">عزيزي المستخدم </span>
        <span class="bar-text">لجعل تصفح الانترنت أسهل وأكثر أمانا ، اجعل وصلات .. الانترنت في صفحة واحدة صفحتك الرئيسية
            !</span><a hidefocus="true" data-val="close" data-sort="topbar" id="addFavClose" class="bar-addfav_close"
            target="_self" href="javascript:void(0)"></a>
    </div>
    <?php 
        use App\Models\PinnedPages;
        use App\Models\Countries;
        use App\Models\Adds;
        
        $all_pinned_page = PinnedPages::get();
        $country_names = Countries::get();
        $adds = Adds::first();
    ?>
    
    
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{-- <h1 class="logo">دليل</h1> --}}
                <img src="{{ url('../public/upload/logo_waslat.png') }}" alt="لوغو" style="margin-right: 4rem;width:150px;height:50px;">
            </a>
            <button class="navbar-toggler" type="button" aria-label="button menu" data-bs-toggle="collapse" data-bs-target="#mynavbar">
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

                        <button class="btn btn-sm dropdown-toggle" id="bbb" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            @if (isset($is_SetCountry))
                                <img src="{{ url('../public/uploading/' . $is_SetCountry->country_flag) }}" alt="{{$is_SetCountry->country_name}}"
                                    style="margin-left:5px;width:16px;height:11px;" loading="lazy">
                                {{ $is_SetCountry->country_name }}
                            @elseif (isset($selectCountry->country))
                                <img src="{{ url('../public/uploading/' . $selectCountry->country->country_flag) }}"
                                    alt="{{$selectCountry->country->country_name}}" style="margin-left:5px;width:16px;height:11px;" loading="lazy">
                                {{ $selectCountry->country->country_name }}
                            @else
                                اختر الدولة
                            @endif

                        </button>

                        <div class="dropdown-menu" style="z-index:999999;">
                            <ul class="list" id="drop_list">
                                @foreach ($country_names as $get_country)
                                    <li id="eee">
                                        <img src="{{ url('../public/uploading/' . $get_country->country_flag) }}"
                                            alt="{{$get_country->country_name}}" style="margin-left:5px" loading="lazy">
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
                  <!-- #region -->

                    {{-- <div class="icon-barr">
                        <span class="icon-home">
                            @isset($get_about_waslat)
                                <a
                                    href="{{ route('about-dalil', [$get_about_waslat->href, $get_about_waslat->id]) }}">
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
                                <img src="{{ url('../public/upload/icon-person.png') }}" width="20" alt="">
                            </div>
                        @else
                            <span class="icon-home">
                                <a href="{{ route('login') }}">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    حسابي
                                </a>
                            </span>
                        @endif

                        <ul class="list-unstyled listli d-none" id="ul-list" >
                            <li class="li"><a href="{{route('mainPageSetting.userr', Auth::check() ? Auth::user()->en_name : '')}}"
                                    class="dropdown-item text-decoration-none"><span><i
                                        class="fa-solid fa-gear"
                                        style="margin-left:.5rem; margin-right:-0.5rem;"></i>إعدادات الحساب</span></a></li>
                            <hr style="margin:0;padding:0;">
                            <li class="li"><a href="{{route('pageme.user', Auth::check() ? Auth::user()->en_name : '')}}"
                                class="dropdown-item text-decoration-none"><span>
                                    <i class="fa-solid fa-file" style="margin-left:.5rem; margin-right:-0.5rem;"></i>
                                    صفحتي</span></a></li>
                                    <li class="li"><a href="{{ route('logout') }}"
                                            class="dropdown-item text-decoration-none"><span><i
                                                class="fa-solid fa-right-from-bracket"
                                                style="margin-left:.5rem; margin-right:-0.5rem;"></i>خروج</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </nav>
<div class="container w-100 addss mt-5 mb-5">
        @isset($adds)
            <p class="text-center">{!! $adds->atTop !!}</p>
        @endisset
    </div>

    <div class="container text-center mt-5 mb-4" style="width:50%;background: #fff;
    padding: 35px;">
        <h1>404</h1>
        <p>الصفحة التي تبحث عنها غير موجودة</p>
        <a href="{{url('/')}}" class="btn btn-success">الرجوع الى الصفحة الرئيسية</a>
    </div>

<div class="container w-100 addss mt-5 mb-5">
            @isset($adds)
                <p class="text-center">{!! $adds->atRight !!}</p>
            @endisset
        </div>
    <div class="mt-1 p-4 bg text-white text-center footer">
        <div class="container l-wrap t-c d-inline-flex justify-content-center edit-footer">
            @isset($all_pinned_page)

                <ul class="box-fot no-hover">
                    <li><a href="{{ route('news.all') }}">المقالات</a><b
                                class="space"></b></li>
                    @foreach ($all_pinned_page as $get_pinned)
                        <li><a
                                href="{{ route('about-dalil', [$get_pinned->href]) }}">{{ $get_pinned->page_name }}</a><b
                                class="space"></b></li>
                    @endforeach
                </ul>
                <br>



            @endisset

        </div>
        
        <div style="color: #595959">
            {{ 'كل المعلومات المقدمة في موقع وصلات من روابط مواقع ، صور ، فيديو ، لوجوهات ، وأيقونات الخ ، بانها ملكاً للغير ولا تنتمى بأي شكل من الأشكال لملكية شركة السورية لخدمات الانترنت وموقع وصلات بإستثناء لوجو وأيقون وصلات.' }}
        </div>
    </div>






    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        // let theBtn = document.querySelector("#bbb"),
        //         countries = document.querySelectorAll("#eee a");

        //         countries.forEach(country =>
        //             country.addEventListener("click", (targetCountry) =>
        //                 theBtn.innerHTML = country.innerHTML))
    </script>
    @yield('script')

</body>

</html>
