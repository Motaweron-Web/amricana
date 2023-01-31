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
                            </li>




                    </ul>
                </div>
            </li>



        </ul>
    </div>
</aside>
<!-- ================================ end Side Nav ================== -->
