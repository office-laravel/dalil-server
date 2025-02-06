@extends('dalil.layout.navabar&footer')

@section('content')


@include('dalil.layout.layoutSearchTop')
    <!---------------------------->
    
    <div class="part-country">
        <div class="container">
            <div class="container addss w-75">
             @isset($adds)
                <p class="text-center">{!! $adds->atTop !!}</p>
            @endisset
            </div>
            <p class="mt-3 mb-3">الصفحة التي تحاول الوصول اليها غير متوفرة حاليا</p>
            <ul class="list-unstyled list-contry">
                @foreach ($country_names as $item)
                    <a href="{{ route('reload', [$item->href]) }}" class="text-decoration-none">
                        <li>
                            <div class="img-contry" style="display: flex;
                    align-items: center;">
                                <img src="{{ url('../public/uploading/' . $item->country_flag) }}" alt="{{ $item->country_name }}">
                            </div>
                            <span>{{ $item->country_name }}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="container addss w-75">
        @isset($adds)
            <p class="text-center ">{!! $adds->atRight !!}</p>
            @endisset
    </div>


@endsection
