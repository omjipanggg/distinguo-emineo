<nav class="sb-topnav navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid px-12">
        <i class="bi bi-list pointered" id="sidebarToggle"></i>
        <a class="navbar-brand ms-3" href="/">{{ config('app.name') ?? 'SABRINA' }}</a>

        {{--
        <ul class="navbar-nav me-auto d-none d-md-block ms-2">
            <span class="navbar-text ms-2" id="clock">{{ date_time_indo_format(date('Y-m-d H:i:s')) }}</span>
        </ul>
        --}}

        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="/mode" class="nav-link d-none d-lg-inline-block" id="toggle-mode"><i class="bi bi-cloud-moon" id="toggle-mode-icon"></i></a></li>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Auth
                            <i class="bi bi-box-arrow-in-right"></i>
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="bi bi-person d-inline-block d-lg-none"></i>
                @auth
                <span class="d-none d-lg-inline-block">{{ Str::lower(auth()->user()->email) }}</span>
                @endauth
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if (auth()->user()->hasRole(1))
                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('home.settings') }}">Pengaturan</a>
                        <hr class="navbar-divider my-1">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

{{-- <div class="mb-4"></div> --}}