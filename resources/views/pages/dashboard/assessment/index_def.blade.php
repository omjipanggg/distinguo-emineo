<table class="table table-bordered table-hover table-striped align-top table-fetch" id="assessmentTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kriteria</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>
                @if (count($item->criterias) > 0)
                    <ol class="m-0 px-3">
                    @foreach($item->criterias as $criteria)
                        <li>{{ $criteria->name }}</li>
                    @endforeach
                    </ol>
                @else
                Tidak ada data
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
