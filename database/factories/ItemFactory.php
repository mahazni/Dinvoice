<?php

namespace Database\Factories;

use Dinvoice\Models\Item;
use Dinvoice\Models\User;
use Dinvoice\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'company_id' => User::where('role', 'super admin')->first()->company_id,
            'price' => $this->faker->randomDigitNotNull,
            'unit_id' => Unit::factory()
        ];
    }
}
