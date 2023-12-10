<nav class="sb-topnav navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid px-12">
        <div class="d-flex align-items-center justify-content-center">
            <i class="bi bi-list pointered" id="sidebarToggle"></i>
            <a class="navbar-brand ms-3" href="/">{{ config('app.name') ?? 'SABRINA' }}</a>
            {{-- <ul class="navbar-nav me-auto d-none d-md-block ms-2"><span class="navbar-text ms-2" id="clock">{{ date_time_indo_format(date('Y-m-d H:i:s')) }}</span></ul> --}}
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/mode" class="nav-link d-none d-lg-flex" id="toggle-mode"><i class="bi bi-cloud-moon" id="toggle-mode-icon"></i></a></li>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="mailto:{{ Str::lower(auth()->user()->email) }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Str::lower(auth()->user()->email) }}
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
    </div>
</nav>

{{-- <div class="mb-4"></div> --}}