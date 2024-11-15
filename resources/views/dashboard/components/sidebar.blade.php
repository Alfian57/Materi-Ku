<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.index') }}" class="d-flex gap-3 align-items-center">
                    <img src="/assets/static/logo/logo-transparent.png" alt="Logo" style="width: 50px; height: auto;">
                    <h3 class="pt-3">Materi-Ku</h3>
                </a>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <!-- Menu -->
                <li class="sidebar-title">Menu</li>
                <li
                    class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }} {{ Request::is('dashboard/learn*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <!-- Application Management (Admin Role) -->
                @if (auth()->user()->accountable_type === 'App\\Models\\Admin')
                    <li class="sidebar-title">Application Management</li>
                    <li class="sidebar-item {{ Request::is('dashboard/students*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.students.index') }}" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Student</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard/teachers*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.teachers.index') }}" class='sidebar-link'>
                            <i class="bi bi-person-badge"></i>
                            <span>Teacher</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard/admins*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admins.index') }}" class='sidebar-link'>
                            <i class="bi bi-person-gear"></i>
                            <span>Admin</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard/course-categories*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.course-categories.index') }}" class='sidebar-link'>
                            <i class="bi bi-book"></i>
                            <span>Course Category</span>
                        </a>
                    </li>
                @endif

                <!-- Teacher Role -->
                @if (auth()->user()->accountable_type === 'App\\Models\\Teacher')
                    <li class="sidebar-title">Main Menu</li>
                    <li class="sidebar-item {{ Request::is('dashboard/courses*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.courses.index') }}" class='sidebar-link'>
                            <i class="bi bi-journal-bookmark"></i>
                            <span>Course</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard/blocked-reviews*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.reviews.getBlocked') }}" class='sidebar-link'>
                            <i class="bi bi-shield-x"></i>
                            <span>Blocked Review</span>
                        </a>
                    </li>
                @endif

                <!-- Student Role -->
                @if (auth()->user()->accountable_type === 'App\\Models\\Student')
                    <li class="sidebar-title">Main Menu</li>
                    <li class="sidebar-item {{ Request::is('dashboard/review-histories*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.student.reviews.histories') }}" class='sidebar-link'>
                            <i class="bi bi-card-checklist"></i>
                            <span>Review History</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard/assignment-histories*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.student.assignment.histories') }}" class='sidebar-link'>
                            <i class="bi bi-clock-history"></i>
                            <span>Assignment History</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>


    </div>
</div>
