@extends('dalil.layout.navabar&footer')

@section('content')
@include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:65%;">
        @isset($adds)
                <p class="text-center w-100">{!! $adds->atTop !!}</p>
            @endisset
    </div>

    <div class="container mt-5 p-3 main-about">
        @isset($get_content)
            @foreach ($get_content as $get_describtion)
                <div class="custom_page_right">
                    @foreach ($all_pinned_page as $get_pinned)
                        <ul>

                            <a class="text-d" href="{{ route('about-dalil', [$get_pinned->href, $get_pinned->id]) }}">
                                <li>{{ $get_pinned->page_name }}</li>
                            </a>
                        </ul>
                    @endforeach
                </div>

                <div class="custom_page_left">
                    <h5>{{ $get_describtion->page_name }}</h5>
                    <div class="description_page">

                        <p>{!! $get_describtion->content !!}</p>

                    </div>
                </div>
            @endforeach
        @endisset

    </div>
<div class="container addss text-center" style="width:65%;">
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