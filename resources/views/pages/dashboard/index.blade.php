@extends('layouts.panel')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row px-12">
        <div class="col p-0">
            {{ Breadcrumbs::render('dashboard.index') }}
        </div>
    </div>

    <div class="row gap-3 px-12">
        <div class="flex-basis-6 p-0 card animated">
            <div class="card-header">Evaluasi</div>

            <div class="card-body">
                <p class="display-4">
                    {{ $evaluation }}
                </p>

                @if ($scores)
                <div class="table-responsive m-0 w-100">
                    <table class="table table-bordered m-0 table-hover">
                    @foreach ($scores as $score)
                    <tr>
                        <td>{{ $score->remarks }}</td>
                        <th class="text-center">{{ $score->total }}</th>
                    </tr>
                    @endforeach
                    </table>
                </div>
                @endif

            </div>

            <div class="card-footer">
                <a href="{{ route('evaluation.index') }}" class="dotted">Kelola</a>
            </div>
        </div>
        <div class="flex-basis-6 p-0 card animated">
            <div class="card-header">Penilai</div>

            <div class="card-body">
                <p class="display-4 mb-0">
                    {{ $evaluator }}
                </p>
            </div>

            <div class="card-footer">
                <a href="{{ route('token.index') }}" class="dotted">Kelola</a>
            </div>
        </div>
        <div class="flex-basis-6 p-0 card animated">
            <div class="card-header">Peserta</div>

            <div class="card-body">
                <p class="display-4 mb-0">
                    {{ $evaluatee }}
                </p>
            </div>

            <div class="card-footer">
                <a href="{{ route('member.index') }}" class="dotted">Kelola</a>
            </div>
        </div>
        <div class="flex-basis-6 p-0 card animated">
            <div class="card-header">Project</div>

            <div class="card-body">
                <p class="display-4 mb-0">
                    {{ $project }}
                </p>
            </div>

            <div class="card-footer">
                <a href="{{ route('project.index') }}" class="dotted">Kelola</a>
            </div>
        </div>
    </div>
</div>
@endsection
