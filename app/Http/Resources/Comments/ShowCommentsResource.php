<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "commentable_id" => $this->commentable_id,
            "parent_id" => $this->parent_id,
            "comment" => $this->comment,
            "commentable_type" => $this->commentable_type,
            "created_at" => $this->created_at
        ];
    }
}
