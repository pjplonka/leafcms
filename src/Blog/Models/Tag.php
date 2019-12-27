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
class Tag extends Model
{
    use Sluggable;

    protected $guarded = [];

    protected $table = 'blog_tags';

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'name']];
    }

    public static function boot(): void
    {
        parent::boot();

        static::saving(function(self $tag) {
            self::checkSlugUniqueness($tag);
        });
    }

    /**
     * To ensure that slug is unique. (Sluggable package is going to be fixed - now unique slug doens't work) todo
     * TODO: Unit test after package fix
     *
     * @throws NonUniqueSlugException
     */
    protected static function checkSlugUniqueness(self $tag): void
    {
        $query = self::query()->where(['slug' => $tag->slug]);

        if ($tag->id) {
            $query->whereNotIn('id', [$tag->id]);
        }

        if ($query->first()) {
            throw new NonUniqueSlugException();
        }
    }
}
