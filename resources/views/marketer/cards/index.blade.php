@extends('layouts.main')
@section('title', 'مدیریت شبا')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cardFormLabel"> افزودن شبا</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form id="cardForm" method="POST" action="{{ route('card.store') }}">
                            @csrf
                            <input type="hidden" name="card_id" id="card_id">




                            <div class="form-group ">
                                <label for="bank_id" class="col-form-label">بانک</label>
                                <select id="bank_id" class="form-control" name="bank_id">
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group ">
                                <label for="identification" class="col-form-label">شماره شبا</label>
                                <input type="text" class="form-control" id="identification" name="identification"
                                    placeholder="شماره شبا">
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
                                <h4 class="mt-0 header-title">شبا</h4>
                                <a id="createNewcard" class="btn btn-success  waves-effect waves-light shadow"
                                    href="javascript:void(0)" data-target="#myModal"><i class="fas fa-credit-card"></i></a>
                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>بانک</th>
                                        <th>شماره شبا </th>
                                        <th>وضعیت</th>

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
                ajax: "{{ route('card.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'identification',
                        name: 'identification'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });


            $('#createNewcard').click(function() {
                $('#saveBtn').val("edit-card");
                $('#card_id').val('');
                $('#cardForm').trigger('reset');
                $('#cardFormLabel').text(' افزودن شبا');
                $('#myModal').modal('show');

            })


            $('body').on('click', '.editCard', function() {

                var card_id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('card.index') }}" + "/" + card_id + "/edit",
                    success: function(data) {



                        $('#cardForm').trigger('reset');
                        $('#cardFormLabel').text('ادیت شبا');

                        $('#myModal').modal('show');

                        $('#card_id').val(data.id);

                        $('#identification').val(data.identification);
                        $('#bank_id').val(data.bank_id);




                    }
                    ,
                    error:function(data){
                        toastr["error"](data.responseJSON.message);

                    }
                })

            });



            $('form').submit(function(event) {
                event.preventDefault();
                var card_id = $('#card_id').val();
                var url = card_id ? "{{ route('card.index') }}" + "/" + card_id :
                    "{{ route('card.index') }}";
                var method = card_id ? "PUT" : "POST";
                $.ajax({
                    method: method,
                    url: url,
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#cardForm').trigger('reset');
                        $('#myModal').modal("hide");

                        table.draw();

                        if ($('#card_id').val()) {
                            toastr["success"]("ویرایش انجام شد");
                        } else {
                            toastr["success"]("شماره شبا جدید ثبت شد");
                        }


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

            $('body').on('click', '.deleteCard', function() {



                var card_id = $(this).data("id");

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

                            url: "{{ route('card.index') }}" + "/" + card_id,

                            success: function(data) {

                                table.draw();
                                Swal.fire({
                                    title: "حذف شد!",
                                    text: "فایل شما حذف شد.",
                                    type: "success"
                                })
                            },

                            error: function(data) {

                                toastr["error"](data.responseJSON.message);

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
