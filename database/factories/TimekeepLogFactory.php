<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimekeepLog>
 */
class TimekeepLogFactory extends Factory
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
            'schedule_id' => Schedule::factory(),
            'time_in' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'time_out' => function (array $attributes) {
                return \Carbon\Carbon::parse($attributes['time_in'])->addHours(9);
            },
        ];
    }
}
