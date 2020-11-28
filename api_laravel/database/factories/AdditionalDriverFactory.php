<?php

namespace Database\Factories;

use App\Models\AdditionalDriver;
use App\Models\InsurancePolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdditionalDriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdditionalDriver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $insurancePolicyFactory = new InsurancePolicyFactory();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'iin' => $insurancePolicyFactory->getFakeIin(),
            'insurance_policy_id' => InsurancePolicy
                ::factory()
                ->create()
                ->id,
        ];
    }
}
