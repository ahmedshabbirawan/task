<?php

namespace App\Http\Resources;

// use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request){
        // return parent::toArray($request);


        return [

            'id' => $this->id,
            
            'business_id' => $this->business_id,
            'business_name' => optional($this->business)->name,

            'customer_id' => $this->customer_id,
            'customer_name' => optional($this->customer)->name,

            'product_id' => $this->product_id,
            'product_name' => optional($this->product)->name,

            'created_at' => $this->created_at->format('Y-m-d h:i:s A')

        ];


    }
}
