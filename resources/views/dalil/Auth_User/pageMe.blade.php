@extends('dalil.layout.navabar&footer')

@section('content')
    @include('dalil.layout.layoutSearchTop')

    <div class="container addss text-center" style="width:73%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atTop !!}</p>
        @endisset
    </div>
    <div class="container mt-2 box-category">
        <div id="success_store"></div>

        <div class="div-sites">
            {{-- for show table to Edit Modal of data --}}
            <div class="contentEdit">
                <!-- Button trigger modal -->
                <a type="button" class="btn btn-success mb-3" href="{{ route('create-sites.user') }}">
                    اضافة موقع<i class="fa-solid fa-plus mx-1"></i>
                </a>


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
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">حذف المنتج</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="container mt-2">
                            <ul id="edit_div_err"></ul>
                        </div>

                        <h4 style="text-align: center;">هل انت متأكد ؟</h4>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا</button>
                            <button type="submit" class="btn btn-primary  " id="btn-modal-del">نعم</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end- delete Modal Sites --}}

            <ul class="list-sitess-search">
                <h4 class="head-search-sitess">مواقعي </h4>
                <div class="fetchD" style="display: contents;">
                    <table class="container table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">العنوان </th>
                                <th scope="col"></th>
                                <th scope="col">تحكم</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sites)
                                @foreach ($sites as $site)
                                    <tr>
                                        <td>{{ $site->id }}</td>
                                        <td>{{ $site->site_name }}</td>
                                        <td>{{ $site->title }}</td>
                                        <td style="text-align: left"><a href={{ url('users/product/all', $site->id) }}
                                                class="products btn btn-success btn-sm">المنتجات</a></td>
                                        <td class="edit" style="width: 20px;"><a
                                                href="{{ route('edit-sites.user', $site->id) }}"
                                                class=" btn btn-primary btn-sm">تعديل</a></td>
                                        <td>

                                            <form action="{{ route('destroy-sites.user', $site->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" id="del-{{ $site->id }}"
                                                    class="btn btn-danger btn-sm delete" title="Delete">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </ul>

        </div>
    </div>


    <div class="container addss text-center" style="width:73%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
        @endisset
    </div>
@endsection
@section('map-js')
    <script src="{{ url('js/delete.js') }}"></script>
@endsection


<style>
    @media (max-width:768px) {
        .addss img {
            width: 100% !important;
        }
    }

    .offcanvas-top {
        height: 20rem !important;
    }

    table tbody .editt {
        width: 50px;
    }
</style>
