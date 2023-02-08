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

@include('sales.layouts.inc_2.sidebar')
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
            }

            }});

    }, 450000);
</script>
{{--start js for museum--}}
@yield('js')
</body>
</html>

