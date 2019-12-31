<?php declare(strict_types=1);

namespace Tests\Feature\FileCenter;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use LeafCms\FileCenter\Models\Image;
use Tests\TestCase;

/**
 * Class ImageTest
 * @package Tests\Feature\FileCenter
 */
class ImageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_see_images_list(): void
    {
        /** @var Image $image */
        $image = factory(Image::class)->create();

        $response = $this->get(route('dashboard.file-center.images.index'));

        $response->assertSee($image->fullFilename());
    }

    /** @test */
    public function a_user_can_upload_a_file(): void
    {
        Storage::fake('local');

        $attributes = [
            'file' => UploadedFile::fake()->image('image.png')
        ];

        $this->post(route('dashboard.file-center.images.store'), $attributes)
            ->assertRedirect(route('dashboard.file-center.images.index'));

        Storage::disk('local')->assertExists('images/image.png');

        $this->assertDatabaseHas('file_center_images', [
            'path'      => 'images',
            'filename'  => 'image',
            'extension' => 'png'
        ]);
    }

    /** @test */
    public function a_user_can_change_image_filename(): void
    {
        Storage::fake('local');

        /** @var Image $image */
        $image = factory(Image::class)->create();

        UploadedFile::fake()->image('image.png')->storeAs($image->path(), $image->fullFilename());

        Storage::disk('local')->assertExists($image->fullPath());

        $this->assertDatabaseHas('file_center_images', $image->toArray());

        $newFilename = 'new-file-name';

        $attributes = [
            'image' => $image->id,
            'filename' => $newFilename
        ];

        $this->put(route('dashboard.file-center.images.update', $attributes))
            ->assertRedirect(route('dashboard.file-center.images.index'));

        Storage::disk('local')->assertMissing($image->fullPath());

        $this->assertDatabaseMissing('file_center_images', $image->toArray());

        $image->filename = $newFilename;

        Storage::disk('local')->assertExists($image->fullPath());

        $this->assertDatabaseHas('file_center_images', $image->toArray());
    }

    /** @test */
    public function a_user_can_delete_a_image(): void
    {
        Storage::fake('local');

        /** @var Image $image */
        $image = factory(Image::class)->create();

        UploadedFile::fake()->image('image.png')->storeAs($image->path(), $image->fullFilename());

        Storage::disk('local')->assertExists($image->fullPath());

        $this->assertDatabaseHas('file_center_images', $image->toArray());

        $this->delete(route('dashboard.file-center.images.destroy', ['image' => $image->id]))
            ->assertRedirect(route('dashboard.file-center.images.index'));

        $this->assertDatabaseMissing('file_center_images', $image->toArray());

        Storage::disk('local')->assertMissing($image->fullPath());
    }

    /** @test */
    public function a_user_can_delete_a_image_by_get_http_method(): void
    {
        Storage::fake('local');

        /** @var Image $image */
        $image = factory(Image::class)->create();

        UploadedFile::fake()->image('image.png')->storeAs($image->path(), $image->fullFilename());

        Storage::disk('local')->assertExists($image->fullPath());

        $this->assertDatabaseHas('file_center_images', $image->toArray());

        $this->get(route('dashboard.file-center.images.get-destroy', ['image' => $image->id]))
            ->assertRedirect(route('dashboard.file-center.images.index'));

        $this->assertDatabaseMissing('file_center_images', $image->toArray());

        Storage::disk('local')->assertMissing($image->fullPath());
    }
}
