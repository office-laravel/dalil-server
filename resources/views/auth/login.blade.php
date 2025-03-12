 
@extends('site.layouts.layout')
@section('content')
<div class="container mt-2 box-category col col-md-6" style="margin-bottom:100px;">
    <section class="section mt-5">
        <div class="container">
            <div class="box-main-foo">
                <div class="sign-in" >
                    <div class="part-above  "  >


                        <h4>مرحبا بك مجددا</h4>


                        @if ($message = Session::get('msg'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('setlogin') }}" class="fomr-sign" id="appointment-form">
                            @csrf
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li class="text-danger">
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="col mb-4">
                                <label class="mb-2" for="typeEmailX-2">بريد الإلكتروني</label>
                                <input type="email" value="{{ old('email') }}" id="typeEmailX-2 " name="email"
                                    class="form-control">

                            </div>

                            <div class="col mb-4">
                                <label class="mb-2" for="typePasswordX-2">كلمة المرور</label>
                                <input type="password" name="password" id="typePasswordX-2" vlaue="{{ old('password') }}"
                                    class="form-control">

                            </div>


<div class="text-center">

                            <button class="btn btn-success button-submit"  type="submit">دخول</button>
                        </div>
                        </form>

                        <div class="sec">
                            <p>
                                هل نسيت كلمة المرور؟
                                <a href="{{ route('password.request') }}">استعادة كلمة المرور </a>
                            </p>
                            <p>
                                ليس لديك حساب؟
                                <a href="{{ route('registerr') }}">سجل الأن</a>
                            </p>
                        </div>
                    </div>

                </div>
               
            </div>
        </div>

    </section>
</div>
@endsection
@section('map-css')
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/bootstrap-icons/font/bootstrap-icons.min.css') }}">

 
    <link rel="stylesheet" href="{{ url('/public/assets/site/css/stylepage.css') }}" />
@endsection
@section('map-js')
 
@endsection
