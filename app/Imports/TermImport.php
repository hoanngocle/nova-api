<?php

namespace App\Imports;

use App\Models\Term;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class TermImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;

    public function model(array $row)
    {
        $dataImport = [
            'set_id' => $row['set_id'],
            'japanese' => $row['japanese'],
            'kanji' => $row['kanji'],
            'vietnamese' => $row['vietnamese'],
            'created_by' => 'Emillia'
        ];

        return new Term($dataImport);
    }

    public function rules(): array
    {
        return [
            '*.set_id' => 'required',
        ];
    }
}
