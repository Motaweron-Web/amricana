<!DOCTYPE html>
<html>
<head>
    <title>@yield('page_title')</title>
    @include('sales.layouts.assets.head')
    @include('layouts.loader.mainLoader.loaderCss')
    {{--start css for museum--}}
    @yield('css')
</head>
<body class="g-sidenav-show  bg-gray-100">
@include('layouts.loader.mainLoader.loader')
@php
    $supervisor_activities = \App\Models\SupervisorActivity::where('supervisor_id',auth()->user()->id)
            ->whereDate('date_time',\Carbon\Carbon::now()->format('Y-m-d'))->get();
@endphp
@if($supervisor_activities->count() > 0 && auth()->user()->supervisor_type == 'activity')
@include('sales.layouts.inc_2.sidebar')
@elseif(auth()->user()->supervisor_type == 'platform')
    @include('sales.layouts.inc_2.sidebar')
@endif
<main class="main-content position-relative h-100 border-radius-lg ">
    @include('sales.layouts.inc_2.navbar')
    <content class="container-fluid pt-4">
        @yield('content')
        @include('sales.layouts.inc_2.footer')
    </content>
</main>
@include('sales.layouts.assets.scripts')
<script>
    setInterval(function(){

        $.ajax({url: "{{url('platform/getLastRequests')}}", success: function(result){
            if(result){
                toastr.info('please check your requests you have new');
                var body = 'please check your requests you have new';
                 new Notification("New Requests", { body });
                playAudio();
            }

            }});

    }, 10000);

    function playAudio() {
        var x = new Audio('{{url('/')}}/sound/eventually-590.ogg');
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
</script>
{{--start js for museum--}}
@yield('js')
</body>
</html>

