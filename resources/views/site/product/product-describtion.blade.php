@extends('site.layouts.layout')
@section('content')
   
    

    <div class="container">
        @isset($product)
            <section class="info-company mt-5">

                 
                
            <div class="box-company">
                <div class="picture-company m">
                    <img src="{{$product->image ? url('public/picProduct/' . $product->image): url('public/picProduct/' . 'default.webp')}}"
                        alt="{{ $product->name }}">
                </div>
                <div class="title-company sizee">
                    <h3 style="color: #fdc93a"> {{ $product->name }}</h3>

                    <div class="category-company mb-3">
                        <a href="{{ url('company/get', $product->site->id) }}" class="span-one">
                            {{ $product->site->title }}</a>

                    </div>

                    <div class="category-company mb-3">

                        <p class="delLink"><strong> {{ $product->price }} <span>{{ $product->currency }}</span><span
                                    style="padding-right: 10px;">{{ $product->unit }}</span></strong></p>
                        <p class="delLink"><strong> </strong></p>
                    </div>

                    <p class="description">
                    </p>
                    <p>{!! $product->description !!}</p>
                    <p></p>
                </div>

            </div>
            </section>
        @endisset
        <div class="container   mb-3 padNews">
            <div class="info-company mt-5 edit-info">
                <div class="boxinfo-company f">
                    <div class="title-companys m">
                        <h3>منتجات ذات صلة</h3>

                        {{-- <a href="#" class="text-decoration-none">مشاهدة
                        المزيد</a> --}}
                    </div>
                </div>
                <div class="N-box">
                    @forelse($related_products as $product)
                     

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
    @endsection
    @section('map-js')
        <script>
            var mainurl = "{{ url('public/PicCate/icon/') }}";
            var token = '{{ csrf_token() }}';
        </script>
    @endsection
 
    @section('css')
    <!-- #region -->
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
    
@endsection