@extends('sales.layouts.master_2')
@section('css')
    <link id="pagestyle" href="{{asset('museum/css/app.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/font.awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/style.css')}}" rel="stylesheet"/>

    <link href="{{asset('museum/css/bootstrap.min.css')}}" rel="stylesheet"/>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">#</th>
                                <th class="min-w-125px">Date</th>
                                <th class="min-w-125px">Group</th>
                                <th class="min-w-125px">Super Visor</th>
                                <th class="min-w-125px">Activity</th>
                                <th class="min-w-125px">Accept</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-50px rounded-end">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($groupMovment as $group)

                                <tr>
                                    <input type="text" hidden value="{{ auth()->user()->id }}" id="supervisor_id">
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->date_time }}</td>
                                    <td id="group_id" data-id="{{ $group->group_id }}">{{ $group->group->title  }}</td>
                                    <td>{{ $group->supervisor->id  }}</td>
                                    <td>{{ $group->activity->id }}</td>
                                    <td>{{ $group->accept }}</td>
                                    <td id="status" data-id="{{ $group->status }}">{{ $group->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-pill btn-info-light btnAccept"><i
                                                class="fa fa-check"></i></button>
                                        {{--                                            <button class="btn btn-pill btn-danger-light"><i class="fa-thin fa-xmark"></i></button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

    <!-- dashboard Js -->
    <script src="{{asset('museum/js/app.min.js')}}"></script>


    <script>
        $('.btnAccept').on('click', function (e) {
            e.preventDefault();


            var group = $('#group_id').data('id');
            var supervisor = $('#supervisor_id').val();
            $.ajax({
                url: "{{ route('groupAccept') }}",
                method: 'POST',
                _token: "{{ csrf_token() }}",
                data: {
                    'group_id': group,
                    'supervisor': supervisor,
                }, success: function (data) {
                    if (data.status == 200) {
                        alert('aaa');
                    }
                }
            });
        });
    </script>

@endsection
