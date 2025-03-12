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

            <span  >
            المنتجات
            </span>
        </div>
    </div>
    </div>

<div class="container" style="height: auto !important; margin-bottom:10px ;">
    <div   >
        <div class="title-breadcrumb m sec" style=" padding:10px;margin-bottom:15px; display: flex;    justify-content: space-between;">
          
            <h5 class="head-search-sitess"  >المنتجات </h5>
    <!-- Button trigger modal -->
    <a type="button" class="btn btn-success " title="اضافة منتج" style=" margin-bottom:10px;border-color:#fdc93a;background-color: #fdc93a " href="{{ url('users/product/create', $site_id) }}">
        <i class="fa fa-solid fa-plus mx-1" style="color: #fff"></i>
    </a>
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
              


                
            </div>
            {{-- End for show table to Edit Modal of data --}}

            <!-- Modal Store-->
        
            {{-- End Modal Store --}}

         
            {{-- end- edit Modal Sites --}}

            {{-- delete Modal Sites --}}
            <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="z-index:999999;">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-bottom-right-radius: 25px;
    border-bottom-left-radius: 25px;">
                        <div class="modal-header" style="display: flex;    justify-content: space-between;">
                            <h5 class="modal-title" id="exampleModalLabel">حذف المنتج</h5>
                            <button type="button" class="btn-close" style="margin: 0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="container mt-2">
                            <ul id="edit_div_err"></ul>
                        </div>

                        <h4 style="text-align: center;">هل انت متأكد ؟</h4>
                        <div class="modal-footer" style="border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;">

                            <button type="button" class="btn btn-secondary no-btn" data-bs-dismiss="modal">لا</button>
                            <button type="submit" class="btn   " style="background-color: #fff;color:#000" id="btn-modal-del">نعم</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end- delete Modal Sites --}}
        
          
              
                @if ($products->count()>0)
                <div class="fetchD" style="display: contents; ">
                  
                    <table class="table" style="margin: 10px; width:95%">
                        <thead>
                            <tr>
                               

                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">النوع </th>
                                <th scope="col">السعر</th>
                                <th scope="col">تحكم</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products)
                            @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->type_conv }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td class="control-td" >
                                             
                                                <a title="تعديل"
                                                href="{{ url('users/product/edit', $product->id) }}"
                                                class=" btn btn-primary btn-sm control-btn"><i class="fa fa-solid fa-pen mx-1" style="color: #fff"></i></a>
                                            
                                                <form action="{{ url('users/product/delete', $product->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" id="del-{{ $product->id }}" title="حذف"
                                                        class="btn btn-danger btn-sm delete control-btn" title="Delete"><i class="fa fa-trash mx-1" style="color: #fff"></i></button>
                                                </form>
                                            
                                            </td>
              
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @else
                <div class="fetchD" style="display: contents; text-align:center">
                    <H3>لايوجد</H3>
                </div> 
                
               
@endif
  
        </div>
    </div>
    </section>
</div>
 
@endsection
@section('map-js')

<script src="{{ url('public/assets/site/js/bootstrap-table-mobile.js') }}"></script>
    <script src="{{ url('public/assets/site/js/delete.js') }}"></script>
@endsection
@section('css')
    <!-- #region -->
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
    
@endsection


 
