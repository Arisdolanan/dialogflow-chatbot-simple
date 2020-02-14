<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaystationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'harga' => $this->harga,
            // relasi antar model quote dengan user
            // 'user' => new DataResource($this->user),
        ];
    }
}
