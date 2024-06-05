<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\project;
use Illuminate\Support\Str;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {
            $newProject = new project();
            $newProject->name = $faker->name();
            $newProject->client_name = $faker->company();
            $newProject->summary = $faker->text(500);
            $newProject->slug = Str::slug($newProject->name, '-');
            $newProject->save();
        }
    
    }
}
