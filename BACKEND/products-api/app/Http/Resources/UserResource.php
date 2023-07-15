<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      //  return parent::toArray($request);
      return [
        'user' => [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'companyID' => $this->company_id
        ],
        'company' => [
          'id' => $this->company->id,
          'companyName' => $this->company->name,
          'companyEmail'=> $this->company->email,
          'companyCnpj'=> $this->company->cnpj,
      ],
    ];
      
    }
}
