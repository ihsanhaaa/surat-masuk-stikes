@extends('layouts.app')

@section('title')
    Surat STIKes | Profil Saya
@endsection

@section('content')
    @push('css-plugins')
        <!-- plugin css -->
        <link href="{{ asset('plugin/ijaboCropTool/ijaboCropTool.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">

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
                                <h4 class="mb-sm-0 font-size-18">Profil Saya</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Profil Saya</li>
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
                </div>

                <!-- Input file with name attribute -->
                <input type="file" id="admin_image" name="admin_image" style="display: none;">

                <div class="col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    @if (Auth::user()->picture)
                                        <a href="#" id="change_picture_btn">
                                            <img src="{{ Auth::user()->picture }}" alt="" height="65" style="border-radius: 50px;">
                                        </a>
                                    @else
                                        <img src="{{ asset('dason/assets/images/users/kepala-keluarga.jpg') }}" alt="" id="change_picture_btn"
                                            class="avatar-lg rounded-circle img-thumbnail">
                                    @endif
                                </div>
                                <div class="flex-1 ms-3">
                                    <h5 class="font-size-15 mb-1"> {{ $user->name }}
                                        @if (Cache::has('user-is-online-' . $user->id))
                                            <span class="text-success">●</span>
                                        @endif
                                    </h5>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <p class="text-muted mb-0">Role: {{ $v }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 pt-1">
                                <p class="text-muted mb-0 mt-2">
                                    <i class="mdi mdi-account-tie font-size-15 align-middle pe-2 text-primary"></i>
                                    @if ($user->jabatan)
                                        Jabatan: {{ $user->jabatan }}
                                    @else
                                        Jabatan: -
                                    @endif
                                </p>
                                <p class="text-muted mb-0 mt-2">
                                    <i class="mdi mdi-cellphone-android font-size-15 align-middle pe-2 text-primary"></i>
                                    @if ($user->phone_number)
                                        No HP: {{ $user->phone_number }}
                                    @else
                                        No HP: -
                                    @endif
                                </p>
                                
                                <p class="text-muted mb-0 mt-2">
                                    <i class="mdi mdi-email font-size-15 align-middle pe-2 text-primary"></i>
                                    Email: {{ $user->email }}
                                    <button id="copyEmail" class="btn btn-sm btn-link"
                                        data-clipboard-text="{{ $user->email }}">
                                        <i class="mdi mdi-content-copy"></i> Salin
                                    </button>
                                </p>
                                <p class="text-muted mb-0 mt-2"><i
                                        class="mdi mdi-clock-outline font-size-15 align-middle pe-2 text-primary"></i>
                                    Bergabung pada: {{ $user->created_at }}
                                </p>
                            </div>
                        </div>

                        <div class="btn-group" role="group">
                            <a href=""
                                class="btn btn-outline-light text-truncate"><i class="uil uil-user me-1"></i> Edit
                                Profil</a>

                            <a href=""
                                class="btn btn-outline-light text-truncate"><i class="uil uil-user me-1"></i> Ganti
                                Password</a>
                        </div>
                    </div>
                    <!-- end card -->
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

        <script src="{{ asset('plugin/ijaboCropTool/ijaboCropTool.min.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {
                $(document).on('click', '#change_picture_btn', function(e) {
                    e.preventDefault(); // Prevent default action if using <a> tag
                    $('#admin_image').click();
                });

                $('#admin_image').ijaboCropTool({
                    preview: '.profil_picture',
                    setRatio: 1,
                    allowedExtensions: ['jpg', 'jpeg', 'png'],
                    buttonsText: ['SIMPAN', 'BATAL'],
                    buttonsColor: ['#30bf7d', '#ee5155', -15],
                    processUrl: '{{ route('profilPictureUpdate') }}',
                    // withCSRF:['_token','{{ csrf_token() }}'],
                    onSuccess: function(message, element, status) {
                        alert(message);
                        location.reload(); // Reload the page on success
                    },
                    onError: function(message, element, status) {
                        alert(message);
                    }
                });
            });
        </script>

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
