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
        @isset($subCatbyName)
            <div class="part">
                <h6><a class="cu1">{{$subCatbyName->category_name}}</a>
                </h6>
            </div>
        @endisset
        <div class="box-part-main">
            @isset($getCompaniesOfSubCategory)
                @foreach($getCompaniesOfSubCategory as $val)
                    
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
            @endisset
        </div>

    </div>

    

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