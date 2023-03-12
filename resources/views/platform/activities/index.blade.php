@extends('sales.layouts.master_2')
@section('css')
    <link id="pagestyle" href="{{asset('museum/css/app.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/font.awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/style.css')}}" rel="stylesheet"/>

    <link href="{{asset('museum/css/bootstrap.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    {{-- assets/uploads/activities  --}}
    <!-- content -->
    <style>
        .activityBlock {
            pointer-events: none;
        }
    </style>
    @if($supervisor_activities && auth()->user()->supervisor_type == 'activity')
        @if($supervisor_activities->status == 'break')
            <h1 style="margin: 95px; font-size: 120px">Your are in Break Now</h1>
            <a style="" href="{{ route('activityBreak') }}">
        <span style="margin: 0px 345px;
    width: 593px;" class="btn btn-primary">Back From Break</span>
            </a>
        @else
            <content
                class="container-fluid pt-4">
                <h2 class="MainTiltle mb-5 ms-4">Egyptian Museum</h2>

                <div class="row mt-5">
                    <div class="col-md-6 col-12">

                        {{--start div box--}}
                        <div class="box {{ (auth()->user()->supervisor_type == 'activity') ? 'activityBlock' : ''  }}"
                        >
                            <h3 class="title-box">Waiting Room</h3>
                            <div class="d-flex justify-content-between">
                                {{--                        <button class="btn-report mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalReport">--}}
                                {{--                            Report--}}
                                {{--                        </button>--}}
                                {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
                            </div>
                            <!-- <div class="item p-3" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll"> -->

                            @foreach($group_customers_waiting as $group_customer)
                                <div style="background-color: {{ $group_customer->color ?? '' }}"
                                     class="items item d-flex justify-content-between" draggable="true"
                                     data-bs-toggle="modal"
                                     data-bs-target="#showModalDetails-{{ $group_customer->group->id }}">
                                    {{ $group_customer->group->title}}
                                    <span class="me-2">{{$group_customer->group->group_quantity}}</span>
                                </div>

                                <!-- popup choose showModalDetails -->
                                <div class="modal modalChoose"
                                     id="showModalDetails-{{ $group_customer->group->id }}"
                                     data-id="{{$group_customer->group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content modalContentChoose modal-All">
                                            <div class="d-flex justify-content-end m-3">
                                                <button type="button" class="btn-close btn-close-choose"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close" id="closeChoose"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-between">
                                                <button class="btn-group mb-2" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalReport-{{ $group_customer->group->id }}">
                                                    Group Details
                                                </button>
                                                <button class="btn-report mb-2" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#moveGroup-{{ $group_customer->group->id }}">
                                                    Move group
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- popup choose showModalDetails -->

                                <!-- popup choose tourguide -->
                                <div class="modal modalChoose"
                                     id="moveGroup-{{ $group_customer->group->id }}"
                                     data-id="{{$group_customer->group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content modalContentChoose modal-All">
                                            <div class="d-flex justify-content-between p-4">
                                                <h6 style="color: white" class="alert alert-info">Recommended Activity
                                                    :{{ $group_customer->group->group_customer[0]->nextActivity->activity->title ?? '' }}</h6>

                                                <button type="button" class="btn-close btn-close-choose"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body modal-lg">
                                                <form action="{{ route('groupMoveCreate') }}" method="post">
                                                    @csrf
                                                    <input type="text" name="group_id"
                                                           value="{{ $group_customer->group->id }}"
                                                           hidden>

                                                    <div class="activity mb-lg-3 form-group">
                                                        <h6 class="title-choose mb-2">Select color</h6>
                                                        <input
                                                            style="width:200px;right: 66px;top: 16px;position: absolute;"
                                                            type="color" name="color">
                                                    </div>

                                                    <input type="text" name="supervisor_old"
                                                           value="{{ $group_customer->supervisor_accept_id }}" hidden>

                                                    <div class="activity mt-4">
                                                        <h6 class="title-choose mb-3">Select Activity</h6>
                                                        <div class="form-group">
                                                            <select style="padding: 5px;" name="activity_id"
                                                                    class="selectform form-select activitySelect"
                                                                    id="activitySelect">
                                                                @foreach($activities_test as $activity)
                                                                    <option
                                                                        value="{{ $activity->activity_id }}">{{ $activity->activity->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="activity mt-3 form-group">
                                                        <h6 class="title-choose mb-3">Select Tourguide</h6>
                                                        <div class="form-group">
                                                            <select style="padding: 5px;" name="supervisor_accept_id"
                                                                    class="form-select selectform tourGuideSelect"
                                                                    id="tourGuideSelect">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="button mt-3 d-flex justify-content-center">
                                                        <button class="btn-accept mb-2" type="submit">
                                                            Move group
                                                        </button>
                                                    </div>
                                                </form>
                                                <!-- <div class="d-flex justify-content-end">
                                                  <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- popup choose tourguide -->

                                <!-- popup group details -->
                                <div class="modal bd-example-modal-lg"
                                     id="exampleModalReport-{{ $group_customer->group->id }}"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div style="width:1260px;right: 180px;" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Group Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table border">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="color">ID</th>
                                                        <th scope="col" class="color">Name</th>
                                                        <th scope="col" class="color">Count</th>
                                                        <th scope="col" class="color">Finished Activities</th>
                                                        <th scope="col" class="color">Current Activity</th>
                                                        <th scope="col" class="color">Time left (mins)</th>
                                                        <th scope="col" class="color">Next Activity</th>
                                                        <th scope="col" class="color">cashier</th>
                                                        <th scope="col" class="color">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($group_customer->group->group_customer as $ticket)
                                                        {{--                                                    @dd($ticket->reservation)--}}
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $ticket->rev_id ?? $ticket->ticket_id }}</td>
                                                            <td>{{ ($ticket->ticket != null) ? $ticket->ticket->client->name : $ticket->reservation->client_name }}</td>
                                                            <td>{{ $ticket->quantity }}</td>
                                                            <td>No activity at moment</td>
                                                            <td>Waiting Room</td>
                                                            <td>00:00</td>
                                                            <td>{{ $ticket->nextActivity->activity->title ?? '' }}</td>
                                                            <td>{{ ($ticket->ticket != null) ? $ticket->ticket->cashier->name : $ticket->reservation->cashier->name }}</td>
                                                            <td>
                                                                <button class="btn btn-success" data-bs-toggle="modal"
                                                                        data-bs-target="#joinGroup-{{ $group_customer->group->id }}">
                                                                    join Group
                                                                </button>
                                                                {{--                                                        <button class="btn btn-primary WaitingRoom" data-id="{{ $group_customer->group->id  }}">--}}
                                                                {{--                                                            To Waiting--}}
                                                                {{--                                                        </button>--}}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- popup group details -->

                                <!-- group join -->
                                <div class="modal bd-example-modal-lg"
                                     id="joinGroup-{{ $group_customer->group->id }}" aria-labelledby=""
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div style="width:1260px;right: 180px;" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Groups</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table border">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="color">ID</th>
                                                        <th scope="col" class="color">Name</th>
                                                        <th scope="col" class="color">capacity</th>
                                                        <th scope="col" class="color">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($group_customer_join as $join_group)
                                                        @if($group_customer->group->id == $join_group->group->id)
                                                            @continue
                                                        @endif
                                                        <tr>
                                                            <td>{{ $join_group->group->id }}</td>
                                                            <td>{{ $join_group->group->title }}</td>
                                                            <td>{{ $join_group->group->GroupQuantity }}
                                                                / {{ $capacity->value }}</td>
                                                            @if($join_group->group->GroupQuantity == $capacity->value)
                                                                <td>
                                                                    <button class="joinGroup btn btn-danger" disabled>
                                                                        full
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <form action="{{ route('joinGroup') }}"
                                                                          method="post">
                                                                        @csrf
                                                                        <input hidden type="text" name="group_id"
                                                                               value="{{ $group_customer->group->id }}">
                                                                        <input hidden type="text" name="group_join"
                                                                               value="{{ $join_group->group->id }}">
                                                                        <button type="submit"
                                                                                class="joinGroup btn btn-success">
                                                                            join
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group join -->
                            @endforeach

                            <!-- </div> -->
                        </div>
                        {{--end div box--}}
                    </div>


                    {{--------------------------------------------------------------------------------------------------------- start activity-----------------------}}
                    @if(auth()->user()->supervisor_type == 'activity' && $supervisor_activities != null)
                        {{--                    @foreach($activities as $activity)--}}
                        <div class="col-md-6 col-12">


                            {{--start div box--}}
                            <div class="box"
                                 style="  background-image: linear-gradient(rgba(246, 238, 207, 0.7), rgba(246, 238, 207,0.9)), url({{URL::to($supervisor_activities->activity->photo)}}) !important;">
                                <h3 class="title-box">{{$supervisor_activities->activity->title}}</h3>
                                <div class="d-flex justify-content-between">
                                    {{--                        <button class="btn-report mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalReport">--}}
                                    {{--                            Report--}}
                                    {{--                        </button>--}}
                                    {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
                                </div>
                                <!-- <div class="item p-3" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll"> -->


                                @foreach($supervisor_activities->activity->groups as $group)
                                    <div style="background-color: {{ $group->group_movement->group_color->color ?? ''}}"
                                         class="items item d-flex justify-content-between divGroup" draggable="true"
                                         data-bs-toggle="modal"
                                         data-bs-target="#showgroupDetails-{{ $group->id }}"
                                         data-id="{{ $group->id }}">
                                        {{ $group->title }}
                                        <span>{{ ($group->group_movement->accept == 'waiting') ? 'Pending' : 'Active' }}</span>
                                        {{--                                <button type="button" ">Group-{{$group->group->id}}</button>--}}
                                        <span class="me-2">{{ $group->group_quantity ?? ''}}</span>
                                    </div>


                                    <!-- popup choose showModalDetails -->
                                    <div class="modal"
                                         id="showgroupDetails-{{ $group->id }}"
                                         data-id="{{$group->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content modalContentChoose modal-All">
                                                <div class="d-flex justify-content-end m-3">
                                                    <button type="button" class="btn-close btn-close-choose"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close" id="closeChoose"></button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-between">
                                                    <button class="btn-group mb-2" type="submit" data-bs-toggle="modal"
                                                            data-bs-target="#groupReport-{{ $group->id }}">
                                                        Group Details
                                                    </button>
                                                    <button class="btn-report mb-2" type="submit" data-bs-toggle="modal"
                                                            data-bs-target="#moveGroup-{{ $group->id }}">
                                                        Move group
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- popup choose tourguide -->
                                    <div class="modal "
                                         id="moveGroup-{{ $group->id }}"
                                         data-id="{{$group->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content modalContentChoose modal-All">
                                                <div class="d-flex justify-content-between p-4">
                                                    <h6 class="modal-title text-danger" id="exampleModalLabel">
                                                        Recommended
                                                        Activity
                                                        :</h5>
                                                        <button type="button" class="btn-close btn-close-choose"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('groupMove') }}" method="post">
                                                        @csrf
                                                        <input type="text" name="group_id" value="{{ $group->id }}"
                                                               hidden>
                                                        {{--                                                @if($group->group_color->color == null)--}}
                                                        {{--                                                <div class="activity mb-lg-3">--}}
                                                        {{--                                                    <h6 class="title-choose mb-2">Select color</h6>--}}
                                                        {{--                                                    <input style="width:200px;right: 66px;top: 16px;position: absolute;"--}}
                                                        {{--                                                           type="color" name="color">--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                                @endif--}}

                                                        <input type="text" name="supervisor_old"
                                                               value="{{ $group->supervisor_accept_id }}" hidden>

                                                        <div class="activity mt-4">
                                                            <h6 class="title-choose mb-3">Select Activity</h6>
                                                            <div class="form-check">
                                                                <select style="padding: 5px;" name="activity_id"
                                                                        class="selectform form-select activitySelect"
                                                                        id="activitySelect">
                                                                    @foreach($activities_test as $activity)
                                                                        <option
                                                                            value="{{ $activity->activity_id }}">{{ $activity->activity->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="activity mt-3">
                                                            <h6 class="title-choose mb-3">Select Tourguide</h6>
                                                            <div class="form-check">
                                                                <select style="padding: 5px;"
                                                                        name="supervisor_accept_id"
                                                                        class="form-select selectform tourGuideSelect"
                                                                        id="tourGuideSelect">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="button mt-3 d-flex justify-content-center">
                                                            <button class="btn-accept mb-2" type="submit">
                                                                Move group
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <!-- <div class="d-flex justify-content-end">
                                                      <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- popup table -->
                                    <div class="modal modalChoose bd-example-modal-lg"
                                         id="groupReport-{{ $group->id }}"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div style="width:1260px;right: 180px;" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Group Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body table-responsive">
                                                    <table class="table border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col" class="color">ID</th>
                                                            <th scope="col" class="color">Name</th>
                                                            <th scope="col" class="color">Type</th>
                                                            <th scope="col" class="color">Count</th>
                                                            <th scope="col" class="color">Finished Activities</th>
                                                            <th scope="col" class="color">Current Activity</th>
                                                            <th scope="col" class="color">Time left (mins)</th>
                                                            <th scope="col" class="color">Next Activity</th>
                                                            <th scope="col" class="color">cashier</th>
                                                            <th scope="col" class="color">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        @foreach($group->group_customer as $ticket)
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $ticket->rev_id ?? $ticket->ticket_id }}</td>
                                                                <td>{{ ($ticket->ticket != null) ? $ticket->ticket->client->name : $ticket->reservation->client_name }}</td>
                                                                <td>{{ $ticket->sale_type }}</td>
                                                                <td>{{ $ticket->quantity }}</td>
                                                                <td>{{ $ticket->lastActivity()->count() }}
                                                                    /{{ $activities->count() }} of Activities
                                                                </td>
                                                                <td>{{ $ticket->currentActivity->activity->title }}</td>
                                                                    <?php
                                                                    $now = Carbon\Carbon::parse(date('H:i:s'));
                                                                    $created_at = Carbon\Carbon::parse($ticket->nextActivity->time_group ?? '');
                                                                    $diffMinutes = $created_at->diffInMinutes($now);
//                                                            dd($diffMinutes);
                                                                    ?>
                                                                <td>{{ $diffMinutes . 'Mins' ?? '00:00' }}</td>
                                                                <td>{{ $ticket->nextActivity->activity->title ?? '' }}</td>
                                                                <td>{{ ($ticket->ticket != null) ? $ticket->ticket->cashier->name : $ticket->reservation->cashier->name }}</td>
                                                                <td>
                                                                    <button class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            {{ ($group->GroupQuantity == $capacity->value) ? 'disabled' : '' }}
                                                                            data-bs-target="#joinGroupMove-{{ $group->id }}">
                                                                        join Group
                                                                    </button>
                                                                    <button class="btn btn-primary WaitingRoom"
                                                                            data-id="{{ $group->id }}">
                                                                        To Waiting
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group join -->
                                    <div class="modal bd-example-modal-lg"
                                         id="joinGroupMove-{{ $group->id }}" aria-labelledby=""
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div style="width:1260px;right: 180px;" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Groups</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body table-responsive">
                                                    <table class="table border">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col" class="color">ID</th>
                                                            <th scope="col" class="color">Name</th>
                                                            <th scope="col" class="color">capacity</th>
                                                            <th scope="col" class="color">Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($group_customer_join as $join_group)
                                                            @if($group->id == $join_group->group->id)
                                                                @continue
                                                            @endif
                                                            <tr>
                                                                <td>{{ $join_group->group->id }}</td>
                                                                <td>{{ $join_group->group->title }}</td>
                                                                <td>{{ $join_group->group->GroupQuantity }}
                                                                    / {{ $capacity->value }}</td>
                                                                @if($join_group->group->GroupQuantity == $capacity->value)
                                                                    <td>
                                                                        <button class="joinGroup btn btn-danger"
                                                                                disabled>
                                                                            full
                                                                        </button>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <form action="{{ route('joinGroup') }}"
                                                                              method="post">
                                                                            @csrf
                                                                            <input hidden type="text" name="group_id"
                                                                                   value="{{ $group->id }}">
                                                                            <input hidden type="text" name="group_join"
                                                                                   value="{{ $join_group->group->id }}">
                                                                            <button type="submit"
                                                                                    class="joinGroup btn btn-success">
                                                                                join
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group join -->
                                @endforeach
                                <!-- </div> -->
                            </div>
                        </div>
                        {{--                    @endforeach--}}
                    @else
                        @foreach($activities as $activity)
                            <div class="col-md-6 col-12">


                                {{--start div box--}}
                                <div class="box"
                                     style="  background-image: linear-gradient(rgba(246, 238, 207, 0.7), rgba(246, 238, 207,0.9)), url({{URL::to($activity->photo)}}) !important;">
                                    <h3 class="title-box">{{$activity->title}}</h3>
                                    <div class="d-flex justify-content-between">
                                        {{--                        <button class="btn-report mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalReport">--}}
                                        {{--                            Report--}}
                                        {{--                        </button>--}}
                                        {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
                                    </div>
                                    <!-- <div class="item p-3" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll"> -->


                                    @foreach($activity->groups as $group)
                                        <div
                                            style="background-color: {{ $group->group_movement->group_color->color ?? ''}}"
                                            class="items item d-flex justify-content-between divGroup" draggable="true"
                                            data-bs-toggle="modal"
                                            data-bs-target="#showgroupDetails-{{ $group->id }}"
                                            data-id="{{ $group->id }}">
                                            {{ $group->title }}
                                            <span>{{ ($group->group_movement->accept == 'waiting') ? 'Pending' : 'Active' }}</span>
                                            {{--                                <button type="button" ">Group-{{$group->group->id}}</button>--}}
                                            <span class="me-2">{{ $group->group_quantity ?? ''}}</span>
                                        </div>


                                        <!-- popup choose showModalDetails -->
                                        <div class="modal"
                                             id="showgroupDetails-{{ $group->id }}"
                                             data-id="{{$group->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content modalContentChoose modal-All">
                                                    <div class="d-flex justify-content-end m-3">
                                                        <button type="button" class="btn-close btn-close-choose"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close" id="closeChoose"></button>
                                                    </div>
                                                    <div class="modal-body d-flex justify-content-between">
                                                        <button class="btn-group mb-2" type="submit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#groupReport-{{ $group->id }}">
                                                            Group Details
                                                        </button>
                                                        <button class="btn-report mb-2" type="submit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#moveGroup-{{ $group->id }}">
                                                            Move group
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- popup choose tourguide -->
                                        <div class="modal "
                                             id="moveGroup-{{ $group->id }}"
                                             data-id="{{$group->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content modalContentChoose modal-All">
                                                    <div class="d-flex justify-content-between p-4">
                                                        <h6 class="modal-title text-danger" id="exampleModalLabel">
                                                            Recommended
                                                            Activity
                                                            :</h5>
                                                            <button type="button" class="btn-close btn-close-choose"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('groupMove') }}" method="post">
                                                            @csrf
                                                            <input type="text" name="group_id" value="{{ $group->id }}"
                                                                   hidden>
                                                            {{--                                                @if($group->group_color->color == null)--}}
                                                            {{--                                                <div class="activity mb-lg-3">--}}
                                                            {{--                                                    <h6 class="title-choose mb-2">Select color</h6>--}}
                                                            {{--                                                    <input style="width:200px;right: 66px;top: 16px;position: absolute;"--}}
                                                            {{--                                                           type="color" name="color">--}}
                                                            {{--                                                </div>--}}
                                                            {{--                                                @endif--}}

                                                            <input type="text" name="supervisor_old"
                                                                   value="{{ $group->supervisor_accept_id }}" hidden>

                                                            <div class="activity mt-4">
                                                                <h6 class="title-choose mb-3">Select Activity</h6>
                                                                <div class="form-check">
                                                                    <select style="padding: 5px;" name="activity_id"
                                                                            class="selectform form-select activitySelect"
                                                                            id="activitySelect">
                                                                        @foreach($activities_test as $activity)
                                                                            <option
                                                                                value="{{ $activity->activity_id }}">{{ $activity->activity->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="activity mt-3">
                                                                <h6 class="title-choose mb-3">Select Tourguide</h6>
                                                                <div class="form-check">
                                                                    <select style="padding: 5px;"
                                                                            name="supervisor_accept_id"
                                                                            class="form-select selectform tourGuideSelect"
                                                                            id="tourGuideSelect">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="button mt-3 d-flex justify-content-center">
                                                                <button class="btn-accept mb-2" type="submit">
                                                                    Move group
                                                                </button>
                                                            </div>
                                                        </form>
                                                        <!-- <div class="d-flex justify-content-end">
                                                          <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- popup table -->
                                        <div class="modal modalChoose bd-example-modal-lg"
                                             id="groupReport-{{ $group->id }}"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div style="width:1260px;right: 180px;" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Group
                                                            Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body table-responsive">
                                                        <table class="table border">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col" class="color">ID</th>
                                                                <th scope="col" class="color">Name</th>
                                                                <th scope="col" class="color">Type</th>
                                                                <th scope="col" class="color">Count</th>
                                                                <th scope="col" class="color">Finished Activities</th>
                                                                <th scope="col" class="color">Current Activity</th>
                                                                <th scope="col" class="color">Time left (mins)</th>
                                                                <th scope="col" class="color">Next Activity</th>
                                                                <th scope="col" class="color">cashier</th>
                                                                <th scope="col" class="color">Actions</th>
                                                            </tr>
                                                            </thead>
                                                            @foreach($group->group_customer as $ticket)
                                                                <tbody>
                                                                <tr>
                                                                    <td>{{ $ticket->rev_id ?? $ticket->ticket_id }}</td>
                                                                    <td>{{ ($ticket->ticket != null) ? $ticket->ticket->client->name : $ticket->reservation->client_name }}</td>
                                                                    <td>{{ $ticket->sale_type }}</td>
                                                                    <td>{{ $ticket->quantity }}</td>
                                                                    <td>{{ $ticket->lastActivity()->count() }}
                                                                        /{{ $activities->count() }} of Activities
                                                                    </td>
                                                                    <td>{{ $ticket->currentActivity->activity->title }}</td>
                                                                        <?php
                                                                        $now = Carbon\Carbon::parse(date('H:i:s'));
                                                                        $created_at = Carbon\Carbon::parse($ticket->nextActivity->time_group ?? '');
                                                                        $diffMinutes = $created_at->diffInMinutes($now);
//                                                            dd($diffMinutes);
                                                                        ?>
                                                                    <td>{{ $diffMinutes . 'Mins' ?? '00:00' }}</td>
                                                                    <td>{{ $ticket->nextActivity->activity->title ?? '' }}</td>
                                                                    <td>{{ ($ticket->ticket != null) ? $ticket->ticket->cashier->name : $ticket->reservation->cashier->name }}</td>
                                                                    <td>
                                                                        <button class="btn btn-success"
                                                                                data-bs-toggle="modal"
                                                                                {{ ($group->GroupQuantity == $capacity->value) ? 'disabled' : '' }}
                                                                                data-bs-target="#joinGroupMove-{{ $group->id }}">
                                                                            join Group
                                                                        </button>
                                                                        <button class="btn btn-primary WaitingRoom"
                                                                                data-id="{{ $group->id }}">
                                                                            To Waiting
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- group join -->
                                        <div class="modal bd-example-modal-lg"
                                             id="joinGroupMove-{{ $group->id }}" aria-labelledby=""
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div style="width:1260px;right: 180px;" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Groups</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body table-responsive">
                                                        <table class="table border">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col" class="color">ID</th>
                                                                <th scope="col" class="color">Name</th>
                                                                <th scope="col" class="color">capacity</th>
                                                                <th scope="col" class="color">Actions</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($group_customer_join as $join_group)
                                                                @if($group->id == $join_group->group->id)
                                                                    @continue
                                                                @endif
                                                                <tr>
                                                                    <td>{{ $join_group->group->id }}</td>
                                                                    <td>{{ $join_group->group->title }}</td>
                                                                    <td>{{ $join_group->group->GroupQuantity }}
                                                                        / {{ $capacity->value }}</td>
                                                                    @if($join_group->group->GroupQuantity == $capacity->value)
                                                                        <td>
                                                                            <button class="joinGroup btn btn-danger"
                                                                                    disabled>
                                                                                full
                                                                            </button>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <form action="{{ route('joinGroup') }}"
                                                                                  method="post">
                                                                                @csrf
                                                                                <input hidden type="text"
                                                                                       name="group_id"
                                                                                       value="{{ $group->id }}">
                                                                                <input hidden type="text"
                                                                                       name="group_join"
                                                                                       value="{{ $join_group->group->id }}">
                                                                                <button type="submit"
                                                                                        class="joinGroup btn btn-success">
                                                                                    join
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- group join -->
                                    @endforeach
                                    <!-- </div> -->
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </content>
        @endif
    @elseif(auth()->user()->supervisor_type == 'platform')
        <content
            class="container-fluid pt-4 {{ (auth()->user()->supervisor_type == 'activity') ? 'activityBlock' : ''  }}">
            <h2 class="MainTiltle mb-5 ms-4">Egyptian Museum</h2>

            <div class="row mt-5">
                <div class="col-md-6 col-12">

                    {{--start div box--}}
                    <div class="box"
                    >
                        <h3 class="title-box">Waiting Room</h3>
                        <div class="d-flex justify-content-between">
                            {{--                        <button class="btn-report mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalReport">--}}
                            {{--                            Report--}}
                            {{--                        </button>--}}
                            {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
                        </div>
                        <!-- <div class="item p-3" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll"> -->
                        @foreach($group_customers_waiting as $group_customer)
                            <div style="background-color: {{ $group_customer->color ?? '' }}"
                                 class="items item d-flex justify-content-between" draggable="true"
                                 data-bs-toggle="modal"
                                 data-bs-target="#showModalDetails-{{ $group_customer->group->id }}">
                                {{ $group_customer->group->title}}
                                <span class="me-2">{{$group_customer->group->group_quantity}}</span>
                            </div>

                            <!-- popup choose showModalDetails -->
                            <div class="modal modalChoose"
                                 id="showModalDetails-{{ $group_customer->group->id }}"
                                 data-id="{{$group_customer->group->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content modalContentChoose modal-All">
                                        <div class="d-flex justify-content-end m-3">
                                            <button type="button" class="btn-close btn-close-choose"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close" id="closeChoose"></button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-between">
                                            <button class="btn-group mb-2" type="submit" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalReport-{{ $group_customer->group->id }}">
                                                Group Details
                                            </button>
                                            <button class="btn-report mb-2" type="submit" data-bs-toggle="modal"
                                                    data-bs-target="#moveGroup-{{ $group_customer->group->id }}">
                                                Move group
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- popup choose showModalDetails -->

                            <!-- popup choose tourguide -->
                            <div class="modal modalChoose"
                                 id="moveGroup-{{ $group_customer->group->id }}"
                                 data-id="{{$group_customer->group->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content modalContentChoose modal-All">
                                        <div class="d-flex justify-content-between p-4">
                                            <h6 style="color: white" class="alert alert-info">Recommended Activity
                                                :{{ $group_customer->group->group_customer[0]->nextActivity->activity->title ?? '' }}</h6>

                                            <button type="button" class="btn-close btn-close-choose"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body modal-lg">
                                            <form action="{{ route('groupMoveCreate') }}" method="post">
                                                @csrf
                                                <input type="text" name="group_id"
                                                       value="{{ $group_customer->group->id }}"
                                                       hidden>

                                                <div class="activity mb-lg-3 form-group">
                                                    <h6 class="title-choose mb-2">Select color</h6>
                                                    <input style="width:200px;right: 66px;top: 16px;position: absolute;"
                                                           type="color" name="color">
                                                </div>

                                                <input type="text" name="supervisor_old"
                                                       value="{{ $group_customer->supervisor_accept_id }}" hidden>

                                                <div class="activity mt-4">
                                                    <h6 class="title-choose mb-3">Select Activity</h6>
                                                    <div class="form-group">
                                                        <select style="padding: 5px;" name="activity_id"
                                                                class="selectform form-select activitySelect"
                                                                id="activitySelect">
                                                            @foreach($activities_test as $activity)
                                                                <option
                                                                    value="{{ $activity->activity_id }}">{{ $activity->activity->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="activity mt-3 form-group">
                                                    <h6 class="title-choose mb-3">Select Tourguide</h6>
                                                    <div class="form-group">
                                                        <select style="padding: 5px;" name="supervisor_accept_id"
                                                                class="form-select selectform tourGuideSelect"
                                                                id="tourGuideSelect">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="button mt-3 d-flex justify-content-center">
                                                    <button class="btn-accept mb-2" type="submit">
                                                        Move group
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- <div class="d-flex justify-content-end">
                                              <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- popup choose tourguide -->

                            <!-- popup group details -->
                            <div class="modal bd-example-modal-lg"
                                 id="exampleModalReport-{{ $group_customer->group->id }}"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div style="width:1260px;right: 180px;" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Group Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body table-responsive">
                                            <table class="table border">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="color">ID</th>
                                                    <th scope="col" class="color">Name</th>
                                                    <th scope="col" class="color">Kid Name</th>
                                                    <th scope="col" class="color">Count</th>
                                                    <th scope="col" class="color">Finished Activities</th>
                                                    <th scope="col" class="color">Current Activity</th>
                                                    <th scope="col" class="color">Time left (mins)</th>
                                                    <th scope="col" class="color">Next Activity</th>
                                                    <th scope="col" class="color">cashier</th>
                                                    <th scope="col" class="color">Actions</th>
                                                </tr>
                                                </thead>
                                                @foreach($group_customer->group->group_customer as $ticket)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $ticket->ticket_id }}</td>
                                                        <td>{{ $ticket->ticket->client->name }}</td>
                                                        <td>{{ $ticket->member_name ?? '--' }}</td>
                                                        <td>{{ $ticket->quantity }}</td>
                                                        <td>No activity at moment</td>
                                                        <td>Waiting Room</td>
                                                        <td>00:00</td>
                                                        <td>{{ $ticket->nextActivity->activity->title ?? '' }}</td>
                                                        <td>{{ $ticket->ticket->cashier->name }}</td>
                                                        <td>
                                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                                    data-bs-target="#joinGroup-{{ $group_customer->group->id }}">
                                                                join Group
                                                            </button>
                                                            {{--                                                        <button class="btn btn-primary WaitingRoom" data-id="{{ $group_customer->group->id  }}">--}}
                                                            {{--                                                            To Waiting--}}
                                                            {{--                                                        </button>--}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- popup group details -->

                            <!-- group join -->
                            <div class="modal bd-example-modal-lg"
                                 id="joinGroup-{{ $group_customer->group->id }}" aria-labelledby=""
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div style="width:1260px;right: 180px;" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Groups</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body table-responsive">
                                            <table class="table border">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="color">ID</th>
                                                    <th scope="col" class="color">Name</th>
                                                    <th scope="col" class="color">capacity</th>
                                                    <th scope="col" class="color">Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($group_customer_join as $join_group)
                                                    @if($group_customer->group->id == $join_group->group->id)
                                                        @continue
                                                    @endif
                                                    <tr>
                                                        <td>{{ $join_group->group->id }}</td>
                                                        <td>{{ $join_group->group->title }}</td>
                                                        <td>{{ $join_group->group->GroupQuantity }}
                                                            / {{ $capacity->value }}</td>
                                                        @if($join_group->group->GroupQuantity == $capacity->value)
                                                            <td>
                                                                <button class="joinGroup btn btn-danger" disabled>
                                                                    full
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <form action="{{ route('joinGroup') }}" method="post">
                                                                    @csrf
                                                                    <input hidden type="text" name="group_id"
                                                                           value="{{ $group_customer->group->id }}">
                                                                    <input hidden type="text" name="group_join"
                                                                           value="{{ $join_group->group->id }}">
                                                                    <button type="submit"
                                                                            class="joinGroup btn btn-success">
                                                                        join
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group join -->
                        @endforeach

                        <!-- </div> -->
                    </div>
                    {{--end div box--}}
                </div>


                {{--------------------------------------------------------------------------------------------------------- start activity-----------------------}}
                @foreach($activities as $activity)
                    <div class="col-md-6 col-12">


                        {{--start div box--}}
                        <div class="box"
                             style="  background-image: linear-gradient(rgba(246, 238, 207, 0.7), rgba(246, 238, 207,0.9)), url({{URL::to($activity->photo)}}) !important;">
                            <h3 class="title-box">{{$activity->title}}</h3>
                            <div class="d-flex justify-content-between">
                                {{--                        <button class="btn-report mb-2" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModalReport">--}}
                                {{--                            Report--}}
                                {{--                        </button>--}}
                                {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
                            </div>
                            <!-- <div class="item p-3" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll"> -->


                            @foreach($activity->groups as $group)
                                <div style="background-color: {{ $group->group_movement->group_color->color ?? ''}}"
                                     class="items item d-flex justify-content-between divGroup" draggable="true"
                                     data-bs-toggle="modal"
                                     data-bs-target="#showgroupDetails-{{ $group->id }}"
                                     data-id="{{ $group->id }}">
                                    {{ $group->title }}
                                    <span>{{ ($group->group_movement->accept == 'waiting') ? 'Pending' : 'Active' }}</span>
                                    {{--                                <button type="button" ">Group-{{$group->group->id}}</button>--}}
                                    <span class="me-2">{{ $group->group_quantity ?? ''}}</span>
                                </div>


                                <!-- popup choose showModalDetails -->
                                <div class="modal"
                                     id="showgroupDetails-{{ $group->id }}"
                                     data-id="{{$group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content modalContentChoose modal-All">
                                            <div class="d-flex justify-content-end m-3">
                                                <button type="button" class="btn-close btn-close-choose"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close" id="closeChoose"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-between">
                                                <button class="btn-group mb-2" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#groupReport-{{ $group->id }}">
                                                    Group Details
                                                </button>
                                                <button class="btn-report mb-2" type="submit" data-bs-toggle="modal"
                                                        data-bs-target="#moveGroup-{{ $group->id }}">
                                                    Move group
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- popup choose tourguide -->
                                <div class="modal "
                                     id="moveGroup-{{ $group->id }}"
                                     data-id="{{$group->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content modalContentChoose modal-All">
                                            <div class="d-flex justify-content-between p-4">
                                                <h6 class="modal-title text-danger" id="exampleModalLabel">Recommended
                                                    Activity
                                                    :</h5>
                                                    <button type="button" class="btn-close btn-close-choose"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('groupMove') }}" method="post">
                                                    @csrf
                                                    <input type="text" name="group_id" value="{{ $group->id }}"
                                                           hidden>
                                                    {{--                                                @if($group->group_color->color == null)--}}
                                                    {{--                                                <div class="activity mb-lg-3">--}}
                                                    {{--                                                    <h6 class="title-choose mb-2">Select color</h6>--}}
                                                    {{--                                                    <input style="width:200px;right: 66px;top: 16px;position: absolute;"--}}
                                                    {{--                                                           type="color" name="color">--}}
                                                    {{--                                                </div>--}}
                                                    {{--                                                @endif--}}

                                                    <input type="text" name="supervisor_old"
                                                           value="{{ $group->supervisor_accept_id }}" hidden>

                                                    <div class="activity mt-4">
                                                        <h6 class="title-choose mb-3">Select Activity</h6>
                                                        <div class="form-check">
                                                            <select style="padding: 5px;" name="activity_id"
                                                                    class="selectform form-select activitySelect"
                                                                    id="activitySelect">
                                                                @foreach($activities_test as $activity)
                                                                    <option
                                                                        value="{{ $activity->activity_id }}">{{ $activity->activity->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="activity mt-3">
                                                        <h6 class="title-choose mb-3">Select Tourguide</h6>
                                                        <div class="form-check">
                                                            <select style="padding: 5px;" name="supervisor_accept_id"
                                                                    class="form-select selectform tourGuideSelect"
                                                                    id="tourGuideSelect">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="button mt-3 d-flex justify-content-center">
                                                        <button class="btn-accept mb-2" type="submit">
                                                            Move group
                                                        </button>
                                                    </div>
                                                </form>
                                                <!-- <div class="d-flex justify-content-end">
                                                  <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- popup table -->
                                <div class="modal modalChoose bd-example-modal-lg"
                                     id="groupReport-{{ $group->id }}"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div style="width:1260px;right: 180px;" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Group Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table border">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="color">ID</th>
                                                        <th scope="col" class="color">Name</th>
                                                        <th scope="col" class="color">Kid Name</th>
                                                        <th scope="col" class="color">Count</th>
                                                        <th scope="col" class="color">Finished Activities</th>
                                                        <th scope="col" class="color">Current Activity</th>
                                                        <th scope="col" class="color">Time left (mins)</th>
                                                        <th scope="col" class="color">Next Activity</th>
                                                        <th scope="col" class="color">cashier</th>
                                                        <th scope="col" class="color">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($group->group_customer as $ticket)
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $ticket->ticket_id }}</td>
                                                            <td>{{ $ticket->ticket->client->name }}</td>
                                                            <td>{{ $ticket->member_name }}</td>
                                                            <td>{{ $ticket->quantity }}</td>
                                                            <td>{{ $ticket->lastActivity()->count() }}
                                                                /{{ $activities->count() }} of Activities
                                                            </td>
                                                            <td>{{ $ticket->currentActivity->activity->title }}</td>
                                                                <?php
                                                                $now = Carbon\Carbon::parse(date('H:i:s'));
                                                                $created_at = Carbon\Carbon::parse($ticket->nextActivity->time_group ?? '');
                                                                $diffMinutes = $created_at->diffInMinutes($now);
//                                                            dd($diffMinutes);
                                                                ?>
                                                            <td>{{ $diffMinutes . 'Mins' ?? '00:00' }}</td>
                                                            <td>{{ $ticket->nextActivity->activity->title ?? '' }}</td>
                                                            <td>{{ $ticket->ticket->cashier->name }}</td>
                                                            <td>
                                                                <button class="btn btn-success" data-bs-toggle="modal"
                                                                        {{ ($group->GroupQuantity == $capacity->value) ? 'disabled' : '' }}
                                                                        data-bs-target="#joinGroupMove-{{ $group->id }}">
                                                                    join Group
                                                                </button>
                                                                <button class="btn btn-primary WaitingRoom"
                                                                        data-id="{{ $group->id }}">
                                                                    To Waiting
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group join -->
                                <div class="modal bd-example-modal-lg"
                                     id="joinGroupMove-{{ $group->id }}" aria-labelledby=""
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div style="width:1260px;right: 180px;" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Groups</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body table-responsive">
                                                <table class="table border">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="color">ID</th>
                                                        <th scope="col" class="color">Name</th>
                                                        <th scope="col" class="color">capacity</th>
                                                        <th scope="col" class="color">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($group_customer_join as $join_group)
                                                        @if($group->id == $join_group->group->id)
                                                            @continue
                                                        @endif
                                                        <tr>
                                                            <td>{{ $join_group->group->id }}</td>
                                                            <td>{{ $join_group->group->title }}</td>
                                                            <td>{{ $join_group->group->GroupQuantity }}
                                                                / {{ $capacity->value }}</td>
                                                            @if($join_group->group->GroupQuantity == $capacity->value)
                                                                <td>
                                                                    <button class="joinGroup btn btn-danger" disabled>
                                                                        full
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <form action="{{ route('joinGroup') }}"
                                                                          method="post">
                                                                        @csrf
                                                                        <input hidden type="text" name="group_id"
                                                                               value="{{ $group->id }}">
                                                                        <input hidden type="text" name="group_join"
                                                                               value="{{ $join_group->group->id }}">
                                                                        <button type="submit"
                                                                                class="joinGroup btn btn-success">
                                                                            join
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- group join -->
                            @endforeach
                            <!-- </div> -->
                        </div>
                    </div>
                @endforeach
            </div>
        </content>
    @else
        @if(auth()->user()->supervisor_type == 'activity')
            <content class="container-fluid pt-4" style="width: 500px">
                <form action="{{ route('addActivity') }}" method="POST">
                    @csrf
                    <input name="supervisor" hidden value="{{ auth()->user()->id }}">
                    <label for="activity">Select Activity</label>
                    <select name="activity" class="form-control">
                        <option value="" selected disabled>Please Select Activity</option>
                        @foreach($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->title }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn btn-primary justify-content-center" type="submit">Add</button>
                </form>
            </content>
        @endif
    @endif

@endsection

@section('js')

    <script src="{{asset('museum/js/popper.min.js')}}"></script>
    <script src="{{asset('museum/js/bootstrap.min.js')}}"></script>

    <!-- <script src="js/all.min.js"></script> -->
    <script src="{{asset('museum/js/bootstrap.bundle.min.js')}}"></script>

    <!-- drag and drop -->
    <script src="{{asset('museum/js/main.js')}}"></script>

    <!-- plugins -->
    <script src="{{asset('museum/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <!-- <script src="js/plugins/smooth-scrollbar.min.js"></script> -->
    <!-- <script src="js/plugins/chartjs.min.js"></script> -->
    <!-- <script src="js/plugins/threejs.js"></script> -->
    <!-- <script src="js/plugins/orbit-controls.js"></script> -->
    <!-- dashboard Js -->
    <script src="{{asset('museum/js/app.min.js')}}"></script>
    <!-- custom Js -->
    <!-- <script src="js/custom.js"></script> -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <!-- <script>
      $(document).ready(function(){
        $("a.open-modal").click(function(){
          $(this).modal({
            fadeDuration:200,
            showClose:false
          })
          return false;
        })
      })
    </script> -->

    <script>

        function playAudio() {
            var x = new Audio('{{ asset('sound/eventually-590.ogg') }}');
            // Show loading animation.
            var playPromise = x.play();

            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    x.play();
                })
                    .catch(error => {
                    });

            }
        }

        $('.activitySelect').on('click', function () {
            var activity = $(this).val();

            // var color = $('.input-color').val();
            // alert(color);
            var url = '{{ route('selectTourguide') }}';

            // alert('color : '+boxColor + ' group Id : '+group);
            $.ajax({
                url: url,
                type: 'post',
                _token: '{{ csrf_token() }}',
                data: {
                    'activity_id': activity,
                },
                success: function (data) {
                    $('.tourGuideSelect').html(data);
                }
            })
        })

        $('.WaitingRoom').on('click', function () {
            var group = $(this).data('id');
            var url = '{{ route('returnWaitingRoom') }}';
            $.ajax({
                url: url,
                type: 'post',
                _token: '{{ csrf_token() }}',
                data: {
                    'group': group,
                },
                success: function (data) {
                    if (data.status === 200) {
                        toastr.success('Group Move To Waiting Activity Successfully');
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }
                }
            })
        })

        $('#closeChoose').on('click', function () {
            location.reload();
        })

        $(document).ready(function () {
            toastr.options.timeOut = 5000;
            @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
            @endif
        });

        // $('.activityBlock').css('', 'none');

    </script>
@endsection
