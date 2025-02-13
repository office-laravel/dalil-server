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


                        <img src="{{ url('picCompany/' . $articaleSites->logo) }}" alt="{{ $articaleSites->site_name }}">


                    </div>
                    <div class="title-company sizee">
                        <h3> {{ $articaleSites->site_name }}</h3>
                        @if (isset($getNameSubCategory) && isset($getNameCategory) && isset($is_SetCountry))
                            <div class="category-company mb-3">
                                <a href="{{ route('showSubCat', [$is_SetCountry->href, $getNameCategory->href]) }}"
                                    class="span-one delLink"><i title="تصنيف"
                                        class="fas fa-folder-open mx-1 "></i>{{ $getNameCategory->category_name }}</a>
                                <a class="delLink"
                                    href="{{ route('subofcategory', [$is_SetCountry->href, $getNameCategory->href, $getNameSubCategory->href]) }}"><i
                                        title="تصنيف فرعي"
                                        class="fas fa-folder-open   mx-1"></i>{{ $getNameSubCategory->category_name }}</a>
                            </div>
                        @endif


                        <p class="description">
                        </p>
                        <p>{!! $articaleSites->description !!}</p>
                        <p></p>
                    </div>

                </div>
                <div style="padding: 0;">
                    <div class="col col-md-12  text-center">
                        <div class="map-result ">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="hrr">
                    <hr style="margin:12px 50px;">
                </div>

                <div class="middle-page">
                    <ul>
                        @if ($is_SetCountry && $getCityName)
                            <li>
                                <div class="flag-country heighter">
                                    <img src="{{ url('uploading/' . $is_SetCountry->country_flag) }}"
                                        alt="$is_SetCountry->country_name">
                                </div>

                                <a href="..." style="color:#494949;">{{ $is_SetCountry->country_name }}</a><span>-<a
                                        href="#" style="color:#494949;">{{ $getCityName->name }}</a></span>

                            </li>
                        @endif
                        <li>
                            <a href="tel:{{ $articaleSites->phone_number }}"><i title="اتصال" class="fa-solid fa-phone"
                                    style="padding-left:18px"></i>{{ $articaleSites->phone_number }}</a>
                        </li>
                        <li>

                            <i class="fa-solid fa-square-share-nodes" style="font-size:20px;"></i>
                            @isset($articaleSites->facebook)
                                <a target="_blank" class="desc-social" href="{{ $articaleSites->facebook }}"><i
                                        class="fab fa-facebook fa-xl" style="color:#1877F2;"></i></a>
                            @endisset
                            @isset($articaleSites->instagram)
                                <a target="_blank" href="{{ $articaleSites->instagram }}" class="desc-social"><i
                                        class="fab fa-instagram fa-xl" style="color:#E4405F;"></i></a>
                            @endisset
                            @isset($articaleSites->twitter)
                                <a target="_blank" href="{{ $articaleSites->twitter }}" class="desc-social"><i
                                        class="fa-brands fa-twitter fa-xl" style="color:#1DA1F2;"></i></a>
                            @endisset
                            @isset($articaleSites->telegram)
                                <a target="_blank" href="{{ $articaleSites->telegram }}" class="desc-social"><i
                                        class="fa-brands fa-telegram fa-xl" style="color:#0088cc;"></i></a>
                            @endisset
                        </li>

                    </ul>
                </div>


            </section>
        @endisset
        @if ($products)
            <div class="container mt-3 mb-3 padNews">
                <div class="info-company mt-5 edit-info">
                    <div>
                        <h3>المنتجات</h3>
                    </div>
                    <div class="N-box">
                        @forelse($products as $product)
                            <a href="{{ url('product', $product->id) }}" class="NewsBox text-decoration-none">
                                <img src="{{ url('picProduct/' . $product->image) }}" alt="{{ $product->name }}">
                                <h4>{{ $product->name }}</h4>
                                <p class="text-center">{{ $product->price }} {{ $product->currency }}</p>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>

            </div>
        @endif

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
                            <div class="box-right" style="padding-bottom: 15px;">
                                <div class="box-descr mainBox" style="color:#000;">
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
    @section('map-js')
        <script>
            var mainurl = "{{ url('PicCate/icon/') }}";
            var token = '{{ csrf_token() }}';
            var comId = '{{ $articaleSites->id }}'
            var companyurl = "{{ url('company/get') }}"
        </script>
        <script src="{{ url('js/map-single.js') }}"></script>
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
