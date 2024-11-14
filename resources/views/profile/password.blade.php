@extends('layouts.app')

@section('title')
    Ganti Password Saya | SIP-0KE
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

    @endpush

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- topbar -->
        @include('components.topbar_admin')

        <!-- sidebar left -->
        @include('components.navbar_admin')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Ganti Password</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('profil.index') }}">Profil Saya</a></li>
                                        <li class="breadcrumb-item active">Ganti Password</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Success</strong> -
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif ($message = Session::get('alert'))
                        <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Danger</strong> -
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong><br>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="POST" action="{{ route('profil.update-password', encrypt($user->id)) }}">
                                            @method('patch')
                                            @csrf
                                        
                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Password Lama</label>
                                                    <input id="current_password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        placeholder="Password lama" type="password" name="current_password" required
                                                        autocomplete="current_password">
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                        
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Password Baru</label>
                                                    <input id="password" class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Password baru minimal 8 karakter" type="password" name="password"
                                                        required autocomplete="new-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                        
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Konfirmasi Password Baru</label>
                                                    <input id="password-confirm" class="form-control" placeholder="Konfirmasi password"
                                                        type="password" name="password_confirmation" required
                                                        autocomplete="new-password">
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                    <div class="mt-3" style="margin-left: 10px;">
                                                        <input id="showpass" type="checkbox" onclick="myFunction()">
                                                        <label class="form-check-label" for="showpass">Lihat password</label>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-xs-12 col-sm-12 col-md-12 text-center my-3">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('components.footer_admin')

    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

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

        <!-- Datatable init js -->
        <script src="{{ asset('dason/assets/js/pages/datatables.init.js') }}"></script>

        <script>
            function myFunction() {
                var x = document.getElementById("current_password");
                var y = document.getElementById("password");
                var z = document.getElementById("password-confirm");
                if (x.type === "password" && y.type === "password" && z.type === "password") {
                    x.type = "text";
                    y.type = "text";
                    z.type = "text";
                } else {
                    x.type = "password";
                    y.type = "password";
                    z.type = "password";
                }
            }
        </script>
    @endpush
@endsection
