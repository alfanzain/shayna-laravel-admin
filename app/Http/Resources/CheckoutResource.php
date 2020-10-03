<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
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
                            ? 'Data checkout berhasil diambil'
                            : 'Data checkout gagal diambil',
            ],
        ];
    }
}
