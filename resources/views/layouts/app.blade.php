<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Salman Mustapa">
    <meta name="description" content="SOBAT : SISTEM PENGELOLAAN OBAT">

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    @include('layouts.partials.style')
    @stack('style')
</head>

<body>
    @include('sweetalert::alert')

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        @include('layouts.components.nav')
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        {{-- @include('layouts.components.chatbox') --}}
        <!--**********************************
            Chat box End
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.components.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.components.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->


        <!--****
		Wallet Sidebar
		****-->
        {{-- @include('layouts.components.wallet-sidebar') --}}
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
				Footer start
			***********************************-->
        @include('layouts.components.footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    @include('layouts.partials.script')

    @stack('script')
</body>

</html>