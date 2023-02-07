
@extends('sales.layouts.master_2')
@section('css')
    <link id="pagestyle" href="{{asset('museum/css/app.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/font.awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('museum/css/style.css')}}" rel="stylesheet"/>

    <link href="{{asset('museum/css/bootstrap.min.css')}}" rel="stylesheet"/>

@endsection
@section('content')


    <!-- content -->
    <content class="container-fluid pt-4">
        <form action="{{ route('addActivity') }}" method="POST">
            @csrf
            <input name="supervisor" hidden value="{{ auth()->user()->id }}">
            <select name="activaty" class="form-control">
                @foreach($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->title }}</option>
                @endforeach
            </select>
            <br>
            <button class="btn btn-primary" type="submit">Add </button>
        </form>
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

    <!-- dashboard Js -->
    <script src="{{asset('museum/js/app.min.js')}}"></script>

@endsection
