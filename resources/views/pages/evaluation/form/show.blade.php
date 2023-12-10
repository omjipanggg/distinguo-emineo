<div class="table-responsive w-100">
	<table class="table table-bordered m-0 table-hover">
		<tr>
			<td>No. PO</td>
			<td class="text-code">{{ Str::upper($evaluatee->project_number) }}</td>
		</tr>
		<tr>
			<td>NIK/Nama</td>
			<td class="text-code">{{ Str::upper($evaluatee->card_number ?? 'null') }} &mdash; {{ Str::upper($evaluatee->name ?? 'null') }}</td>
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
	<table class="table table-bordered m-0 table-hover">
		<tr>
			<th>Kriteria</th>
			<th>Nilai</th>
		</tr>
		@foreach ($evaluation as $score)
		<tr>
			<td class="@if($loop->last) fw-bold border-info-subtle border text-bg-info py-3 @endif">
				{{ $score->criteria->name }}
			</td>
			<td class="@if($loop->last) fw-bold border-info-subtle border text-bg-info py-3 @endif">
				@if (is_numeric($score->remarks))
					@for ($i = 0; $i < $score->remarks; $i++)
						<i class="bi bi-star-fill"></i>
					@endfor
					@for ($i = $score->remarks; $i < 5; $i++)
						<i class="bi bi-star"></i>
					@endfor
				@else
					{{ $score->remarks }}
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</div>