<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Commenting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable =[
        'sub_category_id',
        'user_id',
        'title',
        'body',
        
            ];
            public function category():BelongsTo
            {
                return $this->belongsTo(Category::class);
                
            }

            public function comment():HasMany
{
    return $this->hasMany(Commenting::class);
}
        
}
