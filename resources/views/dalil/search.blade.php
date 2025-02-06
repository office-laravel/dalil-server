@extends('dalil.layout.navabar&footer')

@section('content')

    @include('dalil.layout.layoutSearchTop')
    <div class="container addss text-center" style="width:70%">
        @isset($adds->atTop)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>

    <div class="container mt-2 box-category">
        <!--<div class="box">-->
        <!--    @isset($cat)
        -->
            <!--        @forelse ($cat as $it_cat)
        -->
            <!--                <div class="one">-->
            <!--                    <a class="aaa text-decoration-none"-->
            <!--                        href="{{ route('showSubCat', [$country_namess->href, $it_cat->href]) }}">-->
            <!--                        <h6>{{ $it_cat->category_name }}<i class="fas fa-caret-left"></i></h6>-->
            <!--                    </a>-->

            <!--                    <ul>-->
            <!--                        @foreach ($it_cat->sites as $key => $val)
        -->

            <!--                            <section class=li-inside>-->
            <!--                                <a class="global-icon" href="{{ $val->href }}">-->
            <!--                                    <i class='fas fa-globe'style="font-size: 15px"></i>-->
            <!--                                        </a>-->
            <!--                                <li>-->
            <!--                                    <span class="span-a"><a-->
            <!--                                            href="{{ route('get_descr', [$val->title]) }}">{{ $val->site_name }}</a></span>-->
            <!--                                </li>-->
            <!--                            </section>-->
            <!--
        @endforeach-->
            <!--                    </ul>-->

            <!--                </div>-->

        <!--            @empty-->
            <!--                <p>لا يوجد شيئ عما تبحث عنه</p>-->
            <!--
        @endforelse-->
            <!--
    @endisset-->

        <!--</div>-->
        <div class="div-sites">
            @isset($sitess)
                <ul class="list-sitess-search">
                    <h4 class="head-search-sitess">المواقع</h4>
                    @forelse ($sitess as $row)
                        @if ($row->confirmed == '1')
                            <a class="global-icon" href="{{ $row->href }}">
                                <i class='fas fa-globe' style="font-size: 15px"></i>
                            </a>
                            <a class="anch-sitess" href="{{ url('company/get', $row->id) }}">
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
    @media (max-width:768px) {
        .addss img {
            width: 100% !important;
        }
    }
</style>
