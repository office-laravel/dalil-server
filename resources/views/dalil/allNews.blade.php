@extends('dalil.layout.navabar&footer')

@section('content')

    @include('dalil.layout.layoutSearchTop')
@if(isset($getfixedsitesnews))
     <div class="container d-flex justify-content-center mt-3">

        <div class="mb-2 forDisplay mainPageFixed">

                <ul class="list_fixSites">
                    @foreach ($getfixedsitesnews as $item)
                        <li class="anch_fixedSites" style="justify-content: center;">
                        <a href="{{ $item->link }}" target="_blank" class="text-decoration-none w-100">
                            
                                <div class="img_fixedSites">
                                    <img src="{{ url('../public/uploading/' . $item->img) }}" alt="{{$item->name}}" loading="lazy">
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
    <div class="container addss text-center" style="width:72%;">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>
    
    
    <div class="container mt-5 mb-5">
        <div class="N-box">

            @isset($news)
                @foreach($news as $item)
                @php
                    $imageArray = explode(',', $item->image);
                    $imageUrl = isset($imageArray[1]) ? url('../public/smallNewsImage/'.$imageArray[1]) : '';
                @endphp
                    <a href="{{route('news.descr', $item->id)}}" class="NewsBox text-decoration-none">
                        <img src="{{ $imageUrl }}" alt="{{ $item->title }}">
                        <h4>{{$item->title}}</h4>
                    </a>
                @endforeach
            @endisset
<div class="d-flex justify-content-center w-100 mt-5 mb-4">
                @if (isset($news))
                    {!! $news->appends(['sort' => 'votes'])->links() !!}
                @endif
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
    @media (max-width:768px) {
        .addss img {
            width: 100% !important;
        }
    }
    .page-link {
        background-color: #FFF !important;
        color: #00b075 !important;
        border-color: #00b075 !important;
    }

    .page-link:hover {
        background-color: #00b075 !important;
        color: #FFF !important;
    }

    .page-item.active .page-link {
        background-color: #00b075 !important;
        color: #FFF !important;
        border-color: #00b075;
    }

    .page-link:focus {
        background-color: #FFF;
    }
    
</style>

