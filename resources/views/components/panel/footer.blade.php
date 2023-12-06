@auth
<div class="mt-4"></div>
<footer class="mt-auto shadow-lg">
    <div class="container-fluid px-12">
        <div class="h-56 d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex flex-wrap small">
                <a href="{{ route('dashboard.index') }}" class="dotted pe-2" onclick="underMaintenance(event);">Bantuan</a>&middot;<a href="{{ route('dashboard.index') }}" class="dotted ps-2" onclick="underMaintenance(event);">Laporkan</a>
            </div>
            <small class="small m-0 text-muted">{{ config('app.name') }} &copy; {{ date('Y') }}</small>
        </div>
    </div>
</footer>
@else
<div class="mt-auto"></div>
@endauth