<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;
class TypeSeeder extends Seeder
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
        foreach ($types as $typeName) {
            $newType = new Type();
            $newType->name = $typeName;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->save();
        }
    }
}
