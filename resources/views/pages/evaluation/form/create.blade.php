<form action="{{ route('evaluation.store') }}" method="POST" enctype="multipart/form-data">
	@method('POST')
	@csrf

	<div class="d-flex flex-wrap flex-column gap-3">

	<div class="card animated rounded-0">
		<div class="card-body">

			<div class="table-responsive w-100">
				<table class="table table-bordered m-0 table-hover">
					<tr>
						<td class="fw-bold">ID Project</td>
						<td class="text-code fw-bold">{{ $evaluatee->project->project_number }}</td>
						<td class="text-code fw-bold">{{ Str::upper($evaluatee->project->name ?? 'null') }}</td>
					</tr>
					<tr>
						<td>NIK</td>
						<td colspan="2" class="text-code">{{ Str::upper($evaluatee->card_number ?? 'null') }}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td colspan="2" class="text-code">{{ Str::upper($evaluatee->name ?? 'null') }}</td>
					</tr>
					<tr>
						<td>Departemen/Divisi</td>
						<td colspan="2" class="text-code">{{ Str::upper($evaluatee->departments[0]->name ?? 'null') }}</td>
					</tr>
					<tr>
						<td>Area/Wilayah/Zona</td>
						<td colspan="2" class="text-code">{{ Str::upper($evaluatee->area ?? 'null') }} &mdash; {{ Str::upper($evaluatee->region ?? 'null') }} [{{ Str::upper($evaluatee->zone ?? 'null') }}]</td>
					</tr>
				</table>
			</div>

		</div>
	</div>

	@php($id=1)

	@forelse($materials->criterias as $point)

	<div class="card animated rounded-0">
		<div class="card-body">
			<div class="row align-items-center justify-content-center g-3">
				@if ($point->criteria_type_id == 1)
				<div class="col-md-6">
					<div class="fw-bold mb-2">{{ $loop->iteration }}. {{ $point->name }}</div>
					<div class="text-justify">{{ $point->description }}</div>
				</div>

				<div class="col-md-4 offset-md-2">
					<select required="" name="remarks-{{ $point->id }}" id="remarks-{{ $point->id }}" class="rating">
						<option value="">Rate</option>
						<option value="5">Sangat baik</option>
						<option value="4">Baik</option>
						<option value="3">Cukup</option>
						<option value="2">Kurang</option>
						<option value="1">Sangat kurang</option>
					</select>
				</div>

				@elseif ($point->criteria_type_id == 2)

				<div class="col-12">
					<div class="fw-bold mb-3">{{ $loop->iteration }}. {{ $point->name }}</div>
					<div class="text-justify">{{ $point->description }}</div>

					<textarea name="remarks-{{ $point->id }}" id="remarks-{{ $point->id }}" class="form-control" required="" placeholder="Remarks" cols="30" rows="10"></textarea>
				</div>
				@endif
			</div>
		</div>
	</div>

	@php($id+=1)

	@empty

	<div class="card animated rounded-0">
		<div class="card-body">
			{{ $materials }}
			{{-- Belum ada materi penilaian yang tersedia. --}}
		</div>
	</div>

	@endforelse

	<div class="card animated rounded-0">
		<div class="card-body pb-4">
			<div class="row align-items-center justify-content-center">
				<div class="col-12">

					<div class="mt-3"></div>

					<div class="fw-bold">{{ $id }}. Hasil Penilaian</div>
					<div class="text-justify"></div>

					<div class="mt-3"></div>

					<div class="radio-container d-flex flex-wrap align-items-stretch justify-content-between gap-3">
						<div class="position-relative flex-basis-4">
							<input type="radio" id="result-1" name="result" required="" value="Direkomendasikan">
							<label class="d-flex align-items-center" for="result-1">Direkomendasikan</label>
						</div>
						<div class="position-relative flex-basis-4 d-flex align-items-center justify-content-center">
							<input type="radio" id="result-2" name="result" required="" value="Dipertimbangkan">
							<label class="d-flex align-items-center" for="result-2">Dipertimbangkan</label>
						</div>
						<div class="position-relative flex-basis-4 d-flex align-items-center justify-content-center">
							<input type="radio" id="result-3" name="result" required="" value="Belum direkomendasikan">
							<label class="d-flex align-items-center" for="result-3">Belum<br>direkomendasikan</label>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	</div>

	<input type="hidden" value="{{ $evaluatee->id }}" name="evaluatee_id" id="evaluateeId">
	<input type="hidden" value="{{ $token }}" name="token" id="tokenOnModal">

	<button type="submit" class="btn btn-primary px-3 d-none" id="btnModal">Simpan</button>
</form>
