@extends('layouts.app')

@section('title')
    SIPATRI | 404
@endsection

@section('content')
    @push('css-plugins')
        <link href="{{ asset('assets-softing/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/elegant-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/flaticon-set.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/magnific-popup.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/owl.theme.default.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/animate.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/css/bootsnav.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-softing/style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets-softing/css/responsive.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
    @endpush

    <!-- Start 404 
    ============================================= -->
    <div class="error-page-area bg-gray text-center default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>404</h1>
                    <h2>Ups, Halaman tidak ditemukan!</h2>
                    <a class="btn btn-theme effect btn-md" href="{{ url('/') }}">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 -->

    <!-- Start Footer 
    ============================================= -->
    <footer class="default-padding bg-light">
        <div class="container">
            <div class="f-items">
                <div class="row">
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item">
                            <a href="https://dishub.pontianak.go.id/" target="_blank"><img src="{{ asset('images/logo-pemkot-pontianak.png') }}" alt="Logo" style="height: 100px;"></a>
                            <h4 class="mt-4" >DINAS PERHUBUNGAN <br> KOTA PONTIANAK</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item link">
                            <h4>Tautan Cepat</h4>
                            <ul>
                                @guest
                                    <li>
                                        <a href="{{ route('login') }}"><i class="fas fa-angle-right"></i> Masuk</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Dashoard</a>
                                    </li>
                                @endguest
                                <li>
                                    <a href="{{ url('/') }}"><i class="fas fa-angle-right"></i> Beranda</a>
                                </li>
                                <li>
                                    <a class="smooth-menu" href="{{ url('/') }}#about"><i class="fas fa-angle-right"></i> Tentang</a>
                                </li>
                                <li>
                                    <a class="smooth-menu" href="{{ url('/') }}#contact"><i class="fas fa-angle-right"></i> Kontak</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fas fa-angle-right"></i> Privasi Kebijakan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item twitter-widget">
                            <h4>Informasi Kontak</h4>
                            <div class="address">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <i class="fas fa-home"></i> 
                                        </div>
                                        <div class="info">
                                            <h5>Website:</h5>
                                            <span> <a href="https://dishub.pontianak.go.id/" target="_blank">https://dishub.pontianak.go.id/</a> </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="fas fa-envelope"></i> 
                                        </div>
                                        <div class="info">
                                            <h5>Email:</h5>
                                            <span> <a href="mailto:dishub@pontianakkota.go.id">dishub@pontianakkota.go.id</a> </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="fas fa-phone"></i> 
                                        </div>
                                        <div class="info">
                                            <h5>Phone:</h5>
                                            <span>(0561) 767136</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Footer Bottom -->
            <div class="footer-bottom">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <p>Copyright © 2024 <a href="https://dishub.pontianak.go.id/" target="_blank">Dinas Perhubungan Kota Pontianak</a> | Supported By <a href="https://jign.big.go.id/profil-ppiig/19" target="_blank">PSPIG Universitas Tanjungpura</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer Bottom -->
        </div>
    </footer>
    <!-- End Footer -->

    @push('javascript-plugins')
        <script src="{{ asset('assets-softing/js/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/jquery.appear.js') }}"></script>
        <script src="{{ asset('assets-softing/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/modernizr.custom.13711.js') }}"></script>
        <script src="{{ asset('assets-softing/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets-softing/js/count-to.js') }}"></script>
        <script src="{{ asset('assets-softing/js/bootsnav.js') }}"></script>
        <script src="{{ asset('assets-softing/js/main.js') }}"></script>
    @endpush
@endsection