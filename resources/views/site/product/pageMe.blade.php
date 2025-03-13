@extends('site.layouts.layout')
@section('content')
<div class="container" style="height: auto !important; margin-bottom:10px ;">
    <div   >
        <div class="title-breadcrumb m sec" style=" padding:10px;margin-bottom:15px; display: flex;    justify-content: space-between;">
          
            <h5 class="head-search-sitess"  >مواقعي </h5>
    <!-- Button trigger modal -->
    <a type="button" class="btn btn-success " title="اضافة موقع" style=" margin-bottom:10px;border-color:#fdc93a;background-color: #fdc93a " href="{{ route('create-sites.user') }}">
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
                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel"
                    style="z-index: 99999;">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasTopLabel">مواقعي المفضلة</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                    </div>
                </div>
            </div>
            {{-- End for show table to Edit Modal of data --}}

            <!-- Modal Store-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="z-index:999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">اضافة موقع</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="container mt-2">
                            <ul id="div_err"></ul>
                        </div>
                        <div class="formr-store">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputText" class="form-label">اسم الموقع</label>
                                    <input type="text" class="site form-control" id="exampleInputText" name="site"
                                        value="{{ old('site') }}" aria-describedby="textHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputhref" class="form-label">رابط الموقع</label>
                                    <input type="text" class="href form-control" id="exampleInputhref" name="href"
                                        value="{{ old('href') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="saveBtn">حفظ</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal Store --}}
            {{-- edit Modal Sites --}}
            <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="z-index:999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تعديل وتحديث الموقع</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="container mt-2">
                            <ul id="edit_div_err"></ul>
                        </div>
                        <form>
                            <input type="hidden" id="edit_site_id">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_site" class="form-label">اسم الموقع</label>
                                    <input type="text" class="site form-control" id="edit_site" name="site"
                                        value="{{ old('site') }}" aria-describedby="textHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_href" class="form-label">href</label>
                                    <input type="text" class="href form-control" id="edit_href" name="href"
                                        value="{{ old('href') }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary updateBtn" id="updateBtn">تحديث</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
              
                @if ($sites->count()>0)
                <div class="fetchD" style="display: contents; ">
                  
                    <table class="table" style="margin: 10px; width:95%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">العنوان </th>
                                <th scope="col">تحكم</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sites)
                                @foreach ($sites as $site)
                                    <tr>
                                        <td scope="row">{{ $site->id }}</td>
                                        <td>{{ $site->site_name }}</td>
                                        <td>{{ $site->title }}</td>
                                        <td class="control-td" >
                                            <a href={{ url('users/product/all', $site->id) }}
                                                class="products btn   btn-sm control-btn background-main">المنتجات</a>

                                                <a title="تعديل"
                                                href="{{ route('edit-sites.user', $site->id) }}"
                                                class=" btn btn-primary btn-sm control-btn"><i class="fa fa-solid fa-pen mx-1" style="color: #fff"></i></a>
                                            
                                                <form action="{{ route('destroy-sites.user', $site->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" id="del-{{ $site->id }}" title="حذف"
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


 
