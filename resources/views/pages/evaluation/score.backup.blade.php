{{--
<table class="table m-0 table-bordered table-hover table-fetch" id="scoringTable" data-bs-order="{{ json_encode([[1, 'asc']]) }}">
    <thead>
        <tr>
            <th>Aksi</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Zona</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>
                    <a href="{{ route('evaluation.create', ['token' => $token, 'member_id' => $member->id]) }}" class="btn btn-primary btn-sm rounded-0 px-3">Beri Nilai<i class="bi bi-box-arrow-up-right ms-2"></i></a>
                </td>
                <td>{{ $member->card_number }}</td>
                <td>{{ Str::upper($member->name) }}</td>
                <td>{{ Str::upper($member->region) }}</td>
                <td>{{ Str::upper($member->zone) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Aksi</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>Zona</th>
        </tr>
    </tfoot>
</table>
--}}

{{--
/*
$param = Tokeniser::select('region', 'zone')->where('token', $token)->whereHas('evaluator')->first();

if ($param) {
    $departments = Tokeniser::join('pivot_departments_tokenisers', 'pivot_departments_tokenisers.tokeniser_id', '=', 'tokenisers.id')->where('tokenisers.token', $token)->pluck('pivot_departments_tokenisers.department_id');

    $members = Evaluatee::where('region', $param->region)
        ->where('zone', $param->zone)
        ->whereHas('departments', function($query) use($departments) {
            return $query->whereIn('department_id', $departments);
        })
        ->with(['evaluations'])
    ->get();
}
*/
--}}