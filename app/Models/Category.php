<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

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
}
