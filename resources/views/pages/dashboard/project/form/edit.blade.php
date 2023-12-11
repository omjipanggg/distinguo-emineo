<form action="{{ route('project.update', $project->id) }}" method="POST">
    @method('PUT')
    @csrf

    <input type="hidden" name="old_no_po" id="old_no_po_on_modal" class="form-control mb-2" value="{{ $project->project_number }}">

    <div class="form-floating">
        <input type="text" name="no_po" id="no_po_on_modal" class="form-control" value="{{ $project->project_number }}" placeholder="{{ $project->project_number }}" autocomplete="off" required="">
        <label for="no_po_on_modal">No. PO</label>
    </div>

    <div class="mt-2"></div>

    <div class="form-floating">
        <input type="text" name="name" id="name_on_modal" class="form-control" value="{{ $project->name }}" placeholder="{{ $project->name }}" autocomplete="off" required="">
        <label for="name_on_modal">Nama</label>
    </div>

    <button type="submit" class="btn btn-primary d-none" id="btnModal">Simpan<i class="bi bi-send ms-2"></i></button>
</form>