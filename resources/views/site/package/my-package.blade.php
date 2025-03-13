@extends('site.layouts.layout')

@section('content')
    <div class="container mt-2 box-category">
        <div id="success_store"></div>

        <div class="div-sites" style="padding-bottom: 100px;">
            {{-- sub Modal Sites --}}

            {{-- end- delete Modal Sites --}}
            <section class="u-clearfix u-container-align-center u-section-2  " id="sec-5d9c">
                <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-xl u-sheet-1 ">
                    <h2 class="u-align-center u-text u-text-default u-text-1  " style=" font-size:50px;"> باقتي</h2>
                    <div
                        class="u-container-style u-layout-cell u-size-32-xl u-size-60-lg u-size-60-md u-size-60-sm u-size-60-xs u-layout-cell-1">
                        <div class="u-container-layout u-container-layout-1">
                            <div
                                class="custom-expanded u-expanded-width-lg u-expanded-width-md u-expanded-width-xl u-list u-list-1">
                                <div class="u-repeater u-repeater-1" style="min-height: 100px">

                                    <div
                                        class="u-container-align-right-sm u-container-align-right-xs u-container-style u-list-item u-repeater-item u-list-item-1  ">
                                        <div
                                            class="u-container-layout u-similar-container u-valign-bottom-lg u-valign-bottom-md u-container-layout-2">
                                            <h5 class="u-align-right-sm u-align-right-xs u-text u-text-2 p-name">
                                                {{ $package->name }}</h5>

                                            <ul style="text-align: right;"
                                                class="u-align-right-sm u-align-right-xs u-custom-list u-file-icon u-text u-text-3">
                                                <li>
                                                    @if ($package->href == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>رابط الشركة</span>
                                                </li>
                                                <li>
                                                    @if ($package->category == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>التصنيف</span>
                                                </li>
                                                <li>
                                                    @if ($package->subcategories == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>التصنيف الفرعي</span>
                                                </li>
                                                <li>
                                                    @if ($package->title == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>العنوان</span>
                                                </li>
                                                <li>
                                                    @if ($package->description == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>نبذة</span>
                                                </li>
                                                <li>
                                                    @if ($package->articale == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>مقال ذو صلة</span>
                                                </li>
                                                <li>
                                                    @if ($package->video == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>كود الفيديو</span>
                                                </li>
                                                <li>
                                                    @if ($package->keyword == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>كلمات مفتاحية</span>
                                                </li>
                                                <li>
                                                    @if ($package->logo == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>شعار الشركة</span>
                                                </li>
                                                <li>
                                                    @if ($package->mobile_number == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>رقم الجوال</span>
                                                </li>
                                                <li>
                                                    @if ($package->phone_number == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>رقم الهاتف</span>
                                                </li>
                                                <li>
                                                    @if ($package->social == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>روابط التواصل الاجتماعي</span>
                                                </li>
                                                <li>
                                                    @if ($package->android == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>رابط تطبيق الاندرويد</span>
                                                </li>
                                                <li>
                                                    @if ($package->ios == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>رابط تطبيق الايفون</span>
                                                </li>
                                                <li>
                                                    @if ($package->city == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>تحديد المحافظة والمدينة</span>
                                                </li>
                                                <li>
                                                    @if ($package->maploc == 1)
                                                        <i class="bi bi-check-lg success"
                                                            style="padding-left:3px; color:#198754;"></i>
                                                    @else
                                                        <i class="bi bi-x-lg" style="padding-left:3px;color:#DC3545;"></i>
                                                    @endif <span>تحديد الاحداثيات على
                                                        الخريطة</span>
                                                </li>
                                                <li>
                                                    <span>عدد المواقع</span><span>( {{ $used_sites_count }} /
                                                        {{ $package->sites_count }} )</span>
                                                </li>
                                                <li>
                                                    <span>عدد المنتجات لكل موقع</span><span>(
                                                        {{ $package->products_count }} )</span>
                                                </li>
                                                @if ($package->is_free != 1)
                                                    <li>
                                                        <span>تاريخ الانتهاء </span><span>(
                                                            {{ Carbon\Carbon::parse($package->expire_date)->toDateString() }}
                                                            )</span>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
@section('map-css')
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/bootstrap-icons/font/bootstrap-icons.min.css') }}">

    <link rel="stylesheet" href="{{ url('/public/assets/site/css/nicepage.css') }}">
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/Pricing.css') }}">
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
@endsection
@section('map-js')
    <script src="{{ url('public/assets/site/js/subscribe-auth.js') }}"></script>
@endsection
