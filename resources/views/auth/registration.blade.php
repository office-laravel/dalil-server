@extends('dalil.layout.navabar&footer')

@section('content')

    <section class="section mt-5">
        <div class="container">

            <div class="box-main-foo">

                <div class="sign-in">
                    <div class="part-above">

                        <h4>أنشئ حساب جديد</h4>


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
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('store.Users') }}" method="POST" class="fomr-sign" autocomplete="off">
                            @csrf

                            <div class="row mt-5 mb-4 bg-light p-3" style="border-radius: 5px;">
                                <ul class="mb-4">
                                    <li class="text-secondary"><small class="text-secondary">اسم المستخدم يجب ان يكون
                                            باللغة الانجليزية</small></li>
                                    <li class="text-secondary"><small class="text-secondary">لا يجب على اسم المستخدم ان
                                            يحتوي على مسافات</small></li>
                                </ul>
                                <div class=" col-md-6 col-sm-12 mb-2">
                                    <label for="" class="mb-2">اسم المستخدم</label>
                                    <input type="text" class="form-control" name="enname" vlaue="{{ old('enname') }}"
                                        placeholder="اسم المستخدم ">
                                </div>


                                <div class="col-md-6 col-sm-12 mb-2">
                                    <label for="" class="mb-2">البريد الإلكتروني</label>
                                    <input type="email" autocomplete="on" class="form-control" name="email"
                                        vlaue="{{ old('email') }}" placeholder="البريد الإلكتروني"
                                        aria-label="البريد الإلكتروني">
                                </div>

                                <div class="col-md-6 col-sm-12 mb-2 mt-2">
                                    <label for="" class="mb-2">كلمة المرور</label>
                                    <input type="password" class="form-control" name="password"
                                        vlaue="{{ old('password') }}" placeholder="كلمة المرور">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-2 mt-2">
                                    <label for="password-confirm" class="mb-2">تأكيد كلمة المرور</label>
                                    <input id="password-confirm" class="form-control" type="password"
                                        placeholder="تأكيد كلمة المرور" name="password_confirmation" required>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mt-2 mb-2">
                                        <label for="" class="policy-form">
                                            <span class="policy">
                                                بالتسجيل في موقع وصلات ,انت توافق على
                                                <a href="#">الخصوصية</a>
                                                و
                                                <a href="#">الشروط و الأحكام</a>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" style="width:30%;margin:22px auto; ">تسجيل</button>

                                <div class="sec">
                                    <p>
                                        هل بالفعل لديك حساب
                                        <a href="{{ route('login') }}">دخول</a>
                                    </p>
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

@endsection
