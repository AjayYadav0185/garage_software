<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuelType;

class FuelTypeSeeder extends Seeder
{
    public function run(): void
    {
        $fuelTypes = [
            ['carFuel' => 'Petrol', 'code' => 'PET', 'status' => true],
            ['carFuel' => 'Diesel', 'code' => 'DSL', 'status' => true],
            ['carFuel' => 'Electric', 'code' => 'ELEC', 'status' => true],
            ['carFuel' => 'Hybrid', 'code' => 'HYB', 'status' => true],
        ];

        foreach ($fuelTypes as $fuel) {
            FuelType::create($fuel);
        }
    }
}
