@extends('layouts.panel')
@section('title', 'Peserta')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('member.index') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Peserta</div>

                <div class="card-body">

                    <div class="w-480 border p-3 mb-3">
                        <form action="{{ route('member.import') }}" method="POST" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <span class="form-text mb-2 d-inline-block">Unduh template di sini: <a href="/storage/docs/templates/evaluated.xlsx" class="dotted">evaluated.xlsx</a></span>
                            <div class="d-flex gap-2 flex-wrap align-items-start">
                                <div class="flex-fill">
                                    <input type="file" name="file" id="file" class="form-control" autocomplete="off" required="" accept="text/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                </div>

                                <button type="submit" class="btn btn-primary rounded-1 px-3" data-bs-text="Importing" data-bs-initial-text="Import" data-bs-icon="upload">Import<i class="bi bi-upload ms-2"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped display nowrap" id="memberTable"></table>
                    </div>

                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
