<?php

namespace Database\Factories\FacultyInformation;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacultyInformation\PermanentAddress>
 */
class PermanentAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'house_block_no' => $this->faker->buildingNumber(),
            'street' => $this->faker->streetAddress(),
            'subdivision_village' => $this->faker->city(),
            'barangay' => $this->faker->streetName(),
            'city_municipality' => $this->faker->country(),
            'province' => $this->faker->firstName(),
            'zip_code' => $this->faker->postcode(),
        ];
    }
}
