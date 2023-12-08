@extends('layouts.panel')
@section('title', 'Penilaian: Data')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('evaluation.score') }}
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Penilaian: Data</div>

                <div class="card-body">

                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">

                        <div class="flex-fill">
                            <form action="{{ route('evaluation.score') }}" method="GET">
                                <div class="d-flex flex-wrap gap-2 w-320">
                                    <div class="flex-fill">
                                        <input type="text" class="form-control" placeholder="Masukkan Token" autocomplete="off" name="token" id="token" value="{{ $token }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4 rounded-0">Cari<i class="bi bi-search ms-2"></i></button>
                                </div>
                            </form>
                        </div>

                        @guest
                            @if ($token)
                            <div class="grouped-buttons">
                                <button type="button" onclick="window.location.reload();" class="btn btn-dark px-3 rounded-0"><i class="bi bi-arrow-counterclockwise me-2"></i>Clear</button>
                                @foreach ($departments as $department)
                                 <button type="button" onclick="filterScore(event, '{{ $token }}', {{ $department->id }})" class="btn btn-primary px-3 rounded-0"><i class="bi bi-tag-fill me-2"></i>{{ $department->name }}</button>
                                @endforeach
                            </div>
                            @endif
                        @endguest

                    </div>

                    <div class="mt-3"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover display nowrap" id="scoringTable"></table>
                    </div>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
