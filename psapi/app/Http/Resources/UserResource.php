<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        // 'created_at' => $this->created_at->diffForHumans()

        return [
            "code" => 1,
            "status" => "success",
            "message" => "Login Success",
            'data' => [
                'token' => $this->api_token,
            ],
        ];
    }
}
