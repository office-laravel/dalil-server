@extends('site.layouts.layout')
@section('content')
<div class="container">
    @isset($articaleSites)
        <section class="info-company mt-5">

            <div class="box-company">
                <div class="picture-company m">


                    <img src="{{ $package->logo == 1 && $articaleSites->logo ? url('public/picCompany/' . $articaleSites->logo) : url('public/picCompany/' . 'default.webp') }}"
                        alt="{{ $articaleSites->site_name }}">


                </div>
                <div class="title-company sizee">
                    <h3> {{ $articaleSites->site_name }}</h3>
                    @if (isset($getNameSubCategory) && isset($getNameCategory) && isset($is_SetCountry))
                        <div class="category-company mb-3">
                            @if ($package->category == 1)
                                <a href="#"
                                    class="span-one delLink"><i title="تصنيف"
                                        class="fas fa-folder-open mx-1 "></i>{{ $getNameCategory->category_name }}</a>
                            @endif
                            @if ($package->subcategories == 1)
                                <a class="delLink span-one delLink"
                                    href="#"><i
                                        title="تصنيف فرعي"
                                        class="fas fa-folder-open   mx-1"></i>{{ $getNameSubCategory->category_name }}</a>
                            @endif
                        </div>
                    @endif


                    <p class="description">
                    </p>
                    @if ($package->description == 1)
                        <p>{!! $articaleSites->description !!}</p>
                    @endif
                    <p></p>
                </div>

            </div>
            @if ($package->maploc == 1)
                <div style="padding: 0;">
                    <div class="col col-md-12  text-center">
                        <div class="map-result ">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="hrr">
                <hr style="margin:12px 50px;">
            </div>

            <div class="middle-page">
                <ul>
                    @if ($is_SetCountry && $getCityName)
                        <li>
                            <div class="flag-country heighter">
                                <img src="{{ url('public/uploading/' . $is_SetCountry->country_flag) }}"
                                    alt="$is_SetCountry->country_name">
                            </div>

                            <a href="..." style="color:#494949;">{{ $is_SetCountry->country_name }}</a>
                            @if ($package->city == 1)
                                <span> -
                                    <a href="#" style="color:#494949;">{{ $getCityName->name }}</a></span>
                            @endif
                        </li>
                    @endif
                    @if ($package->phone_number == 1)
                        <li> 
                            <a href="tel:{{ $articaleSites->phone_number }}"><i title="اتصال" class="fas fa-phone main-color"
                                    style="padding-left:2px"></i>{{ $articaleSites->phone_number }}</a>
                        </li>
                    @endif
                    @if ($package->mobile_number == 1)
                        <li>
                            <a href="tel:{{ $articaleSites->mobile_number }}"><i title="اتصال" class="fas   fa-mobile-alt"
                                    style="padding-left:5px"></i>{{ $articaleSites->mobile_number }}</a>
                        </li>
                    @endif
                    @if ($package->social == 1)
                        <li>

                            <i class="fas fa-share-alt fa-2x" style="font-size:20px;"></i>
                            @isset($articaleSites->facebook)
                                <a target="_blank" class="desc-social" href="{{ $articaleSites->facebook }}"><i
                                        class="fab fa-facebook fa-2x" style="color:#1877F2;"></i></a>
                            @endisset
                            @isset($articaleSites->instagram)
                                <a target="_blank" href="{{ $articaleSites->instagram }}" class="desc-social"><i
                                        class="fab fa-instagram fa-2x" style="color:#E4405F;"></i></a>
                            @endisset
                            @isset($articaleSites->twitter)
                                <a target="_blank" href="{{ $articaleSites->twitter }}" class="desc-social"><i
                                        class="fab fa-twitter fa-2x" style="color:#1DA1F2;"></i></a>
                            @endisset
                            @isset($articaleSites->telegram)
                                <a target="_blank" href="{{ $articaleSites->telegram }}" class="desc-social"><i
                                        class="fab fa-telegram fa-2x" style="color:#0088cc;"></i></a>
                            @endisset
                        </li>
                    @endif
                </ul>
            </div>


        </section>
    @endisset
    @if ($products->count()>0)
        <div class="container   mb-3 padNews">
            <div class="info-company mt-5 edit-info">
                <div class="boxinfo-company f">
                    <div class="title-companys m">
                        <h3>المنتجات</h3>
                        {{-- <a href="#" class="text-decoration-none">مشاهدة
                        المزيد</a> --}}
                    </div>
                </div>
                <div class="N-box">
                    @forelse($products->take($package->products_count) as $product)
                     

                        <div class="list-company">
                            <a href="{{ url('product', $product->id) }}">
                                <div class="company-preview-image" style="    border-bottom: 1px solid #ebebeb;">
                                    <img src="{{$product->image ? url('public/picProduct/' . $product->image): url('public/picProduct/' . 'default.webp')}}"
                                        alt="{{ $product->name }}">
                                </div>
                            </a>
                            <div class="title_company"  style="border-bottom: 0px ">
                                <a href="{{ url('product', $product->id) }}">
                                    <h2 class="product-titl"  >{{ $product->name }}</h2>
                                </a>
                                <div class="views_feature" style="padding-bottom: 10px ">
                                    {{ $product->price }} {{ $product->currency }}
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

        </div>
    @endif

    <section class="info-company  edit-info"   style="margin-bottom:10px">
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
                    @foreach ($getLatestCompany->take($package->sites_count) as $item)
                        <div class="list-company">
                            <a href="{{ url('company/get', $item->id) }}">
                                <div class="company-preview-image">
                                    <img src="{{ $package->logo == 1 && $item->logo ? url('public/picCompany/' . $item->logo) : url('public/picCompany/' . 'default.webp') }}"
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
        @if ($articaleSites->articale == null || $package->articale != 1)
        @else
        
    <section class="info-company   edit-info"   style="margin-bottom:10px">
            <div class="container"  >
               
                                      
                        <div class="boxinfo-company f"  style="margin-bottom:5px">
                            <div class="title-companys m">
                                <h3>مقال ذو صلة</h3>
                               
                            </div>
                        </div>
                        <div class="boxinfo-company f" >
                            <div class="title-companys m" style="margin-top:1px;color:#000;" >
                                {!! $articaleSites->articale !!}
                               
                            </div>
                        </div>
                    

               
            </div>
        </section>
        @endif
    @endisset
    <div style="margin-bottom: 75px;">
</div>
    
</div>

@endsection 
 
@section('map-js')
<script>
    var mainurl = "{{ url('PicCate/icon/') }}";
    var token = '{{ csrf_token() }}';
    var comId = '{{ $articaleSites->id }}'
    var companyurl = "{{ url('company/get') }}";
</script>
<script src="{{ url('public/assets/site/js/map-single.js') }}"></script>
@endsection
@section('css')
    <!-- #region -->
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
    
@endsection
