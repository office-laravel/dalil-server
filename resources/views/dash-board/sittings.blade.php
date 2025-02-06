@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0">الاعدادات العامة</h6>
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




        {{-- الاعدادات العامة --}}

        <form method="POST" action="{{ route('setSittings') }}" class=" m-5  shadow " enctype="multipart/form-data">
            @csrf

            @if (!empty(session('msg')))
                <div class="row backgroundW p-4  ">
                    <div class="alert" style="background-color: #42424a ">
                        <ul>
                            <li style="color:white" class="">{{ session('msg') }}</li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="row backgroundW p-4  ">
                @if ($errors->any())
                    <div class="alert" style="background-color: #42424a ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:white" class=>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-check d-flex justify-content-between">
                    <div>
                        <input class="form-check-input" name="insertCheck" type="checkbox" id="flexCheckIndeterminate" @isset($getShowSettings) {{ $getShowSettings->insertQuick ? 'checked ' : '' }} @endisset>
                        <label class="form-check-label" for="flexCheckIndeterminate">
                          تفعيل دخول سريع
                        </label>
                    </div>
                    <div>
                    <input class="form-check-input" name="btnhide" type="checkbox" id="BtnHide">
                    <label class="form-check-label" for="BtnHide">
                      اخفاء الصفحة الرئيسية
                    </label>    
                    </div>
                    
                </div>
                <div class="col-12 mb-3">
                    <label for="inputFirstNmae" class="form-labell">أسم الموقع</label>
                    <input type="text" class="@error('nameWebsite') is-invalid @enderror form-controll "
                        name="nameWebsite" id="inputFirstNmae"
                        value="@isset($getShowSettings) {{ $getShowSettings->nameWebsite }} @endisset"
                        required>
                </div>


                <div class="col-12 mb-3">
                    <label for="inputLastNmae" class="form-labell  ">رابط الموقع</label>
                    <input type="text" class="form-controll" name="linkWebsite" id="inputLastNmae"
                        value="@isset($getShowSettings) {{ $getShowSettings->linkWebsite }} @endisset">
                </div>

                <div class="col-md-6 mb-3 ">
                    <label for="inputlink1" class="form-labell  ">رابط فيسبوك</label>
                    <input type="text" class="form-controll " name="socialMidiaFacebook" id="inputlink1"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaFacebook }} @endisset">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputlink2" class="form-labell ">رابط تلغرام</label>
                    <input type="text" class="form-controll" name="socialMidiaTelegram" id="inputlink2"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaTelegram }} @endisset">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputlink3" class="form-labell ">رابط انستغرام</label>
                    <input type="text" class="form-controll" name="socialMidiaInstagram" id="inputlink3"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaInstagram }} @endisset">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputlink4" class="form-labell ">رابط يوتيوب</label>
                    <input type="text" class="form-controll" name="socialMidiaYoutube" id="inputlink4"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaYoutube }} @endisset">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputLinkden" class="form-labell ">Linlkden رابط </label>
                    <input type="text" id="inputLinkden" class="form-controll"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaFacebook }} @endisset">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">نبذة عن الموقع </label>
                    <textarea type="text" id="Description" name="Description" class="form-controll resizeForTextarea">
@isset($getShowSettings)
{{ $getShowSettings->Description }}
@endisset
</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">الكلمات المفتاحية ( يجب الفصل بينها بفاصلة
                        )</label>
                    <textarea type="text" id="Description" name="Keywords" class="form-controll resizeForTextarea">
@isset($getShowSettings)
{{ $getShowSettings->Keywords }}
@endisset
</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="ph" class="form-labell">اضافة صورة favicon</label>
                    <input type="file" name="favicon" id="ph" class="form-controll">
                    @isset($getShowSettings->favicon)
                        <img src="{{url('../public/uploading/' . $getShowSettings->favicon)}}" alt="">
                    @endisset
                </div>
                <div class="col-md-12 mb-3">
                    <label for="ph" class="form-labell">رفع صورة افتراضية للشركة</label>
                    <input type="file" name="imgDefault" id="ph" class="form-controll">
                    @isset($getShowSettings->image_default)
                        <img src="{{url('/public/uploading/' . $getShowSettings->image_default)}}" alt="">
                    @endisset
                </div>
                <div class="col-12 ">
                    <button type="submit" class="btn btn-dark" style="background-color: #42424a">حفظ</button>
                </div>
        </form>
        </div>

        </div>


        {{-- نهاية الاعدادات العامة --}}
        

        </div>
    </main>
<div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" style="background-color: #42424a">
            <i class="material-icons py-2" style="color:#fff">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-end">
                    <h5 class="mt-3 mb-0">الاعدادات</h5>
                </div>
                <div class="float-start mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">الوان الشريط الجانبي</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-end">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">نوع Sidenav</h6>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                        onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch me-auto my-auto">
                        <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch me-auto my-auto">
                        <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">

                <div class="w-100 text-center">
                    <a href="https://www.twitter.com" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endsection
