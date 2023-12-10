@extends('layouts.panel')
@section('title', 'Konfigurasi')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('dashboard.config') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Konfigurasi</div>

                <div class="card-body">
                    Konfigurasi
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
