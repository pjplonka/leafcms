<?php declare(strict_types=1);

namespace LeafCms\FileCenter\Models;

use Illuminate\Database\Eloquent\Model;

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
}
