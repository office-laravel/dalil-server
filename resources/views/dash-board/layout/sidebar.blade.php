<aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret bg-gradient-dark ps ps__rtl ps--active-y"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{route('home')}}">
                <img src="{{ url('../public/dashboard/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="me-1 font-weight-bold text-white">لوحة التحكم</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div dir="rtl" class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!--<li class="nav-item d-flex align-items-center">-->
                <!--    <a href="{{route('admin.logout')}}" style="width:100%;"-->
                <!--        class="nav-link text-body font-weight-bold px-0 logout">-->
                <!--        <i class="fa fa-user me-sm-1"></i>-->
                <!--        <span class="d-sm-inline d-none">تسجيل خروج</span>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<hr>-->
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الرئيسية</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sittings') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text me-1">الاعدادات العامة</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " href="{{ route('AddControl') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">person</i>
                        </div>
                        <span class="nav-link-text me-1">منطقة الاعلانات </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('countries.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الدول</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('categories.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">التصنيفات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('city.all')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">المدن</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sites.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الشركات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('news.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الأخبار</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('SitesWait')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">قائمة الانتظار</span>
                    </a>
                </li>
                                
                <li class="nav-item">
                    <a class="nav-link " href="{{route('sites.order')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">طلبات تعديل المواقع</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('notification')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">قسم المواقع لا تعمل</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('fixedsitesmain.main')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">مواقع مثبتة الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('fixedsitesnews.main')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">مواقع مثبتة بالاخبار</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('fixedsites.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">المواقع المثبتة</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('users.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">person</i>
                        </div>
                        <span class="nav-link-text me-1">المستخدمين</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('managers.main') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">person</i>
                        </div>
                        <span class="nav-link-text me-1">المدراء</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('main.pages') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الصفحات الثابتة</span>
                    </a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link " href="{{route('tags.main')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">تاغات</span>
                    </a>
                </li>
                
                
            </ul>
        </div>
    </aside>
