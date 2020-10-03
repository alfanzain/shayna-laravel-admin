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
        if (is_null($this->resource)) {
            return [];
        }

        return is_array($this->resource)
            ? $this->resource
            : [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'type' => $this->type,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'code' => !is_null($this->resource) 
                            ? 200
                            : 404,
                'status' => !is_null($this->resource) 
                            ? 'success'
                            : 'failed',
                'message' => !is_null($this->resource) 
                            ? 'Data produk berhasil diambil'
                            : 'Data produk gagal diambil',
            ],
        ];
    }
}
