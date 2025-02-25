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




            {{-- delete Modal Sites --}}
            <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                style="z-index:999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">حذف المنتج</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <a href="{{ url('users/product/create', $site_id) }}" class="btn btn-success mb-3">
                    اضافة منتج<i class="fa-solid fa-plus mx-1"></i>
                </a>


            </div>

            <ul class="list-sitess-search">

                <div style="display: flex;justify-content: space-between; width:100%;">
                    <h4 class="head-search-sitess">منتجات شركة: <span> {{ $site->site_name }}</span></h4>
                    <a style="width: 80px" href="{{ route('pageme.user', Auth::check() ? Auth::user()->en_name : '') }}"
                        style="text-decoration: none;">
                        مواقعي<i class="fa-solid fa-arrow-left mx-1"></i>
                    </a>

                </div>
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
                                            <a href="{{ url('users/product/edit', $product->id) }}"
                                                class=" btn btn-primary btn-sm">تعديل</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('users/product/delete', $product->id) }}" method="POST"
                                                class="d-inline">
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


    <div class="container addss text-center" style="width:73%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
        @endisset
    </div>
@endsection

@section('map-js')
    <script src="{{ url('public/js/delete.js') }}"></script>
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
