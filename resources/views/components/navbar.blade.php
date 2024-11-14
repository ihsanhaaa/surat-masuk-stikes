<div class="st-height-70"></div>
<header class="st-header st-solid-header st-style1 st-sticky-menu">
    <div class="st-main-header">
        <div class="container">
            <div class="st-main-header-in">
                <div class="st-site-branding">
                    <a href="{{ url('/') }}" class="st-logo-link"><img src="{{ asset('limpty/img/favicon.png') }}"
                            alt="demo"></a>
                </div>
                <!-- For Site Title -->
                <!-- <span class="st-site-title">
                    <a href="index.html">Logo</a>
                </span> -->
                <div class="st-nav-wrap st-fade-down">
                    <div class="st-nav-toggle st-style1">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <nav class="st-nav st-desktop-nav">
                        <ul class="st-nav-list onepage-nav">

                            @guest
                                <li><a href="{{ url('/') }}">Beranda</a></li>
                                <li><a href="#unduh-aplikasi"
                                        class="smooth-scroll">Download Aplikasi</a></li>
                                <li><a href="{{ route('panduan') }}">Download Panduan</a></li>
                                <li><a href="{{ route('panduan') }}">FAQ</a></li>
                                <li><a href="{{ route('login') }}">Masuk</a></li>
                            @else
                                <li><a href="{{ url('/') }}">Beranda</a></li>
                                <li><a href="#unduh-aplikasi" class="smooth-scroll">Download Aplikasi</a></li>
                                <li><a href="{{ route('panduan') }}">Download Panduan</a></li>
                                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="d-flex align-items-center"><i
                                                class="font-size-lg me-2 feather icon-power"></i>
                                            <span>Keluar</span>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest

                        </ul>
                    </nav><!-- .st-nav -->
                </div><!-- .st-nav-wrap -->
            </div>
        </div>
    </div>
</header>
