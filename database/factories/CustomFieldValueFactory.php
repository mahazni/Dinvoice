<?php

namespace Database\Factories;

use Dinvoice\Models\CustomFieldValue;
use Dinvoice\Models\CustomField;
use Dinvoice\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomFieldValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomFieldValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'custom_field_valuable_type' => $this->faker->name ,
            'custom_field_valuable_id' => 1,
            'type' => $this->faker->name,
            'custom_field_id' => CustomField::factory(),
            'company_id' => User::where('role', 'super admin')->first()->company_id,
        ];
    }
}
