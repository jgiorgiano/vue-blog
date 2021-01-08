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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'subscribe' => $this->subscribe,
            'subscribe_date' => $this->subscribe_date,
            'profile_image_path' => $this->profile_image_path,
            'created_at' => $this->created_at,
        ];

//        return parent::toArray($request);
    }
}
