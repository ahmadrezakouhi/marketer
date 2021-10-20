
@extends('layouts.main')

@section('content')



<div class="home-btn d-none d-sm-block">
    <a href="index.html"><i class="fas fa-home h2 text-dark"></i></a>
</div>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center">
                    <a href="index.html">
                        <span><img src="assets/images/logo-dark.png" alt="تصویر" height="22"></span>
                    </a>
                    <p class="text-muted mt-2 mb-4">قالب مدیریتی واکنش گرا</p>
                </div>
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">ورود</h4>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="emailaddress">ایمیل</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="ایمیل خود را وارد کنید">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">رمز عبور</label>
                                <input class="form-control" type="password"  id="password" name="password" required autocomplete="current-password" placeholder="رمز عبور خود را وارد کنید">
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">من را به خاطر بسپار</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"> ورود </button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="pages-recoverpw.html" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>رمز عبور خود را فراموش کرده اید؟</a></p>
                        <p class="text-muted">حساب کاربری ندارید؟ <a href="pages-register.html" class="text-dark ml-1"><b>ثبت نام کنید</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>


@endsection

