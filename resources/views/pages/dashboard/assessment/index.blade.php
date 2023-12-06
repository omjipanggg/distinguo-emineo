@extends('layouts.panel')
@section('title', 'Assessment')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('assessment.index') }}
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        Assessment

                        <a href="{{ route('assessment.create') }}" data-bs-toggle="modal" data-bs-target="#modalControl" data-bs-table="Assessment" data-bs-type="Add" class="btn btn-primary px-3 rounded-1">Tambah<i class="bi bi-plus-square-dotted ms-2"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped align-top table-fetch" id="assessmentTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if (count($item->criterias) > 0)
                                            <ol class="m-0 px-3">
                                            @foreach($item->criterias as $criteria)
                                                <li>{{ $criteria->name }}</li>
                                            @endforeach
                                            </ol>
                                        @else
                                        Tidak ada data
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kriteria</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
