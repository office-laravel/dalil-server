@extends('dalil.layout.navabar&footer')


@section('content')
@include('dalil.layout.layoutSearchTop')
<div class="container addss text-center" style="width:70%">
    @isset($adds)
    <p class="text-center w-100">{!! $adds->atTop !!}</p>
    @endisset
</div>
<div class="content_box">

    <div class="container mb-5 p-2">
        @isset($subCat->category_name)
        <div class="part">
            <h6><a class="cu1" href="#">{{$subCat->category_name}}</a>
            </h6>
        </div>
        @endisset
        <ul class="showsubclass-list">
            @isset($subCat)
                @foreach($subCatbyCategory as $item)
                    @foreach($item->supcategories as $key => $val)
                        <li><a href="{{route('subofcategory', [$country_href,$item->href, $val->href])}}">{{$val->category_name}}</a></li>    
                    @endforeach
                @endforeach
            @endisset
        </ul>
        <div class="box-part-main">
            @isset($subCatbyCategory)
            @foreach($subCatbyCategory as $item)
                @foreach($item->sites as $key => $val)
                <div class="list-company">
                    <a href="{{url('companydetails/get/' . $is_SetCountry->href. '/' . $val->id)}}">
                        <div class="company-preview-image">
                            @if(!empty($val->logo))
                                <img src="{{url('./public/picCompany/'. $val->logo)}}" alt="">
                            @else
                            @isset($Settings)
                                <img src="{{url('./public/uploading/'. $Settings->image_default)}}" alt="">
                            @endisset
                            @endif
			    	    </div>
			    	</a>    
			    	<div class="title_company">
                        <a href="#">
                            <h2>{{$val->site_name}}</h2>
                        </a>
                        <div class="views_feature">
                            <span class="title-span"><i class="far fa-eye"></i>{{$val->views}}</span>
                            <p>موصى به</p>    
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
            @endisset
        </div>
        {{-- @isset($subCat)
        @foreach ($subCat->supcategories as $item)
        
        @if ($item->parent_id == $subCat->id)
        <div class="box-main-sub">
            <div class="border-sub-h">
                <h6>{{ $item->category_name }}</h6>
            </div>
            <ul>
                @foreach ($subCat->sites as $index => $val)
                @isset($getIdCountry)
                @if($val->countries_id == $getIdCountry->id || $val->countries_id == '0')
                @if ($val->subcategories == $item->id)
                @if ($val->confirmed == '1')
                <li>
                    <span><a class="text-decoration-none cc" href="{{ $val->href }}" target="_blank"><i
                                class='fas fa-globe' style="font-size: 15px"></i></a></span>
                    @if ($Settings->insertQuick == 1)
                    <a class="anchor" href="{{ $val->href }}" target="_blank">
                        {{$val->site_name}}
                    </a>
                    @else
                    <a class="anchor" href="{{ route('get_descr', $val->title) }}">
                        {{$val->site_name}}
                    </a>
                    @endif
                </li>
                @endif
                @endif
                @endif
                @endisset
                @endforeach
            </ul>
        </div>
        @endif
        
        @endforeach
        @endisset --}}

    </div>

    {{-- <div class="aside">
        <h5>الأقسام</h5>
        <ul class="list-unstyled">
            @isset($getAllCategory)
            <!--@isset($category_change_country)-->
            @foreach($getAllCategory as $getAll)
            <a href="{{route('showSubCat', [$category_change_country->href, $getAll->href])}}"
                class="text-decoration-none">
                <li class="items_list">
                    {{$getAll->category_name}}
                </li>
            </a>

            @endforeach
            <!--@endisset-->
            @endisset
        </ul>
    </div> --}}

</div>

<div class="container addss text-center" style="width:70%">
    @isset($adds)
    <p class="mt-2 text-center w-100">{!! $adds->atRight !!}</p>
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