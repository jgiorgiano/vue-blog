<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => (int)$this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => (int)$this->role,
            'subscribe' => (int)$this->subscribe,
            'subscribe_date' => $this->subscribe_date,
            'profile_image_path' => $this->profile_image_path,
            'created_at' => $this->created_at,
            'terms_agreement' => (int)$this->terms_agreement,
        ];
    }
}
