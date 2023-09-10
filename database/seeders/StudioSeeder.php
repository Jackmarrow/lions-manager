<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Studio::insert([
            [
                "name" => "studio_1",
            ],
            [
                "name" => "studio_2",
            ],
            [
                "name" => "espace_cafe",
            ],
            [
                "name" => "espace_Agora",
            ],
            [
                "name" => "co_working",
            ],
            [
                "name" => "externe",
            ],
        ]);
    }
}
