<?php

namespace Database\Seeders;

use App\Models\AdditionalDriver;
use App\Models\InsurancePolicy;
use Database\Factories\InsurancePolicyFactory;
use Illuminate\Database\Seeder;

class InsurancePolicyDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $policies = InsurancePolicy::factory()
            ->times(20)
            ->create();

        $this->generateAdditionalDriversFor($policies);
    }

    private function generateAdditionalDriversFor($policies): void
    {
        foreach ($policies as $policy) {
            $driversCount = collect([0, 1, 2])
                ->shuffle()
                ->first();

            $policy
                ->additionalDrivers()
                ->createMany(
                    AdditionalDriver
                        ::factory()
                        ->times($driversCount)
                        ->make()
                        ->toArray()
                );
        }
    }
}
