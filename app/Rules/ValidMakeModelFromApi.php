<?php

namespace App\Rules;

use App\Services\VehicleApiService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidMakeModelFromApi implements ValidationRule
{
    public function __construct(
        private readonly string $makeField = 'make',
        private readonly string $modelField = 'model',
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $attribute will be "model" if we attach rule to model field (recommended).
        // We'll fetch the make + model from request.
        $make = request()->input($this->makeField, '');
        $model = request()->input($this->modelField, '');

        $service = app(VehicleApiService::class);

        // 1) Make must exist
        if (!$service->makeExists($make)) {
            $fail("The selected make '{$make}' does not appear to be a valid manufacturer (checked via external API).");
            return;
        }

        // 2) Model must exist for that make
        if (!$service->modelExistsForMake($make, $model)) {
            $fail("The model '{$model}' does not appear to exist for '{$make}' (checked via external API).");
        }
    }
}
