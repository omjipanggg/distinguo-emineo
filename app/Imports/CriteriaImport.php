<?php

namespace App\Imports;

use App\Models\Criteria;
use App\Models\CriteriaType;

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

class CriteriaImport implements ShouldQueue, ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow
{
	use Importable, RemembersRowNumber;

    public function __construct() {}

    public function collection(Collection $collection)
    {
    	foreach ($collection as $row) {
    		$exists = CriteriaType::where('name', $row['type'])->first();

    		if ($exists) {
    			$type = $exists->id;
    		} else {
    			$type = CriteriaType::create(['name' => $row['type']]);
    			$type = $type->id;
    		}

    		Criteria::updateOrCreate([
    			'name' => $row['title'],
    			'description' => $row['description'],
    			'criteria_type_id' => $type
    		]);
    	}
    }

    public function batchSize(): int
    {
        return 64;
    }

    public function chunkSize(): int
    {
        return 64;
    }
}
