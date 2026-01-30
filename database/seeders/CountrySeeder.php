<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = ['USA', 'Germany', 'Japan', 'India', 'UK', 'France', 'Italy'];

        foreach ($countries as $name) {
            Country::create(['name' => $name]);
        }
    }
}
