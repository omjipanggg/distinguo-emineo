<form action="{{ route('token.store') }}" method="POST">
	@method('POST')
	@csrf

	<input type="hidden" value="1" name="assessment_id" id="assessmentIdOnModal">

	<div class="form-floating">
		<input type="text" class="form-control" autocomplete="off" placeholder="Token" value="{{ Str::upper(substr(Str::uuid(), -12)) }}" maxlength="24" name="token" id="tokenOnModal">
		<label for="tokenOnModal">Token</label>
	</div>

	<div class="mb-2"></div>

	<div class="form-floating">
		<input type="text" class="form-control" autocomplete="off" placeholder="Nama Penilai" name="name" id="nameOnModal" required="">
		<label for="nameOnModal">Nama Penilai</label>
	</div>

	<div class="mb-2"></div>

	<div class="form-select-floating">
		<select name="projects[]" id="projects" class="form-select select2-single-modal" multiple="" required="" data-bs-table="projects">
			@foreach ($projects as $project)
			<option value="{{ $project->id }}">{{ $project->project_number }} | {{ Str::upper($project->name ?? 'null') }}</option>
			@endforeach
		</select>
		<label for="projects">No. PO</label>
	</div>

	{{--
	<div class="form-select-floating">
		<select name="departments[]" id="departments" class="form-select select2-single-modal" multiple="" required="" data-bs-table="departments">
			@foreach ($departments as $department)
			<option value="{{ $department->id }}">{{ Str::upper($department->name ?? 'null') }}</option>
			@endforeach
		</select>
		<label for="departments">Divisi</label>
	</div>

	<div class="mb-2"></div>

	<div class="form-select-floating">
		<select name="region" id="region" class="form-select select2-single-modal" data-bs-table="regions" required="">
			<option value="" selected="" disabled="">Pilih satu</option>
			@foreach ($regions as $region)
			<option value="{{ Str::upper($region->name ?? 'null') }}">{{ Str::upper($region->name ?? 'null') }}</option>
			@endforeach
			<option value="ALL">SEMUA WILAYAH</option>
		</select>
		<label for="region">Wilayah</label>
	</div>

	<div class="mb-2"></div>

	<div class="form-select-floating">
		<select name="zone" id="zone" class="form-select select2-multiple-modal" data-bs-table="zones" required="">
			<option value="" selected="" disabled="">Pilih satu</option>
			@foreach ($zones as $zone)
			<option value="{{ Str::upper($zone ?? 'null') }}">{{ Str::upper($zone ?? 'null') }}</option>
			@endforeach
			<option value="ALL">SEMUA ZONA</option>
		</select>
		<label for="zone">Zona</label>
	</div>
	--}}

	{{-- <input type="text" class="form-control" placeholder="Zona" autocomplete="off" name="zone" id="zone"> --}}

	<button type="submit" class="btn btn-primary px-3 d-none" id="btnModal">Submit</button>
</form>