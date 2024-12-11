<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Comment $comment */
        $comment = $this->resource;

        return [
            'id' => $comment->id,
            'comment' => $comment->comment,
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $comment->created_at
        ];
    }
}
