<aside id="sidebar" class="sidebar">

    @can('is_admin')
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>USERS</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('students.index') }}">
                            <i class="bi bi-circle"></i><span>Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('parents.index') }}">
                            <i class="bi bi-circle"></i><span>Parents</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('teachers.index') }}">
                            <i class="bi bi-circle"></i><span>Teachers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admins.index') }}">
                            <i class="bi bi-circle"></i><span>Admins</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Subjects</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @for ($i = 1; $i <= 6; $i++)
                        <li>
                            <a href="{{ route('subject.level', $i) }}">
                                <i class="bi bi-circle"></i><span>level {{ $i }}</span>
                            </a>
                        </li>
                    @endfor

                </ul>
            </li>
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Classes</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                @for ($i = 1; $i <= 6; $i++)
                    <li>
                        <a href="{{ route('getclassesbylevel', $i) }}">
                            <i class="bi bi-circle"></i><span>level {{ $i }}</span>
                        </a>
                    </li>
                @endfor

            </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link " data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>scadular</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('schedules.index') }}">
                            <i class="bi bi-circle"></i><span>scadular</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Get Repors</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportattendance') }}">
                            <i class="bi bi-circle"></i><span>Attendance</span>
                        </a>
                    </li>
                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportattendancetostudent') }}">
                            <i class="bi bi-circle"></i><span>Attendance to student</span>
                        </a>
                    </li>
                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportgrade') }}">
                            <i class="bi bi-circle"></i><span>Grade</span>
                        </a>
                    </li>

                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportgradetostudent') }}">
                            <i class="bi bi-circle"></i><span>Grade to student</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    @endcan
   @can('is_student')
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('student.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Grades</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('grades.showtostudent') }}">
                            <i class="bi bi-circle"></i><span>Grades </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Attendance</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('attendance.showtostudent') }}">
                            <i class="bi bi-circle"></i><span>Attendance</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
  @endcan
   @can('is_teacher')
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('teacher.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Classes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('teacher.getclasses') }}">
                            <i class="bi bi-circle"></i><span>Classes </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Get Repors</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportattendance') }}">
                            <i class="bi bi-circle"></i><span>Attendance</span>
                        </a>
                    </li>
                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportattendancetostudent') }}">
                            <i class="bi bi-circle"></i><span>Attendance to student</span>
                        </a>
                    </li>
                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportgrade') }}">
                            <i class="bi bi-circle"></i><span>Grade</span>
                        </a>
                    </li>

                </ul>
                <ul id="charts-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.getreportgradetostudent') }}">
                            <i class="bi bi-circle"></i><span>Grade to student</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    @endif



</aside>
