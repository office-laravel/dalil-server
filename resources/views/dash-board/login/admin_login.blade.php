<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول أدمن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ url('../public/styleLogin/style.css') }}">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="logo text-center mt-5 d-flex justify-content-center">
            
            <!--<h1>وصلات</h1>-->
            <div class="img_logo">
                <img src="{{url('../public/upload/logo_waslat.png')}}" alt="" />
            </div>
        </div>    
        <div class="wrapper">
        @if (Session::has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session::get('error')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width:10px !important; height:10px !important; color:#000;line-height:10px;"><i class="fa-sharp fa-solid fa-xmark"></i></button>
          </div>
        @endif
        <div class="inner-warpper text-center">
            <h2 class="title">تسجيل الدخول المدير</h2>

            <form action="{{ route('admin.login') }}" method="post" id="formvalidate">
                @csrf
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

                <button type="submit" id="login" style="border-radius: 5px;
    font-size: 16px;
    font-weight: 700;">تسجيل الدخول</button>
                <div class="clearfix supporter">
                    <div class="pull-left remember-me">
                        <input id="rememberMe" name="remember" type="checkbox">
                        <label for="rememberMe">تذكرني</label>
                    </div>
                    <!--<a class="forgot pull-right" href="#">نسيت كلمة المرور?</a>-->
                </div>
            </form>
        </div>
        <!--<div class="signup-wrapper text-center">-->
        <!--    <a href="{{route('admin.register')}}">ليس لديك حساب? <span class="text-primary">انشئ واحدا</span></a>-->
        <!--</div>-->
    </div>
    
    </div>
    

    


    <!-- partial -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
    <script src="./script.js"></script>

</body>

</html>
