@extends('layouts.panel')
@section('title', 'User')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('user.index') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>

                <div class="card-body">
                    <a href="/storage/docs/templates/evaluated.xlsx" class="btn btn-primary px-3 rounded-0">
                        Template
                        <i class="bi bi-download ms-1"></i>
                    </a>

                    <div class="mt-2"></div>

                    <form action="{{ route('member.import') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="d-flex gap-2 align-items-start">
                            <div class="flex-fill">
                                <input type="file" name="file" id="file" class="form-control" autocomplete="off" required="" accept="text/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            </div>

                            <button type="submit" class="btn btn-primary rounded-0" data-bs-text="Importing" data-bs-initial-text="Import" data-bs-icon="upload">Import<i class="bi bi-upload ms-2"></i></button>
                        </div>
                    </form>

                    <div class="mt-3"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped display nowrap" id="userTable"></table>
                    </div>

                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
