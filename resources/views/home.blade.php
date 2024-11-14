@extends('layouts.app')

@section('title')
    Surat STIKes | Dashboard
@endsection

@section('content')
    @push('css-plugins')
        <link href="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

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
                                <h6 class="mb-sm-0 font-size-15">Selamat Datang {{ Auth::user()->name }} !</h6>
                                {{-- <h4 class="mb-sm-0 font-size-18">Dashboard !</h4> --}}

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active"><a href="javascript: void(0);">Dashboard</a></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="mb-3">
                            <h4 class="mb-sm-0 font-size-18">Rekap Surat Tahun {{ $tahunSekarang }}</h4>
                        </div>
                        <div style="width: 100%; height: 400px;">
                            <canvas id="suratChart"></canvas>
                        </div>
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
        <script src="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('dason/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

        <script src="{{ asset('dason/assets/js/pages/allchart.js') }}"></script>
        <!-- dashboard init -->
        <script src="{{ asset('dason/assets/js/pages/dashboard.init.js') }}"></script>

        <script src="{{ asset('dason/assets/js/app.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            const ctx = document.getElementById('suratChart').getContext('2d');
            const suratChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_values($bulan)) !!}, // Nama bulan
                    datasets: [
                        {
                            label: 'Surat Masuk',
                            data: {!! json_encode(array_values($dataSurat['Surat Masuk'])) !!}, // Data Surat Masuk
                            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Warna batang biru
                            borderColor: 'rgba(54, 162, 235, 1)', // Garis batang biru
                            borderWidth: 1
                        },
                        {
                            label: 'Surat Keluar',
                            data: {!! json_encode(array_values($dataSurat['Surat Keluar'])) !!}, // Data Surat Keluar
                            backgroundColor: 'rgba(255, 99, 132, 0.5)', // Warna batang merah
                            borderColor: 'rgba(255, 99, 132, 1)', // Garis batang merah
                            borderWidth: 1
                        },
                        {
                            label: 'Surat SK',
                            data: {!! json_encode(array_values($dataSurat['Surat SK'])) !!}, // Data SK
                            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Warna batang hijau
                            borderColor: 'rgba(75, 192, 192, 1)', // Garis batang hijau
                            borderWidth: 1
                        },
                        {
                            label: 'Surat Penting',
                            data: {!! json_encode(array_values($dataSurat['Surat Penting'])) !!}, // Data Surat Penting
                            backgroundColor: 'rgba(153, 102, 255, 0.5)', // Warna batang ungu
                            borderColor: 'rgba(153, 102, 255, 1)', // Garis batang ungu
                            borderWidth: 1
                        },
                        {
                            label: 'Surat Arsip Yayasan PKPI',
                            data: {!! json_encode(array_values($dataSurat['Surat Arsip'])) !!}, // Data Surat Arsip
                            backgroundColor: 'rgba(255, 159, 64, 0.5)', // Warna batang oranye
                            borderColor: 'rgba(255, 159, 64, 1)', // Garis batang oranye
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    },
                    onClick: function(evt, elements) {
                        if (elements.length > 0) {
                            const chartElement = elements[0];
                            const monthLabel = this.data.labels[chartElement.index]; // Mendapatkan nama bulan
                            const redirectUrl = `/surat/${monthLabel}`; // URL redirect, sesuaikan dengan rute Anda
                            window.location.href = redirectUrl; // Redirect ke halaman
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
