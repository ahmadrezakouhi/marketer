@extends('layouts.main')
@section('title', 'مدیریت عمل')
@section('content')

    <div>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="surgeryFormLabel"> افزودن کاربر</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                        <form id="surgeryForm" method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <input type="hidden" name="surgery_id" id="surgery_id">
                            <div class="form-group ">
                                <label for="name" class="col-form-label">نام</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="نام">
                            </div>





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
                        <div class="card-box" style="">
                            <div class="d-flex justify-content-between">
                                <h4 class="mt-0 header-title">کاربر ها</h4>
                                <a id="createNewUser" class="btn btn-success  waves-effect waves-light shadow"
                                    href="javascript:void(0)" data-target="#myModal"><i class="fas fa-user-plus"></i></a>
                            </div>
                            <hr>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>نام</th>

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
                ajax: "{{ route('surgery.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
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
                $('#saveBtn').val("edit-surgery");
                $('#surgery_id').val('');
                $('#surgeryForm').trigger('reset');
                $('#surgeryFormLabel').text(' افزودن عمل');
                $('#myModal').modal('show');

            })


            $('body').on('click', '.editSurgery', function() {

                var surgery_id = $(this).data('id');

                $.get("{{ route('surgery.index')}}"+"/"+surgery_id + "/edit", function(data) {



                    $('#surgeryForm').trigger('reset');
                    $('#surgeryFormLabel').text('ادیت عمل');

                    $('#myModal').modal('show');

                    $('#surgery_id').val(data.id);

                    $('#name').val(data.name);




                })

            });



            $('form').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{ route('surgery.store') }}",
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#surgeryForm').trigger('reset');
                        $('#myModal').modal("hide");

                        table.draw();

                        if($('#surgery_id').val()){
                            toastr["success"]("ویرایش انجام شد");
                        }else {
                            toastr["success"]("کاربر جدید ثبت شد");
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

            $('body').on('click', '.deleteSurgery', function() {



                var surgery_id = $(this).data("id");

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

                            url: "{{ route('surgery.index')}}"+'/'+ surgery_id,

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
