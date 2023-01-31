@extends('sales.layouts.master_2')
@section('css')
    <link id="pagestyle" href="{{asset('museum/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('museum/css/font.awesome.css')}}" rel="stylesheet" />
    <link href="{{asset('museum/css/style.css')}}" rel="stylesheet" />

    <link href="{{asset('museum/css/bootstrap.min.css')}}" rel="stylesheet" />

@endsection
@section('content')

    {{-- assets/uploads/activities  --}}
    <!-- content -->
    <content class="container-fluid pt-4">
        <h2 class="MainTiltle mb-5 ms-4">Egyptian Museum</h2>

        <div class="row mt-5">
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
                    <div class="items item d-flex justify-content-between" draggable="true" data-bs-toggle="modal" data-bs-target="#exampleModalAll">
                        Group Number 1
                        <span class="me-2">2</span>
                    </div>
                    <div class="items item" draggable="true">
                        Group Number 2
                    </div>
                    <!-- popup all student -->
                    <div class="modal" id="exampleModalAll">
                        <div class="modal-dialog">
                            <div class="modal-content modal-All">
                                <div class="d-flex justify-content-end m-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <div class="member" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <div class="items item" draggable="true">
                        Group Number 3
                    </div>
                    <div class="items item" draggable="true">
                        Group Number 4
                    </div>
                    <div class="items item" draggable="true">
                        Group Number 5
                    </div>
                    <div class="items item" draggable="true">
                        Group Number 6
                    </div>
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
        <div class="modal fade" id="exampleModalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- popup choose tourguide -->
        <div class="modal modalChoose" id="exampleModalAll">
            <div class="modal-dialog">
                <div class="modal-content modalContentChoose modal-All">
                    <div class="d-flex justify-content-end m-3">
                        <button type="button" class="btn-close btn-close-choose" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="tourguid">
                            <h5 class="mb-3 fw-bold">Select Group Color</h5>
                            <div class="d-flex">
                                <!-- <div> -->
                                <!-- <input type="radio" class="custom-check" name="box-color" id="c1"> -->
                                <span class="box-color" data-color="#5FB7D4" style="background-color: #5FB7D4;"></span>
                                <!-- </div> -->
                                <!-- <div> -->
                                <!-- <input type="radio" class="custom-check" name="box-color" id="c2"> -->
                                <span class="box-color" data-color="#DA323F" style="background-color: #DA323F;"></span>
                                <!-- </div> -->
                                <!-- <div> -->
                                <!-- <input type="radio" class="custom-check" name="box-color" id="c3"> -->
                                <span class="box-color" data-color="#87554B" style="background-color: #87554B;"></span>
                                <!-- </div> -->
                                <!-- <div> -->
                                <!-- <input type="radio" class="custom-check" name="box-color" id="c4"> -->
                                <span class="box-color" data-color="#2F366C" style="background-color: #2F366C;"></span>
                                <!-- </div> -->
                                <!-- <div> -->
                                <!-- <input type="radio" class="custom-check" name="box-color" id="c5"> -->
                                <span class="box-color" data-color="red" style="background-color: red;"></span>
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="tourguid">
                            <h5 class="title-choose mb-2">Select Tourguide</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Tourguide N1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Tourguide N2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Tourguide N3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Tourguide N4
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                                <label class="form-check-label" for="flexRadioDefault5">
                                    Tourguide N5
                                </label>
                            </div>
                        </div>
                        <!-- <div class="d-flex justify-content-end">
                          <button class="btn-select mb-2 mt-3" type="submit">Done</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>


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
@endsection