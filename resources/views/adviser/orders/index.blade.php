@extends('layouts.main')
@section('title', 'مدیریت سفارش ها')
@section('content')

    <div>



        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userFormLabel"> مشخصات مشتری </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <p>نام : </p>
                                <p>نام خانوادگی : </p>
                                <p>جنسیت : </p>
                                <p>سن : </p>
                                <p> موبایل : </p>
                                <p> تلفن : </p>
                                <p> آدرس : </p>
                            </div>
                            <div class="col-md-6">
                                <p id="name"></p>
                                <p id="last_name"> </p>
                                <p id="gender"></p>
                                <p id="age"></p>
                                <p id="phone"> </p>
                                <p id="tel"> </p>
                                <p id="address"> </p>
                            </div>
                        </div>











                    </div>
                    {{-- <div class="modal-footer">


                    </div> --}}
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>



        <div id="setPrice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userFormLabel"> هزینه عمل </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">



                        <form action="">


                            <div class="form-group">

                                <input type="hidden" name="order_id" id="order_id">
                                <div class="form-group ">
                                    <label for="price" class="col-form-label">هزینه</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="هزینه">
                                </div>


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
                        <div class="card-box shadow" style="">
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
                                        <th>عمل</th>
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
                searching: false,
                orderable: false,
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


                    },
                    {
                        data: 'surgery',
                        name: 'surgery',

                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('form').submit(function(event) {
                event.preventDefault();

                $.ajax({
                    method: "POST",
                    url: "{{ route('adviser.orders.accept') }}",
                    data: $(this).serialize(),
                    success: function(res) {

                        toastr["success"]("سفارش مورد نظر تایید شد");
                        $('#price').val('');
                        $('#setPrice').modal("hide");

                    },
                    error: function(res) {
                        var error = res.responseJSON;
                        $.each(error, function(index, value) {
                            toastr["error"](value);
                        })

                    }
                })

                table.draw();
            })


            $('body').on('click', '.acceptOrder', function() {

                var order_id = $(this).data('id');
                $('#order_id').val(order_id);

                $('#setPrice').modal('show');


            });


            $('body').on('click', '.declineOrder', function() {

                var order_id = $(this).data('id');

                $.ajax({
                    method: "POST",
                    url: "{{ route('adviser.orders.decline') }}",
                    data: {
                        order_id: order_id
                    },
                    success: function(res) {
                        toastr["success"]("سفارش مورد نظر رد شد");
                    },
                    error: function(res) {
                        var error = res.responseJSON;
                        $.each(error, function(index, value) {
                            toastr["error"](value);
                        })

                    }

                })

                table.draw();

            });



            $('body').on('click', '.showOrder', function() {

                var order_id = $(this).data('id');

                $.ajax({
                    method: "GET",
                    url: "{{ url('adviser/orders') }}" + '/' + order_id,
                    // data: {
                    //     order_id: order_id
                    // },
                    success: function(res) {
                        // toastr["success"]("سفارش مورد نظر رد شد");
                        $('#name').text(res.name);
                        $('#last_name').text(res.last_name);
                        $('#age').text(res.age);
                        if (res.gender == 0) {
                            $('#gender').text("مرد");
                        } else {
                            $('#gender').text("زن");

                        }
                        $('#phone').text(res.phone);
                        $('#tel').text(res.tel);
                        $('#address').text(res.address);
                        $('#myModal').modal('show');

                    },
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
