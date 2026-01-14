<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Make;
use App\Models\CarModel;

class MakeCarModelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Toyota' => ['Yaris', 'Corolla', 'Auris'],
            'Honda' => ['Civic', 'Jazz'],
            'Volkswagen' => ['Golf', 'Polo'],
            'BMW' => ['320i', 'X1'],
            'Mercedes' => ['A Class', 'C Class'],
        ];

        foreach ($data as $makeName => $models) {
            $make = Make::firstOrCreate(['name' => $makeName]);

            foreach ($models as $modelName) {
                CarModel::firstOrCreate([
                    'make_id' => $make->id,
                    'name' => $modelName,
                ]);
            }
        }
    }
}
