<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'category_id'=>new CategoryResource($this->category),
            'user_id'=>new UserResource($this->user),
            'title'=>$this->title,
            'body'=>$this->body,
            'created_at'=>$this->created_at,
                    ];
                }
    }

