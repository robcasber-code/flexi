<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email'     => $this->email,
            'username'  => $this->username,
            'gender'    => $this->gender,
            'country'   => $this->country,
            'city'      => $this->city,
            'phone'     => $this->phone,
        ];
    }
}
