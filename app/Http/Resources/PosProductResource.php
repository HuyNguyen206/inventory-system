<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PosProductResource extends JsonResource
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
            'product_name' => $this->product_name,
            'image' => $this->image,
            'created_at' => Carbon::make($this->created_at)->diffForHumans(),
            'product_quantity' => $this->product_quantity,
            'category_id' => $this->category_id
        ];
    }
}
