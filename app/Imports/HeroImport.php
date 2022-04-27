<?php

namespace App\Imports;

use App\Models\Hero;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class HeroImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;

    public function model(array $row)
    {
        $dataImport = [
            'name'          => $row['name'],
            'bio'           => $row['bio'],
            'avatar'        => $row['avatar'],
            'rarity'        => $row['rarity'],
            'element'       => $row['element'],
            'type'          => $row['type'],
            'attack'        => $row['attack'],
            'health'        => $row['health'],
            'defend'        => $row['defend'],
            'eva'           => $row['eva'],
            'aim'           => $row['aim'],
            'crit_rate'     => $row['crit_rate'],
            'crit_damage'   => $row['crit_damage'],
            'exp_rate'      => $row['exp_rate'],
            'coin_rate'     => $row['coin_rate'],
            'statuse'       => $row['status'],
            'created_at'    => $row['created_at'],
        ];

        return new Hero($dataImport);
    }

    public function rules(): array
    {
        return [
            '*.name'    => 'required',
            '*.bio'     => 'required',
            '*.avatar'  => 'required',
            '*.rarity'  => 'required',
            '*.element' => 'required',
            '*.type'    => 'required',
            '*.attack'  => 'required',
            '*.defend'  => 'required',
            '*.health'  => 'required',
            '*.status'  => 'required',
        ];
    }
}
