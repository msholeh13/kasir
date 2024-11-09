<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\supplier>
 */
class SupplierFactory extends Factory
{

    // protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $string = '';

        return [
            'nama'      => $faker->name(),
            'alamat'    => $faker->address(),
            'nohp'      => '08' . str_pad($string, 10, mt_rand(0, 9999999999)),
        ];
    }
}
