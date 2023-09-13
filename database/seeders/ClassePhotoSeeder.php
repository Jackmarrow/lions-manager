<?php

namespace Database\Seeders;

use App\Models\ClassePhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassePhoto::insert([
            [
                "name"=> "salle_1.jpg",
                "classe_id"=>1
            ],
            [
                "name"=> "salle_2.jpg",
                "classe_id"=>1
            ],
            [
                "name"=> "salle_3.jpg",
                "classe_id"=>2
            ],
            [
                "name"=> "salle_4.jpg",
                "classe_id"=>2
            ],
            [
                "name"=> "salle_5.jpg",
                "classe_id"=>3
            ],
            [
                "name"=> "salle_6.jpg",
                "classe_id"=>3
            ],
            [
                "name"=> "salle_7.jpg",
                "classe_id"=>4
            ],
            [
                "name"=> "salle_8.jpg",
                "classe_id"=>4
            ],
            [
                "name"=> "salle_9.jpg",
                "classe_id"=>5
            ],
            [
                "name"=> "salle_10.jpg",
                "classe_id"=>5
            ],
            [
                "name"=> "salle_11.jpg",
                "classe_id"=>6
            ],
            [
                "name"=> "salle_12.jpg",
                "classe_id"=>6
            ],
            
        ]);
    }
}
