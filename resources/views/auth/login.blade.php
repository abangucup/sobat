<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Salman Mustapa">
    <meta name="description" content="SOBAT : SISTEM PENGELOLAAN OBAT">

    <title>LOGIN - {{ env('APP_NAME') }}</title>

    @include('layouts.partials.style')
    @stack('style')
</head>

<body class="body  h-100">

    @include('sweetalert::alert')

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="container h-100">
        <div class="row h-100 align-items-center justify-contain-center">
            <div class="col-xl-12">
                <div class="card main-width">
                    <div class="card-body  p-0">
                        <div class="row m-0">
                            <div class="col-xl-12 col-lg-1">
                                <div class="card">
                                    <div class="card-body">

                                        <a href="{{ route('login') }}" class="d-flex justify-content-center">
                                            <img src="{{ asset('assets/images/png/logo_kota.png') }}" width="80"
                                                class="img-fluid rounded-circle" alt="Logo Kota">
                                            <img src="{{ asset('assets/images/png/logo_kesehatan.png') }}" width="80"
                                                class="img-fluid rounded-circle" alt="Logo Kesehatan">
                                        </a>


                                        <div class="text-center mt-2">
                                            <span class="h2">HALAMAN LOGIN</span><br>
                                            <span class="h6">SISTEM INFORMASI PENGELOLAAN OBAT (SOBAT) <br>
                                                RSUD. OTANAHA
                                            </span>
                                        </div>
                                        <form class="mt-4" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="form-group mb-4">
                                                <label for="inputUsername">Username</label>
                                                <input type="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="inputUsername" name="username" placeholder="Masukan Username"
                                                    value="{{ old('username') }}" required>

                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="inputPassword">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="inputPassword"
                                                        name="password" placeholder="Masukan Password" required>
                                                    <span class="input-group-text" id="togglePassword"><i
                                                            class="fa fa-eye-slash"></i></span>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary btn-block mb-4" type="submit">
                                                <i class="fa-solid fa-lock text-white me-2"></i>
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2">
                        <a href="https://plagiarismcheckerx.com/" target="_blank"
                            title="PlagiarismCheckerx Protection Badge">
                            <img src="https://plagiarismcheckerx.com/assets/images/badges/pcx-protected-12.png"
                                alt="Protection Badge"></a>
                        <a href="https://plagiarismcheckerx.com/" target="_blank"
                            title="PlagiarismCheckerx Protection Badge">
                            <img src="https://plagiarismcheckerx.com/assets/images/badges/pcx-protected-11.png"
                                alt="Protection Badge"></a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.partials.script')

    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

</body>

</html>