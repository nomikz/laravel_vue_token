<?php

namespace Database\Factories;

use App\Models\InsurancePolicy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InsurancePolicyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InsurancePolicy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomDateTime = $this
            ->faker
            ->dateTime
            ->format('Y-m-d H:i:s');
        $validUntil = Carbon
            ::parse($randomDateTime)
            ->addMonths($this->faker->randomDigit)
            ->toDateTimeString();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'iin' => $this->getFakeIin(),
            'phone' => '+77777777777',
            'car_number' => $this->getFakeCarNumber(),
            'valid_from' => $randomDateTime,
            'valid_until' => $validUntil,
        ];
    }

    public function getFakeIin(): string
    {
        $iin = '';

        foreach (range(0, 11) as $i) {
            $iin .= $this->faker->randomDigit;
        }

        return $iin;
    }

    private function getFakeCarNumber(): string
    {
        $carNumber = '';

        foreach(range(0, 2) as $i) {
            $carNumber .= $this->faker->randomDigit;
        }

        foreach(range(0, 1) as $i) {
            $carNumber .= $this->faker->randomLetter;
        }

        return $carNumber . '02';
    }
}
