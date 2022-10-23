<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->first_name . ' ' .$this->last_name,
            "email" => $this->email,
            "role" => $this->getRoleNames(),
            "permissions" => $this->getPermissionsViaRoles()->pluck('name'),
            "active_status" => (bool) $this->user_status,
            "created_at" => $this->created_at->format("M d, Y H:i A"),
            "updated_at" => $this->updated_at->format("M d, Y H:i A")
        ];
    }
}
