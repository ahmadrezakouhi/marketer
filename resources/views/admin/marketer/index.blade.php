@extends('layouts.main')
@section('title', 'مدیریت بازایاب ها')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userFormLabel"> افزودن بازاریاب</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form id="userForm" method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <input type="hidden" name="marketer_id" id="marketer_id">
                            <input type="hidden" name="user_id" id="user_id">
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
                                <label for="phone" class="col-form-label">موبایل</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="تلفن">
                            </div>
                            <div class="form-group ">
                                <label for="tel" class="col-form-label">تلفن ثابت</label>
                                <input type="text" class="form-control" id="tel" name="tel" placeholder="تلفن">
                            </div>
                            <div class="form-group ">
                                <label for="address" class="col-form-label">آدرس</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="آدرس">
                            </div>
                            <div class="form-group ">
                                <label for="national_code" class="col-form-label">کد ملی</label>
                                <input type="text" class="form-control" id="national_code" name="national_code"
                                    placeholder="کد ملی">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="level1" class="col-form-label text-center  " style="width:100%">پورسانت</label>
                                    <select id="level1" class="form-control" name="level1">
                                        @for ($i=1;$i<=13;$i++)
                                            <option value="{{ $i }}"
                                            @if($i==5)
                                            selected
                                            @endif

                                            >{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="level2" class="col-form-label text-center" style="width:100%">پورسانت زیر دست اول</label>
                                    <select id="level2" class="form-control" name="level2">
                                        @for ($i=1;$i<=13;$i++)
                                            <option value="{{ $i }}"
                                            @if($i==3)
                                            selected
                                            @endif
                                            >{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="level3" class="col-form-label text-center" style="width: 100%"> پورسانت زیردست دوم</label>
                                    <select id="level3" class="form-control" name="level3">
                                        @for ($i=1;$i<=13;$i++)
                                            <option value="{{ $i }}" @if($i==1)
                                            selected
                                            @endif
                                            >{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>

                            </div>


                            <div class="checkbox checkbox-success">
                                <input id="active" type="checkbox">
                                <label for="active">فعال</label>
                            </div>



                    </div>
                    <div class="modal-footer">

                        <button id="saveBtn" type="submit" class="btn btn-primary btn-block shadow mt-2"
                            value="create">ثبت</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>













        <div class="wrapper">
            <div class="container">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title">بازاریاب ها</h4>
                                <a id="createNewUser" class="btn btn-success  waves-effect waves-light shadow"
                                    href="javascript:void(0)" data-target="#myModal"><i class="fas fa-user-plus"></i></a>
                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>ایمیل</th>
                                        <th>موبایل</th>
                                        <th>تلفن ثابت</th>
                                        <th>آدرس</th>
                                        <th>کد ملی</th>
                                        <th>وضعیت</th>
                                        <th>درصد پوسانت</th>
                                        <th>درصد پوسانت زیردست اول</th>
                                        <th>درصد پورسانت زیر دست دوم</th>
                                        <th></th>

                                    </tr>
                                </thead>


                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('marketer.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'tel',
                        name: 'tel'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'national_code',
                        name: 'national_code'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'level1',
                        name: 'level1'
                    },
                    {
                        data: 'level2',
                        name: 'level2'
                    },
                    {
                        data: 'level3',
                        name: 'level3'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#createNewUser').click(function() {
                $('#saveBtn').val("edit-user");
                $('#marketer_id').val('');
                $('#user_id').val('');
                $('#userForm').trigger('reset');
                $('#userFormLabel').text(' افزودن بازاریاب');
                $('#myModal').modal('show');

            })


            $('body').on('click', '.editMarketer', function() {

                var marketer_id = $(this).data('id');

                $.get("{{ route('marketer.index') }}" + "/" + marketer_id + "/edit", function(data) {


                    console.log(data);
                    $('#userForm').trigger('reset');
                    $('#userFormLabel').text('ادیت بازاریاب');

                    $('#myModal').modal('show');

                    $('#marketer_id').val(data.id);
                    $('#user_id').val(data.user_id);

                    $('#name').val(data.name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#tel').val(data.tel);
                    $('#address').val(data.address);
                    $('#national_code').val(data.national_code);
                    // var cheched = data.status ? true : false;
                    $('#active').prop('checked', data.status);
                    $('#level1').val(data.level1);
                    $('#level2').val(data.level2);
                    $('#level3').val(data.level3);


                })

            });



            $('form').submit(function(event) {
                event.preventDefault();
                var marketer_id = $('#marketer_id').val();
                var url = marketer_id ? "{{ route('marketer.index') }}" + "/" + marketer_id :
                    "{{ route('marketer.index') }}";
                var method = marketer_id ? "PUT" : "POST";
                console.log(url);
                $.ajax({
                    method: method, //"POST",
                    url: url, //"{{ route('marketer.store') }}",
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#userForm').trigger('reset');
                        $('#myModal').modal("hide");

                        table.draw();

                        if ($('#marketer_id').val()) {
                            toastr["success"]("ویرایش انجام شد");
                        } else {
                            toastr["success"]("بازاریاب جدید ثبت شد");
                        }
                        console.log(res);

                    },
                    error: function(res) {
                        // var error = eval("(" + res.responseText + ")")
                        // $.each(error.errors, function(index, value) {
                        //     toastr["error"](value);
                        // });
                        console.log(res);
                        // var errors = res.responseJSON;
                    //    if(errors){
                        $.each(res.responseJSON.errors, function(index, value) {
                            toastr["error"](value);
                        })

                    //    }

                    }
                })

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

            $('body').on('click', '.deleteMarketer', function() {



                var marketer_id = $(this).data("id");

                Swal.fire({
                    title: "مطمئنی؟",
                    text: "این کار قابل بازگشت نیست!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "بله حذفش کن!",
                    cancelButtonText: "نه لغو کن!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ml-2 mt-2",
                    buttonsStyling: !1
                }).then(function(t) {
                    if (t.value) {


                        $.ajax({

                            type: "DELETE",

                            url: "{{ route('marketer.index') }}" + "/" + marketer_id,

                            success: function(data) {

                                table.draw();
                                Swal.fire({
                                    title: "حذف شد!",
                                    text: "فایل شما حذف شد.",
                                    type: "success"
                                })
                            },

                            error: function(data) {

                                console.log('Error:', data);

                            }

                        });





                    } else {
                        t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                            title: "لغو شد",
                            type: "error"
                        })
                    }
                })





            });




        })
    </script>



@endsection
