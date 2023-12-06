@extends('layouts.panel')
@section('title', 'Temporary')

@section('content')
<div class="container-fluid px-12">
    <div class="row">
        <div class="col">
            {{ Breadcrumbs::render('evaluation.index') }}
        </div>
    </div>

    <div class="row">
    	<div class="col">
    		<div class="card">
    			<div class="card-header"></div>

    			<div class="card-body">

					<div class="table-responsive w-100">
						<table class="table table-bordered m-0 table-hover">
							<tr>
								<td>NIK</td>
								<td class="text-code">{{ Str::upper($evaluatee->card_number ?? 'null') }}</td>
							</tr>
							<tr>
								<td>Nama</td>
								<td class="text-code">{{ Str::upper($evaluatee->name ?? 'null') }}</td>
							</tr>
							<tr>
								<td>Departemen/Divisi</td>
								<td class="text-code">{{ Str::upper($evaluatee->departments[0]->name ?? 'null') }}</td>
							</tr>
							<tr>
								<td>Area/Wilayah/Zona</td>
								<td class="text-code">{{ Str::upper($evaluatee->area ?? 'null') }} &mdash; {{ Str::upper($evaluatee->region ?? 'null') }} <strong>[{{ Str::upper($evaluatee->zone ?? 'null') }}]</strong></td>
							</tr>
						</table>
					</div>

					<div class="mt-3"></div>

    				<div class="table-responsive w-100">
    					<table class="table table-bordered m-0 table-hover table-striped">
    						<thead>
    							<tr>
    								<th>Kriteria</th>
    								<th>Nilai</th>
    							</tr>
    						</thead>
    						<tbody>
								@foreach ($evaluation as $score)
    							<tr>
    								<td>{{ $score->criteria->name }}</td>
    								<td>
    									@if (is_numeric($score->remarks))
	    									@for ($i = 0; $i < $score->remarks; $i++)
	    									<i class="bi bi-star-fill"></i>
	    									@endfor
	    									@for ($i = 5; $i > $score->remarks ; $i--)
	    									<i class="bi bi-star"></i>
	    									@endfor
    									@else
    									{{ $score->remarks }}
    									@endif
    								</td>
    							</tr>
								@endforeach
    						</tbody>
    						<tfoot>
    							<tr>
    								<th>Kriteria</th>
    								<th>Nilai</th>
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