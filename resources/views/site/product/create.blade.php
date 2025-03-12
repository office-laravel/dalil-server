@extends('site.layouts.layout')
@section('content')
 
 
<div class="container" style="height: auto !important; margin-bottom:10px ;">
    <div   >
        <div class="title-breadcrumb m sec">
          
            <a href="{{ route('pageme.user', Auth::check() ? Auth::user()->en_name : '') }}"
                style="text-decoration: none;">
                مواقعي 
            </a> /
            <span  >
                {{ $site->site_name }}
            </span>
            /
    <a href={{ url('users/product/all', $site->id) }}  style="text-decoration: none;"> المنتجات</a>  / <span  >إضافة منتج</span> 
        </div>
    </div>
    </div>

 



<div class="container" style="height: auto !important; margin-bottom:100px ;">
    <section class="info-company mt-5">


    <div  style="text-align: right ;margin-top:25px;">
        <div id="success_store"></div>

        <div class="div-sites">
            {{-- for show table to Edit Modal of data --}}
            <div class="contentEdit" style="text-align: right;">
              
                <form action="{{ url('users/product/store') }}" method="POST" id="form-product"
                enctype="multipart/form-data" class="p-2">

                <h4   style="margin:20px 0px;border-bottom: 1px solid #dee2e6;"> بيانات المنتج :</h4>
                @csrf


                <div class="row" style="margin: 0">
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المنتج</label>
                        <input type="text" class="site form-control" id="name" name="name" value=""
                            aria-describedby="textHelp">
                        <div id="name-error" class="invalid-feedback"></div>

                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">النوع</label>
                        <select class="form-control" id="type" name="type">
                            <option value="0">اختر النوع</option>
                            <option value="p">منتج مادي</option>
                            <option value="s">خدمة</option>
                        </select>
                        <div id="type-error" class="invalid-feedback"></div>

                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>الوصف </strong></label>
                        <textarea class="ckeditor form-control" name="description"></textarea>
                    </div>
                    <div class="mb-3" style="width: 50%">
                        <label for="price" class="form-label">السعر</label>
                        <input type="text" class="site form-control" id="price" name="price" value=""
                            aria-describedby="textHelp">
                        <div id="price-error" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3" style="width: 25%">
                        <label for="currency" class="form-label">العملة</label>
                        <input type="text" class="site form-control" id="currency" name="currency"
                            value=""  >
                        <div id="currency-error" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">الوحدة</label>
                        <input type="text" class="site form-control" id="unit" name="unit" value=""
                            aria-describedby="textHelp" placeholder="قطعة">
                        <div id="price-error" class="invalid-feedback"></div>

                    </div>
                    <div class="mb-3">
                        <label for="sequence" class="form-label">الترتيب</label>
                        <input type="text" class="site form-control" id="sequence" name="sequence"
                            value="" aria-describedby="textHelp" placeholder="1">
                        <div id="sequence-error" class="invalid-feedback"></div>

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-labell ">صورة المنتج</label>
                        <input type="file" name="image" class="form-control mt-2">
                    </div>
                    <input type="hidden" name="site_id" value="{{ $site->id }}">
                    
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary button-submit btn-submit "
                           >حفظ</button>
                    </div>
                </div>


            </form>

                
            </div>
           
        
            
        </div>
    </div>
    </section>
</div>
 
@endsection
 

@section('map-js')
    <script src="{{ url('public/assets/site/js/product.js') }}"></script>
 
@endsection
@section('css')
    <!-- #region -->
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
    
@endsection


 
