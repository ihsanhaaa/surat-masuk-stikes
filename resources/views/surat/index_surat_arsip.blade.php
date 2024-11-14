@extends('layouts.app')

@section('title')
    Surat STIKes | Surat Arsip Yayasan PKPI
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
                                <h4 class="mb-sm-0 font-size-18">Data Surat Arsip Yayasan PKPI ({{ $surats->count() }})</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Data Surat Arsip Yayasan PKPI</li>
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
                    @elseif ($message = Session::get('error'))
                        <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Danger</strong> -
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong><br>
                            @endforeach
                        </div>
                    @endif

                    @can('create-surat')
                        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#uploadModal"><i class="fas fa-plus"></i> Tambah Surat Arsip Yayasan PKPI</a>

                        <!-- Modal Upload Berkas -->
                        <div class="modal fade" id="uploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Tambah Surat Arsip Yayasan PKPI</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('surat-arsip.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaBerkas" class="form-label">Perihal/Keterangan <span style="color: red;">*</span> </label>
                                                <input type="text" class="form-control" id="namaBerkas" name="nama_berkas" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomorBerkas" class="form-label">Nomor Surat <span style="color: red;">*</span> </label>
                                                <input type="text" class="form-control" id="nomorBerkas" name="nomor_berkas" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="tanggalBerkas" class="form-label">Tanggal Surat <span style="color: red;">*</span> </label>
                                                <input type="date" class="form-control" id="tanggalBerkas" name="tanggal_berkas" required>
                                            </div>

                                            <input type="hidden" name="kategori_berkas" value="Surat Arsip">

                                            <div class="mb-3">
                                                <label for="fileBerkas" class="form-label">Unggah Berkas (PDF atau DOCX) <span style="color: red;">*</span> </label>
                                                <input type="file" class="form-control" id="fileBerkas" name="file_berkas" accept=".pdf,.docx" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                            <th>Perihal/Keterangan</th>
                                            <th>Nomor Surat</th>
                                            <th>Tanggal Surat</th>
                                            <th>Jenis Surat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surats as $key => $surat)
                                            <tr>
                                                <td>
                                                    <span>{{ ++$key }}</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#showModal{{ $surat->id }}">
                                                            {{ $surat->nama_berkas }}
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>{{ $surat->nomor_berkas }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $surat->tanggal_berkas }}</span>
                                                </td>
                                                <td>
                                                    <span>{{ $surat->kategori_berkas }}</span>
                                                </td>
                                                <td>

                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-info btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#showModal{{ $surat->id }}"><i class="fas fa-eye"></i> Detail</a>

                                                        <div class="modal fade" id="showModal{{ $surat->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="showModalLabel">Detail Surat {{ $surat->nama_berkas }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    
                                                                    <div class="modal-body">
                                                                        <p class="mb-2"> <b>Perihal/Keterangan:</b> {{ $surat->nama_berkas }}</p>
                                                                        <p class="mb-2"> <b>Nomor Surat:</b> {{ $surat->nomor_berkas }}</p>
                                                                        <p class="mb-2"> <b>Tanggal Surat:</b> {{ $surat->tanggal_berkas }}</p>
                                                                        <p class="mb-2"> <b>Kategori Berkas:</b> {{ $surat->kategori_berkas }}</p>
                                                                        <p class="mb-2"> <b>File:</b> <a href="{{ asset('berkas/' . $surat->file_berkas) }}" target="_blank"> <i class="fas fa-file-alt"></i> {{ $surat->file_berkas }}</a> </p>
                                                                    </div>
    
                                                                    <div class="btn-group" role="group">
                                                                        <a href=""class="btn btn-outline-light text-truncate"><i class="uil uil-user me-1"></i>
                                                                            Bagikan
                                                                        </a>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        @can('edit-surat')
                                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $surat->id }}"><i class="fas fa-edit"></i> Edit</a>
    
                                                            <div class="modal fade" id="editModal{{ $surat->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="showModalLabel">Edit</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
    
                                                                        <form action="{{ route('surat-arsip.store') }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="namaBerkas" class="form-label">Nama Berkas</label>
                                                                                    <input type="text" class="form-control" id="namaBerkas" name="nama_berkas" value="{{ $surat->nama_berkas }}" required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="tanggalBerkas" class="form-label">Tanggal Berkas</label>
                                                                                    <input type="date" class="form-control" id="tanggalBerkas" name="tanggal_berkas" value="{{ $surat->tanggal_berkas }}" required>
                                                                                </div>
    
                                                                                <div class="mb-3">
                                                                                    <label for="tanggalBerkas" class="form-label">File Berkas</label>
                                                                                    <a href="{{ asset('berkas/' . $surat->file_berkas) }}" target="_blank"> <i class="fas fa-file-alt"></i> {{ $surat->file_berkas }}</a>
                                                                                </div>
    
                                                                                <div class="mb-3">
                                                                                    <label for="fileBerkas" class="form-label">Unggah Berkas Baru (PDF atau DOCX)</label>
                                                                                    <input type="file" class="form-control" id="fileBerkas" name="file_berkas" accept=".pdf,.docx" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                            </div>
                                                                        </form>
    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        @endcan
    
                                                        @can('delete-surat')
                                                            <form id="input"
                                                                action="{{ route('surat-arsip.destroy', $surat->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah anda yakin ingin menghapus surat arsip ini?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                            </form>
                                                        @endcan
                                                    </div>

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
