@extends('layouts.panel')
@section('title', 'Evaluasi')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('evaluation.index') }}
        </div>
    </div>

    <script>
        let columnDefs = {!! json_encode($columns) !!}

        columnDefs.map((item) => {
            return item.render = function(data, type, row, meta) {
                if (!data.length) {
                    return '<em>null</em>';
                }

                return data.map((idx) => {
                    if (idx['other_id'] == item.id) {
                        return idx['other_remarks'];
                    }
                }).join('');
            }
        });
    </script>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                    @yield('title')

                    <div id="buttons" class="position-relative"></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="evaluationTable"></table>
                    </div>
                </div>

                <div class="card-footer">
                    <span class="fw-bold mb-0"><i class="bi bi-info-circle me-3"></i>Keterangan!</span>

                    <span class="text-code">
                    @foreach ($criterias as $criteria)
                        Q{{ $criteria->id }}: {{ $criteria->name }}@if (!$loop->last), @endif
                    @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
