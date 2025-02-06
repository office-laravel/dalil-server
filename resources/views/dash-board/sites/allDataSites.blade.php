@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الشركات</h6>
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
                            <a href="{{route('admin.logout')}}"
                                class="nav-link text-body font-weight-bold px-0 logout">
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
                <div class="sear d-flex justify-content-center">
                <form id="searchthis" action="{{route('live_search.action')}}" style="display:inline;" method="get">

                    <input id="search" name="q" type="text" placeholder="ما الذي تبحث عنه؟" style="padding:7px; border-radius:9px; border: 1px solid #abab;">
                    <!--<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>-->
                    <!--  -->
                </form>
                </div>

                <div class="form-group btn-create">
                    <h4>الشركات</h4>
                    <br>

                    <a href="{{ route('sites.create') }}" class="btn btn-success">اضافة الشركة</a>

                </div><br>
                <br>
                <div class="d-flex justify-content-between w-100">
                    <div class="btn-group">
                    <label for="">فلترة الدول:</label>
                    <button class="dropdown-toggle tgle" id="bbb" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">

                        @if(isset($country_namess))
                            {{$country_namess->country_name}}
                        @else
                        رئيسية
                        @endif
                    </button>

                    <div class="dropdown-menu">
                        <ul class="listt" id ="drop_list">
                            <a class="text-decoration-none text-dark mb-1"
                                href="{{ route('sites.main') }}">
                                <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                            </a>
                            @foreach ($country_names as $get_country)
                            <a class="text-decoration-none text-dark mb-1"
                                    href="{{route('getSitesCounttry' , [$get_country->id])}}" >
                            <li id="eee" style="text-align: right">
                                    {{$get_country->country_name}}

                                </li></a>
                            @endforeach

                        </ul>

                    </div>

                    </div>
                    <div class="btn-group">
                        <label for="">فلترة التصنيف:</label>
                        <button class="dropdown-toggle tgle" id="bbb" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            @if(isset($categorySet))
                                {{$categorySet->category_name}}
                            @else
                            التصنيف
                            @endif
                        </button>
                        <div class="dropdown-menu">
                            <ul class="listt" id ="drop_list">
                                <a class="text-decoration-none text-dark mb-1"
                                    href="{{ route('sites.main') }}">
                                    <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                                </a>
                                @foreach ($categories as $get_cate)
                                <a class="text-decoration-none text-dark mb-1"
                                        href="{{route('getSitesCategory', [$get_cate->id])}}" >
                                <li id="eee" style="text-align: right">
                                        {{$get_cate->category_name}}

                                    </li></a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">اسم الشركة</th>
                            <th scope="col">عدد الزوار</th>
                            <th scope="col">عنوان</th>
                            <th scope="col">عمليات</th>


                        </tr>
                    </thead>
                    <tbody class="allData">
                        @php
                            $i = 0;
                        @endphp
                        @isset($showSites)

                            @forelse ($showSites as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    {{-- <td>{{$item->user->name}}</td> --}}
                                    <td>{{ $item->site_name }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>{{ $item->title }}</td>

                                    <td style="width: 50px">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="{{ route('sites.edit', $item->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </div>

                                            <div class="col-sm">
                                                <a href="{{ route('sites.destroy', ['id' => $item->id]) }}"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align:center;">لايوجد بيانات لعرضها</td>
                                    </tr>
                            @endforelse
                        @endisset

                        @isset($sites_show)

                            @foreach ($sites_show as $item)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    {{-- <td>{{$item->user->name}}</td> --}}
                                    <td>{{ $item->site_name }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>{{ $item->title }}</td>

                                    <td style="width: 50px">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="{{ route('sites.edit', $item->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </div>

                                            <div class="col-sm">
                                                <a href="{{ route('sites.destroy', ['id' => $item->id]) }}"><i
                                                        class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                    <tbody id="mycard" class="searchData"></tbody>
                </table>
            </div>
            @if(isset($showSites))
            {!! $showSites->appends(['sort' => 'votes'])->links() !!}
            @else
            {!! $sites_show->appends(['sort' => 'votes'])->links() !!}
            @endif
        </div>

    </main>

@endsection




@section('script')

<script type="text/javascript">

    $(document).ready(function () {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
        });
        $('#search').on('keyup', function(){
            var value = $(this).val();
            if(value){
                $('.allData').hide();
                $('.searchData').show();
            }
            else{
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
                data: {'q':value},

                success: function (data) {
                    // console.log(data);
                    $('#mycard').html(data);
                }
            });
        });
    });
</script>


@endsection

