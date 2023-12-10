<div class="table-responsive w-100">
	<table class="table table-bordered m-0 table-hover">
		<tr>
			<td>No. PO</td>
			<td class="text-code fw-bold">{{ Str::upper($evaluatee->project_number) }}</td>
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

<form action="{{ route('evaluation.update', $batch) }}" method="POST">
	@method('PUT')
	@csrf

	<div class="table-responsive w-100">
		<table class="table table-bordered m-0 table-hover align-middle">
			<tr>
				<th>Kriteria</th>
				<th>Nilai</th>
			</tr>
			@foreach ($evaluation as $score)
				<tr>
					<td>{{ $score->criteria->name }}</td>
					<td>
						@if (is_numeric($score->remarks))
							<select name="remarks-{{ $score->id }}" id="remarks-{{ $score->id }}" required="" class="rating">
								<option value="">Rate</option>
								<option value="5" @if ($score->remarks == 5) selected="" @endif>5</option>
								<option value="4" @if ($score->remarks == 4) selected="" @endif>4</option>
								<option value="3" @if ($score->remarks == 3) selected="" @endif>3</option>
								<option value="2" @if ($score->remarks == 2) selected="" @endif>2</option>
								<option value="1" @if ($score->remarks == 1) selected="" @endif>1</option>
							</select>
						@else
							@if ($score->criteria_id == 999)
								<select name="remarks-{{ $score->id }}" id="remarks-{{ $score->id }}" required="" class="form-select select2-single-modal">
									<option value="Direkomendasikan" @if($score->remarks == 'Direkomendasikan') selected="" @endif>Direkomendasikan</option>
									<option value="Dipertimbangkan" @if($score->remarks == 'Dipertimbangkan') selected="" @endif>Dipertimbangkan</option>
									<option value="Belum direkomendasikan" @if($score->remarks == 'Belum direkomendasikan') selected="" @endif>Belum direkomendasikan</option>
								</select>
							@else
								<input type="text" class="form-control rounded-1" required="" placeholder="{{ $score->remarks }}" value="{{ $score->remarks }}" autocomplete="off" name="remarks-{{ $score->id }}" id="remarks-{{ $score->id }}">
							@endif
						@endif

					</td>
				</tr>
			@endforeach
		</table>
	</div>

	<button type="submit" class="btn btn-primary d-none" id="btnModal">Simpan</button>
</form>
