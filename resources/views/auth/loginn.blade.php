@extends('dalil.layout.navabar&footer')

@section('content')
    <section class="section mt-5">
        <div class="container">
            <div class="box-main-foo">
                <div class="sign-in">
                    <div class="part-above mt-5 mb-4 bg-light p-3" style="border-radius: 5px;" >


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




                            <button class="btn btn-success" style="width:30%;margin:22px auto; " type="submit">دخول</button>

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
                <div class="left-form-login">
                    <img src="{{ url('../public/assets/images/login.svg') }}" alt="">
                </div>
            </div>
        </div>

    </section>
@endsection
