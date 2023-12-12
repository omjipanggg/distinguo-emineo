@extends('layouts.panel')
@section('title', 'Kriteria')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('criteria.index') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        @yield('title')

                        <a href="{{ route('criteria.create') }}" class="btn btn-primary px-3 rounded-1" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Criteria" data-bs-type="Add">
                            Tambah
                            <i class="bi bi-plus-square-dotted ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="w-480 border p-3 mb-3">
                        <form action="{{ route('criteria.import') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <span class="form-text mb-2 d-inline-block">Unduh template di sini: <a href="/storage/docs/templates/criteria.xlsx" class="dotted">criteria.xlsx</a></span>
                            <div class="d-flex gap-2 flex-wrap align-items-start">
                                <div class="flex-fill">
                                    <input type="file" name="file" id="file" class="form-control" autocomplete="off" required="" accept="text/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                </div>

                                <button type="submit" class="btn btn-primary rounded-0" data-bs-text="Importing" data-bs-initial-text="Import" data-bs-icon="upload">Import<i class="bi bi-upload ms-2"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped display nowrap" id="criteriaTable"></table>
                    </div>

                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
