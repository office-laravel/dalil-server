 
@extends('site.layouts.layout')
@section('content')
<div class="container mt-2 box-category col col-md-6" style="margin-bottom:100px;">
    <section class="section mt-5">
        <div class="container">
            <div class="box-main-foo">
                <div class="sign-in" >
                    <div class="part-above  "  >


                        <h4 style="margin-bottom: 20px;">استعادة كلمة المرور</h4>


                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">البريد  الالكتروني</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                             

                                <div class="text-center">

                                    <button  type="submit" class="btn btn-success button-submit" >إرسال</button>
                                </div>
                            </form>
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
