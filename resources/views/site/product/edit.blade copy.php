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

            {{-- End for show table to Edit Modal of data --}}




            <!-- Modal Store-->

            {{-- End Modal Store --}}


            {{-- edit Modal Sites --}}

            {{-- end- edit Modal Sites --}}

            {{-- delete Modal Sites --}}


            <div class="list-sitess-search">
                <h4 class="head-search-sitess">شركة: <a
                        href={{ url('users/product/all', $site->id) }}>{{ $site->site_name }}</a> </h4>
                <h5 class="head-search-sitess">تعديل المنتج </h5>
                <div class="fetchD" style="display: contents;">
                    <form action="{{ url('users/product/update', $product->id) }}" method="POST" id="form-product"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المنتج</label>
                                <input type="text" class="site form-control" id="name" name="name"
                                    value="{{ $product->name }}" aria-describedby="textHelp">
                                <div id="name-error" class="invalid-feedback"></div>

                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">النوع</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="0">اختر النوع</option>
                                    <option value="p" {{ $product->type == 'p' ? 'selected' : '' }}>منتج مادي</option>
                                    <option value="s" {{ $product->type == 's' ? 'selected' : '' }}>خدمة</option>
                                </select>
                                <div id="type-error" class="invalid-feedback"></div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <label><strong>الوصف </strong></label>
                                <textarea class="ckeditor form-control" name="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-3" style="width: 50%">
                                <label for="price" class="form-label">السعر</label>
                                <input type="text" class="site form-control" id="price" name="price"
                                    value="{{ $product->price }}" aria-describedby="textHelp">
                                <div id="price-error" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" style="width: 25%">
                                <label for="currency" class="form-label">العملة</label>
                                <input type="text" class="site form-control" id="currency" name="currency"
                                    value="{{ $product->currency }}" aria-describedby="textHelp">
                                <div id="currency-error" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">الوحدة</label>
                                <input type="text" class="site form-control" id="unit" name="unit"
                                    value="{{ $product->unit }}" aria-describedby="textHelp" placeholder="قطعة">
                                <div id="price-error" class="invalid-feedback"></div>

                            </div>
                            <div class="mb-3">
                                <label for="sequence" class="form-label">الترتيب</label>
                                <input type="text" class="site form-control" id="sequence" name="sequence"
                                    value="{{ $product->sequence }}" aria-describedby="textHelp" placeholder="1">
                                <div id="sequence-error" class="invalid-feedback"></div>

                            </div>
                            <div style="width:300px;">
                                <label for="image" class="form-labell ">صورة المنتج</label>
                                <input type="file" name="image" id="image" class="form-control mt-2">

                            </div>
                            <div style="width:300px;padding:20px;">
                                <img src="{{ url('public/picProduct/' . $product->image) }}"
                                    style="padding: 5px;border:1px solid #ced4da" width="100px;" id="imgshow">

                            </div>
                            <input type="hidden" name="site_id" value="{{ $site->id }}">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-submit "
                                    style="padding-left:40px;padding-right: 40px">حفظ</button>
                                <button type="button" class="btn btn-secondary">الغاء الامر</button>
                            </div>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>


    <div class="container addss text-center" style="width:73%">
        @isset($adds)
            <p class="text-center w-100">{!! $adds->atRight !!}</p>
        @endisset
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {



            // ############# edit
            $(document).on('click', '.edit_sites', function(e) {
                e.preventDefault();
                var site_id = $(this).val();
                // $('edit_site_id').val(site_id);
                // console.log(site_id);
                $('#EditModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ route('pageme.editSites.user', '') }}/" + site_id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_store').html("");
                            $('#success_store').addClass('alert alert-danger');
                            $("#success_store").text(response.message);
                        } else {
                            $('#edit_site_id').val(site_id);
                            $('#edit_site').val(response.sites.name);
                            $('#edit_href').val(response.sites.href);
                        }
                    }
                });
            });


            // ############ Update data of Modal
            $(document).on('click', '.updateBtn', function(e) {
                e.preventDefault();
                $(this).text('جاري تحديث..');
                var site_id = $('#edit_site_id').val();
                // console.log(site_id);
                var data = {
                    'site': $('#edit_site').val(),
                    'href': $('#edit_href').val()
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('pageme.updateSites.user', '') }}/" + site_id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#edit_div_err').html("");
                            $('#edit_div_err').addClass('alert alert-danger');
                            $.each(response.errors, function(key, value) {
                                // console.log(response.errors);
                                $('#edit_div_err').append('<li>' + value + '</li>');
                            });
                            $('.updateBtn').text(' تحديث');
                        } else if (response.status == 404) {
                            $('#edit_div_err').html("");
                            $('#success_store').addClass('alert alert-success');
                            $("#success_store").text(response.message);
                            $('.updateBtn').text('تحديث');
                        } else {
                            $('#edit_div_err').html("");
                            $('#success_store').html("");
                            $('#success_store').addClass('alert alert-success');
                            $("#success_store").text(response.message);
                            $('#EditModal').modal('hide');
                            $('.updateBtn').text('تحديث');
                            fetchSites();
                        }
                    }
                });



            });



            // ########### Delete
            $(document).on('click', '.delete_sites', function(e) {
                e.preventDefault();
                var site_id = $(this).val();
                $('#delete_site_id').val(site_id);
                // console.log(site_id);
                $('#DeleteModal').modal('show');
            });



            // ########### Btn sure delete
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                var site_id = $('#delete_site_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ route('pageme.deleteSites.user', '') }}/" + site_id,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_store').html("");
                            $('#success_store').addClass('alert alert-success');
                            $("#success_store").text(response.message);
                        } else {
                            $('#DeleteModal').modal('hide');
                            $("#DeleteModal").find('input').val("");
                            $('.deleteBtn').html('جاري الحذف..');
                            fetchSites();
                        }
                    }
                });
            });





            // Store data of Modal
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                $(this).html('جاري الحفظ..');
                var data = {
                    'site': $('.site').val(),
                    'href': $('.href').val()
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('pageme.storeSites.user') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#div_err').html("");
                            $('#div_err').addClass('alert alert-danger');
                            $.each(response.errors, function(key, value) {
                                // console.log(response.errors);
                                $('#div_err').append('<li>' + value +
                                    '</li>');
                            });
                        } else {
                            $('#success_store').html("");
                            $('#success_store').addClass('alert alert-success');
                            $("#success_store").text(response.message);
                            $("#exampleModal").modal('hide');
                            $("#exampleModal").find('input').val("");
                            fetchSites();
                        }
                    }
                });

            });


        });
    </script>
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
@section('map-js')
    <script src="{{ url('public/js/product.js') }}"></script>
@endsection
