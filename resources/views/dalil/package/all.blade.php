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
            <section class="u-clearfix u-container-align-center u-section-2  " id="sec-5d9c">
                <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-xl u-sheet-1 ">
                    <h2 class="u-align-center u-text u-text-default u-text-1  " style=" font-size:50px;"> الاشتراكات</h2>
                    <div
                        class="u-container-style u-layout-cell u-size-32-xl u-size-60-lg u-size-60-md u-size-60-sm u-size-60-xs u-layout-cell-1">
                        <div class="u-container-layout u-container-layout-1">
                            <div
                                class="custom-expanded u-expanded-width-lg u-expanded-width-md u-expanded-width-xl u-list u-list-1">
                                <div class="u-repeater u-repeater-1">
                                    @foreach ($packages as $package)
                                        <div
                                            class="u-container-align-right-sm u-container-align-right-xs u-container-style u-list-item u-repeater-item u-list-item-1  ">
                                            <div
                                                class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-md u-container-layout-2">
                                                <h5 class="u-align-right-sm u-align-right-xs u-text u-text-2">
                                                    {{ $package->name }}
                                                </h5>

                                                <ul style="text-align: right;"
                                                    class="u-align-right-sm u-align-right-xs u-custom-list u-file-icon u-text u-text-3">
                                                    <li>
                                                        @if ($package->href == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>رابط الشركة</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->category == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>التصنيف</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->subcategories == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>التصنيف الفرعي</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->title == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>العنوان</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->description == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>نبذة</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->articale == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>مقال ذو صلة</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->video == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>كود الفيديو</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->keyword == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>كلمات مفتاحية</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->logo == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>شعار الشركة</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->mobile_number == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>رقم الجوال</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->phone_number == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>رقم الهاتف</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->social == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>روابط التواصل الاجتماعي</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->android == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>رابط تطبيق الاندرويد</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->ios == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>رابط تطبيق الايفون</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->city == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>تحديد المحافظة والمدينة</span>
                                                    </li>
                                                    <li>
                                                        @if ($package->maploc == 1)
                                                            <i class="bi bi-check-lg success"
                                                                style="padding-left:3px; color:#198754;"></i>
                                                        @else
                                                            <i class="bi bi-x-lg"
                                                                style="padding-left:3px;color:#DC3545;"></i>
                                                        @endif <span>تحديد الاحداثيات على
                                                            الخريطة</span>
                                                    </li>
                                                    <li>
                                                        <span>عدد المواقع</span><span>/ {{ $package->sites_count }} /</span>
                                                    </li>
                                                    <li>
                                                        <span>عدد المنتجات لكل موقع</span><span>/
                                                            {{ $package->sites_count }} /</span>
                                                    </li>



                                                </ul>
                                                <form action="{{ url('users/package/store') }}" method="POST"
                                                    id="form-product">
                                                    @csrf
                                                    @if ($package->is_free != 1)
                                                        <div style="text-align: right ;padding-top:10px;">
                                                            @php
                                                                $i = 0;
                                                            @endphp


                                                            @foreach ($package->durationspackages->sortBy('duration.duration') as $durationspackage)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="year-{{ $package->id }}"
                                                                        value="{{ $durationspackage->id }}"
                                                                        @if ($i == 0) checked @endif>
                                                                    <label class="form-check-label">
                                                                        {{ $durationspackage->duration->duration }} سنة
                                                                        ({{ $durationspackage->price }} $)
                                                                    </label>
                                                                </div>

                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            @endforeach
                                                            <input type="hidden" name="package"
                                                                value="{{ $package->id }}">
                                                        </div>
                                                </form>
                                                <a href="#"
                                                    class="u-active-white u-align-right-sm u-align-right-xs u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-base u-border-palette-1-base u-btn u-btn-round u-button-style u-hover-white u-palette-1-base u-radius u-text-active-black u-text-body-alt-color u-text-hover-black u-btn-1">
                                                    اشترك الان</a>
                                    @endif

                                </div>
                            </div>
                            @endforeach










                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>

    </div>

    </div>


    <div class="container addss text-center" style="width:73%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
        @endisset
    </div>
@endsection
@section('map-css')
    <link rel="stylesheet" href="{{ url('/FrontStyle/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ url('/FrontStyle/css/nicepage.css') }}">
    <link rel="stylesheet" href="{{ url('/FrontStyle/css/Pricing.css') }}">
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
