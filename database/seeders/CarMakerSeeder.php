<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarMaker;
use App\Models\Country;

class CarMakerSeeder extends Seeder
{
    public function run(): void
    {
        $makers = [
            ['name' => 'Toyota', 'country' => 'Japan'],
            ['name' => 'Honda', 'country' => 'Japan'],
            ['name' => 'BMW', 'country' => 'Germany'],
            ['name' => 'Mercedes', 'country' => 'Germany'],
            ['name' => 'Ford', 'country' => 'USA'],
            ['name' => 'Chevrolet', 'country' => 'USA'],
        ];

        foreach ($makers as $maker) {
            $country = Country::where('name', $maker['country'])->first();
            if ($country) {
                CarMaker::create([
                    'name' => $maker['name'],
                    'country_id' => $country->id,
                    'checkin' => true, // default check-in
                ]);
            }
        }
    }
}
