<?php declare(strict_types=1);

namespace LeafCms\FileCenter\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int    $id
 * @property string $path
 * @property string $filename
 * @property string $extension
 */
class Image extends Model
{
    protected $guarded = [];

    protected $table = 'file_center_images';

    public function filename(): string
    {
        return $this->filename;
    }

    public function fullFilename(): string
    {
        return $this->filename . '.' . $this->extension;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function fullPath(): string
    {
        return $this->path . '/' . $this->fullFilename();
    }

    public static function notTaken(): Collection
    {
        return Image::query()->whereNotExists(function (Builder $query) {
            $query->select('id')
                ->from('blog_articles')
                ->whereRaw('blog_articles.image_id = file_center_images.id');
        })->get();
    }
}
