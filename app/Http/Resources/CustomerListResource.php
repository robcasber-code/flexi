<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email'     => $this->email,
            'country'   => $this->country,
        ];
    }
}
