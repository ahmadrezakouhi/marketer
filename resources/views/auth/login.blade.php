{{-- @extends('layouts.main') --}}

{{-- @section('content') --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- @endsection --}}



{{-- <div class="home-btn d-none d-sm-block">
        </div> --}}
@extends('layouts.master_login')
@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">

                    </div>
                    <div class="card shadow">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">ورود</h4>
                            </div>

                            <form method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="form-group mb-3 ">
                                    <label for="phone">موبایل</label>
                                    <input dir="ltr" class="form-control text-right" type="text" id="phone" name="phone"
                                        placeholder="09*******">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">رمز عبور</label>
                                    <input dir="ltr" class="form-control " type="password" id="password" name="password"
                                        placeholder="">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">من را به خاطر بسپار</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> ورود </button>
                                </div>
                                {{-- <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <p> <a href="{{route('password.request')}}" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>رمز عبور خود را فراموش کرده اید؟</a></p>

                                        </div> <!-- end col -->
                                    </div> --}}
                            </form>
                            {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class=" alert alert-danger text-danger">{{$error}}</div>
                            @endforeach
                        @endif --}}
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->


                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <script>
        $(document).ready(function() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            toastr["error"]('{{$error}}');
                            @endforeach
                            @endif

            // $('form').submit(function(event) {
                // event.preventDefault();
                // $.ajax({
                //     method: 'POST',
                //     url: '{{ route('login') }}',
                //     data: $(this).serialize(),
                //     success:function(res){

                //     }
                //     ,
                //     error: function(res) {

                //         $.each(res.responseJSON.errors, function(index, value) {
                //             toastr["error"](value);
                //         })
                //     }
                // });

            // })
        })
    </script>
@endsection
