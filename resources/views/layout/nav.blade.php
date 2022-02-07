<div class="header-area header-transparrent">
    <div class="headder-top header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-2">
                    <!-- Logo -->
                    <div class="logo">
                        <h3>Job Seeker</h3>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="menu-wrapper">
                        <!-- Main-menu -->
                        <div class="main-menu">
                            <nav class="d-none d-lg-block">
                                <ul id="navigation">
                                    @if(Auth::user())
                                        @if((Auth::guard('job_seeker')->check()) && (Auth::user()->getTable() == 'job_seeker'))
                                            <li><a href="{{url('find-job')}}" class="{{ request()->is('find-job') ? 'active' : '' }}">Find a Job</a></li>
                                            <li><a href="{{ url('job-applied') }}" class="{{ request()->is('job-applied') ? 'active' : '' }}">Job Applied</a></li>
                                        @endif
                                        @if((Auth::guard('recruiter')->check()) && (Auth::user()->getTable() == 'recruiter'))
                                        <li><a href="{{url('applied-job')}}" class="{{ request()->is('applied-job') ? 'active' : '' }}">Job Applied</a></li>
                                            <li><a href="{{url('job-post')}}" class="{{ request()->is('job-post') ? 'active' : '' }}">Job Post</a></li>
                                            <li><a href="{{url('candidates')}}" class="{{ request()->is('candidates') ? 'active' : '' }}">Candidates</a></li>
                                        @endif
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <!-- Header-btn -->
                        <div class="header-btn d-none f-right d-lg-block">
                            @if(Auth::user())
                                <a href="{{ url('logout') }}" class="btn head-btn1">Logout</a>
                            @else
                                <a href="{{ url('job-seeker') }}" class="btn head-btn1">Job Seeker</a>
                                <a href="{{ url('recruiter') }}" class="btn head-btn2">Recruiter</a>
                            @endif

                        </div>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>