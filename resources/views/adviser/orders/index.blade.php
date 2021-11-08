@extends('layouts.main')
@section('title', 'مدیریت سفارش  ها')
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

                orderable:false,
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
                        name: 'status',
                        searchable:false,
                        orderable: false,

                    },
                    {
                        data: 'price',
                        name: 'price' ,
                        searchable:false,
                        orderable: false,

                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });





            $('body').on('click', '.acceptOrder', function() {

                var order_id = $(this).data('id');

                $.ajax({
                    method:"POST",
                    url: "{{route('adviser.orders.accept')}}",
                    data:{
                        order_id:order_id
                    },
                    success:function(res){
                        console.log('ss');
                        toastr["success"]("سفارش مورد نظر تایید شد");
                    }
                    ,
                    error: function(res) {
                        var error = res.responseJSON;
                        $.each(error, function(index, value) {
                            toastr["error"](value);
                        })

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
                        toastr["success"]("سفارش مورد نظر رد شد");
                    }
                    ,
                    error: function(res) {
                        var error = res.responseJSON;
                        $.each(error, function(index, value) {
                            toastr["error"](value);
                        })

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






        })
    </script>



@endsection
