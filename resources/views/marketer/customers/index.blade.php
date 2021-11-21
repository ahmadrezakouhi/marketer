@extends('layouts.main')
@section('title', 'مدیریت سفارش ها')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userFormLabel"> افزودن کاربر</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form id="userForm" method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <input type="hidden" name="customer_id" id="customer_id">
                            <div class="form-group ">
                                <label for="name" class="col-form-label">نام</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="نام">
                            </div>
                            <div class="form-group ">
                                <label for="last_name" class="col-form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="نام خانوادگی">
                            </div>

                            <h4 class="header-title">جنسیت</h4>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="gender1" value="0" name="gender" checked>
                                <label for="gender2"> آقا</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="gender2" value="1" name="gender" >
                                <label for="gender2">خانم </label>
                            </div>


                            <div class="form-group ">
                                <label for="age" class="col-form-label">سن</label>
                                <input type="text" class="form-control" id="age" name="age" placeholder="سن">
                            </div>
                            <div class="form-group ">
                                <label for="phone" class="col-form-label">موبایل</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="موبایل">
                            </div>
                            <div class="form-group ">
                                <label for="tel" class="col-form-label">تلفن ثابت</label>
                                <input type="text" class="form-control" id="tel" name="tel" placeholder="تلفن ثابت">
                            </div>
                            <div class="form-group ">
                                <label for="address" class="col-form-label"> آدرس</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="آدرس">
                            </div>
                            <div class="form-group ">
                                <label for="surgery_id" class="col-form-label">عمل</label>
                                <select id="surgery_id" class="form-control" name="surgery_id">
                                    @foreach ($surgeries as $surgery)
                                        <option value="{{ $surgery->id }}">{{ $surgery->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="form-group ">
                                <label for="role_id" class="col-form-label">نوع کاربر</label>
                                <select id="role_id" class="form-control" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                            </div> --}}



                    </div>
                    <div class="modal-footer">

                        <button id="saveBtn" type="submit" class="btn btn-primary btn-block shadow mt-2" value="create">ثبت</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>













        <div class="wrapper">
            <div class="container">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box shadow" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title">مشتری ها</h4>
                                <a id="createNewUser" class="btn btn-success  waves-effect waves-light shadow"
                                    href="javascript:void(0)" data-target="#myModal"><i class="fas fa-user-plus"></i></a>
                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>جنسیت</th>
                                        <th>سن</th>
                                        <th>تلفن</th>
                                        <th>موبایل</th>
                                        <th>آدرس</th>
                                        <th>عمل</th>
                                        {{-- <th></th> --}}

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
                ajax: "{{ route('customer.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'tel',
                        name: 'tel'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'surgery',
                        name: 'surgary'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });


            $('#createNewUser').click(function() {
                $('#saveBtn').val("edit-user");
                $('#user_id').val('');
                $('#userForm').trigger('reset');
                $('#userFormLabel').text(' افزودن کاربر');
                $('#myModal').modal('show');

            })


            $('body').on('click', '.editUser', function() {

                var user_id = $(this).data('id');

                $.get("{{ route('user.index')}}"+"/"+user_id + "/edit", function(data) {



                    $('#userForm').trigger('reset');
                    $('#userFormLabel').text('ادیت کاربر');

                    $('#myModal').modal('show');

                    $('#user_id').val(data.id);

                    $('#name').val(data.name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);



                })

            });



            $('form').submit(function(event) {
                event.preventDefault();
                var customer_id = $('#customer_id').val();
                var url = customer_id ? "{{ route('customer.index') }}" + "/" + customer_id :
                    "{{ route('customer.index') }}";
                var method = customer_id ? "PUT" : "POST";
                $.ajax({
                    method: method,
                    url: url,
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#userForm').trigger('reset');
                        $('#myModal').modal("hide");

                        table.draw();

                        if($('#user_id').val()){
                            toastr["success"]("ویرایش انجام شد");
                        }else {
                            toastr["success"]("سفارش جدید ثبت شد");
                        }


                    }
                    ,
                    error:function(res){
                        var error =eval("("+res.responseText+")")
                         $.each(error.errors,function (index,value) {
                            toastr["error"](value);
                         })

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

            $('body').on('click', '.deleteUser', function() {



                var user_id = $(this).data("id");

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

                            url: "/user/" + user_id,

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
