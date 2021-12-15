<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExcelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
       // return parent::toArray($request);
        return [
            'code' => $this->code,
            'recipient_name' => $this->recipient_name,
            'recipient_phone' => $this->recipient_phone,
            'goods_name' => $this->goods_name,
            'weight' => $this->weight,
            'price' => $this->price,
            'helo'=>'eho'
        ];
    }
}
