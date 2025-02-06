<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول أدمن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('styleLogin/style.css') }}">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="logo text-center">
        <h1>Logo</h1>
    </div>

    <div class="wrapper">
        @if (Session::has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session::get('error')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width:10px !important; height:10px !important; color:#000;line-height:10px;"><i class="fa-sharp fa-solid fa-xmark"></i></button>
          </div>
        @endif
        <div class="inner-warpper text-center">
            <h2 class="title">تسجيل الدخول إلى حسابك</h2>

            <form action="{{ route('admin.register.create') }}" method="post" id="formvalidate">
                @csrf

                <div class="input-group">
                    <input type="text" name="name" class="form-control"
                        placeholder="ادخل اسمك بالكامل" id="logname"
                        autocomplete="off">
                    <span class="lighting"></span>
                </div>
                <div class="input-group">
                    {{-- <label class="palceholder" for="userName">بريد الإلكتروني</label> --}}
                    <input class="form-control" name="email" id="userName" type="text" placeholder="بريد الإلكتروني" autocomplete="on" />
                    <span class="lighting"></span>
                </div>
                <div class="input-group">
                    {{-- <label class="palceholder" for="userPassword">كلمة المرور</label> --}}
                    <input class="form-control" name="password" id="userPassword" type="password" placeholder="كلمة المرور" autocomplete="off" />
                    <span class="lighting"></span>
                </div>
                <div class="form-group mt-2 mb-4">
                    {{-- <label class="palceholder" for="couserPassword">تأكيد كلمة المرور</label> --}}
                    <input class="form-control" name="password_confirmation" id="couserPassword" type="password" placeholder="تأكيد كلمة المرور" autocomplete="off" />

                </div>

                <button type="submit" id="login">تسجيل </button>
                {{-- <div class="clearfix supporter">
                    <div class="pull-left remember-me">
                        <input id="rememberMe" type="checkbox">
                        <label for="rememberMe">تذكرني</label>
                    </div>
                    <a class="forgot pull-right" href="#">نسيت كلمة المرور?</a>
                </div> --}}
            </form>
        </div>
        <div class="signup-wrapper text-center">
            <a href="{{route('login_form')}}">لديك حساب? <span class="text-primary">سجل الدخول</span></a>
        </div>
    </div>


    <!-- partial -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
    <script src="./script.js"></script>

</body>

</html>
