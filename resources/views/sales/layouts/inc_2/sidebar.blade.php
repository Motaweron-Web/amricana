<!-- ================================ Side Nav ============== -->
<aside id="sidenav-main"
       class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <img src="{{asset($setting->logo)}}" class="navbar-brand-img h-100" alt="main_logo">
            <!-- <span class="ms-1 font-weight-bold">{{$setting->title}}</span> -->
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- nav-item  -->


            {{--            <li class="nav-item">--}}
            {{--                <a href="{{route('forceupdate')}}" class="nav-link" id="mainHome">--}}
            {{--                    <div--}}
            {{--                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">--}}
            {{--                        <i class="fas fa-home"></i>--}}
            {{--                    </div>--}}
            {{--                    <span class="nav-link-text ms-1">Sync database</span>--}}
            {{--                </a>--}}
            {{--            </li>--}}


            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#groupSale" class="nav-link " id="main-group"
                   aria-controls="groupSale" role="button"
                   aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                        <i class="fad fa-bus-school"></i>
                    </div>
                    <span class="nav-link-text ms-1">Activities</span>
                </a>
                <div class="collapse" id="groupSale">
                    <ul class="nav ms-4 ps-3">
                        <li class="nav-item createReservation">
                            <a class="nav-link createReservation" href="{{route('platform')}}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal"> All Activities </span>
                            </a>
{{--                            @if(auth('admin')->user()->supervisor_type == 'activity')--}}
{{--                                <a class="nav-link createReservation" href="{{route('joinActivaties')}}">--}}
{{--                                    <span class="sidenav-mini-icon"> A </span>--}}
{{--                                    <span class="sidenav-normal"> Join Activities </span>--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        </li>

                    </ul>
                </div>
            </li>

            @if(auth('admin')->user()->supervisor_type == 'activity')

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#request" class="nav-link " id="main-group"
                       aria-controls="groupSale" role="button"
                       aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fad fa-bus-school"></i>
                        </div>
                        <span class="nav-link-text ms-1">Requests</span>
                    </a>
                    <div class="collapse" id="request">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item createReservation">
                                <a class="nav-link createReservation" href="{{route('requests')}}">
                                    <span class="sidenav-mini-icon"> A </span>
                                    <span class="sidenav-normal">Requests</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endif

            @if(auth('admin')->user()->supervisor_type == 'platform')

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#groupMoves" class="nav-link " id="main-group"
                       aria-controls="groupSale" role="button"
                       aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fad fa-bus-school"></i>
                        </div>
                        <span class="nav-link-text ms-1">Group Moves</span>
                    </a>
                    <div class="collapse" id="groupMoves">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item createReservation">
                                <a class="nav-link createReservation" href="{{route('groupMoves')}}">

                                    <span class="sidenav-normal">Group Moves</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#supervisorMoving" class="nav-link " id="main-group"
                       aria-controls="groupSale" role="button"
                       aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <i class="fad fa-bus-school"></i>
                        </div>
                        <span class="nav-link-text ms-1">Supervisor Status</span>
                    </a>
                    <div class="collapse" id="supervisorMoving">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item createReservation">
                                <a class="nav-link createReservation" href="{{route('supervisorMoving')}}">
                                    <span class="sidenav-normal">Supervisor Status</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endif

        </ul>
    </div>
</aside>
<!-- ================================ end Side Nav ================== -->
