<form action="{{ route('assessment.store') }}" method="POST">
	@method('POST')
	@csrf

	<div class="d-flex flex-wrap gap-2">
		<div class="flex-basis-6">
			<div class="form-floating">
				<input type="text" class="form-control" autocomplete="off" name="name" id="nameOnModal" placeholder="Nama" required="">
				<label for="nameOnModal">Nama</label>
			</div>
		</div>
		<div class="flex-basis-6">
			<div class="form-floating">
				<input type="text" class="form-control" autocomplete="off" name="description" id="descriptionOnModal" placeholder="Deskripsi">
				<label for="descriptionOnModal">Deskripsi</label>
			</div>
		</div>
	</div>

	<div class="mt-2"></div>

	<div class="form-select-floating">
		<select name="criterias[]" id="criteriasOnModal" class="form-select select2-single-modal" multiple="" required="">
			@foreach ($criterias as $criteria)
				<option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
			@endforeach
		</select>
		<label for="criteriasOnMOdal">Kriteria</label>
	</div>

	<button type="submit" class="btn btn-primary d-none" id="btnModal">Simpan<i class="bi bi-send ms-2"></i></button>
</form>