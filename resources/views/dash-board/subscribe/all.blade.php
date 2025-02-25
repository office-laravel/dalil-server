@extends('dash-board.layout.navabr&footer')

@section('content')
    @include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0"><a href="{{ route('sites.main') }}">الشركات</a>
                        /
                        <a href="{{ route('sites.edit', $site->id) }}">{{ $site->site_name }}</a>
                    </h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

                    <ul class="navbar-nav me-auto ms-0 justify-content-end">

                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('admin.logout') }}" class="nav-link text-body font-weight-bold px-0 logout">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">تسجيل خروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-white" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $item)
                    <li class="text-danger">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="row backgroundW p-4 m-3">
            <div class="container">


                <div class="form-group btn-create">

                    <br>



                </div>
                <br>

                <div class="div-sites">




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

                    <div class="contentEdit">
                        <!-- Button trigger modal -->
                        <div style="display: flex;justify-content: space-between; width:100%;">
                            <a href="{{ url('admin/product/create', $site_id) }}" class="btn btn-success mb-3">
                                اضافة منتج<i class="fa-solid fa-plus mx-1"></i>
                            </a>
                            <h6 class="head-search-sitess">منتجات شركة:<a href="{{ route('sites.edit', $site->id) }}"><span>
                                        {{ $site->site_name }}</span></a> </h6>




                        </div>
                    </div>

                    <ul class="list-sitess-search">


                        <div class="fetchD" style="display: contents;">
                            <table class="container table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">النوع </th>
                                        <th scope="col">السعر</th>
                                        <th scope="col">تحكم</th>
                                        <th scope="col"></th>
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
                                                <td class="editt">
                                                    <a href="{{ url('admin/product/edit', $product->id) }}"
                                                        class=" btn btn-primary btn-sm">تعديل</a>
                                                </td>
                                                <td>
                                                    <form action="{{ url('admin/product/delete', $product->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf

                                                        <button type="submit" id="del-{{ $product->id }}"
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


        </div>

    </main>




















@endsection

@section('map-js')
    <script src="{{ url('public/js/delete.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#search').on('keyup', function() {
                var value = $(this).val();
                if (value) {
                    $('.allData').hide();
                    $('.searchData').show();
                } else {
                    $('.allData').show();
                    $('.searchData').hide();
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "{{ route('live_search.action') }}",
                    data: {
                        'q': value
                    },

                    success: function(data) {
                        // console.log(data);
                        $('#mycard').html(data);
                    }
                });
            });
        });
    </script>
@endsection
