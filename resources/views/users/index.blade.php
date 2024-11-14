@extends('layouts.app')

@section('title')
    Surat STIKes | Data Pengguna
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
                                <h4 class="mb-sm-0 font-size-18">Data Pengguna ({{ $data->count() }})</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Data Pengguna</li>
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

                    @can('create-user')
                        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Tambah Pengguna</a>
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
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Operator</th>
                                            <th>Progres</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td>
                                                    <span>{{ ++$key }}</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('users.show', encrypt($user->id)) }}">{{ $user->name }}</a>
                                                        @if(Cache::has('user-is-online-' . $user->id))
                                                            <span class="text-success">●</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>{{ $user->email }}</span>
                                                    <button id="copyEmail" class="btn btn-sm btn-link"
                                                        data-clipboard-text="{{ $user->email }}">
                                                        <i class="mdi mdi-content-copy"></i> Salin
                                                    </button>
                                                </td>
                                                <td>
                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <span>{{ $v }}</span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->desa)
                                                        @if (!empty($user->getRoleNames()))
                                                            @foreach ($user->getRoleNames() as $v)
                                                                @if($v == 'Operator Kecamatan')
                                                                    KECAMATAN {{ $user->desa->kecamatan->nama_kecamatan }}
                                                                @elseif ($v == 'Camat')
                                                                    KECAMATAN {{ $user->desa->kecamatan->nama_kecamatan }}
                                                                @elseif ($v == 'Verifikator')
                                                                    DESA {{ $user->desa->nama_desa }}
                                                                @else
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $totalKK = 0;
                                                        $totalKkSubmit = 0;
                                                        $persentaseSubmit = 0;
                                                
                                                        // Melakukan pengecekan apakah desa tidak null
                                                        if ($user->desa) {
                                                            $totalKK = $user->desa->keluargas()->count();

                                                            $totalKkSubmitVerifikator2 = $user->desa->keluargas()
                                                                ->where(function ($query) {
                                                                    $query->where('is_submit', 1)
                                                                        ->orWhere(function ($query) {
                                                                            $query->where('alamat_valid', 'TIDAK')
                                                                                ->where('is_submit', 0);
                                                                        })
                                                                        ->orWhere(function ($query) {
                                                                            $query->whereNull('is_submit')
                                                                                ->where('alamat_valid', 'TIDAK');
                                                                        });
                                                                })
                                                                ->count();
                                                            $persentaseSubmitVerifikator = ($totalKK > 0) ? number_format($totalKkSubmitVerifikator2 / $totalKK * 100, 2) : 0;
                                                        }
                                                    @endphp
                                                    <span>
                                                        @if ($user->desa)
                                                            {{ $persentaseSubmitVerifikator }}%
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.show', encrypt($user->id)) }}">Lihat</a>
                                                    @can('edit-user')
                                                        <a href="{{ route('users.edit', encrypt($user->id)) }}"
                                                            class="dropdown-item">
                                                            <div class="d-flex align-items-center">
                                                                <i class="feather icon-edit feather"></i>
                                                                <span class="ms-2">Ubah</span>
                                                            </div>
                                                        </a>
                                                    @endcan
                                                    @can('delete-user')
                                                        <form id="input"
                                                            action="{{ route('users.destroy', encrypt($user->id)) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus User ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <i class="feather icon-trash-2"></i>
                                                            <button type="submit"
                                                                style="border: none; background-color: white; color: red;">Hapus</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

        <script>
            var clipboard = new ClipboardJS('#copyEmail');

            clipboard.on('success', function(e) {
                console.log('Email berhasil dicopy:', e.text);
            });

            clipboard.on('error', function(e) {
                console.error('Gagal menyalin email:', e.action);
            });
        </script>
    @endpush
@endsection
