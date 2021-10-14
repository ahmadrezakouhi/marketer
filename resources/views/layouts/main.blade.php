<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="یک قالب مدیریتی با امکانات فراوان برای ساخت سی آر ام، سیستم مدیریت محتوا و ..." name="description" />
        <meta content="قائم امیدی" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="token">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!--Morris Chart-->
        <link rel="stylesheet" href="{{ asset('assets/libs/morris-js/morris.css')}}" />
        <link href="assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('js/jquery.js')}}"></script>
    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>


                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>پاک کردن همه</small>
                                            </a>
                                        </span>اطلاعیه ها
                                    </h5>
                                </div>

                                <div class="slimscroll noti-scroll">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="تصویر" /> </div>
                                        <p class="notify-details">علی کردی</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>سلام چطوری؟ در مورد جلسه بعدی...</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">پیام خصوصی از طرف رضا
                                            <small class="text-muted">1 دقیقه پیش</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="تصویر" /> </div>
                                        <p class="notify-details">سجاد صابری</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>ادمین تو واقعا عالیه</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">ثبت نام کاربر تازه
                                            <small class="text-muted">5 ساعت پیش</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">پیام خصوصی از طرف رضا
                                            <small class="text-muted">4 روز پیش</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">نسیم دیدگاه شما را لایک کرد.
                                            <small class="text-muted">13 روز پیش</small>
                                        </p>
                                    </a>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    مشاهده همه
                                    <i class="fi-arrow-right"></i>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/users/user-1.jpg" alt="تصویر کاربر" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    قائم <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">خوش اومدی!</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>حساب کاربری</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>تنظیمات</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>قفل کردن صفحه</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>خروج</span>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo text-center">
                            <span class="logo-lg">
                                <img src="assets/images/logo-light.png" alt="تصویر" height="16">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">U</span> -->
                                <img src="assets/images/logo-sm.png" alt="تصویر" height="24">
                            </span>
                        </a>
                    </div>

                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="index.html"><i class="mdi mdi-view-dashboard"></i>پیشخوان</a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="mdi mdi-invert-colors"></i>رابط کاربری  <div class="arrow-down"></div></a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="ui-buttons.html">دکمه ها</a>
                                            </li>
                                            <li>
                                                <a href="ui-cards.html">کارت ها</a>
                                            </li>
                                            <li>
                                                <a href="ui-draggable-cards.html">کارت های کشیدنی</a>
                                            </li>
                                            <li>
                                                <a href="ui-checkbox-radio.html">چک باکس ها و دکمه های رادیویی</a>
                                            </li>
                                            <li>
                                                <a href="ui-material-icons.html">آیکون های متریال دیزاین</a>
                                            </li>
                                            <li>
                                                <a href="ui-font-awesome-icons.html">Font Awesome</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="ui-dripicons.html">Dripicons</a>
                                            </li>
                                            <li>
                                                <a href="ui-themify-icons.html">آیکون های Themify</a>
                                            </li>
                                            <li>
                                                <a href="ui-modals.html">مودال ها</a>
                                            </li>
                                            <li>
                                                <a href="ui-notification.html">اطلاعیه</a>
                                            </li>
                                            <li>
                                                <a href="ui-range-slider.html">اسلایدر محدوده</a>
                                            </li>
                                            <li>
                                                <a href="ui-components.html">کامپوننت ها</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="ui-sweetalert.html">سوییت آلرت</a>
                                            </li>
                                            <li>
                                                <a href="ui-treeview.html">نمای درختی</a>
                                            </li>
                                            <li>
                                                <a href="ui-widgets.html">ابزارک ها</a>
                                            </li>
                                            <li>
                                                <a href="ui-typography.html">تایپوگرافی</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#">
                                    <i class="mdi mdi-lifebuoy"></i>کامپوننت ها <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">فرم ها <div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="form-elements.html">عناصر عمومی</a>
                                            </li>
                                            <li>
                                                <a href="form-advanced.html">فرم پیشرفته</a>
                                            </li>
                                            <li>
                                                <a href="form-validation.html">اعتبارسنجی فرم</a>
                                            </li>
                                            <li>
                                                <a href="form-wizard.html">فرم ویزارد</a>
                                            </li>
                                            <li>
                                                <a href="form-fileupload.html">بارگذاری</a>
                                            </li>
                                            <li>
                                                <a href="form-quilljs.html">ویرایشگر Quilljs</a>
                                            </li>
                                            <li>
                                                <a href="form-xeditable.html">X-editable</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">جدول ها <div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="tables-basic.html">جدول ساده</a>
                                            </li>
                                            <li>
                                                <a href="tables-datatable.html">دیتا تیبل</a>
                                            </li>
                                            <li>
                                                <a href="tables-responsive.html">جدول واکنش گرا</a>
                                            </li>
                                            <li>
                                                <a href="tables-editable.html">جدول قابل ویرایش</a>
                                            </li>
                                            <li>
                                                <a href="tables-tablesaw.html">جدول Tablesaw</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="calendar.html">تقویم</a>
                                    </li>
                                    <li>
                                        <a href="inbox.html">ایمیل</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="mdi mdi-chart-donut-variant"></i>نمودارها <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="charts-flot.html">نمودار Flot</a>
                                    </li>
                                    <li>
                                        <a href="charts-morris.html">نمودار Morris</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartist.html">نمودار Chartist</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartjs.html">نمودار Chartjs</a>
                                    </li>
                                    <li>
                                        <a href="charts-other.html">دیگر نمودارها</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="mdi mdi-cards-outline"></i>برگه ها <div class="arrow-down"></div></a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="pages-starter.html">برگه شروع</a>
                                            </li>
                                            <li>
                                                <a href="pages-login.html">ورود</a>
                                            </li>
                                            <li>
                                                <a href="pages-register.html">ثبت نام</a>
                                            </li>
                                            <li>
                                                <a href="pages-recoverpw.html">بازیابی رمز عبور</a>
                                            </li>
                                            <li>
                                                <a href="pages-lock-screen.html">قفل کردن صفحه</a>
                                            </li>
                                            <li>
                                                <a href="pages-confirm-mail.html">تایید ایمیل</a>
                                            </li>
                                            <li>
                                                <a href="pages-404.html">خطای 404</a>
                                            </li>
                                            <li>
                                                <a href="pages-500.html">خطای 500</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="extras-projects.html">پروژه ها</a>
                                            </li>
                                            <li>
                                                <a href="extras-tour.html">تور</a>
                                            </li>
                                            <li>
                                                <a href="extras-taskboard.html">تسک بورد</a>
                                            </li>
                                            <li>
                                                <a href="extras-taskdetail.html">جزئیات تسک</a>
                                            </li>
                                            <li>
                                                <a href="extras-profile.html">پروفایل</a>
                                            </li>
                                            <li>
                                                <a href="extras-maps.html">نقشه ها</a>
                                            </li>
                                            <li>
                                                <a href="extras-contact.html">فهرست مخاطبان</a>
                                            </li>
                                            <li>
                                                <a href="extras-pricing.html">تعرفه ها</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="extras-timeline.html">تایم لاین</a>
                                            </li>
                                            <li>
                                                <a href="extras-invoice.html">صورتحساب</a>
                                            </li>
                                            <li>
                                                <a href="extras-faq.html">پرسش های متداول</a>
                                            </li>
                                            <li>
                                                <a href="extras-gallery.html">گالری</a>
                                            </li>
                                            <li>
                                                <a href="extras-email-templates.html">قالب های ایمیل</a>
                                            </li>
                                            <li>
                                                <a href="extras-maintenance.html">حالت تعمیر</a>
                                            </li>
                                            <li>
                                                <a href="extras-comingsoon.html">به زودی</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"> <i class="mdi mdi-card-bulleted-settings-outline"></i>طرح ها <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="layouts-menubar-dark.html">منوی تیره</a>
                                    </li>
                                    <li>
                                        <a href="layouts-center-menu.html">منوی وسط چین</a>
                                    </li>
                                    <li>
                                        <a href="layouts-menu-drop-dark.html">زیر منوی تیره</a>
                                    </li>
                                    <li>
                                        <a href="layouts-preloader.html">پیش بارگذار</a>
                                    </li>
                                    <li>
                                        <a href="layouts-normal-header.html">سربرگ ثابت</a>
                                    </li>
                                    <li>
                                        <a href="layouts-boxed.html">جعبه ای</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->

        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="wrapper">
            <div class="container-fluid">

                @yield('content')

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->





        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

        <!-- knob plugin -->
        <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets/libs/morris-js/morris.min.js')}}"></script>
        <script src="{{ asset('assets/libs/raphael/raphael.min.js')}}"></script>

        <!-- Dashboard init js-->
        <script src="{{ asset('assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js')}}"></script>

        <!-- Toastr plugins -->
        <script src="{{ asset('assets/libs/toastr/toastr.min.js')}}"></script>


    </body>
</html>
