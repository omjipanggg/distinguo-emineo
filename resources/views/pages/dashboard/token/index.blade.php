@extends('layouts.panel')
@section('title', 'Penilai')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('token.index') }}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                        <span>Penilai</span>

                        <a href="{{ route('token.create') }}" class="btn btn-primary px-3 rounded-1" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Token" data-bs-type="Generate">
                            Tambah
                            <i class="bi bi-plus-square-dotted ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped display nowrap" id="tokenTable"></table>
                    </div>

                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
