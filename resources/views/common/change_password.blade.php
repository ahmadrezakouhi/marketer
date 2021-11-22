@extends('layouts.main')
@section('title','تغییر رمز')
@section('content')
<div>
    <div class="account-pages  mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">

                    </div>
                    <div class="card shadow">

                        <div class="card-body p-4 shadow">



                            <form method="POST" action="">
                                
                              <div class="">

                              </div>

                                <div class="form-group mb-3">
                                    <label for="password">رمز عبور جدید</label>
                                    <input class="form-control" type="password"  id="password" name="password" placeholder="رمز عبور خود را وارد کنید">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">تکرار رمز عبور جدید</label>
                                    <input class="form-control" type="password"  id="password-confirme" name="password-confirme" placeholder="رمز عبور خود را وارد کنید">
                                </div>



                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> تغییر پسورد </button>
                                </div>

                            </form>

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
</div>


    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('form').submit(function (event) {
                event.preventDefault();
                $.ajax({

                    method:"PATCH"
                    ,
                    url:"{{ route('common.change-password')}}"
                    ,
                    data:$(this).serialize()
                    ,

                    success:function(res){


                    }
                    ,
                    error:function(res){

                    }

                });
            });


        });
    </script>

@endsection
