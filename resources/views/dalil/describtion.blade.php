@extends('dalil.layout.navabar&footer')


@section('content')

    @include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:70%">
        @isset($adds->atTop)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>

    <div class="container">
        @isset($articaleSites)
            <section class="info-company mt-5">

                <div class="box-company">
                    <div class="picture-company m">


                        <img src="{{ url('./public/picCompany/' . $articaleSites->logo) }}" alt="{{ $articaleSites->site_name }}">


                    </div>
                    <div class="title-company sizee">
                        <h3> {{ $articaleSites->site_name }}</h3>
                        @isset($getNameSubCategory, $getNameCategory, $is_SetCountry)@isset(d)
                            <div class="category-company mb-3">
                                <a href="{{ route('showSubCat', [$is_SetCountry->href, $getNameCategory->href]) }}"
                                    class="span-one delLink"><i title="تصنيف"
                                        class="fas fa-folder-open mx-1 "></i>{{ $getNameCategory->category_name }}</a>
                                <a class="delLink"
                                    href="{{ route('subofcategory', [$is_SetCountry->href, $getNameCategory->href, $getNameSubCategory->href]) }}"><i
                                        title="تصنيف فرعي"
                                        class="fas fa-folder-open   mx-1"></i>{{ $getNameSubCategory->category_name }}</a>
                            </div>
                        @endisset
                        <p class="description">
                        </p>
                        <p>{!! $articaleSites->description !!}</p>
                        <p></p>
                    </div>

                </div>
                <div class="hrr">
                    <hr style="margin:12px 50px;">
                </div>

                <div class="middle-page">
                    <ul>
                        @isset($is_SetCountry, $getCityName)
                            <li>
                                <div class="flag-country heighter">
                                    <img src="{{ url('../public/uploading/' . $is_SetCountry->country_flag) }}"
                                        alt="$is_SetCountry->country_name">
                                </div>

                                <a href="..." style="color:#494949;">{{ $is_SetCountry->country_name }}</a><span>-<a
                                        href="#" style="color:#494949;">{{ $getCityName->name }}</a></span>

                            </li>
                        @endisset
                        <li>
                            <a href="tel:966-533134395"><i title="اتصال"
                                    class="fa-solid fa-phone"></i>{{ $articaleSites->phone_number }}</a>
                        </li>
                        <li>

                            <i class="fa-solid fa-square-share-nodes" style="font-size:20px;"></i>
                            @isset($articaleSites->facebook)
                                <a target="_blank" href="{{ $articaleSites->facebook }}"><i class="fab fa-facebook fa-xl"
                                        style="color:#1877F2;"></i></a>
                            @endisset
                            @isset($articaleSites->instagram)
                                <a target="_blank" href="{{ $articaleSites->instagram }}"><i class="fab fa-instagram fa-xl"
                                        style="color:#E4405F;"></i></a>
                            @endisset
                            @isset($articaleSites->twitter)
                                <a target="_blank" href="{{ $articaleSites->twitter }}"><i class="fa-brands fa-twitter fa-xl"
                                        style="color:#1DA1F2;"></i></a>
                            @endisset
                            @isset($articaleSites->telegram)
                                <a target="_blank" href="{{ $articaleSites->telegram }}"><i class="fa-brands fa-telegram fa-xl"
                                        style="color:#0088cc;"></i></a>
                            @endisset
                        </li>

                    </ul>
                </div>


            </section>
        @endisset
        <section class="info-company mt-5 edit-info">
            <div class="container">
                <div class="boxinfo-company f">
                    <div class="title-companys m">
                        <h3>شركات ننصحك بزيارتها</h3>
                        {{-- <a href="#" class="text-decoration-none">مشاهدة
                        المزيد</a> --}}
                    </div>
                </div>
                <div class="box-part-main">
                    @isset($getLatestCompany)
                        @foreach ($getLatestCompany as $item)
                            <div class="list-company">
                                <a href="{{ url('company/get', $item->id) }}">
                                    <div class="company-preview-image">
                                        <img src="{{ url('./public/picCompany/' . $item->logo) }}"
                                            alt="{{ $item->site_name }}">
                                    </div>
                                </a>
                                <div class="title_company">
                                    <a href="{{ url('company/get', $item->id) }}">
                                        <h2>{{ $item->site_name }}</h2>
                                    </a>
                                    <div class="views_feature">
                                        <span class="title-span"><i class="far fa-eye"></i>{{ $item->views }}</span>
                                        <p>موصى به</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>

            </div>
        </section>
        @isset($articaleSites)
            @if ($articaleSites->articale == null)
            @else
                <div class="container" style="padding-left:0;padding-right:0;">
                    <div class="mt-4 text-white rounded box-main-discr">
                        <div class="main-box">
                            <h4 class="edit-descr-page"><span>مقال ذو صلة</span></h4>
                            <div class="box-right">
                                <div class="box-descr mainBox">
                                    {!! $articaleSites->articale !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endisset

        <div class="container addss text-center mt-3" style="width:70%">
            @isset($adds->atRight)
                <p class="text-center w-100">{!! $adds->atRight !!}</p>
            @endisset
        </div>

    @endsection


    <style>
        .middle-page ul li .flag-country {
            height: 16px !important;
        }

        @media (max-width:768px) {
            .addss img {
                width: 100% !important;
            }
        }
    </style>
