@extends('site.layouts.master')

@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
    <div class="col-md-6 text-left jumbotron bg-wd">
                      <div class="mb-5"><i class="fa fa-circle t-orange small"></i> إنشاء حساب جديد</div>

                      <div class="mt-2 row">
                          <form method="POST" action="{{ route('register') }}">
                              @csrf

                              <div class="form-group row">
                                  <label for="name" class="col-md-5 col-form-label text-left">الاسم</label>

                                  <div class="col-md-7">
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                      @error('name')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-5 col-form-label text-left">البريد الإلكتروني</label>

                                  <div class="col-md-7">
                                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                      @error('email')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password" class="col-md-5 col-form-label text-left">كلمة المرور</label>

                                  <div class="col-md-7">
                                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                      @error('password')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                      @enderror
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password-confirm" class="col-md-5 col-form-label text-left">تأكيد كلمة المرور</label>

                                  <div class="col-md-7">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                  </div>
                              </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-7 offset-md-5">
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary">
                                                تسجيل
                                            </button>
                                            <a class="btn btn-sm btn-danger" href="{{url('/login/google')}}"><i class="fab fa-google-plus f-s-25"></i></a>
                                            <a class="btn btn-sm btn-primary" href="{{url('/login/facebook')}}"><i class="fab fa-facebook-square f-s-25" style="color:#ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                          </form>
                      </div>
                  </div>

    </div>
</div>
@endsection
