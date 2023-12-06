@extends('layouts.panel')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('dashboard.index') }}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ __('This is the DASHBOARD page.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
