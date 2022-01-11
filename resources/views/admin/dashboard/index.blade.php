@extends('layouts.main')
@section('title', 'پیشخوان')
@section('content')

    <div>

        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow " style="background-color: #046FB6;border-radius: 10px">




                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img class="" src="{{ asset('assets/images/icons/sallery.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 pt-2 text-right">
                            <p class="header-title  text-white">درآمد کل</p>
                            <p class="font-weight-normal text-white "> {{ number_format($totalPrice) }} </p>
                            {{-- <p class="text-muted mb-1">تومان</p> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow " style="background-color: #27AE60;border-radius: 10px">




                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img class="" src="{{ asset('assets/images/icons/commission.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 pt-2 text-right">
                            <p class="header-title  text-white">پورسانت  واریزی</p>
                            <p class="font-weight-normal text-white "> {{ number_format($totalPrice) }} </p>
                            {{-- <p class="text-muted mb-1">تومان</p> --}}
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow " style="background-color: tomato;border-radius: 10px">




                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img class="" src="{{ asset('assets/images/icons/marketer.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 pt-2 text-right">
                            <p class="header-title  text-white"> بازاریاب  فعال </p>
                            <p class="font-weight-normal text-white "> {{ $activeMarketers }} </p>
                            {{-- <p class="text-muted mb-1">تومان</p> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow " style="background-color: #DE6800;border-radius: 10px">




                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img class="" src="{{ asset('assets/images/icons/surgery.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 pt-2 text-right">
                            <p class="header-title  text-white">   عمل  انجام شده </p>
                            <p class="font-weight-normal text-white "> {{ $totalCustomerSurgery }} </p>
                            {{-- <p class="text-muted mb-1">تومان</p> --}}
                        </div>
                    </div>
                </div>

            </div>




        </div>




        <div class="row mt-2">
            <div class="col-xl-4">
                <div class="card-box shadow">


                    <h4 class="header-title mb-3">آخرین درخواست های پرداخت </h4>

                    <div class="inbox-widget">

                        @foreach ($payments as $payment)



                            <div class="inbox-item">
                                <a href="#">
                                    <div class="inbox-item-img"><img src="{{ asset('assets/images/users/avatar.png') }}"
                                            class="rounded-circle" alt="تصویر"></div>
                                    <h5 class="inbox-item-author mt-0 mb-1">
                                        {{ $payment->name . ' ' . $payment->last_name }}</h5>
                                    <p class="inbox-item-text">{{ $payment->amount }}</p>
                                    {{-- <p class="inbox-item-date">{{ \Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</p> --}}
                                </a>
                            </div>

                        @endforeach


                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-8">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-3">آخرین عمل ها</h4>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نوع عمل</th>
                                    <th>بازاریاب ثبت کننده</th>
                                    <th>نام مشتری </th>
                                    <th>وضعیت</th>
                                    <th>نام مشاور</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customerSurgeries as $customerSurgery)


                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customerSurgery->surgery->name }}</td>
                                        <td>{{ $customerSurgery->customer->marketer->user->name }}</td>
                                        <td>{{ $customerSurgery->customer->name }}</td>
                                        <td><span class="badge
                                            @if ($customerSurgery->status == 0)
                                            badge-warning
                                            @elseif($customerSurgery->status == 1 )
                                            badge-success
                                            @elseif($customerSurgery->status == -1)
                                            badge-danger
                                            @elseif($customerSurgery->status == -2)
                                            badge-primary
                                            @endif


                                            ">
                                                @if ($customerSurgery->status == 0)
                                                در حال انتظار
                                                @elseif($customerSurgery->status == 1 )
                                                تایید شده
                                                @elseif($customerSurgery->status == -1)
                                                رد شده
                                                @elseif($customerSurgery->status == -2)
                                                در حال مشاوره
                                                @endif


                                            </span></td>
                                        <td>
                                            @if($customerSurgery->status == 1)
                                            {{$customerSurgery->adviser->name}}
                                            @else
                                            {{'ناشناس'}}
                                            @endif
                                        </td>
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
