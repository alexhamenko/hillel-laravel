<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Category extends Model
{
    use HasFactory, HasEagerLimit;

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * Id of default category which used for uncategorized posts
     *
     * @var int
     */
    protected static $default_category_id = 1;

    /**
     * Returns id of default category which used for uncategorized posts
     *
     * @return int
     */
    public static function getDefaultCategoryId():int {
        return self::$default_category_id;
    }

    /**
     * Set id of default category
     *
     * @param int $id
     */
    public static function setDefaultCategoryId(int $id) {
        self::$default_category_id = $id;
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all of the category's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
