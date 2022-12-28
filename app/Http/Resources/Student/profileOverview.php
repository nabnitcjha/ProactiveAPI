<?php

namespace App\Http\Resources\student;

use Illuminate\Http\Resources\Json\JsonResource;

class profileOverview extends JsonResource
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
            "full_name" => $this->id,
            "subjects" => $this->first_name . ' ' .$this->last_name,
            "parents" => $this->email,
            "classes" => $this->getRoleNames(),
            "email" => $this->getPermissionsViaRoles()->pluck('name'),
            "phone" => (bool) $this->user_status
        ];
    }
}
