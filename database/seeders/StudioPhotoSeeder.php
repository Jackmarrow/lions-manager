<?php

namespace Database\Seeders;

use App\Models\StudioPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudioPhoto::insert([
            [
                "photo"=> "studio_1.jpg",
                "studio_id"=>1
            ],
            [
                "photo"=> "studio_2.jpg",
                "studio_id"=>1
            ],
            [
                "photo"=> "studio_3.jpg",
                "studio_id"=>2
            ],
            [
                "photo"=> "studio_4.jpg",
                "studio_id"=>2
            ],
            [
                "photo"=> "cafe_1.jpg",
                "studio_id"=>3
            ],
            [
                "photo"=> "cafe_2.jpg",
                "studio_id"=>3
            ],
            [
                "photo"=> "agora_space_1.jpg",
                "studio_id"=>4
            ],
            [
                "photo"=> "agora_space_2.jpg",
                "studio_id"=>4
            ],
            [
                "photo"=> "co-working_1.jpg",
                "studio_id"=>5
            ],
            [
                "photo"=> "co-working_2.jpg",
                "studio_id"=>5
            ],
            [
                "photo"=> "externe_1.jpg",
                "studio_id"=>6
            ],
            [
                "photo"=> "externe_2.jpg",
                "studio_id"=>6
            ],
            
        ]);
    }
}
