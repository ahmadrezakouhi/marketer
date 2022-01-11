@extends('layouts.main')
@section('title', 'پیشخوان')
@section('content')

    <div>

        {{-- <div class="row">

            <div class="col-xl-4 col-md-6">
                <div class="card-box shadow">


                    <h2 class="header-title mt-0 mb-4">درآمد کل</h2>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/sallery.png') }}" alt="" style="width: 100px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h2 class="font-weight-normal pt-5 "> {{number_format($wallet)}} </h2>

                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">بازاریاب های زیر دست</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/submarketer.png') }}" alt="" style="width: 100px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h2 class="font-weight-normal pt-5 ">{{ $countMarketers }}</h2>
                            <p class="text-muted mb-1"> </p>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">عمل های ثبت شده</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/surgery.png') }}" alt="" style="width: 100px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h2 class="font-weight-normal pt-5 "> {{ $countCustomers }}</h2>

                        </div>
                    </div>
                </div>

            </div><!-- end col -->



        </div> --}}

<div class="row">
    <div class="col-md-4 ">
        <div class="card-box shadow " style="background-color: #046FB6;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/sallery.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">درآمد کل</p>
                    <p class="font-weight-normal text-white "> {{number_format($wallet+$totalPayment)}} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4 ">
        <div class="card-box shadow " style="background-color: #F4412F;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/marketer.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">بازاریاب زیردست</p>
                    <p class="font-weight-normal text-white "> {{ $countMarketers }} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4 ">
        <div class="card-box shadow " style="background-color: #DE6800;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/surgery.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">عمل ثبت شده</p>
                    <p class="font-weight-normal text-white "> {{ number_format($countCustomers) }} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card-box shadow " style="background-color: #27AE60;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/amount_requested.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">مجموع مبالغ درخواستی</p>
                    <p class="font-weight-normal text-white "> {{ number_format($totalRequestPayment) }} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="card-box shadow " style="background-color: #ff9800;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/supply.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">موجودی</p>
                    <p class="font-weight-normal text-white "> {{ number_format($wallet) }} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                    <div class="my-md-4 my-xl-0"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="card-box shadow " style="background-color: #3f51b5;border-radius: 10px">




            <div class="widget-chart-1 ">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <img class="" src="{{ asset('assets/images/icons/commission.png') }}" alt="" style="width: 70px">
                </div>

                <div class="widget-detail-1 pt-2 text-right">
                    <p class="header-title  text-white">مبالغ پرداخت شده</p>
                    <p class="font-weight-normal text-white "> {{ number_format($totalPayment) }} </p>
                    {{-- <p class="text-muted mb-1">تومان</p> --}}
                </div>
            </div>
        </div>

    </div>
</div>


        <div class="row mt-2">


            <div class="col-xl-12">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-3">آخرین عمل های ثبت شده</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی </th>
                                    <th>نوع عمل</th>
                                    <th>وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)


                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->customerName }}</td>
                                        <td>{{ $customer->customerLastName }}</td>
                                        <td>{{ $customer->surgeryName }}</td>
                                        <td><span class="badge
                                            @if ($customer->customerSurgeryStatus == 0)
                                            badge-warning
                                            @elseif($customer->customerSurgeryStatus == 1 )
                                            badge-success
                                            @elseif($customer->customerSurgeryStatus == -1)
                                            badge-danger
                                            @elseif($customer->customerSurgeryStatus == -2)
                                            badge-primary
                                            @endif


                                            ">
                                                @if ($customer->customerSurgeryStatus == 0)
                                                در حال انتظار
                                                @elseif($customer->customerSurgeryStatus == 1 )
                                                تایید شده
                                                @elseif($customer->customerSurgeryStatus == -1)
                                                رد شده
                                                @elseif($customer->customerSurgeryStatus == -2)
                                                در حال مشاوره
                                                @endif


                                            </span></td>

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- end col -->

        </div>




    </div>

@endsection
