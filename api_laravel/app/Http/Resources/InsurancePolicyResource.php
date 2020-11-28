<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InsurancePolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'iin' => $this->iin,
            'phone' => $this->phone,
            'car_number' => $this->car_number,
            'valid_from' => (string)$this->valid_from,
            'valid_until' => (string)$this->valid_until,
            'created_at' => (string)$this->created_at,
            'additional_drivers' => AdditionalDriverResource
                ::collection($this->whenLoaded('additionalDrivers')),
            $this->mergeWhen(
                $request->input('withDriversCount'),
                [
                    'drivers_count' => 1 + $this->additionalDrivers()->count(),
                ]
            ),
        ];
    }
}
