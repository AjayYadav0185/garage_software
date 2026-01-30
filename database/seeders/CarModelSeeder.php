<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;
use App\Models\CarMaker;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            ['maker' => 'Toyota', 'name' => 'Corolla', 'year' => 2023],
            ['maker' => 'Toyota', 'name' => 'Camry', 'year' => 2022],
            ['maker' => 'Honda', 'name' => 'Civic', 'year' => 2023],
            ['maker' => 'Honda', 'name' => 'Accord', 'year' => 2022],
            ['maker' => 'BMW', 'name' => 'X5', 'year' => 2023],
            ['maker' => 'Mercedes', 'name' => 'C-Class', 'year' => 2022],
            ['maker' => 'Ford', 'name' => 'F-150', 'year' => 2023],
        ];

        foreach ($models as $model) {
            $maker = CarMaker::where('name', $model['maker'])->first();
            if ($maker) {
                CarModel::create([
                    'maker_id' => $maker->id,
                    'name' => $model['name'],
                    'year' => $model['year'],
                ]);
            }
        }
    }
}
