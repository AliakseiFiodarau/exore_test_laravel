<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    /**
     * constant strings for post model attributes
     */
    public const TABLE_NAME = 'posts';
    public const TITLE = 'title';
    public const IMAGE = 'image';
    public const CATEGORY_ID = 'category_id';
    public const POSTED_BY = 'posted_by';

    protected $table = self::TABLE_NAME;

    /**
     * set fillable fields
     * @var array
     */
    protected $fillable = [
        self::TITLE,
        self::IMAGE,
        self::CATEGORY_ID,
        self::POSTED_BY
    ];

    /**
     * set string fields for filtering
     * @var array
     */
    protected $likeFilterFields = [
        self::TITLE
    ];

    /**
     * set string fields for filtering
     * @var array
     */
    protected $boolFilterFields = [];

    /**
     * get post category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            self::CATEGORY_ID,
            'id'
        );
    }

    /**
     * get user who created the post
     *
     * @return BelongsTo
     */
    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            self::POSTED_BY,
            'id'
        );
    }
}
