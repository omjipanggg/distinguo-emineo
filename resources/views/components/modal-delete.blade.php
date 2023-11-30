<form action="{{ route('home.vanish') }}" method="POST" id="vanisher">
	@csrf
	@method('DELETE')
	<button type="submit" class="d-none" id="btn-vanisher">Hapus</button>
</form>