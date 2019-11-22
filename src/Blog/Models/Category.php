<?php declare(strict_types=1);

namespace LeafCms\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use LeafCms\Blog\Exceptions\NonUniqueSlugException;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class Category extends Model
{
    use Sluggable;

    protected $guarded = [];

    protected $table = 'blog_categories';

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'name']];
    }

    public static function boot(): void
    {
        parent::boot();

        static::saving(function(self $category) {
            self::checkSlugUniqueness($category);
        });
    }

    /**
     * To ensure that slug is unique. (Sluggable package is going to be fixed - now unique slug doens't work) todo
     * TODO: Unit test after package fix
     *
     * @throws NonUniqueSlugException
     */
    protected static function checkSlugUniqueness(self $category): void
    {
        $query = self::query()->where(['slug' => $category->slug]);

        if ($category->id) {
            $query->whereNotIn('id', [$category->id]);
        }

        if ($query->first()) {
            throw new NonUniqueSlugException();
        }
    }
}
