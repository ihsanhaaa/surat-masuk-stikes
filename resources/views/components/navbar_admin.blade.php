text/x-generic navbar_admin.blade.php ( HTML document, ASCII text, with CRLF line terminators )
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                @role('Admin')
                <li>
                    <a href="{{ route('home') }}">
                        <i data-feather="home"></i>
                        {{-- <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span> --}}
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                

                <li>
                    <a href="{{ route('profile.index') }}">
                        <i data-feather="user"></i>
                        <span data-key="t-chat">Profil Saya</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('roles.index') }}">
                        <i data-feather="lock"></i>
                        <span data-key="t-chat">Peran</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-chat">Pengguna</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-masuk.index') }}">
                        <i data-feather="inbox"></i>
                        <span data-key="t-chat">Surat Masuk</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-keluar.index') }}">
                        <i data-feather="upload"></i>
                        <span data-key="t-chat">Surat Keluar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-sk.index') }}">
                        <i data-feather="book"></i>
                        <span data-key="t-chat">Surat SK</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-penting.index') }}">
                        <i data-feather="star"></i>
                        <span data-key="t-chat">Surat Penting</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-arsip.index') }}">
                        <i data-feather="archive"></i>
                        <span data-key="t-chat">Arsip Yayasan PKPI</span>
                    </a>
                </li>

                @elseif (Auth::user()->hasRole('Staff Administrasi'))
                <li>
                    <a href="{{ route('home') }}">
                        <i data-feather="home"></i>
                        {{-- <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span> --}}
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                

                <li>
                    <a href="{{ route('profile.index') }}">
                        <i data-feather="user"></i>
                        <span data-key="t-chat">Profil Saya</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-masuk.index') }}">
                        <i data-feather="inbox"></i>
                        <span data-key="t-chat">Surat Masuk</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-keluar.index') }}">
                        <i data-feather="upload"></i>
                        <span data-key="t-chat">Surat Keluar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-sk.index') }}">
                        <i data-feather="book"></i>
                        <span data-key="t-chat">Surat SK</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-penting.index') }}">
                        <i data-feather="star"></i>
                        <span data-key="t-chat">Surat Penting</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('surat-arsip.index') }}">
                        <i data-feather="archive"></i>
                        <span data-key="t-chat">Arsip Yayasan PKPI</span>
                    </a>
                </li>

                @else
                <li>
                    <a href="{{ route('home') }}">
                        <i data-feather="home"></i>
                        {{-- <span class="badge rounded-pill bg-success-subtle text-success float-end">9+</span> --}}
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}">
                        <i data-feather="user"></i>
                        <span data-key="t-chat">Profil Saya</span>
                    </a>
                </li>
                @endrole

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<script>
    function confirmLogout(event) {
        event.preventDefault(); // Menghentikan default action (pengiriman formulir) sementara menampilkan SweetAlert

        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            text: 'Anda akan keluar dari sesi ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>