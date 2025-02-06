@extends('dalil.layout.navabar&footer')

@section('content')

@include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:70%">
        @isset($adds->atTop)
                <p class="text-center w-100">{!! $adds->atTop !!}</p>
            @endisset
    </div>

    <div class="container mt-2 box-category">
        <div class="div-sites">
            @isset($new_Sites)
                <ul class="list-sitess-search">
                    <h4 class="head-search-sitess">المواقع</h4>
                    @forelse ($new_Sites as $row)
                        @if ($row->confirmed == '1')
                        <a class="global-icon" href="{{ $row->href }}">
                            <i class='fas fa-globe' style="font-size: 15px"></i>
                        </a>
                        <a class="anch-sitess" href="{{ route('get_descr', $row->title) }}">
                            <span class="span-a">
                                <li>
                                    {{ $row->site_name }}
                                </li>
                            </span>
                        </a>
                        @endif
                        @empty
                        <p>لا يوجد شيئ عما تبحث عنه</p>
                    @endforelse
                </ul>
            @endisset
        </div>
    </div>

    
<div class="container addss text-center" style="width:70%">
        @isset($adds->atRight)
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
