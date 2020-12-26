<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
                'code' => !is_null($this->resource) 
                            ? 200
                            : 404,
                'status' => !is_null($this->resource) 
                            ? 'success'
                            : 'failed',
                'message' => !is_null($this->resource) 
                            ? 'Data transaksi berhasil diambil'
                            : 'Data transaksi tidak ditemukan',
            ],
        ];
    }
}
