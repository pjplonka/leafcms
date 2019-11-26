<?php declare(strict_types=1);

namespace LeafCms\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use LeafCms\Blog\Exceptions\NonUniqueSlugException;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 */
class Article extends Model
{
    use Sluggable;

    protected $guarded = [];

    protected $table = 'blog_articles';

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public static function boot(): void
    {
        parent::boot();

        static::saving(function(self $article) {
            self::checkSlugUniqueness($article);
        });
    }

    /**
     * To ensure that slug is unique. (Sluggable package is going to be fixed - now unique slug doens't work) todo
     * TODO: Unit test after package fix
     *
     * @throws NonUniqueSlugException
     */
    protected static function checkSlugUniqueness(self $article): void
    {
        $query = self::query()->where(['slug' => $article->slug]);

        if ($article->id) {
            $query->whereNotIn('id', [$article->id]);
        }

        if ($query->first()) {
            throw new NonUniqueSlugException();
        }
    }
}
