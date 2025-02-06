@extends('dalil.layout.navabar&footer')

@section('content')
@include('dalil.layout.layoutSearchTop')

    <div class="container addss text-center" style="width:70%">
        @isset($adds)
                <p class="text-center w-100">{!! $adds->atTop !!}</p>
            @endisset
    </div>

    <div class="container mt-2 box-category">
        <div class="div-sites">
            @isset($tagss)
                <ul class="list-sitess-search">
                    <h4 class="head-search-sitess">المواقع التي تحتوي على وسم({{$tagSam->name}})</h4>
                    @forelse ($tagss as $eel)
                        @foreach ($eel->sites as $index => $rr)
                            @if ($rr->id == $rr->pivot->sites_id)
                                <a class="global-icon" href="{{ $rr->href }}">
                                    <i class='fas fa-globe' style="font-size: 15px"></i>
                                </a>
                                <a class="anch-sitess" href="{{ route('get_descr', [$rr->title]) }}">
                                    <span class="span-a">
                                        <li>
                                            {{ $rr->site_name }}
                                        </li>
                                    </span>
                                </a>
                            @endif
                        @endforeach
                        @empty
                        <p>لا يوجد شيئ عما تبحث عنه</p>
                    @endforelse
                </ul>
            @endisset
        </div>
    </div>

    
<div class="container addss text-center" style="width:70%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
            @endisset
    </div>




@endsection

<style>

    @media (max-width:768px){
        .addss img{
            width:100% !important;
        }
    }
    </style>
