@extends('site.layouts.layout')
@section('content')
 


    <div style="display: flex;justify-content: space-evenly;padding-top:5px; background-color: #ffff;">
        <div style="width: 90%">
            <app-filter-map _ngcontent-ng-c4263166228="" _nghost-ng-c1314327070="">
                <div _ngcontent-ng-c1314327070="" class="div-filter">
                    <div _ngcontent-ng-c1314327070="" class="thumbnails ion-padding-top">
                        <div _ngcontent-ng-c1314327070="" class="list-thumbnail">
                            <span _ngcontent-ng-c1314327070="" id="cat-0"
                                class="typographyTextSmLd3Medium  cat-tag select-filter"> الكل </span>
                            @foreach ($categories as $item)
                                <span _ngcontent-ng-c1314327070="" id="cat-{{ $item->id }}"
                                    class="typographyTextSmLd3Medium cat-tag">{{ $item->category_name }}</span>
                            @endforeach

                        </div>
                    </div>
                </div><!---->
            </app-filter-map>
        </div>
    </div>
    <div style="padding: 0;">
        <div class="   text-center">
            <div class="map-result ">
                <div id="map" style="height:500px; width: 100%;"></div>
            </div>
        </div>
    </div>


    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content modal-content-search ">
            <div class="modal-header">

                <h6 style="padding-right: 20px;"> بحث متقدم</h6>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body" style="text-align: right">
                <form method="POST" action="{{ url('searchmap') }}" style="width:100%" name="search_map" id="search_map">
                    <div class="row " style="display: block">

                        <div class="col col-sm-12 col-md-12 filter-input" style="text-align: -webkit-center;">

                            <div  class="col col-sm-12 col-md-6 text-center ">
                                <input type="text" class="form-control" id="text-search-main" dir="rtl"
                                    style="padding: 15px" class="form-control" name="text-search-main" placeholder="ابحث هنا">

                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-12 ">
                            <div class="row"  style="text-align: -webkit-center; display: flex;justify-content: center;">
                        <div class="col col-sm-12 col-md-3 filter-input">
                            <h6>المحافظة</h6>
                            <div>
                                <select class="form-control " id="city_id" name="city_id">
                                    <option value="0">الكل</option>
                                    @foreach ($cities as $city)
                                        <option data-lat="{{ $city->latitude }}" data-long="{{ $city->longitude }}"
                                            value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-3 filter-input">
                            <h6>المدينة</h6>
                            <select class="form-control " id="subcity" name="subcity">
                                <option value="0">الكل</option>
                            </select>
                        </div>
                    </div>
                    </div>
                        <div class="col col-sm-12 col-md-12 " style="text-align: -webkit-center;">
                            <div  class="col col-sm-12 col-md-3 text-center ">
                            <button type="submit" class="form-control " id="search_map_btn"
                                style="padding: 15px;background-color: #fdc93a;border: 0;  height: 50px;text-align: center; margin-top: 20px;">بحث</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>
@endsection

@section('map-js')
    <script>
        $(document).ready(function() {
            // الحصول على العناصر باستخدام jQuery

        });
    </script>

    <script>
        var mainurl = "{{ url('PicCate/icon/') }}";
        var token = '{{ csrf_token() }}';
        var subcityurl = "{{ url('subcity/ItemId') }}";
        var companyurl = "{{ url('company/get') }}"
    </script>
    <script src="{{ url('public/assets/site/js/map.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#category').on('change', function(e) {
                var cat_id = e.target.value;
                console.log(cat_id);
                $.ajax({
                    url: "{{ route('supcate') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append(
                            '<option value=""> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = ""> -- لا شيئ --</option>');
                        $.each(data.supcategories[0].supcategories, function(index,
                            subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.category_name + '</option>'
                            );
                            console.log(subcategory.category_name);
                        });
                        console.log(data);
                    }
                })
            });
        });
    </script>
@endsection
@section('css')
    <!-- #region -->
@endsection
