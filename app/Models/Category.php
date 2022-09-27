<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * constant strings for category model attributes
     */
    public const TABLE_NAME = 'categories';
    public const TITLE = 'title';

    protected $guarded = [];

    /**
     * get collection of posts, belonging to the category
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            Post::class,
            Post::CATEGORY_ID,
            'id'
        );
    }
}
