<?php

namespace App\Http\Resources;

use App\Entities\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Customer $this */
        return [
            'full_name' => $this->getFirstName() . ' ' . $this->getLastName(),
            'email' => $this->getEmail(),
            'country' => $this->getCountry(),
        ];
    }
}