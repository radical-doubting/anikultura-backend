<?php

namespace App\Http\Resources\BigBrother;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\BigBrother\BigBrother
 */
class BigBrotherResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'firstName' => $this->first_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->last_name,
        ];
    }
}
