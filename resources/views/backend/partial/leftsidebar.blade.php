
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
      @can('classwork.index')
        <?php
          // $topic_assignments = App\Assignment::where('topic_id', $topic-->get()
          // use App\Http\Helpers\AppHelper;
          $modules = App\Topic::where('status', AppHelper::ACTIVE)->get(); 

          
          
          if(Auth::user()->role->role_id === 1 || Auth::user()->role->role_id === 8) {
            // Admin
              $modules =  App\Topic::where('status', AppHelper::ACTIVE)->get();
              $bySubjects = $modules->keyBy('subject_id');
          }
          
          if(Auth::user()->role->role_id === 2){ 
              //Teacher
              $modules =  App\Topic::where('status', AppHelper::ACTIVE)
                      ->where('teacher_id', Auth::user()->employee->id)
                      ->get();
              
              $bySubjects = $modules->keyBy('subject_id');
          }

          if(Auth::user()->role->role_id === 3){ 
              //Teacher
              $modules =  App\Topic::where('status', AppHelper::ACTIVE)
                      ->where('class_id', Auth::user()->student->registration[0]->class->id)
                      ->get();
              
              $bySubjects = $modules->keyBy('subject_id');
          }
          
          // $modules = $modules->groupBy('subject_id', 'class_id');
        ?>
          <li @if($modules->count() > 0)  class="treeview" @endif >
            <a @if($modules->count() <= 0 ||  $modules->count() == null) href="{{ URL::route('classwork.index') }}"@else href="#" @endif>
            <i class="fa fa-calculator"></i> <span>Class Activities</span>
            @if($modules->count() > 0)
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
          </a>
            
          <ul class="treeview-menu">
            <li @if($modules->count() > 0)  class="treeview" @endif >
              <a href="{{ URL::route('classwork.index') }}">
                <i class="fa fa-archive"></i> <span>By Class Modules</span>
                @if($modules->count() > 0)
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                @endif
              </a>
              @if($modules->count() > 0)
                <ul class="treeview-menu">
                  <li>
                    <a href="{{ URL::route('classwork.index') }}">
                      <i class="fa fa-book"></i> <span>All Modules</span>
                    </a>
                  </li>
                  @foreach($modules as $module)
                    <li>
                      <a href="{{ URL::route('topic.show', $module->id) }}">
                        <i class="fa fa-book"></i> <span>{{ $module->name }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              @endif
            </li>
            <li @if($bySubjects->count() > 0) class="treeview" @endif >
              <a href="{{ URL::route('academic.subject') }}">
                <i class="fa icon-subject"></i> <span>By Subjects</span>
                 @if($bySubjects->count() > 0)
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  @endif
              </a>
              @if($bySubjects->count() > 0)
                <ul class="treeview-menu">
                  @foreach($bySubjects as $subject)
                    <li
                    @if($modules->where('subject_id', $subject->subject->id)->count() > 0)
                    class="treeview"
                    @endif
                    >
                      <a href="{{ URL::route('topic.show', $module->id) }}">
                        <i class="fa icon-subject"></i> <span>{{ $subject->subject->name }}</span>
                        @if($modules->where('subject_id', $subject->subject->id)->count() > 0)
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        @endif
                      </a>
                      @if($modules->where('subject_id', $subject->subject->id)->count() > 0)
                        <ul class="treeview-menu">
                        @foreach($modules as $module)
                          @if($module->subject->id === $subject->subject->id) 
                            <li>
                              <a href="{{ URL::route('topic.show', $module->id) }}">
                                <i class="fa fa-book"></i> <span>{{ $module->name }}</span>
                              </a>
                            </li>
                          @endif
                        @endforeach
                        </ul>
                      @endif
                    </li>
                  @endforeach
                </ul>
              @endif
            </li>
          </ul>
        </li>
      @endcan
      @can('teacher.index')
      <li class="treeview">
        
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa icon-teacher"></i>
          <span>Facilitators</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ URL::route('teacher.index') }}">
              <i class="fa icon-teacher"></i> <span>Teachers</span>
            </a>
          </li>          
          <li>
            <a href="#">
              <i class="fa fa-folder"></i> <span>Manage Classroom</span>
            </a>
          </li>
        </ul>
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
          <li>
            <a href="{{ URL::route('student_attendance.index') }}">
              <i class="fa icon-student"></i> <span>Student Attendance</span>
            </a>
          </li>
            <li>
            <a href="{{ URL::route('employee_attendance.index') }}">
              <i class="fa icon-member"></i> <span>Employee Attendance</span>
            </a>
          </li>
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

          {{--<li>--}}
          {{--<a href="#">--}}
          {{--<i class="fa fa-clock-o"></i><span>Routine</span>--}}
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
      @can('user.index')
        <li>
          <a href="{{ URL::route('user.index') }}">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
      @endcan

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
{{--              @can('report.student_monthly_attendance')--}}
                <li>
                  <a href="{{ URL::route('report.student_monthly_attendance') }}">
                    <i class="fa icon-attendancereport"></i> <span>Monthly Attendance</span>
                  </a>
                </li>
              {{--@endcan--}}
                <li>
                  <a href="{{route('report.student_list')}}">
                    <i class="fa icon-student"></i> <span>Student List</span>
                  </a>
                </li>
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
              <li>
                <a href="{{ URL::route('report.employee_monthly_attendance') }}"><i class="fa icon-attendancereport"></i> <span>Monthly Attendance</span></a>
              </li>
              <li>
                <a href="{{route('report.employee_list')}}"><i class="fa icon-teacher"></i> <span>Employee List</span></a>
              </li>

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
              <li>
                <a href="{{route('report.marksheet_pub')}}"><i class="fa fa-file-pdf-o"></i><span>Marksheet Public</span></a>
              </li>
            </ul>
          </li>
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
