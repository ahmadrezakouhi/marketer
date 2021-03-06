<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="token">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!--Morris Chart-->
    <link rel="stylesheet" href="{{ asset('assets/libs/morris-js/morris.css') }}" />

    <!-- third party css -->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
    <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/treeview/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->


    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-rtl2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/jquery.js') }}"></script>

</head>

<body class="topbar-dark">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom navbar-custom-dark">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                {{-- <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="?????? ?? ????...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li> --}}

                {{-- <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="" class="text-dark">
                                        <small>?????? ???????? ??????</small>
                                    </a>
                                </span>?????????????? ????
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon">
                                    <img src="{{ asset('assets/images/users/avatar.png')}}" class="img-fluid rounded-circle"
                                        alt="??????????" />
                                </div>
                                <p class="notify-details">?????? ????????</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>???????? ???????????? ???? ???????? ???????? ????????...</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">???????? ?????????? ???? ?????? ??????
                                    <small class="text-muted">1 ?????????? ??????</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon">
                                    <img src="{{asset('assets/images/users/avatar.png')}}" class="img-fluid rounded-circle"
                                        alt="??????????" />
                                </div>
                                <p class="notify-details">???????? ??????????</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>?????????? ???? ?????????? ??????????</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">?????? ?????? ?????????? ????????
                                    <small class="text-muted">5 ???????? ??????</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">???????? ?????????? ???? ?????? ??????
                                    <small class="text-muted">4 ?????? ??????</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">???????? ???????????? ?????? ???? ???????? ??????.
                                    <small class="text-muted">13 ?????? ??????</small>
                                </p>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item notify-all">
                            ???????????? ??????
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li> --}}

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/avatar.png') }}" alt="?????????? ??????????"
                            class="rounded-circle">
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name.' '.Auth::user()->last_name}} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">?????? ??????????!</h6>
                        </div>

                        <!-- item-->
                        {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>???????? ????????????</span>
                        </a> --}}

                        <!-- item-->
                        {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>??????????????</span>
                        </a> --}}

                        <!-- item-->
                        <a href="{{route('common.change-password')}}" class="dropdown-item notify-item">
                            <i class="fe-lock"></i>
                            <span>?????????? ??????</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fe-log-out"></i>
                            <span>????????</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>

                {{-- <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li> --}}


            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                {{-- <a href="index.html" class="logo text-center"> --}}
                {{-- <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="??????????" height="16">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="assets/images/logo-sm.png" alt="??????????" height="24">
                    </span> --}}

                <h4 class="page-title-main text-center">@yield('title')</h4>
                {{-- </a> --}}
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    {{-- <h4 class="page-title-main">@yield('title')</h4> --}}
                </li>

            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="slimscroll-menu">

                <!-- User box -->
                <div class="user-box text-center">
                    <img src="{{ asset('assets/images/users/avatar.png') }}" alt="?????????? ??????????" title="???????? ??????????"
                        class="rounded-circle img-thumbnail avatar-lg">
                    <div class="dropdown">
                        <a href="#" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">
                            {{ Auth::user()->name . ' ' . Auth::user()->last_name }}</a>
                        <div class="dropdown-menu user-pro-dropdown">

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user mr-1"></i>
                                <span>???????? ????????????</span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings mr-1"></i>
                                <span>??????????????</span>
                            </a> --}}

                            <!-- item-->
                            {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock mr-1"></i>
                                <span>?????? ???????? ????????</span>
                            </a> --}}

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fe-log-out"></i>
                                <span>????????</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </div>
                    <p class="text-muted">{{ Auth::user()->role->farsi_name }}</p>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="{{route('common.change-password')}}" class="text-muted">
                                <i class="fe-lock"></i>
                            </a>
                        </li>

                        <li class="list-inline-item">


                            <a href="javascript:void(0);" class="text-custom" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-power"></i>

                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">
                            <hr>
                        </li>



                        @if(Auth::user()->isSuperAdmin())

                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span> ?????????????? </span>
                            </a>
                        </li>


                        <li>

                            <a href="{{ url('/admin/user') }}"><i class="mdi mdi-account-group"></i>?????????? ????</a>

                        </li>
                        <li>

                            <a href="{{ url('/admin/surgery') }}"><i class="mdi mdi-medical-bag"></i>?????? ????</a>


                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-account-group"></i>
                                <span> ???????????? ???????????????? ????</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{ route('marketer.index') }}"> <span class="mdi mdi-account-group"> </span> ???????????????? ???? </a></li>
                                <li><a href="{{ route('admin.sub-marketer')}}"><span class="mdi mdi-file-tree"> </span>  ?????? ?????? ????</a></li>

                            </ul>
                        </li>

                        @endif


                        @if(Auth::user()->isAdmin())

                        <li>
                            <a href="{{ url('/admin/marketer') }}"><i class="mdi mdi-account-group"></i>????????????????
                                ????</a>
                        </li>

                        @endif

                        @if(Auth::user()->isAdviser())

                        <li>
                            <a href="{{ url('/adviser/orders') }}"><i class="mdi mdi mdi-briefcase"></i>???????? ?????????????? ?????? ??????</a>
                            <a href="{{ url('/adviser/owner/orders') }}"><i class="mdi mdi mdi-briefcase"></i> ???????? ?????????????? ???? </a>
                        </li>

                        @endif
                        @if(Auth::user()->isAccountant())

                        <li>
                            <a href="{{ url('/accountant/payments') }}"><i class="mdi mdi-coin"></i>???????????? ????</a>
                        </li>

                        <li>
                            <a href="{{ url('/accountant/cards') }}"><i class="mdi mdi-credit-card"></i> ??????</a>
                        </li>

                        @endif


                            @if (Auth::user()->isMarketer())
                            <li>
                                <a href="{{ route('marketer.dashboard') }}">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> ?????????????? </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/marketer/customer') }}"><i class="mdi mdi-briefcase"></i>?????????? ????</a>

                        </li>
                        {{-- <li >

                                <a href="{{ url('/marketer/marketers') }}"><i
                                        class="mdi mdi-account-group"></i>???????????????? ????</a>

                        </li> --}}

                        <li>
                             <a href="javascript: void(0);">
                                <i class="mdi mdi-account-group"></i>
                                <span> ???????????? ???????????????? ????</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{ route('marketers.index') }}"> <span class="mdi mdi-account-group"> </span> ???????????????? ???? </a></li>
                                <li><a href="{{ route('marketer.sub-marketer')}}"><span class="mdi mdi-file-tree"> </span>  ?????? ?????? ????</a></li>

                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);">
                               <i class="fa fa-wallet"></i>
                               <span> ???????????? ????????</span>
                               <span class="menu-arrow"></span>
                           </a>
                           <ul class="nav-second-level" aria-expanded="false">
                               <li> <a href="{{ url('/marketer/card') }}"><i class="mdi mdi-credit-card"></i>??????</a></li>
                               <li><a href="{{ url('/marketer/payments') }}"><i class="mdi mdi mdi-wallet"></i>?????? ??????</a></li>

                           </ul>
                       </li>


                        @endif


                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <div class="container-fluid">
                    @yield('content')
                </div>

            </div> <!-- content -->



        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    {{-- <div class="right-bar">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="dripicons-cross noti-icon"></i>
            </a>
            <h4 class="m-0 text-white">??????????????</h4>
        </div>
        <div class="slimscroll-menu">
            <!-- User box -->
            <div class="user-box">
                <div class="user-img">
                    <img src="{{asset('assets/images/users/avatar.png')}}" alt="?????????? ??????????" title="???????? ??????????"
                        class="rounded-circle img-fluid">
                    <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
                </div>

                <h5><a href="javascript: void(0);">???????? ??????????</a> </h5>
                <p class="text-muted mb-0"><small>????</small></p>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h5 class="pl-3">?????????????? ????????</h5>
            <hr class="mb-0" />

            <div class="p-3">
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox1" type="checkbox" checked>
                    <label for="Rcheckbox1">
                        ?????????????? ????
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox2" type="checkbox" checked>
                    <label for="Rcheckbox2">
                        ???????????? ???? ???? ????
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox3" type="checkbox">
                    <label for="Rcheckbox3">
                        ???? ???????????????? ?????? ????????????
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-2">
                    <input id="Rcheckbox4" type="checkbox" checked>
                    <label for="Rcheckbox4">
                        ?????????? ????????????
                    </label>
                </div>
                <div class="checkbox checkbox-primary mb-0">
                    <input id="Rcheckbox5" type="checkbox" checked>
                    <label for="Rcheckbox5">
                        ???????????? ????????????
                    </label>
                </div>
            </div>

            <!-- Timeline -->
            <hr class="mt-0" />
            <h5 class="pl-3 pr-3">???????? ???? <span class="float-right badge badge-pill badge-danger">25</span></h5>
            <hr class="mb-0" />
            <div class="p-3">
                <div class="inbox-widget">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{asset('assets/images/users/avatar.png')}}" class="rounded-circle"
                                alt="??????????"></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">????????</a>
                        </p>
                        <p class="inbox-item-text">?????????? ???????? ????. ???????? ???? ????...</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{asset('assets/images/users/avatar.png')}}" class="rounded-circle"
                                alt="??????????"></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">????????</a>
                        </p>
                        <p class="inbox-item-text">?????? ???????? ??????????!</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{asset('assets/images/users/avatar.png')}}" class="rounded-circle"
                                alt="??????????"></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">????????</a>
                        </p>
                        <p class="inbox-item-text">???? ???????? ?????????? ???????????? ??????</p>
                    </div>

                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{asset('assets/images/users/avatar.png')}}" class="rounded-circle"
                                alt="??????????"></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">??????????</a>
                        </p>
                        <p class="inbox-item-text">????????! ???? ??????????????...</p>
                    </div>
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="{{asset('assets/images/users/avatar.png')}}" class="rounded-circle"
                                alt="??????????"></div>
                        <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">????????</a>
                        </p>
                        <p class="inbox-item-text">?????? ???????? ??????????!</p>
                    </div>
                </div> <!-- end inbox-widget -->
            </div> <!-- end .p-3-->

        </div> <!-- end slimscroll-menu-->
    </div> --}}
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>


    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- knob plugin -->
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>





    <!-- App js-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <!-- Toastr plugins -->
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>


    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/treeview/jstree.min.js')}}"></script>
    {{-- <script src="{{ asset('assets/js/pages/treeview.init.js')}}"></script> --}}

</body>

</html>
