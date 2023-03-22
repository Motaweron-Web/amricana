<!-- ================================ NavBar ================== -->
<nav id="navbarBlur"
     class="navbar navbar-main navbar-expand-lg position-sticky mt-2 top-1 p-2 px-3 mx-4 bg-white shadow-blur  border-radius-xl z-index-sticky"
     data-scroll="true">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-2">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-3 text-dark" href="#">
                    <i class="fas fa-house-day"></i>
                </a>
            </li>
            @yield('links')
        </ol>
    </nav>
    <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
        <a href="#!" class="nav-link text-body p-0">
            <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse  me-md-0 me-sm-4" id="navbar">
        <ul class="ms-md-auto navbar-nav  justify-content-end">
            @if(auth()->user()->supervisor_type == 'platform')
                <li class="nav-item d-flex align-items-center">
                    <span class="d-inline p-3">Name : {{ auth('admin')->user()->name }}</span>
                    <a href="{{route('platform.logout')}}" class="nav-link text-body font-weight-bold px-0">
                        <span class="d-inline">Log out</span>
                    </a>
                </li>
            @elseif(auth()->user()->supervisor_type == 'activity')

                <li class="nav-item d-flex align-items-center">
                    <div class="dropdown">
                    <span class="dropdown-toggle d-inline p-3" role="button" id="dropdownMenuLink"
                          data-bs-toggle="dropdown" aria-expanded="false">
                        Supervisors List
                    </span>
                        @php
                            $activity = \App\Models\SupervisorActivity::where('supervisor_id', auth('admin')->user()->id)
                                       ->whereDate('date_time', '=', \Carbon\Carbon::now()->format('Y-m-d'))->first('activity_id');

                            $supervisors_list = \App\Models\SupervisorActivity::where('activity_id', $activity->activity_id)
                                       ->whereDate('date_time', '=', \Carbon\Carbon::now()->format('Y-m-d'))->get();
                        @endphp
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($supervisors_list as $supervisor_list)
                                @if($supervisor_list->supervisor_id == auth('admin')->user()->id)
                                    @continue
                                @endif
                                <li class="m-1">{{ $supervisor_list->supervisors->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <span class="d-inline p-3">Name : {{ auth('admin')->user()->name }}</span>
                    <a href="{{route('activity.logout')}}" class="nav-link text-body font-weight-bold px-0">
                        <span class="d-inline">Log out</span>

                    </a>

                    <a href="{{route('activityBreak')}}" style="margin-left:50px"
                       class="nav-link text-body font-weight-bold px-0">
                        @php
                            $user = \App\Models\SupervisorActivity::where('supervisor_id', auth('admin')->user()->id)
                                ->whereDate('created_at', '=', \Carbon\Carbon::now()->format('Y-m-d'))->first();
                        @endphp
                        @if($user)
                            @if($user->status == 'available')
                                <span class="d-inline btn btn-sm btn-danger">Take Break</span>
                                {{--                            @else--}}
                                {{--                            <span class="d-inline btn-sm btn-primary">Back From Break</span>--}}
                            @endif
                        @endif
                    </a>


                    <a href="{{route('resetSupervisorActivity')}}" style="margin-left:50px"
                       class="nav-link text-body font-weight-bold px-0">
                        @if($user)
                            @if($user->status == 'available')
                                <span class="d-inline btn btn-sm btn-primary">change Activity</span>
                                {{--                            @else--}}
                                {{--                            <span class="d-inline btn-sm btn-primary">Back From Break</span>--}}
                            @endif
                        @endif
                    </a>
                </li>
            @endif
            {{--            @else--}}
            {{--                <li class="nav-item d-flex align-items-center">--}}
            {{--                    <a href="{{route('lo')}}" class="nav-link text-body font-weight-bold px-0">--}}
            {{--                        <span class="d-inline">Log In</span>--}}
            {{--                        <i class="fa fa-user ms-2"></i>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="#!" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- ================================ end NavBar ================== -->
