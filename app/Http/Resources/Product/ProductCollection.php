<?php

namespace App\Http\Resources\Product;

//use Illuminate\Http\Resources\Json\ResourceCollection;
//Modify to use Resource
use Illuminate\Http\Resources\Json\JsonResource;

//class ProductCollection extends ResourceCollection
class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        //dd($request);
        return [
            'name' => $this->name,
            'final_price' => round((1 - ($this->discount/100)) * $this->price , 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No rating yet',
            'discount' => $this->discount,
            'href' => [
                'link' => route('products.show' , $this->id)
            ]
        ];
    }
}
