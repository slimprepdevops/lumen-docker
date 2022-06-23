<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Node;
use Illuminate\Database\Eloquent\Factories\Factory;

class NodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Node::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
    	return [
            'total_ram' => $this->faker->randomNumber(8),
            'total_disk' => $this->faker->randomNumber(8),
            'allocated_ram' => $this->faker->randomNumber(8),
            'allocated_disk' => $this->faker->randomNumber(8),
            'system_uptime' => Carbon::now(),
    	];
    }
}
