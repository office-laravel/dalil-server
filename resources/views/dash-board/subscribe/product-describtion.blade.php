@extends('dalil.layout.navabar&footer')
@section('content')
    @include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:70%">
        @isset($adds->atTop)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>

    <div class="container">
        @isset($product)
            <section class="info-company mt-5">

                <div class="box-company">
                    <div class="picture-company m">


                        <img src="{{ url('public/picProduct/' . $product->image) }}" alt="{{ $product->name }}">


                    </div>
                    <div class="title-company sizee">
                        <h3 style="color: #6A0808"> {{ $product->name }}</h3>

                        <div class="category-company mb-3">
                            <a href="{{ url('company/get', $product->site->id) }}" class="span-one   ">
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

        <div class="container addss text-center mt-3" style="width:70%">
            @isset($adds->atRight)
                <p class="text-center w-100">{!! $adds->atRight !!}</p>
            @endisset
        </div>

        <div class="container mt-3 mb-3 padNews">
            <div>
                <h3>منتجات ذات صلة</h3>
            </div>
            <div class="N-box">
                @forelse($related_products as $product)
                    <a href="{{ url('product', $product->id) }}" class="NewsBox text-decoration-none">
                        <img src="{{ url('public/picProduct/' . $product->image) }}" alt="{{ $product->name }}">
                        <h4>{{ $product->name }}</h4>
                        <p class="text-center">{{ $product->price }} {{ $product->currency }}</p>
                    </a>
                @empty
                @endforelse


            </div>
        </div>
    @endsection
    @section('map-js')
        <script>
            var mainurl = "{{ url('public/PicCate/icon/') }}";
            var token = '{{ csrf_token() }}';
        </script>
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
