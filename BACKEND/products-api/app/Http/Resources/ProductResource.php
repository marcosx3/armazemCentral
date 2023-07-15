<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => [
                'id' => $this->id,
                'name' => $this->name,
                'category' => $this->category,
                'quantity' => $this->quantity,
                'unitary_price' => $this->unitary_price,
                // You need review this relationship
                //'user_id' => $this->user()->id,
                //'company_id' => $this->company->company_id
            ],
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'companyID' => $this->company->id
            ],
            'company' => [
                'id' => $this->company->id,
                'companyName' => $this->company->name,
                'companyEmail' => $this->company->email,
                'companyCnpj' => $this->company->cnpj,
            ],
        ];
    }
}
