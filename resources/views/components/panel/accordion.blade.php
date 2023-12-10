<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
@auth
    <div class="sb-sidenav-menu">
        <div class="nav mb-4">
            {{-- <div class="sb-sidenav-menu-heading pt-24">Core</div> --}}
            <a class="pt-24 nav-link @if(url()->current() == route('dashboard.index')) active @endif" href="{{ route('dashboard.index') }}">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-house"></i></div>
                Dashboard
            </a>
            <a class="nav-link collapsed" href="/menu" data-bs-toggle="collapse" data-bs-target="#configurationMenu" aria-expanded="false" aria-controls="configurationMenu">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-database-gear"></i></div>
                Konfigurasi
                <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
            </a>
            <div class="collapse" id="configurationMenu" aria-labelledby="configurationMenu" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    {{--
                    <a class="{{ (url()->current() == route('dashboard.index')) ? 'active' : '' }} nav-link disabled" href="{{ route('dashboard.index') }}">
                        Departemen
                    </a>
                    --}}
                    <a class="{{ (url()->current() == route('project.index')) ? 'active' : '' }} nav-link" href="{{ route('project.index') }}">
                        Project
                    </a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="/menu" data-bs-toggle="collapse" data-bs-target="#materialMenu" aria-expanded="false" aria-controls="materialMenu">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-journal-bookmark"></i></div>
                Materi
                <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
            </a>
            <div class="collapse" id="materialMenu" aria-labelledby="materialMenu" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="{{ (url()->current() == route('assessment.index')) ? 'active' : '' }} nav-link" href="{{ route('assessment.index') }}">
                        Asesmen
                    </a>
                    <a class="{{ (url()->current() == route('criteria.index')) ? 'active' : '' }} nav-link" href="{{ route('criteria.index') }}">
                        Kriteria
                    </a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="/menu" data-bs-toggle="collapse" data-bs-target="#userMenu" aria-expanded="false" aria-controls="userMenu">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-people"></i></div>
                Pengguna
                <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
            </a>
            <div class="collapse" id="userMenu" aria-labelledby="userMenu" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="{{ (url()->current() == route('token.index')) ? 'active' : '' }} nav-link" href="{{ route('token.index') }}">
                        Penilai
                    </a>
                    <a class="{{ (url()->current() == route('member.index')) ? 'active' : '' }} nav-link" href="{{ route('member.index') }}">
                        Peserta
                    </a>
                    {{--
                    <a class="nav-link @if(url()->current() == route('user.index')) active @endif" href="{{ route('user.index') }}">
                        <div class="sb-nav-link-icon pe-2"><i class="bi bi-people"></i></div>
                        User
                    </a>
                    --}}
                </nav>
            </div>
        </div>
    </div>
    <form action="{{ route('dashboard.search') }}" class="form form-inline d-inline-block" method="GET">
        {{-- @method('GET') --}}
        {{-- @csrf --}}
        <div class="input-group">
            <input class="form-control no-border rounded-0" type="text" autocomplete="off" placeholder="Search" aria-label="Search" aria-describedby="btn-search" name="keyword" value="{{ request()->input('keyword') ?? old('keyword') }}">
            <button class="btn btn-dark rounded-0" id="btn-search" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>
    <div class="sb-sidenav-footer h-56 d-flex align-items-center gap-3">
        <a href="{{ route('home.settings') }}">
            <img src="{{ asset('img/avatar.webp') }}" alt="Avatar" class="img-fluid">
        </a>
        <div class="d-flex flex-column align-items-start justify-content-start">
            <small class="text-smaller">
                @foreach (auth()->user()->roles as $element)
                    @php($position=$element->name)
                @endforeach
                {{ $position }}
            </small>
            <a href="{{ route('home.settings') }}" class="d-inline-block text-truncate w-160 dotted text-white">{{ Str::upper(auth()->user()->name) }}</a>
        </div>
    </div>
@else
    <div class="sb-sidenav-menu">
        <div class="nav mb-4">
            <a class="pt-24 nav-link @if(url()->current() == route('evaluation.index')) active @endif" href="{{ route('evaluation.index') }}" onclick="underMaintenance(event);">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-house"></i></div>
                Dashboard
            </a>
            {{--
            <a class="nav-link @if(url()->current() == route('evaluation.score')) active @endif" href="{{ route('evaluation.score') }}">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-bar-chart-line"></i></div>
                Penilaian
            </a>
            --}}
            <a class="nav-link collapsed" href="/menu" data-bs-toggle="collapse" data-bs-target="#assessmentMenu" aria-expanded="false" aria-controls="assessmentMenu">
                <div class="sb-nav-link-icon pe-2"><i class="bi bi-bar-chart-line"></i></div>
                Penilaian
                <div class="sb-sidenav-collapse-arrow"><i class="bi bi-caret-down-fill"></i></div>
            </a>
            <div class="collapse" id="assessmentMenu" aria-labelledby="assessmentMenu" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="{{ (url()->current() == route('evaluation.score')) ? 'active' : '' }} nav-link" href="{{ route('evaluation.score') }}">
                        Data
                    </a>
                    <a class="{{ (url()->current() == route('evaluation.history')) ? 'active' : '' }} nav-link" href="{{ route('evaluation.history') }}">
                        Riwayat
                    </a>
                </nav>
            </div>

        </div>
    </div>
@endauth
</nav>
</div>