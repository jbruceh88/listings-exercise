<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->randomElement([
            'Manchester', 'Leeds', 'Liverpool', 'Sheffield',
            'Newcastle', 'Nottingham', 'Bristol', 'Birmingham',
        ]);

        return [
            'name' => $city.' '.fake()->randomElement(['Central', 'North', 'South', 'Quays', 'Village']),
            'region' => $city,
        ];
    }
}
