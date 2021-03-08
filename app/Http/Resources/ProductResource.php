<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'category' => $this->category,
            'product_name' => $this->product_name,
            'product_code' => $this->product_code,
            'root' => $this->root,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'supplier_id' => $this->supplier_id,
            'supplier' => $this->supplier,
            'buying_date' => $this->buying_date,
            'image' => $this->image,
            'product_quantity' => $this->product_quantity,
        ];
    }
}
