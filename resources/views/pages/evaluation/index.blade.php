@extends('layouts.panel')
@section('title', 'Evaluasi')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('evaluation.index') }}
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                    @yield('title')

                    <div id="buttons"></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="evaluationTable"></table>
                    </div>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
