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
    <content class="container-fluid pt-4">
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
                             class="items item d-flex justify-content-between" draggable="true" data-bs-toggle="modal"
                             data-bs-target="#moveGroup-{{ $group_customer->group->id }}">
                            {{ $group_customer->group->title}}
                            <span class="me-2">{{$group_customer->group->group_quantity}}</span>
                        </div>

                        <!-- popup choose tourguide -->
                        <div class="modal modalChoose chooseColor"
                             id="moveGroup-{{ $group_customer->group->id }}"
                             data-id="{{$group_customer->group->id}}">
                            <div class="modal-dialog">
                                {{--                                    <input class="input-group" data-id="{{ $group->group->id }}" value="{{ $group->group->id }}">--}}
                                <div class="modal-content modalContentChoose modal-All">
                                    <div class="d-flex justify-content-end m-3">
                                        <button type="button" class="btn-close btn-close-choose"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="tourguid">
                                                <h5 class="mb-3 fw-bold">Select Group Color</h5>
                                                <div class="d-flex">
                                                    <!-- <div> -->
                                                    <!-- <input type="radio" class="custom-check" name="box-color" id="c1"> -->
                                                    <span class="box-color"
                                                          data-group="{{ $group_customer->group->id }}"
                                                          data-color="#5FB7D4"
                                                          style="background-color: #5FB7D4;"></span>
                                                    <!-- </div> -->
                                                    <!-- <div> -->
                                                    <!-- <input type="radio" class="custom-check" name="box-color" id="c2"> -->
                                                    <span class="box-color"
                                                          data-group="{{ $group_customer->group->id }}"
                                                          data-color="#DA323F"
                                                          style="background-color: #DA323F;"></span>
                                                    <!-- </div> -->
                                                    <!-- <div> -->
                                                    <!-- <input type="radio" class="custom-check" name="box-color" id="c3"> -->
                                                    <span class="box-color"
                                                          data-group="{{ $group_customer->group->id }}"
                                                          data-color="#87554B"
                                                          style="background-color: #87554B;"></span>
                                                    <!-- </div> -->
                                                    <!-- <div> -->
                                                    <!-- <input type="radio" class="custom-check" name="box-color" id="c4"> -->
                                                    <span class="box-color"
                                                          data-group="{{ $group_customer->group->id }}"
                                                          data-color="#2F366C"
                                                          style="background-color: #2F366C;"></span>
                                                    <!-- </div> -->
                                                    <!-- <div> -->
                                                    <!-- <input type="radio" class="custom-check" name="box-color" id="c5"> -->
                                                    <span class="box-color"
                                                          data-group="{{ $group_customer->group->id }}"
                                                          data-color="#ff0000"
                                                          style="background-color: #ff0000;"></span>
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        <form action="{{ route('groupMoveCreate') }}" method="post">
                                            @csrf

                                            <input type="text" name="group_id" value="{{ $group_customer->group->id }}"
                                                   hidden>
                                            <div class="activity">
                                                <h5 class="title-choose mb-2">Select Activity</h5>
                                                <div class="form-check">
                                                    <select name="activity_id" class="form-select" id="activitySelect">
                                                        @foreach($activities as $activity)
                                                            <option
                                                                value="{{ $activity->id }}">{{ $activity->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="activity">
                                                <h5 class="title-choose mb-2">Select Tourguide</h5>
                                                <div class="form-check">
                                                    <select name="supervisor_accept_id" class="form-select"
                                                            id="tourGuideSelect">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="button">
                                                <button class="btn tn-sm btn-primary-gradient"
                                                        type="submit">
                                                    Submit
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

                        <!-- popup all student -->
                        <div class="modal" id="exampleModalAll">
                            <div class="modal-dialog">
                                <div class="modal-content modal-All">
                                    <div class="d-flex justify-content-end m-3">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td><h6 class="fw-bold">No student</h6></td>
                                                <td class="info">{{$group_customer->group->group_quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td class="name-members"><h6 class="fw-bold">Name of students</h6>
                                                </td>
                                                <td class="info">

{{--                                                    @foreach($group_customer->ticket->models as $model)--}}
{{--                                                        <div class="member" data-bs-toggle="modal"--}}
{{--                                                             data-bs-target="#exampleModal">--}}
{{--                                                            {{$model->name}}--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}

                                                    {{--                                            <div class="member">Student Number 2</div>--}}
                                                    {{--                                            <div class="member">Student Number 3</div>--}}
                                                    {{--                                            <div class="member">Student Number 4</div>--}}
                                                    {{--                                            <div class="member">Student Number 5</div>--}}
                                                    {{--                                            <div class="member">Student Number 6</div>--}}
                                                    {{--                                            <div class="member">Student Number 7</div>--}}
                                                    {{--                                            <div class="member">Student Number 8</div>--}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="fw-bold">Name of school</h6></td>
                                                <td class="info">Secondary school</td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="fw-bold">Tourguide</h6></td>
                                                <td class="info">Name of Tourguide</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- popup student -->

                        <div class="modal" id="exampleModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="d-flex justify-content-end m-3">
                                        <!-- <button type="button" class="btn-back" data-bs-toggle="modal" data-bs-target="#exampleModalAll"><i class="fa-solid fa-arrow-left"></i></button> -->
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" d-flex justify-content-center mb-5">
                                            <img class="img-tourist" src="img/person.jpeg">
                                        </div>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td><h6 class="fw-bold">Name</h6></td>
                                                <td class="info">Student Number 1</td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="fw-bold">Phone</h6></td>
                                                <td class="info">01000111000</td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="fw-bold">Name of school</h6></td>
                                                <td class="info">Secondary school</td>
                                            </tr>
                                            <tr>
                                                <td><h6 class="fw-bold">Tourguide</h6></td>
                                                <td class="info">Name of Tourguide</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                 data-bs-target="#exampleModalAll-{{ $group->id }}"
                                 data-id="{{ $group->id }}">
                                {{ $group->title }}
                                <span>{{ ($group->group_movement->accept == 'waiting') ? 'Pending' : 'Active' }}</span>
                                {{--                                <button type="button" ">Group-{{$group->group->id}}</button>--}}
                                <span class="me-2">{{ $group->group_quantity ?? ''}}</span>
                            </div>


                            <!-- popup choose tourguide -->
                            <div class="modal modalChoose chooseColor"
                                 id="exampleModalAll-{{ $group->id }}"
                                 data-id="{{$group->id}}">
                                <div class="modal-dialog">
                                    {{--                                    <input class="input-group" data-id="{{ $group->group->id }}" value="{{ $group->group->id }}">--}}
                                    <div class="modal-content modalContentChoose modal-All">
                                        <div class="d-flex justify-content-end m-3">
                                            <button type="button" class="btn-close btn-close-choose"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($group->group_movement->group_color->color == null)
                                                <div class="tourguid">
                                                    <h5 class="mb-3 fw-bold">Select Group Color</h5>
                                                    <div class="d-flex">
                                                        <!-- <div> -->
                                                        <!-- <input type="radio" class="custom-check" name="box-color" id="c1"> -->
                                                        <span class="box-color"
                                                              data-group="{{ $group->id }}"
                                                              data-color="#5FB7D4"
                                                              style="background-color: #5FB7D4;"></span>
                                                        <!-- </div> -->
                                                        <!-- <div> -->
                                                        <!-- <input type="radio" class="custom-check" name="box-color" id="c2"> -->
                                                        <span class="box-color"
                                                              data-group="{{ $group->id }}"
                                                              data-color="#DA323F"
                                                              style="background-color: #DA323F;"></span>
                                                        <!-- </div> -->
                                                        <!-- <div> -->
                                                        <!-- <input type="radio" class="custom-check" name="box-color" id="c3"> -->
                                                        <span class="box-color"
                                                              data-group="{{ $group->id }}"
                                                              data-color="#87554B"
                                                              style="background-color: #87554B;"></span>
                                                        <!-- </div> -->
                                                        <!-- <div> -->
                                                        <!-- <input type="radio" class="custom-check" name="box-color" id="c4"> -->
                                                        <span class="box-color"
                                                              data-group="{{ $group->id }}"
                                                              data-color="#2F366C"
                                                              style="background-color: #2F366C;"></span>
                                                        <!-- </div> -->
                                                        <!-- <div> -->
                                                        <!-- <input type="radio" class="custom-check" name="box-color" id="c5"> -->
                                                        <span class="box-color"
                                                              data-group="{{ $group->id }}"
                                                              data-color="#ff0000"
                                                              style="background-color: #ff0000;"></span>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            @endif
                                            <form action="{{ route('groupMove') }}" method="post">
                                                @csrf

                                                <input type="text" name="group_id"
                                                       value="{{ $group->id }}" hidden>
                                                <input type="text" name="supervisor_old"
                                                       value="{{ $group->group_movement->supervisor_accept_id }}" hidden>
                                                <div class="activity">
                                                    <h5 class="title-choose mb-2">Select Activity</h5>
                                                    <div class="form-check">
                                                        <select name="activity_id" class="form-select"
                                                                id="activitySelect">
                                                            @foreach($activities as $activity)
                                                                <option
                                                                    value="{{ $activity->id }}">{{ $activity->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="activity">
                                                    <h5 class="title-choose mb-2">Select Tourguide</h5>
                                                    <div class="form-check">
                                                        <select name="supervisor_accept_id" class="form-select"
                                                                id="tourGuideSelect">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="button">
                                                    <button class="btn tn-sm btn-primary-gradient"
                                                            type="submit">
                                                        Submit
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

                            <!-- popup all student -->
                            <div class="modal" id="exampleModalAll">
                                <div class="modal-dialog">
                                    <div class="modal-content modal-All">
                                        <div class="d-flex justify-content-end m-3">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td><h6 class="fw-bold">No student</h6></td>
                                                    <td class="info">8</td>
                                                </tr>
                                                <tr>
                                                    <td class="name-members"><h6 class="fw-bold">Name of students</h6>
                                                    </td>
                                                    <td class="info">
                                                        <div class="member" data-bs-toggle="modal"
                                                             data-bs-target="#exampleModal">
                                                            Student Number 1
                                                        </div>
                                                        <div class="member">Student Number 2</div>
                                                        <div class="member">Student Number 3</div>
                                                        <div class="member">Student Number 4</div>
                                                        <div class="member">Student Number 5</div>
                                                        <div class="member">Student Number 6</div>
                                                        <div class="member">Student Number 7</div>
                                                        <div class="member">Student Number 8</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><h6 class="fw-bold">Name of school</h6></td>
                                                    <td class="info">Secondary school</td>
                                                </tr>
                                                <tr>
                                                    <td><h6 class="fw-bold">Tourguide</h6></td>
                                                    <td class="info">Name of Tourguide</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- popup student -->
                            <div class="modal" id="exampleModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="d-flex justify-content-end m-3">
                                            <!-- <button type="button" class="btn-back" data-bs-toggle="modal" data-bs-target="#exampleModalAll"><i class="fa-solid fa-arrow-left"></i></button> -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class=" d-flex justify-content-center mb-5">
                                                <img class="img-tourist" src="img/person.jpeg">
                                            </div>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td><h6 class="fw-bold">Name</h6></td>
                                                    <td class="info">Student Number 1</td>
                                                </tr>
                                                <tr>
                                                    <td><h6 class="fw-bold">Phone</h6></td>
                                                    <td class="info">01000111000</td>
                                                </tr>
                                                <tr>
                                                    <td><h6 class="fw-bold">Name of school</h6></td>
                                                    <td class="info">Secondary school</td>
                                                </tr>
                                                <tr>
                                                    <td><h6 class="fw-bold">Tourguide</h6></td>
                                                    <td class="info">Name of Tourguide</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- </div> -->
                    </div>
                    {{--end div box--}}


                </div>
            @endforeach
        </div>


        {{--            <div class="col-md-6 col-12">--}}
        {{--                <div class="box">--}}
        {{--                    <h3 class="title-box">Mummies Hall</h3>--}}
        {{--                    <div class="d-flex justify-content-between">--}}
        {{--                        <button class="btn-report mb-2" type="submit">Report</button>--}}
        {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}


        {{--            <div class="col-md-6 col-12">--}}
        {{--                <div class="box">--}}
        {{--                    <h3 class="title-box">Tutankhamun Hall</h3>--}}
        {{--                    <div class="d-flex justify-content-between">--}}
        {{--                        <button class="btn-report mb-2" type="submit">Report</button>--}}
        {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-6 col-12">--}}
        {{--                <div class="box">--}}
        {{--                    <h3 class="title-box">Egyptian Textile Hall</h3>--}}
        {{--                    <div class="d-flex justify-content-between">--}}
        {{--                        <button class="btn-report mb-2" type="submit">Report</button>--}}
        {{--                        <button class="btn-report btn-end mb-2" type="submit">End Tour</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- popup report -->
        <div class="modal fade" id="exampleModalReport" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row mt-3 mb-3">
                            <div class="col-12 mb-3">
                                <input type="text" class="w-100 p-2 message" placeholder="Name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="number" class="w-100 p-2 message" placeholder="Phone" required>
                            </div>
                            <div class="col-12 mb-3 text-message">
                                <textarea class="w-100 p-2 message" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn-report" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--        <!-- popup choose tourguide -->--}}
        {{--        <div class="modal modalChoose" id="exampleModalAll">--}}
        {{--            <div class="modal-dialog">--}}
        {{--                <div class="modal-content modalContentChoose modal-All">--}}
        {{--                    <div class="d-flex justify-content-end m-3">--}}
        {{--                        <button type="button" class="btn-close btn-close-choose"--}}
        {{--                                data-bs-dismiss="modal" aria-label="Close"></button>--}}
        {{--                    </div>--}}
        {{--                    <div class="modal-body">--}}
        {{--                        --}}{{--                                            @if($groupColor->color == null)--}}
        {{--                        <div class="tourguid">--}}
        {{--                            <h5 class="mb-3 fw-bold">Select Group Color</h5>--}}
        {{--                            <div class="d-flex">--}}
        {{--                                <!-- <div> -->--}}
        {{--                                <!-- <input type="radio" class="custom-check" name="box-color" id="c1"> -->--}}
        {{--                                <span class="box-color" data-color="#5FB7D4"--}}
        {{--                                      style="background-color: #5FB7D4;"></span>--}}
        {{--                                <!-- </div> -->--}}
        {{--                                <!-- <div> -->--}}
        {{--                                <!-- <input type="radio" class="custom-check" name="box-color" id="c2"> -->--}}
        {{--                                <span class="box-color" data-color="#DA323F"--}}
        {{--                                      style="background-color: #DA323F;"></span>--}}
        {{--                                <!-- </div> -->--}}
        {{--                                <!-- <div> -->--}}
        {{--                                <!-- <input type="radio" class="custom-check" name="box-color" id="c3"> -->--}}
        {{--                                <span class="box-color" data-color="#87554B"--}}
        {{--                                      style="background-color: #87554B;"></span>--}}
        {{--                                <!-- </div> -->--}}
        {{--                                <!-- <div> -->--}}
        {{--                                <!-- <input type="radio" class="custom-check" name="box-color" id="c4"> -->--}}
        {{--                                <span class="box-color" data-color="#2F366C"--}}
        {{--                                      style="background-color: #2F366C;"></span>--}}
        {{--                                <!-- </div> -->--}}
        {{--                                <!-- <div> -->--}}
        {{--                                <!-- <input type="radio" class="custom-check" name="box-color" id="c5"> -->--}}
        {{--                                <span class="box-color" data-color="red"--}}
        {{--                                      style="background-color: red;"></span>--}}
        {{--                                <!-- </div> -->--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        --}}{{--                                            @endif--}}

        {{--                        <div class="activity">--}}
        {{--                            <h5 class="title-choose mb-2">Select Activity</h5>--}}
        {{--                            <div class="form-check">--}}
        {{--                                <select name="activity" class="form-select" id="activitySelect">--}}
        {{--                                    @foreach($activities as $activity)--}}
        {{--                                        <option value="{{ $activity->id }}">{{ $activity->title }}</option>--}}
        {{--                                    @endforeach--}}
        {{--                                </select>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}

        {{--                        <div class="activity">--}}
        {{--                            <h5 class="title-choose mb-2">Select Tourguide</h5>--}}
        {{--                            <div class="form-check">--}}
        {{--                                <select name="tourguide" class="form-select" id="tourGuideSelect">--}}

        {{--                                </select>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <!-- <div class="d-flex justify-content-end">--}}
        {{--                          <button class="btn-select mb-2 mt-3" type="submit">Done</button>--}}
        {{--                        </div> -->--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}


{{--        <input id="color_id" name="color" value="">--}}


        <!-- ================================ Footer ================== -->
        <!-- <footer id="loadFooter" class="footer pt-3"></footer> -->
        <!-- ================================ end Footer ================== -->
        </div>
    </content>

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


        // $('.box-color').on('click', function(){
        //     var color = $(this).data('color');
        //     alert(color);
        // });


        $('.box-color').on('click', function () {
            var boxColor = $(this).data('color');
            var group = $(this).data('group');
            var url = '{{ route('groupColor') }}';
            $.ajax({
                url: url,
                type: 'post',
                _token: '{{ csrf_token() }}',
                data: {
                    'groupId': group,
                    'boxColor': boxColor,
                },
                success: function () {
                    // location.reload();
                }
            })
        })

        $('#activitySelect').on('click', function () {
            var activity = $(this).val();
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
                    $('#tourGuideSelect').html(data);
                }
            })
        })

    </script>
@endsection
