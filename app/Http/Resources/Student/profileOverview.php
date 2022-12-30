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
            "student_info" => $this->student,
            "subject_info" => $this->subject,
            "teacher_info" => $this->teacher,
            "parent_info" => $this->guardian,
            "class_info" => [
                "topic"=> $this->topic,
                "start_date"=> $this->start_date,
                "end_date"=> $this->end_date,
                "description"=> $this->description
            ]
        ];
    }
}
