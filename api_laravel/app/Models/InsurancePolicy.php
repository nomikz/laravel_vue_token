<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePolicy extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['additionalDrivers'];

    public function additionalDrivers()
    {
        return $this->hasMany(
            AdditionalDriver::class,
            'insurance_policy_id',
            'id'
        );
    }
}
