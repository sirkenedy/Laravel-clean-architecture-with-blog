<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
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
            "title" => $this->title,
            "description" => $this->description,
            "image" => $this->image,
            "keywords" => $this->keywords,
            "user" => [
                "id" => $this->user->id,
                "name" => $this->user->name,
                "username" => $this->user->username,
                "Joined_on" => $this->user->created_at,
            ],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
