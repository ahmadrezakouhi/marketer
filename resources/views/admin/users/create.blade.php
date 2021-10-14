@extends('layouts.main')
@section('title', 'ایجاد کاربر')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"> افزودن کاربر</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf

                            <div class="form-group ">
                                <label for="name" class="col-form-label">نام</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="نام">
                            </div>
                            <div class="form-group ">
                                <label for="last_name" class="col-form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="نام خانوادگی">
                            </div>


                            <div class="form-group ">
                                <label for="email" class="col-form-label">ایمیل</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل">
                            </div>
                            <div class="form-group ">
                                <label for="phone" class="col-form-label">تلفن</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="تلفن">
                            </div>
                            <div class="form-group ">
                                <label for="role_id" class="col-form-label">نوع کاربر</label>
                                <select id="role_id" class="form-control" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-row " id="marketer_section" style="display: none">
                                <div class="form-group col-md-4">
                                    <label for="level1" class="col-form-label">پورسانت</label>
                                    <select id="level1" class="form-control" name="level1">
                                        @for ($i = 1; $i <= 13; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="level2" class="col-form-label">پورسانت زیردست </label>
                                    <select id="level2" class="form-control" name="level2">
                                        @for ($i = 1; $i <= 13; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="level3" class="col-form-label">پورسانت زیردست دوم</label>
                                    <select id="level3" class="form-control" name="level3">
                                        @for ($i = 1; $i <= 13; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary btn-block shadow mt-2">ثبت</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>








        <button class="btn btn-primary waves-effect waves-light" id="test">مودال
            استاندارد</button>








        <div class="card-box" style="min-width: 500px">
            <div class="d-flex justify-content-between">
                <h4 class="mt-0 header-title">کاربر ها</h4>
                <button class="btn btn-success  waves-effect waves-light shadow" data-toggle="modal"
                    data-target="#myModal"><i class="fas fa-user-plus"></i></button>
            </div>
            <hr>


            <table id="datatable" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>سمت</th>
                        <th>ایمیل</th>
                        <th>تلفن</th>

                    </tr>
                </thead>


                <tbody>
                    <tr>
                        <td>علی فتحی</td>
                        <td>بازاریاب</td>
                        <td>alifathi@gmail.com</td>
                        <td>093045666</td>

                    </tr>

                </tbody>
            </table>
        </div>





    </div>





    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            toasterOptions();
            $('table').DataTable();

            $('form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{ route('user.store') }}",
                    data: $(this).serialize(),
                    success: function(res) {

                        $('#myModal').modal("hide");



                        toastr["danger"]("با موفقیت انجام شد");


                    }
                })

            })


            $('#role_id').change(function () {
                if($(this).find(":selected").text()==="marketer"){
                    $('#marketer_section').fadeIn();

                }else{
                    $('#marketer_section').fadeOut();
                }
            });



            $('#test').click(function() {



                toastr["info"]("با موفقیت انجام شد");
            })

            function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }

        })
    </script>



@endsection
