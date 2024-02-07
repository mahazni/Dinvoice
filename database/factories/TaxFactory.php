<?php

namespace Database\Factories;

use Dinvoice\Models\Tax;
use Dinvoice\Models\TaxType;
use Dinvoice\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tax_type_id' => TaxType::factory(),
            'percent' => function (array $item) {
                return TaxType::find($item['tax_type_id'])->percent;
            },
            'name' => function (array $item) {
                return TaxType::find($item['tax_type_id'])->name;
            },
            'company_id' => User::where('role', 'super admin')->first()->company_id,
            'amount' => $this->faker->randomDigitNotNull
        ];
    }
}
