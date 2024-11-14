@extends('layouts.app')

@section('title')
    Surat STIKes | Data Peran
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
                                <h4 class="mb-sm-0 font-size-18">Data Peran</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Data Peran</li>
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

                    @can('create-role')
                        <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Tambah Peran</a>
                    @endcan
                    
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Dibuat</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>
                                                    <span>{{ ++$key }}</span>
                                                </td>
                                                <td>
                                                    <span><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></span>
                                                </td>
                                                <td>
                                                    <span>{{ $role->created_at }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('roles.show', $role->id) }}" class="dropdown-item">
                                                        <div class="d-flex align-items-center">
                                                            <i class="feather icon-eye feather"></i>
                                                            <span class="ms-2">Lihat</span>
                                                        </div>
                                                    </a>
                                                    @can('edit-role')
                                                        <a href="{{ route('roles.edit', $role->id) }}" class="dropdown-item">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-edit feather"></i>
                                                                <span class="ms-2">Ubah</span>
                                                            </div>
                                                        </a>
                                                    @endcan
                                                    @can('delete-role')
                                                        <form id="input"
                                                            action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus Role ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                style="border: none; background-color: white; color: red;">Hapus</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

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
    @endpush
@endsection
