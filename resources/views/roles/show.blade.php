@extends('layouts.app')

@section('title')
    Detail Peran | SIP-0KE
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
                                <h4 class="mb-sm-0 font-size-18">Detail Peran</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Peran</a></li>
                                        <li class="breadcrumb-item active">Detail Peran</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    
                </div>

                <div class="col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="p-3 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-md-center">
                                            <i class="feather h2 text-primary mb-0 icon-user"></i>
                                            <div class="ms-3">
                                                <div class="text-dark fw-bolder">Nama Peran:</div>
                                                <p class="mb-0">{{ $role->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-md-center">
                                            <i class="feather h2 text-primary mb-0 icon-lock"></i>
                                            <div class="ms-3">
                                                <div class="text-dark fw-bolder">Permission:</div>
                                                <p class="mb-0">
                                                    @if (!empty($rolePermissions))
                                                        @foreach ($rolePermissions as $v)
                                                            <label
                                                                class="badge bg-success">{{ $v->name }}</label> <br>
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @can('role-edit')
                            <div class="btn-group" role="group">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-light text-truncate"><i
                                    class="uil uil-user me-1"></i> Edit Role</a>
                            </div>
                        @endcan
                    </div>
                    <!-- end card -->
                </div>

                <div class="text-center my-5">
                    <form method="get" action="{{ URL::previous() }}">
                        <button class="btn btn-primary">Kembali</button>
                    </form>
                </div>

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



        <!-- Required datatable js -->
        <script src="{{ asset('dason/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('dason/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('dason/assets/js/pages/datatables.init.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

        <script>
            var clipboard = new ClipboardJS('#copyEmail');
        
            clipboard.on('success', function (e) {
                console.log('Email berhasil dicopy:', e.text);
            });
        
            clipboard.on('error', function (e) {
                console.error('Gagal menyalin email:', e.action);
            });
        </script>
    @endpush
@endsection
