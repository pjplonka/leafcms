<?php declare(strict_types=1);

namespace LeafCms\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LeafCms\Blog\Exceptions\NonUniqueSlugException;
use LeafCms\FileCenter\Models\Image;

/**
 * @property int        $id
 * @property string     $title
 * @property string     $slug
 * @property Image|null $image
 * @property Collection $categories
 * @property Collection $tags
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

        static::saving(function (self $article) {
            self::checkSlugUniqueness($article);
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blog_article_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_article_tag');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
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
