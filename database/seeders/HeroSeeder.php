<?php

namespace Database\Seeders;

use App\Imports\HeroImport;
use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hero::query()->truncate();

        Excel::import(
            new HeroImport(),
            storage_path('app/public/data_seeder/hero.xlsx')
        );
    }
}
