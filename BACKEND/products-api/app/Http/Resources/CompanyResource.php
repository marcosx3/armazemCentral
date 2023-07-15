<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'company' => [
                'id' => $this->id,
                'companyName' => $this->name,
                'companyEmail'=> $this->email,
                'companyCnpj'=> $this->cnpj,
            ],
           
        ];
    }
}
