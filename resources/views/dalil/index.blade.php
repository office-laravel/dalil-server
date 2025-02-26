@extends('dalil.layout.navabar&footer')

@section('content')

    @include('dalil.layout.layoutSearchTop')



    <div class="container d-flex justify-content-center mt-3">
@if(isset($getfixed_sites))
        <div class="mb-2 forDisplay">
                <ul class="list_fixSites">
                    @foreach ($getfixed_sites->fixedsite as $index => $item)
                        <a href="{{ $item->href }}" target="_blank" class="anch_fixedSites text-decoration-none">
                            <li>
                                <div class="img_fixedSites">
                                    <img src="{{ url('/public/uploading/' . $item->photo) }}" alt="{{ $item->site_name }}" loading="lazy">
                                </div>
                                <div class="textFixedSites">{{ $item->site_name }}</div>
                            </li>
                        </a>


                        <!--<a class="anchor-text text-decoration-none" href="{{ $item->href }}" target="_blank"-->
                        <!--    style="color:#454545;margin-left:3px;">{{ $item->site_name }}</a>-->
                    @endforeach
                </ul>
        </div>
@endif
    </div>

    <div class="container addss text-center" style="width:72%;">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>
    <div class="container mt-3 mb-3 padNews">
        <div class="N-box">
            @isset($news)
                @foreach($news as $item)
                @php
                    $imageArray = explode(',', $item->image);
                    $imageUrl = isset($imageArray[1]) ? url('/public/smallNewsImage/'.$imageArray[1]) : '';
                @endphp
                    <a href="{{route('news.descr', $item->id)}}" class="NewsBox text-decoration-none">
                        <img src="{{ $imageUrl }}" alt="{{ $item->title }}">
                        <h4>{{$item->title}}</h4>
                    </a>
                @endforeach
            @endisset

        </div>
    </div>
    <div class="container position-relative">
        <div class="container mb-2 position-relative">
            <div class="container mt-2 box-category">
                <div class="box">
                    @isset($getAllCate)
                        @foreach ($getAllCate as $item)
                                <a href="{{ route('showSubCat', [$category_change_country->href, $item->href]) }}" class="mt-3 one">
                                    <div class="img">
                                        <img src="{{ url('/public/PicCate/'.$item->image)}} " alt="{{$item->category_name}}">
                                    </div>
                                    <p class="title">{{$item->category_name}}</p>
                                </a>
                            
                        @endforeach
                    @endisset
                </div>
            </div>

        </div>
        
    </div>
    <div class="container addss text-center" style="width:72%;">
            @isset($adds)
                <p class="text-center w-100">{!! $adds->atRight !!}</p>
            @endisset
        </div>

@endsection
<style>
.box .one{
    /*display:block;*/
    /*text-align: center;*/
    /*font-size: 13px;*/
    /*color: #707070;*/
    /*font-weight: bold;*/
    /*text-decoration:none;*/
    /*padding: 14px 5px;*/
    /*border-radius:5px;*/
}
.box .one:hover{background-color:#e9f9eb;}
.padNews{
        padding:10px 78px 0 !important;
    }
    .padNews .NewsBox{
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
