<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\TaxCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OtherIncome>
 */
class OtherIncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'tax_category_id' => TaxCategory::factory(),
            'code' => $this->faker->randomElement(['MEAL_ALW', 'PERA', 'CLOTH_ALW']),
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 500, 2000),
            'is_recurring' => $this->faker->boolean(80),
        ];
    }
}
