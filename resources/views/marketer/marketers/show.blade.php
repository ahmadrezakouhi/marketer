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
                                <h4 class="mt-0 header-title">بازاریاب های زیر دست </h4>
                                <h6 class="mt-0 header-title text-success">{{ $selectedMarketer->user->fullname }}</h6>

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

            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('marketers.index') }}" + "/" + {{ $id }},
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

                ]
            });























        })
    </script>



@endsection
