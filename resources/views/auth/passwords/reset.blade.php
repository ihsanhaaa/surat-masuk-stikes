@extends('layouts.app')

@section('title')
    Masuk | SIP-0KE
@endsection

@section('content')
    @push('css-plugins')
        <!-- plugin css -->
        <link href="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
            rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="{{ asset('dason/assets/css/preloader.min.css') }}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('dason/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('dason/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('dason/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('dason/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dason/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('dason/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css" />
    @endpush

    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-7 col-lg-6 col-md-5">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay"></div>
                        <div class="row justify-content-center align-items-end"></div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xxl-5 col-lg-6 col-md-7">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="{{ url('/') }}" class="d-block auth-logo">
                                        <img src="{{ asset('dason/assets/images/Logo-Kab-Sambas.png') }}" alt="" height="50"> <span class="logo-txt">SIP-0KE</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">{{ __('Reset Password') }}</h5>
                                        <p class="text-muted mt-2">Silahkan lengkap formulir dibawah untuk melanjutkan.</p>
                                    </div>
                                    <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-floating form-floating-custom mb-4">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="email">{{ __('Email') }}</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                        </div>

                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="password">{{ __('Password Baru') }}</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{ __('Reset password') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-2 mt-md-2 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> PSPIG UNTAN</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @push('javascript-plugins')
        <!-- JAVASCRIPT -->
        <script src="{{ asset('dason/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/feather-icons/feather.min.js') }}"></script>
        <!-- pace js -->
        <script src="{{ asset('dason/assets/libs/pace-js/pace.min.js') }}"></script>


        <!-- apexcharts -->
        <script src="{{ asset('dason/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
        </script>
        <script
            src="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
        </script>

        <script src="{{ asset('dason/assets/js/pages/allchart.js') }}"></script>

        <!-- dashboard init -->
        <script src="{{ asset('dason/assets/js/pages/dashboard.init.js') }}"></script>

        <script src="{{ asset('dason/assets/js/app.js') }}"></script>



        <!-- Required datatable js -->
        <script src="{{ asset('dason/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('dason/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('dason/assets/js/pages/datatables.init.js') }}"></script>
    @endpush
@endsection
