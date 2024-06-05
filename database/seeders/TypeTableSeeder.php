<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['FrontEnd', 'Backend', 'FullStack', 'Design', 'DevOps'];

        // per ogni categoria crea nuova istanza di Category, la popolo e la salvo
        foreach ($types as $typesName) {
            $newTypes = new Type();
            $newTypes->name = $typesName;
            $newTypes->slug = Str::slug($newTypes->name, '-');
            $newTypes->save();
        }
    }
}