<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
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
        return [
            'id'=>$this->id,
            'post_id'=>new PostResource($this->post),
            'user_id'=>new UserResource($this->user),
            'commenting'=>$this->commenting,
            'created_at'=>$this->created_at,
                    ];
    }
}
