@extends('dash-board.layout.navabr&footer')

@section('content')
@include('dash-board.layout.sidebar')
<?php 
    use App\Models\Sites;
?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                        <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark"
                                href="javascript:;">لوحات القيادة</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">RTL</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">RTL</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                            <label class="form-label">أكتب هنا...</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <ul class="navbar-nav me-auto ms-0 justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{route('admin.logout')}}"
                            class="nav-link text-body font-weight-bold px-0 logout">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">تسجيل خروج</span>
                        </a>
                            {{-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}
                        </li>
                        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <!--<li class="nav-item px-3 d-flex align-items-center">-->
                        <!--    <a href="javascript:;" class="nav-link text-body p-0">-->
                        <!--        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="nav-item dropdown ps-2 d-flex align-items-center">
                            <!--<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"-->
                            <!--    data-bs-toggle="dropdown" aria-expanded="false">-->
                            <!--    <i class="fa fa-bell cursor-pointer"></i>-->
                            <!--</a>-->
                            <ul class="dropdown-menu  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  ms-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="../assets/img/small-logos/logo-spotify.svg"
                                                    class="avatar avatar-sm bg-gradient-dark  ms-3 ">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="avatar avatar-sm bg-gradient-secondary  ms-3  my-auto">
                                                <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <title>credit-card</title>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-2169.000000, -745.000000)"
                                                            fill="#FFFFFF" fill-rule="nonzero">
                                                            <g transform="translate(1716.000000, 291.000000)">
                                                                <g transform="translate(453.000000, 454.000000)">
                                                                    <path class="color-background"
                                                                        d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                        opacity="0.593633743"></path>
                                                                    <path class="color-background"
                                                                        d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize">عدد التصنيفات </p>
                                <h4 class="mb-0">
                                    <?php
                                        use App\Models\Category;
                                        $count_Category = Category::where('parent_id' , 0)->count();
                                        echo $count_Category;
                                    ?>
                                </h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+55%
                                </span>من الأسبوع الماضي</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <a href="{{route('news.main')}}">
                                <div class="text-start pt-1">
                                    <p class="text-sm mb-0 text-capitalize">عدد المقالات </p>
                                    <h4 class="mb-0">
                                        <?php
                                            use App\Models\News;
                                            $news = News::count();
                                            echo $news;
                                        ?>
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+55%
                                </span>من الأسبوع الماضي</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <a href="{{route('SitesWait')}}">
                                <div class="text-start pt-1">
                                    <p class="text-sm mb-0 text-capitalize">عدد المواقع قيد الانتظار </p>
                                    <h4 class="mb-0">
                                        <?php
                                                
                                                $count_wait_Sites = Sites::where('confirmed', 0)->count();
                                                echo $count_wait_Sites;
                                            ?>
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+55%
                                </span>من الأسبوع الماضي</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">leaderboard</i>
                            </div>
                            <a href="{{route('sites.main')}}">
                                <div class="text-start pt-1">
                                    <p class="text-sm mb-0 text-capitalize">عدد المواقع</p>
                                    <h4 class="mb-0">
                                        <?php
                                            
                                            $count_Sites = Sites::where('confirmed', 1)->count();
                                            echo $count_Sites;
                                        ?>
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+33%
                                </span>من الأسبوع الماضي</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4 mt-5">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">store</i>
                            </div>
                            <a href="{{route('countries.main')}}">
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize">عدد الدول</p>
                                <h4 class="mb-0">
                                    {{-- <span class="text-danger text-sm font-weight-bolder ms-1">-2%</span> --}}
                                    <?php
                                        use App\Models\Countries;
                                        $count_Countries = Countries::count();
                                        echo $count_Countries;
                                    ?>
                                </h4>
                            </div>
                        </a>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+5%
                                </span>من الشهر الماضي</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mt-5">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person_add</i>
                            </div>
                            <a href="{{route('users.main')}}">
                                <div class="text-start pt-1">
                                    <p class="text-sm mb-0 text-capitalize">عدد المستخدمين</p>
                                    <h4 class="mb-0">
                                        <?php
                                        use App\Models\User;
                                        $count_User = User::count();
                                        echo $count_User;
                                    ?>
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">+7%
                                </span>مقارنة بيوم أمس</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row mt-4">
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">مشاهدات الموقع</h6>
                            <p class="text-sm ">آخر أداء للحملة</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto ms-1">schedule</i>
                                <p class="mb-0 text-sm"> الحملة أرسلت قبل يومين </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> المبيعات اليومية </h6>
                            <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) زيادة في مبيعات
                                اليوم. </p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto ms-1">schedule</i>
                                <p class="mb-0 text-sm"> تم التحديث منذ 4 دقائق </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">المهام المكتملة</h6>
                            <p class="text-sm ">آخر أداء للحملة</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm">تم تحديثه للتو</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-end">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="#" class="font-weight-bold"
                                    target="_blank">Dashboard</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
    </main>


    @endsection
