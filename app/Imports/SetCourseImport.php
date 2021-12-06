<?php

namespace App\Imports;

use App\Models\Set;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class SetCourseImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;

    public function model(array $row)
    {
        $dataImport = [
            'course_id' => $row['course_id'],
            'name' => $row['name'],
            'gold' => $row['gold'],
            'exp' => $row['exp'],
            'item_type' => $row['item_type'],
            'item_amount' => $row['item_amount'],
            'waifu_id' => $row['waifu_id'],
            'waifu_fragment_amount' => $row['waifu_fragment_amount'],
            'created_by' => $row['created_by']
        ];

        return new Set($dataImport);
    }

    public function rules(): array
    {
        return [
            '*.course_id' => 'required',
        ];
    }
}
