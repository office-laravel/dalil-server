@extends('dalil.layout.navabar&footer')

@section('content')


    <div class="content-all" style="width: 100%; height:auto;">
        <div class="section-search">
            <div class="container mt-3 mb-2 d">
                <div class="search_mainIndex">
                    <form id="searchthis" action="{{ route('search') }}" style="display:inline;" method="get">

                        <input id="namanyay-search-box-mainIndex" name="q" type="text"
                            placeholder="ما الذي تبحث عنه؟" required />
                        <button id="namanyay-search-btn-mainIndex" aria-label="بحث" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                        <!-- {{-- <button class="navbar-search_button">
                    <i class="fa fa-search"></i>
                </button> --}} -->
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------->
        <div class="part-country" style="margin-right: 12px;margin-left: 12px;">

            <div class="container mt-3 mb-2 d" style="text-align: -webkit-center;">

                <form method="POST" action="{{ url('searchmap') }}" style="width:100%" name="search_map" id="search_map">
                    <div class="row map-container  text-center " style="padding:15px; margin:0;">


                        <div style="text-align: -webkit-center;">
                            <div class="col col-sm-12 col-md-8 col-lg-8  ">
                                <div class="input-group" dir="ltr">

                                    <div class="input-group-prepend">
                                        {{-- advance --}}
                                        <button type="button" class="input-group-text btn btn-secondary "
                                            style="padding: 15px;margin: 0px" data-toggle="collapse"
                                            data-target="#collapsefilter" aria-expanded="false"
                                            aria-controls="collapsefilter"><i class="fa fa-sliders  fa-rotate-90"
                                                aria-hidden="true"></i></i></button>
                                        {{-- simple search --}}
                                        <button class="input-group-text btn btn-primary" type="submit" id="search_map_btn"
                                            style="padding: 15px;background-color: #4991f5;border: 0; margin: 0px"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                    <input type="text" id="text-search-main" dir="rtl" style="padding: 15px"
                                        class="form-control" aria-label="Input group example" placeholder="ابحث في الخريطة"
                                        aria-describedby="btnGroupAddon">
                                </div>
                            </div>

                        </div>

                        <div class="collapse" id="collapsefilter">
                            <div class="row ">
                                <div class="col col-sm-12 col-md-3 filter-input">
                                    <h6>المحافظة</h6>
                                    <div>
                                        <select class="form-control " id="city_id" name="city_id">
                                            <option value="0">الكل</option>
                                            @foreach ($cities as $city)
                                                <option data-lat="{{ $city->latitude }}" data-long="{{ $city->longitude }}"
                                                    value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-sm-12 col-md-3 filter-input">
                                    <h6>المدينة</h6>
                                    <select class="form-control " id="subcity" name="subcity">
                                        <option value="0">الكل</option>
                                    </select>
                                </div>
                                <div class="col  col-md-3 filter-input">
                                    <h6>التصنيفات</h6>
                                    <select class="form-control col col-md-12" id="category" name="category">
                                        <option value="0">الكل</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col  col-md-3 filter-input">
                                    <h6>التصنيفات الفرعية</h6>
                                    <select class="form-control  " name="subcategory" id="subcategory">
                                        <option value="0">الكل</option>
                                    </select>
                                </div>

                            </div>
                        </div>





                        <div style="padding: 0;">
                            <div class="col col-md-12  text-center">
                                <div class="map-result ">
                                    <div id="map" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @if (isset($fixedmainsites))
            <div class="container d-flex justify-content-center mt-3">
                <div class="mb-2 forDisplay mainPageFixed">
                    <ul class="list_fixSites">
                        @foreach ($fixedmainsites as $item)
                            <li class="anch_fixedSites" style="justify-content: center;">
                                <a href="{{ $item->link }}" target="_blank" class="text-decoration-none w-100">

                                    <div class="img_fixedSites">
                                        <img src="{{ url('uploading/' . $item->img) }}" alt="{{ $item->name }}"
                                            loading="lazy">
                                    </div>
                                    <div class="textFixedSites text-black">{{ $item->name }}</div>

                                </a>
                            </li>


                            <!--<a class="anchor-text text-decoration-none" href="{{ $item->href }}" target="_blank"-->
                            <!--    style="color:#454545;margin-left:3px;">{{ $item->site_name }}</a>-->
                        @endforeach
                    </ul>






                </div>

            </div>
        @endif
        <div class="container addss text-center" style="width:73%;">
            @isset($adds)
                <p class="mt-2 w-100 text-center">{!! $adds->atTop !!}</p>
            @endisset
        </div>
        <div>

            <div class="part-country">
                <div class="container">

                    <ul class="list-unstyled list-contry">
                        @foreach ($country_names as $item)
                            <li>
                                <a href="{{ route('reload', [$item->href]) }}" class="text-decoration-none">

                                    <div class="img-contry"
                                        style="display: flex;
                    align-items: center;">
                                        <img src="{{ url('uploading/' . $item->country_flag) }}"
                                            alt="{{ $item->country_name }}" style="width:16px;height:11px"
                                            loading="lazy">
                                    </div>
                                    <span>{{ $item->country_name }}</span>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="container mt-3 mb-3 padNews">
                <div class="N-box">
                    @isset($news)
                        @foreach ($news as $item)
                            @php
                                $imageArray = explode(',', $item->image);
                                $imageUrl = isset($imageArray[1]) ? url('smallNewsImage/' . $imageArray[1]) : '';
                            @endphp
                            <a href="{{ route('news.descr', $item->id) }}" class="NewsBox text-decoration-none">
                                <img src="{{ $imageUrl }}" alt="{{ $item->title }}">
                                <h4>{{ $item->title }}</h4>
                            </a>
                        @endforeach
                    @endisset

                </div>
            </div>
        </div>
        <div class="container addss text-center" style="width:73%;">
            @isset($adds)
                <p class="text-center w-100">{!! $adds->atRight !!}</p>
            @endisset
        </div>

    @endsection
    @section('map-js')
        <script>
            var mainurl = "{{ url('PicCate/icon/') }}";
            var token = '{{ csrf_token() }}';
            var subcityurl = "{{ url('subcity/ItemId') }}";
            var companyurl = "{{ url('company/get') }}"
        </script>
        <script src="{{ url('js/map.js') }}"></script>
    @endsection
    @section('script')
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                                console.log(subcategory.category_name);
                            });
                            console.log(data);
                        }
                    })
                });
            });
        </script>
    @endsection
    <style>
        .padNews {
            padding: 10px 78px 0 !important;
        }

        .padNews .NewsBox {
            width: 23.2%;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        @media (max-width:768px) {
            .addss img {
                width: 100% !important;
            }
        }
    </style>
