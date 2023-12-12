<form action="{{ route('criteria.store') }}" method="POST">
	@method('POST')
	@csrf

	<div class="d-flex flex-wrap gap-2">
		<div class="flex-basis-6">
			<input type="text" name="name" id="nameOnModal" class="form-control" autocomplete="off" required="" placeholder="Nama">
		</div>
		<div class="flex-basis-6">
			<select name="criteria_type_id" id="criteriaTypeIdOnModal" class="form-select" required="">
				<option value="" selected="" disabled="">Pilih satu</option>
				<option value="1">Scale (1-5)</option>
				<option value="2">Textual</option>
			</select>
		</div>
	</div>

	<div class="mt-2"></div>

	<textarea name="description" id="descriptionOnModal" cols="30" rows="6" class="form-control" autocomplete="off" placeholder="Deskripsi"></textarea>

	<button type="submit" class="d-none" id="btnModal">Simpan</button>
</form>