<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDriver extends Model
{
    use HasFactory;

    protected $protected = [];

    public function insurancePolicy()
    {
        return $this->belongsTo(
            InsurancePolicy::class,
            'insurance_policy_id',
            'id'
        );
    }
}
