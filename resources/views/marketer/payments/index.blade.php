@extends('layouts.main')
@section('title', 'کیف پول')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="paymentFormLabel"> برداشت از کیف پول</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form id="paymentForm" method="POST" action="{{ route('user.store') }}">
                            @csrf



                            <div class="form-group ">
                                <label for="card_id" class="col-form-label">شماره کارت</label>
                                <select id="card_id" class="form-control" name="card_id">
                                    @foreach ($cards as $card)
                                        <option value="{{ $card->id }}">{{ $card->identification }}</option>
                                    @endforeach

                                </select>

                                <div class="form-group ">
                                    <label for="amount" class="col-form-label">مقدار</label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="مقدار">
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
                    <div class="col-4">
                        <div class="card-box shadow" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title ">موجودی</h4>

                            </div>
                            <hr>

                            <h3 class="text-center">{{ number_format($amount) }}</h3>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card-box shadow" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title">برداشت ها</h4>
                                <a id="createPayment" class="btn btn-success  waves-effect waves-light shadow"
                                    href="javascript:void(0)" data-target="#myModal"><i
                                        class="fas fa-money-bill-wave"></i></a>
                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>نام بانک</th>
                                        <th>شماره کارت</th>
                                        <th>مقدار</th>
                                        <th>وضعیت</th>


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
                ajax: "{{ route('payments.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'identification',
                        name: 'identification'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                ]
            });


            $('#createPayment').click(function() {
                $('#saveBtn').val("edit-user");
                $('#paymentForm').trigger('reset');
                $('#paymentFormLabel').text('برداشت از کیف پول');
                $('#myModal').modal('show');

            })





            $('form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{ route('payments.store') }}",
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#paymentForm').trigger('reset');
                        $('#myModal').modal("hide");

                        table.draw();


                        toastr["success"]("برداشت جدید ثبت شد");



                    },
                    error: function(res) {
                        var error = eval("(" + res.responseText + ")")
                        $.each(error.errors, function(index, value) {
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






        })
    </script>



@endsection
