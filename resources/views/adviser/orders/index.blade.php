@extends('layouts.main')
@section('title', 'مدیریت بازایاب ها')
@section('content')

    <div>














        <div class="wrapper">
            <div class="container">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title"> مدیریت سفارش ها</h4>

                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>

                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>وضعیت</th>
                                        <th>مبلغ</th>
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
                ajax: "{{ route('adviser.orders.index') }}",
                columns: [


                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'price',
                        name: 'price'
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
                $('#userForm').trigger('reset');
                $('#userFormLabel').text(' افزودن کاربر');
                $('#myModal').modal('show');

            })


            $('body').on('click', '.acceptOrder', function() {

                var order_id = $(this).data('id');

                $.ajax({
                    method:"POST",
                    url: "{{route('adviser.orders.accept')}}",
                    data:{
                        order_id:order_id
                    },
                    success:function(res){
                        toastr["success"]("تایید انجام شد");
                    }
                })

                table.draw();

            });
            $('body').on('click', '.declineOrder', function() {

                var order_id = $(this).data('id');

                $.ajax({
                    method:"POST",
                    url: "{{route('adviser.orders.decline')}}",
                    data:{
                        order_id:order_id
                    },
                    success:function(res){
                        toastr["success"]("شبا مورد نظر رد شد");
                    }
                })

                table.draw();

            });











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
