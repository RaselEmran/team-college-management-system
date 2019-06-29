<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <section class="sidebar">
    <!-- sidebar menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="{{ URL::route('user.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      @can('student.index')
      <li>
        <a href="{{ URL::route('student.index') }}">
          <i class="fa icon-student"></i> <span>Students</span>
        </a>
      </li>
      @endcan
      @can('promotion')
       <li>
        <a href="{{ URL::route('promotion') }}">
          <i class="fa icon-student"></i> <span>Promotion</span>
        </a>
      </li>
      @endcan
      @can('teacher.index')
      <li>
        <a href="{{ URL::route('teacher.index') }}">
          <i class="fa icon-teacher"></i> <span>Teachers</span>
        </a>
      </li>
      @endcan
      @canany(['student_attendance.index', 'employee_attendance.index'])
      <li class="treeview">
        <a href="#">
          <i class="fa icon-attendance"></i>
          <span>Attendance</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('student_attendance.index')
          <li>
            <a href="{{ URL::route('student_attendance.index') }}">
              <i class="fa icon-student"></i> <span>Student Attendance</span>
            </a>
          </li>
          @endcan
          @can('employee_attendance.index')
          <li>
            <a href="{{ URL::route('employee_attendance.index') }}">
              <i class="fa icon-member"></i> <span>Employee Attendance</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endcanany
      <li class="treeview">
        <a href="#">
          <i class="fa icon-academicmain"></i>
          <span>Academic</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @notrole('Student')
          @can('academic.class')
          <li>
            <a href="{{ URL::route('academic.class') }}">
              <i class="fa fa-sitemap"></i> <span>Class</span>
            </a>
          </li>
          @endcan
          @can('academic.section')
          <li>
            <a href="{{ URL::route('academic.section') }}">
              <i class="fa fa-cubes"></i> <span>Section</span>
            </a>
          </li>
          @endcan
          @endnotrole
          @can('academic.subject')
          <li>
            <a href="{{ URL::route('academic.subject') }}">
              <i class="fa icon-subject"></i> <span>Subject</span>
            </a>
          </li>
          @endcan
          {{-- Without Permission --}}
         {{--  @can('academic.subject')
         <li>
           <a href="{{ URL::route('holidays.index') }}">
             <i class="fa icon-subject"></i> <span>Holidays</span>
           </a>
         </li>
         @endcan
         @can('academic.subject')
         <li>
           <a href="{{ URL::route('class-off.index') }}">
             <i class="fa icon-subject"></i> <span>Class Off</span>
           </a>
         </li>
         @endcan
          {{-- ================================ --}}
          {{--<li>--}}
            {{--<a href="#">--}}
              {{--<i class="fa fa-clock-o"></i><span>Routine</span>--}}
            {{--</a>--}}
          {{--</li>--}}
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i>
          <span>Library</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          @can('library.search')
           <li>
            <a href="{{URL::route('library.search')}}">
              <i class="fa fa-calendar-plus-o"></i> <span>Book Search</span>
            </a>
          </li>
          @endcan
          @can('library.issuebook')
          <li>
            <a href="{{URL::route('library.issuebook')}}">
              <i class="fa fa-calendar-plus-o"></i> <span>Borrow Book</span>
            </a>
          </li>
          @endcan
          @can('library.issuebookview')
          <li>
            <a href="{{ route('library.issuebookview') }}">
              <i class="fa icon-mailandsms"></i> <span>Borrowd Book List</span>
            </a>
          </li>
          @endcan
          @can('library.getview-show')
          <li>
            <a href="{{ route('library.getview-show') }}">
              <i class="fa fa-id-card"></i> <span>Book List</span>
            </a>
          </li>
          @endcan
          @can('library.getaddbook')
          <li>
            <a href="{{ route('library.getaddbook') }}">
              <i class="fa fa-user-md"></i> <span> Book Entry</span>
            </a>
          </li>
          @endcan
          @can('library.reports')
          <li>
            <a href="{{ route('library.reports') }}">
              <i class="fa fa-eye-slash"></i> <span>Reports</span>
            </a>
          </li>
          @endcan
          @can('library.reports.fine')
          <li>
            <a href="{{ route('library.reports.fine') }}">
              <i class="fa fa-users"></i> <span>Monthly Fine Reports</span>
            </a>
          </li>
          @endcan
          {{--<li>--}}
          {{--<a href="#">--}}
          {{--<i class="fa fa-download"></i> <span>Backup</span>--}}
          {{--</a>--}}
          {{--</li>--}}

          {{--<li>--}}
          {{--<a href="#">--}}
          {{--<i class="fa fa-upload"></i> <span>Restore</span>--}}
          {{--</a>--}}
          {{--</li>--}}

        </ul>
      </li>
      @notrole('Student')
      <li class="treeview">
        <a href="#">
          <i class="fa icon-exam"></i>
          <span>Exam</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('exam.index')
          <li>
            <a href="{{ URL::route('exam.index') }}">
              <i class="fa icon-exam"></i> <span>Exam</span>
            </a>
          </li>
          @endcan
          @can('exam.grade.index')
          <li>
            <a href="{{ URL::route('exam.grade.index') }}">
              <i class="fa fa-bar-chart"></i> <span>Grade</span>
            </a>
          </li>
          @endcan
          @can('exam.rule.index')
          <li>
            <a href="{{ URL::route('exam.rule.index') }}">
              <i class="fa fa-cog"></i> <span>Rule</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa icon-markmain"></i>
          <span>Marks & Result</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('marks.index')
          <li>
            <a href="{{ URL::route('marks.index') }}">
              <i class="fa icon-markmain"></i> <span>Marks</span>
            </a>
          </li>
          @endcan
          @can('result.index')
          <li>
            <a href="{{ URL::route('result.index') }}">
              <i class="fa icon-markpercentage"></i> <span>Result</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endnotrole
      @notrole('Student')
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>HRM</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('hrm.employee.index')
          <li>
            <a href="{{ URL::route('hrm.employee.index') }}">
              <i class="fa icon-member"></i> <span>Employee</span>
            </a>
          </li>
          @endcan
          @can('hrm.leave.index')
          <li>
            <a href="{{ URL::route('hrm.leave.index') }}">
              <i class="fa fa-bed"></i> <span>Leave</span>
            </a>
          </li>
          @endcan
          @can('hrm.work_outside.index')
          <li>
            <a href="{{ URL::route('hrm.work_outside.index') }}">
              <i class="glyphicon glyphicon-log-out"></i> <span>Work Outside</span>
            </a>
          </li>
          @endcan
          @can('hrm.policy')
          <li>
            <a href="{{ URL::route('hrm.policy') }}">
              <i class="fa fa-cogs"></i> <span>Policy</span>
            </a>
          </li>
          @endcan

           <li>
            <a href="{{ URL::route('sallary.setuplist') }}">
              <i class="fa icon-mailandsms"></i> <span>Sallary Setup</span>
            </a>
          </li>

            <li>
            <a href="{{ URL::route('sallary.payment') }}">
              <i class="fa fa-circle-o"></i> <span>Sallary Payment</span>
            </a>
          </li>

            <li>
            <a href="{{ URL::route('sallary.report') }}">
              <i class="fa fa-circle-o"></i> <span>Sallary Report</span>
            </a>
          </li>
        </ul>
      </li>
      @endnotrole
      @role('Admin')
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i>
          <span>Administrator</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ URL::route('administrator.academic_year') }}">
              <i class="fa fa-calendar-plus-o"></i> <span>Academic Year</span>
            </a>
          </li>
          <li>
            <a href="{{ URL::route('administrator.template.mailsms.index') }}">
              <i class="fa icon-mailandsms"></i> <span>Mail/SMS Template</span>
            </a>
          </li>
          <li>
            <a href="{{ URL::route('administrator.template.idcard.index') }}">
              <i class="fa fa-id-card"></i> <span>ID Card Template</span>
            </a>
          </li>
          <li>
            <a href="{{URL::route('administrator.user_index')}}">
              <i class="fa fa-user-md"></i> <span>System Admin</span>
            </a>
          </li>
          <li>
            <a href="{{route('administrator.user_password_reset')}}">
              <i class="fa fa-eye-slash"></i> <span>Reset User Password</span>
            </a>
          </li>
          <li>
            <a href="{{URL::route('user.role_index')}}">
              <i class="fa fa-users"></i> <span>Role</span>
            </a>
          </li>
          {{--<li>--}}
            {{--<a href="#">--}}
              {{--<i class="fa fa-download"></i> <span>Backup</span>--}}
            {{--</a>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<a href="#">--}}
              {{--<i class="fa fa-upload"></i> <span>Restore</span>--}}
            {{--</a>--}}
          {{--</li>--}}
        </ul>
      </li>
      @endrole
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i>
          <span>Fees</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            @can('student.fee.views')
            <li><a href="{{ route('student.fee.views') }}"><i class="fa fa-circle-o"></i>Student Fees</a></li>
            @endcan
            @can('student.fee.collection')
            <li ><a href="{{ route('student.fee.collection') }}"><i class="fa fa-circle-o"></i> Fees Collection</a></li>
            @endcan
            @can('student.fee.setuplist')
            <li class="{{Request::is('fees/setup*') ?'active':''}}" ><a href="{{ route('student.fee.setuplist') }}"><i class="fa fa-circle-o"></i> Fees Setup</a></li>
            <li ><a href="{{ route('student.fee.report') }}"><i class="fa fa-circle-o"></i> Fee Collection Report</a></li>
            @endcan
          </ul>
    </li>


    <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i>
          <span>Dormitory</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            @can('dormitory')
            <li><a href="{{ route('dormitory') }}"><i class="fa fa-circle-o"></i>Dormitory</a></li>
            @endcan
            @can('dormitory.assignstd')
            <li ><a href="{{ route('dormitory.assignstd') }}"><i class="fa fa-circle-o"></i> Assign Student</a></li>
            @endcan
            @can('dormitory.assignstd.list')
            <li  ><a href="{{ route('dormitory.assignstd.list') }}"><i class="fa fa-circle-o"></i> Student List</a></li>
            @endcan
            @can('dormitory.fee')
            <li ><a href="{{ route('dormitory.fee') }}"><i class="fa fa-circle-o"></i> Fee Collection</a></li>
            @endcan
            @can('dormitory.report.std')
            <li ><a href="{{ route('dormitory.report.std') }}"><i class="fa fa-circle-o"></i> Dormitory Report</a></li>
            @endcan
            @can('dormitory.report.fee')
             <li ><a href="{{ route('dormitory.report.fee') }}"><i class="fa fa-circle-o"></i> Fee Reports</a></li>
            @endcan
          </ul>
    </li>
      @can('user.index')
      <li>
        <a href="{{ URL::route('user.index') }}">
          <i class="fa fa-users"></i> <span>Users</span>
        </a>
      </li>
      @endcan

          <li class="treeview">
        <a href="#">
          <i class="fa fa-user-secret"></i>
          <span>Accounting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            @can('sectors')
            <li><a href="{{ route('sectors') }}"><i class="fa fa-circle-o"></i>Sectors</a></li>
            @endcan
            @can('accounting.incomelist')
            <li ><a href="{{ route('accounting.income') }}"><i class="fa fa-circle-o"></i> Add Income</a></li>
            @endcan
            @can('accounting.incomelist')
            <li  ><a href="{{ route('accounting.incomelist') }}"><i class="fa fa-circle-o"></i> View Income</a></li>
            @endcan
            @can('accounting.expence')
            <li ><a href="{{ route('accounting.expence') }}"><i class="fa fa-circle-o"></i> Add Expence</a></li>
            @endcan
            @can('accounting.expencelist')
            <li ><a href="{{ route('accounting.expencelist') }}"><i class="fa fa-circle-o"></i> View Expence</a></li>
            @endcan
          </ul>
    </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-pdf-o"></i>
          <span>Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
            <a href="#">
              <i class="fa icon-studentreport"></i>
              <span>Student</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('report.student_monthly_attendance')
              <li>
                <a href="{{ URL::route('report.student_monthly_attendance') }}">
                  <i class="fa icon-attendancereport"></i> <span>Monthly Attendance</span>
                </a>
              </li>
              @endcan
              @can('report.student_monthly_attendance_details')
              <li>
                <a href="{{ route('report.student_monthly_attendance_details') }}">
                  <i class="fa icon-attendance"></i> <span>Monthly Details Attendance</span>
                </a>
              </li>
              @endcan
             {{--  <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Monthly Individual Attendance</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Monthly Individual Details Attendance</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Weekly Attendance</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Weekly Details Attendance</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Weekly Individual Attendance</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Weekly Individual Details Attendance</span>
                </a>
              </li> --}}
              {{-- <li>
                <a href="#">
                  <i class="fa icon-payment"></i> <span>Payment History</span>
                </a> --}}
              </li>
              @can('report.student_list')
              <li>
                <a href="{{route('report.student_list')}}">
                  <i class="fa icon-student"></i> <span>Student List</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>HRM</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li>
                <a href="#">
                  <i class="fa icon-attendance"></i> <span>Absenteeism Attendance</span>
                </a>
              </li> -->
              @can('report.employee_monthly_attendance')
              <li>
                <a href="{{ route('report.employee_monthly_attendance') }}"><i class="fa icon-attendance"></i> <span>Monthly Attendance</span></a>
              </li>
              @endcan
              @can('report.employee_monthly_attendance_details')
              <li>
                <a href="{{ route('report.employee_monthly_attendance_details') }}"><i class="fa icon-attendance"></i> <span>Monthly Details Attendance</span></a>
              </li>
              @endcan
              @can('report.employee_list')
              <li>
                <a href="{{ route('report.employee_list') }}"><i class="fa icon-attendance"></i> <span>Employee List</span></a>
              </li>
              @endcan
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa icon-exam"></i>
              <span>Exam</span>
              <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
              @can('admission_name')
              <li>
                <a href="{{ route('admission_name') }}"><i class="fa fa-id-card"></i> <span>Admision</span></a>
              </li>
              @endcan
{{--
              <li>
                <a href="#"><i class="fa fa-id-card"></i> <span>Applicant List</span></a>
              </li> --}}
              {{-- <li>
                <a href="#"><i class="fa fa-id-card"></i> <span>Admit Card</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-sort-numeric-asc"></i> <span>Seat Plan</span></a>
              </li> --}}
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa icon-mark2"></i>
              <span>Marks & Result</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('passing_summary')
              <li>
                <a href="{{ route('passing_summary') }}"><i class="fa fa-list-alt"></i><span>Passing Summery(Class)</span></a>
              </li>
              @endcan
              @can('subjectpass_summary')
              <li>
                <a href="{{ route('subjectpass_summary') }}"><i class="fa fa-list-alt"></i><span>Passing Summery(Subject)</span></a>
              </li>
              @endcan
              {{--
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Pass-Fail Percentage</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Pass-Fail Summery</span></a>
              </li>
 --}}
              @can('gradesheet')
              <li>
                <a href="{{ route('gradesheet') }}"><i class="fa fa-list-alt"></i><span>Marksheet</span></a>
              </li>
              @endcan
              @can('tabulation')
              <li>
                <a href="{{ route('tabulation') }}"><i class="fa fa-list-alt"></i><span>Tabulationsheet</span></a>
              </li>
              @endcan
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa icon-hostel"></i>
              <span>Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('accounting.report')
              <li>
                <a href="{{ route('accounting.report') }}"><i class="fa fa-list-alt"></i><span>Account By Type</span></a>
              </li>
              @endcan
              @can('accounting.reportsum')
              <li>
                <a href="{{ route('accounting.reportsum') }}"><i class="fa fa-list-alt"></i><span>Account Balance</span></a>
              </li>
              @endcan
            </ul>
          </li>
          {{-- <li class="treeview">
            <a href="#">
              <i class="fa icon-hostel"></i>
              <span>Hostel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Member List</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Fee collection</span></a>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa icon-library"></i>
              <span>Library</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Books Summary</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Fine Collection</span></a>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa icon-account"></i>
              <span>Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Monthly Collection</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Monthly Expenditure</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Total Collection</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Total Expenditure</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Balance Sheet</span></a>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa icon-payment"></i>
              <span>Payroll</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Salary Sheet(M.P.O)</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Salary Sheet Bangla(M.P.O)</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Salary Sheet</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Salary Sheet Bangla</span></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-list-alt"></i><span>Employee Payment History</span></a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa icon-attendance"></i> <span>Academic Calendar</span>
            </a>
          </li> --}}
        </ul>
      </li>
      @role('Admin')
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ URL::route('settings.institute') }}">
              <i class="fa fa-building"></i> <span>Institute</span>
            </a>
          </li>
          <li>
            <a href="{{ URL::route('settings.academic_calendar.index') }}">
              <i class="fa fa-calendar"></i> <span>Academic Calendar</span>
            </a>
          </li>
          <li>
            <a href="{{ URL::route('settings.sms_gateway.index') }}">
              <i class="fa fa-external-link"></i> <span>SMS Gateways</span>
            </a>
          </li>
          <li>
            <a href="{{ URL::route('settings.report') }}">
              <i class="fa fa-file-pdf-o"></i> <span>Report</span>
            </a>
          </li>
        </ul>
      </li>
      @endrole
      <!-- Frontend Website links and settings -->
      @if($frontend_website)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Site</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @can('site.dashboard')
          <li>
            <a href="{{ URL::route('site.dashboard') }}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          @endcan
          <li class="treeview">
            <a href="#">
              <i class="fa fa-home"></i>
              <span>Home</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('site.index')
              <li><a href="{{URL::route('slider.index')}}"><i class="fa fa-picture-o text-aqua"></i> Sliders</a></li>
              @endcan
              @can('site.about_content')
              <li><a href="{{URL::route('site.about_content')}}"><i class="fa fa-info text-aqua"></i> About Us</a></li>
              @endcan
              @can('site.service')
              <li><a href="{{ URL::route('site.service') }}"><i class="fa fa-file-text text-aqua"></i> Our Services</a></li>
              @endcan
              @can('site.statistic')
              <li><a href="{{ URL::route('site.statistic') }}"><i class="fa fa-bars"></i> Statistic</a></li>
              @endcan
              @can('site.testimonial')
              <li><a href="{{ URL::route('site.testimonial') }}"><i class="fa fa-comments"></i> Testimonials</a></li>
              @endcan
              @can('site.subscribe')
              <li><a href="{{ URL::route('site.subscribe') }}"><i class="fa fa-users"></i> Subscribers</a></li>
              @endcan
            </ul>
          </li>
          @can('class_profile.index')
          <li>
            <a href="{{ URL::route('class_profile.index') }}">
              <i class="fa fa-building"></i>
              <span>Class</span>
            </a>
          </li>
          @endcan
          @can('teacher_profile.index')
          <li>
            <a href="{{ URL::route('teacher_profile.index') }}">
              <i class="fa icon-teacher"></i>
              <span>Teachers</span>
            </a>
          </li>
          @endcan
          @can('event.index')
          <li>
            <a href="{{ URL::route('event.index') }}">
              <i class="fa fa-bullhorn"></i>
              <span>Events</span>
            </a>
          </li>
          @endcan
          @can('site.gallery')
          <li>
            <a href="{{ URL::route('site.gallery') }}">
              <i class="fa fa-camera"></i>
              <span>Gallery</span>
            </a>
          </li>
          @endcan
          @can('site.contact_us')
          <li>
            <a href="{{ URL::route('site.contact_us') }}">
              <i class="fa fa-map-marker"></i>
              <span>Contact Us</span>
            </a>
          </li>
          @endcan
          @can('site.faq')
          <li>
            <a href="{{ URL::route('site.faq') }}">
              <i class="fa fa-question-circle"></i>
              <span>FAQ</span>
            </a>
          </li>
          @endcan
          @can('site.timeline')
          <li>
            <a href="{{ URL::route('site.timeline') }}"><i class="fa fa-clock-o"></i>
              <span>Timeline</span>
            </a>
          </li>
          @endcan
          @can('site.settings')
          <li>
            <a href="{{ URL::route('site.settings') }}"><i class="fa fa-cogs"></i>
              <span>Settings</span>
            </a>
          </li>
          @endcan
          @can('site.analytics')
          <li>
            <a href="{{ URL::route('site.analytics') }}"><i class="fa fa-line-chart"></i>
              <span>Analytics</span>
            </a>
          </li>
          @endcan
        </ul>
      </li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>