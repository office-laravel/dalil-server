@extends('site.layouts.layout')

@section('content')    
    <div class="container mt-2 box-category" style="margin-bottom: 100px;">
        <section class="section mt-5"
            style="  background-color: #fff; padding-top:30px;padding-left:20px;padding-right:20px;padding-bottom:20px;">
            <div class="container div-sites" style="text-align: right ;  ">

                <div class="box-main-foo">

                    <div class="sign-in">
                        <div class="part-above">

                            
                           
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li class="text-danger">
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('msg'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            <form action="{{ route('updatePageSetting.userr') }}" method="POST" class="fomr-sign"
                                autocomplete="off">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 border-right">
                                        <div class="p-3 ">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="text-right">معلومات عن الحساب</h4>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12 mt-2"><label class="labels">بريد الإلكتروني</label><input type="text"
                                                        name="email" class="form-control mt-2" value="{{ $getUserAuth->email }}" disabled>
                                                </div>
                                                <div class="col-md-12 mt-2"><label class="labels">تغيير البريد الإلكتروني </label><input
                                                        type="text" name="email" class="form-control mt-2"></div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12 mb-2 mt-2">
                                                    <label for="" class="mb-2">كلمة المرور الجديدة</label>
                                                    <input type="password" class="form-control" name="password" placeholder="كلمة المرور">
                    
                                                </div>
                                                <div class="col-md-12 col-sm-12 mb-2 mt-2">
                                                    <label for="password-confirm" class="mb-2">تأكيد كلمة المرور</label>
                                                    <input id="password-confirm" class="form-control" type="password"
                                                        placeholder="تأكيد كلمة المرور" name="password_confirmation">
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                           <div style="text-align: center; ">
                                                    <button type="submit" class="btn btn-success"
                                                    style="padding:10px 20px;margin:22px auto;border-color:#fdc93a;background-color: #fdc93a; ">حفظ التغييرات</button>
                                                </div>
                                        </div>
                                    </div>
                    
                    
                                </div>
 

                                    
                                </div>
                            </form>


                        </div>
                    </div>
                    {{-- <div class="left-form-login">
                    <img src="{{ url('../public/assets/images/login.svg') }}" alt="">
                </div> --}}

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
