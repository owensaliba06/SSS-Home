<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VehicleApiService
{
    /**
     * Validate that a vehicle make exists using NHTSA vPIC.
     * Returns true if make is found.
     */
   public function makeExists(string $make): bool
{
    $make = trim($make);

    if ($make === '') {
        return false;
    }

    $cacheKey = 'vpci_make_exists_' . md5(strtolower($make));

    return Cache::remember($cacheKey, now()->addDays(7), function () use ($make) {
        try {
            $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json';

            $response = Http::timeout(8)->retry(2, 200)->get($url);

            if (!$response->ok()) {
                // Fail-open if API responds with non-200
                return true;
            }

            $data = $response->json();
            $results = $data['Results'] ?? [];

            $needle = strtolower($make);

            foreach ($results as $row) {
                $name = strtolower($row['Make_Name'] ?? '');
                if ($name === $needle) {
                    return true;
                }
            }

            return false;
        } catch (\Throwable $e) {
            // Fail-open if network/DNS/timeout happens (prevents 500 errors)
            return true;
        }
    });
}

    /**
     * Validate that a model exists for a given make using NHTSA vPIC.
     * Returns true if model is found for make.
     */
    public function modelExistsForMake(string $make, string $model): bool
{
    $make = trim($make);
    $model = trim($model);

    if ($make === '' || $model === '') {
        return false;
    }

    $cacheKey = 'vpci_model_exists_' . md5(strtolower($make) . '|' . strtolower($model));

    return Cache::remember($cacheKey, now()->addDays(7), function () use ($make, $model) {
        try {
            $url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformake/' . urlencode($make) . '?format=json';

            $response = Http::timeout(8)->retry(2, 200)->get($url);

            if (!$response->ok()) {
                // Fail-open if API responds with non-200
                return true;
            }

            $data = $response->json();
            $results = $data['Results'] ?? [];

            $needle = strtolower($model);

            foreach ($results as $row) {
                $name = strtolower($row['Model_Name'] ?? '');
                if ($name === $needle) {
                    return true;
                }
            }

            return false;
        } catch (\Throwable $e) {
            // Fail-open if network/DNS/timeout happens (prevents 500 errors)
            return true;
        }
    });
}
}
