<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title> {{ env('APP_NAME') }} </title>
    <link href="{{ URL::asset('css/jquery.dataTables.min.css') }}">
    <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('css/custom.min.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

    <link href="{{ URL::asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/dropify.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title"><i class="fa fa-paw"></i>
                            <span>{{ env('APP_NAME') }}</span></a>
                    </div>

                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a><i class="fa fa-graduation-cap"></i> Academics <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        {{-- <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li class="sub_menu"><a href="level2.html">Level Two</a>
                                                </li>
                                                <li><a href="#level2_1">Level Two</a>
                                                </li>
                                                <li><a href="#level2_2">Level Two</a>
                                                </li>
                                            </ul>
                                        </li> --}}
                                        <li><a href="/academic_years">Academic Year</a></li>
                                        <li><a href="/class_rooms">Class Rooms</a></li>
                                        <li><a href="/shifts">Shifts</a></li>
                                        <li><a href="/subjects">Subjects</a></li>
                                        <li><a href="/teachers">Teachers</a></li>
                                        <li><a href="/subject_groups">Subject Groups </a></li>
                                        <li><a href="/teacher_subjects">Teacher Subject Mapping</a></li>
                                        <li><a href="/class_room_subjects">Class Subject Mapping</a></li>
                                        <li><a href="/schedules">Class Time Table</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-question-circle"></i> Examination <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/gradings">Grading</a></li>
                                        <li><a href="/exam_groups">Exam Groups</a></li>
                                        <li><a href="/exams">Exams</a></li>
                                        <li><a href="/exam_results">Exam Result</a></li>
                                        <li><a href="/exams/schedule">Exam Schedule</a></li>
                                        {{-- <li><a href="#">Get Marks Sheet</a></li> --}}
                                        {{-- <li><a href="#">Get Admit Card</a></li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-money"></i> Fees Collection <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/fees">Fees list</a></li>
                                        <li><a href="/fees/create">Generate Fee</a></li>
                                        <li><a href="/fees/collect_fees">Collect Fees</a></li>
                                        <li><a href="/fees/due_list">Search Due Fees</a></li>
                                        <li><a href="/fees/paid_list">Search Paid Fees</a></li>
                                        <li><a href="/fee_types">Fee Types</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-eye"></i> Attendance <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/attendances">Make Attendance</a></li>
                                        <li><a href="/attendance_result_statuses">Attendance Status</a></li>
                                        <li><a href="/leaves">Leaves</a></li>
                                        <li><a href="/teacher_attendances">Teacher Attendance</a></li>
                                        <li><a href="/attendance_results">Student Attendance Report</a></li>
                                    </ul>
                                </li>


                                <li><a><i class="fa fa-book"></i> Accounting <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/finance/accounts">Chart of accounts</a></li>
                                        <li><a href="/finance/journal_entry">Journal Entry</a></li>
                                        <li><a href="/finance/balance_sheet">Balance sheet</a></li>
                                        <li><a href="/finance/trial_balance">Trial Balance</a></li>
                                        <li><a href="/finance/income_statement">Income statement</a></li>
                                        <li><a href="/finance/expenses">Expenses</a></li>
                                        <li><a href="/finance/new_expense">New Expenses</a></li>
                                        <li><a href="/finance/new_expense_category">New Expense Head</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a><i class="fa fa-child"></i> Registration <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/students">Student Details</a></li>
                                        <li><a>Student Admission<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li class="sub_menu"><a href="/student_class_rooms">Admission list</a>
                                                </li>
                                                <li class="sub_menu"><a href="/student_class_rooms/create">Admit By Student</a>
                                                </li>
                                                <li class="sub_menu"><a href="/student_class_rooms/admit_in_batches">Admit By Batch</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">inActive Students</a></li>
                                        <li><a href="#">Graduated Students</a></li>
                                        <li><a href="/student_addresses">Student Areas</a></li>
                                        <li><a href="/guardians">Parents</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-users"></i> User Management <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/users">Users</a></li>
                                        <li><a href="/roles">Roles</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                                        alt="">{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/users/change_password"><i class="fa fa-lock pull-right"></i>
                                        Change password</a>
                                    <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out pull-right"></i>
                                        Log Out</a>
                                </div>
                            </li>




                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            @yield('content')
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    &copy; {{ env('APP_NAME') }}
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>




    <script src="{{ URL::asset('js/dropify.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('vendors/nprogress/nprogress.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ URL::asset('vendors/iCheck/icheck.min.js') }}"></script>

    @if (isset($list))
        <!-- Datatables -->
        <script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
        <script src="{{ URL::asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/jszip/dist/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    @endif
    <script src="{{ URL::asset('js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/echarts/map/js/world.js') }}"></script>
    <script src="{{ URL::asset('vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ URL::asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ URL::asset('vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ URL::asset('vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ URL::asset('vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ URL::asset('vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ URL::asset('vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('js/custom.js') }}"></script>
 

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $('select').each(function() {
                $(this).select2({
                    width: '100%'
                })
            });

            $(".alert").each(function() {
                $(this).fadeTo(2000, 700).slideUp(700, function() {
                        $(this).slideUp(700);
                });
            });
        });
    </script>
</body>

</html>
