@extends('layouts.main')
@section('title', 'پیشخوان')
@section('content')

    <div>

        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">درآمد کل</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/sallery.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h3 class="font-weight-normal pt-4 "> {{ number_format($totalPrice) }} </h3>
                            {{-- <p class="text-muted mb-1">تومان</p> --}}
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">مجموع پورسانت</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/commission.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h3 class="font-weight-normal pt-4 "> {{ $activeMarketers }} </h3>
                            <p class="text-muted mb-1"> </p>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">بازاریاب فعال</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/marketer.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h3 class="font-weight-normal pt-4 "> {{ $activeMarketers }} </h3>
                            {{-- <p class="text-muted mb-1">درآمد امروز</p> --}}
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card-box shadow">


                    <h4 class="header-title mt-0 mb-4">عمل های انجام شده</h4>

                    <div class="widget-chart-1 ">
                        <div class="widget-chart-box-1 float-left" dir="ltr">
                            <img src="{{ asset('assets/images/icons/surgery.png') }}" alt="" style="width: 70px">
                        </div>

                        <div class="widget-detail-1 text-right">
                            <h3 class="font-weight-normal pt-4 "> {{ $totalCustomerSurgery }} </h3>
                            {{-- <p class="text-muted mb-1">درآمد امروز</p> --}}
                        </div>
                    </div>
                </div>

            </div><!-- end col -->



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
                                    <p class="inbox-item-date">{{ \Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</p>
                                </a>
                            </div>

                        @endforeach


                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-8">
                <div class="card-box shadow">
                    <div class="dropdown float-right">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">اقدام</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">اقدام دیگر</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">گزینه دیگر</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">لینک جدا</a>
                        </div>
                    </div>

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
                                        <td>{{ $customerSurgery->surgeryName }}</td>
                                        <td>{{ $customerSurgery->marketerName }}</td>
                                        <td>{{ $customerSurgery->customerName }}</td>
                                        <td><span class="badge
                                            @if ($customerSurgery->customerSurgeryStatus == 0)
                                            badge-warning
                                            @elseif($customerSurgery->customerSurgeryStatus == 1 )
                                            badge-success
                                            @elseif($customerSurgery->customerSurgeryStatus == -1)
                                            badge-danger
                                            @elseif($customerSurgery->customerSurgeryStatus == -2)
                                            badge-primary
                                            @endif


                                            ">
                                                @if ($customerSurgery->customerSurgeryStatus == 0)
                                                در حال انتظار
                                                @elseif($customerSurgery->customerSurgeryStatus == 1 )
                                                تایید شده
                                                @elseif($customerSurgery->customerSurgeryStatus == -1)
                                                رد شده
                                                @elseif($customerSurgery->customerSurgeryStatus == -2)
                                                در حال مشاوره
                                                @endif


                                            </span></td>
                                        <td>قائم</td>
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
