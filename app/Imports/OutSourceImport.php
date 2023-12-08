<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Evaluatee;
use App\Models\Project;
use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OutSourceImport implements ShouldQueue, ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow
{
	use Importable, RemembersRowNumber;

    public function __construct() {}

    public function collection(Collection $collection)
    {
    	foreach ($collection as $row) {
            $card = $row['nik'];

            Evaluatee::updateOrCreate([
                'card_number' => $card
            ], [
                'card_number' => $card,
                'name' => $row['nama'],
                'area' => $row['area'],
                'region' => $row['regional'],
                'zone' => $row['zona'],
                'project_number' => $row['no_po']
            ]);

            $snake = Str::snake($row['divisi']);

            $exists = Department::where('snake_name', $snake)->first();

            if ($exists) {
                $id = $exists->id;
            } else {
                $id = Department::create([
                    'name' => $row['divisi'],
                    'snake_name' => $snake
                ]);
            }

            $user = Evaluatee::where('card_number', $card)->first();
            $user->departments()->sync([$id]);

            Project::updateOrCreate([
                'project_number' => $row['no_po']
            ], [
                'project_number' => $row['no_po'],
                'name' => $row['nama_project']
            ]);
    	}
    }

    public function batchSize(): int
    {
        return 246;
    }

    public function chunkSize(): int
    {
        return 246;
    }
}
