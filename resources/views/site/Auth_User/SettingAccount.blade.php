@extends('dalil.layout.navabar&footer')
@section('content')
@include('dalil.layout.layoutSearchTop')
<div class="container addss w-100">
        @isset($adds)
                <p class="text-center">{!! $adds->atTop !!}</p>
            @endisset
    </div>
    <div class="container rounded bg-white mt-5 mb-5" style="width:71%;">


        @if ($message = Session::get('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('updatePageSetting.userr') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">معلومات عن الحساب</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 mt-2"><label class="labels">بريد الإلكتروني</label><input type="text"
                                    name="email" class="form-control mt-2" value="{{ $getUserAuth->email }}" disabled>
                            </div>
                            <div class="col-md-12 mt-2"><label class="labels">اضافة بريد الإلكتروني جديد</label><input
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
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">حفظ
                                التغييرات</button></div>

                    </div>
                </div>


            </div>
        </form>
    </div>
    <div class="container addss w-100">
       @isset($adds)
            <p class="text-center">{!! $adds->atRight !!}</p>
        @endisset 
    </div>
@endsection
