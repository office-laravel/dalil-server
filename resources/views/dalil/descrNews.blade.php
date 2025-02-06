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
    <div class="container w-100 addss mt-5 mb-5">
        @isset($adds)
            <p class="text-center">{!! $adds->atTop !!}</p>
        @endisset
    </div>
    
        @isset($newsDescr)
        <div class="container card newsCard mt-5 mb-4" style="width:72%;">
            <h5 class="card-title text-start">
              <span>{{$newsDescr->title}}</span>
              <a href="{{ route('news.all') }}" class="text-decoration-none mx-3"><small>المقالات</small></a>
            </h5>
            @php
                $imageArray = explode(',', $newsDescr->image);
                $imageUrl = isset($imageArray[0]) ? url('../public/newsImage/'.$imageArray[0]) : '';
            @endphp
          <img src="{{ $imageUrl }}" class="card-img-top" alt="{{$newsDescr->title}}">
          <div class="card-body">
              <?php
                $dateString = $newsDescr->created_at;
                $date = new DateTime($dateString);
                $formattedDate = $date->format('d/m/Y');
            ?>
            <div><i class="fa-solid fa-calendar-days me-3"></i>{{$formattedDate}}</div>
            <span><i class="fa-solid fa-eye me-3"></i>{{$newsDescr->views == null ? 0 : $newsDescr->views}}</span>
            <p class="card-text">{!! $newsDescr->descr !!}</p>
          </div>
          <div class="timti">
              <span></span>
          </div>
        </div>
        @endisset
    

    <div class="container w-100 addss mt-5 mb-5">
        @isset($adds)
            <p class="text-center">{!! $adds->atRight !!}</p>
        @endisset
    </div>
    <div class="container mt-3 mb-3 padNews">
        <h2 class="h2-head">مقالات قد تهمك</h2>
        <div class="N-box">
            @isset($news)
                @foreach($news->take(4)->shuffle() as $item)
                    @php
                        $imageArray = explode(',', $item->image);
                        $imageUrl = isset($imageArray[1]) ? url('../public/smallNewsImage/'.$imageArray[1]) : '';
                    @endphp
                    <a href="{{ route('news.descr', $item->id) }}" class="NewsBox text-decoration-none">
                        <img src="{{ $imageUrl }}" alt="{{ $item->title }}">
                        <h4>{{ $item->title }}</h4>
                    </a>
                @endforeach
            @endisset

        </div>
    </div>
@endsection
<style>
    .h2-head{
        width: 100%;
    color: #00b075;
    font-size: 24px;
    padding: 9px 16px;
    border-bottom: 2px solid;
    border-radius: 10px;
    }
    .card-title{
        padding-top: 15px;
        padding-bottom: 15px;
        padding-right: 20px;
        color:#00b075;
    }
    .card{
        padding:10px !important;
    }
    .card-body p{
        text-align:start !important;
    }
    .card-body p a{
        text-decoration:none;
        color:#00b075;
    }
    .card img{
        width: 100%;
        height: 27rem;
        object-fit: fill;
    }
    .card-title{
        display: flex;
        justify-content: space-between;
    }
    .card-title a{
        color:#00b075;
    }
    .card-title a:hover{
        transition:all .5s;
        color:#00b075b5;
    }
    @media (max-width:768px) {
        .addss img {
            width: 100% !important;
        }
    }
</style>