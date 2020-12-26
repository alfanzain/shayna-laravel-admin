<?php

namespace App\Http\Resources;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ProductResource::collection($this->collection),
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
                'code' => !is_null($this->collection) 
                            ? 200
                            : 404,
                'status' => !is_null($this->collection) 
                            ? 'success'
                            : 'failed',
                'message' => !is_null($this->collection) 
                            ? 'Data daftar produk berhasil diambil'
                            : 'Data daftar produk tidak ditemukan',
            ],
        ];
    }
}
