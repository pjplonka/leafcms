<?php declare(strict_types=1);

namespace Tests\Feature\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_see_tags_list(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        $response = $this->get(route('dashboard.blog.tags.index'));

        $response->assertSee($tag->name);
    }

    /** @test */
    public function a_user_can_create_a_tag(): void
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);

        $attributes = [
            'name' => $name,
        ];

        $this->post(route('dashboard.blog.tags.store'), $attributes)
            ->assertRedirect(route('dashboard.blog.tags.index'));

        $expectedDataInDb = array_merge($attributes, ['slug' => $slug]);

        $this->assertDatabaseHas('blog_tags', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_create_a_tag_without_name(): void
    {
        $response = $this->post(route('dashboard.blog.tags.store'));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_not_create_a_tag_with_not_unique_name(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        $attributes = [
            'name' => $tag->name
        ];

        $response = $this->post(route('dashboard.blog.tags.store', $attributes));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_tag(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        $this->assertDatabaseHas('blog_tags', $tag->toArray());

        $attributes = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
        ];

        $this->put(route('dashboard.blog.tags.update', ['tag' => $tag->id]), $attributes)
            ->assertRedirect(route('dashboard.blog.tags.index'));

        $expectedDataInDb = array_merge($attributes, ['id' => $tag->id]);

        $this->assertDatabaseMissing('blog_tags', $tag->toArray());
        $this->assertDatabaseHas('blog_tags', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_update_a_tag_with_not_unique_name_and_slug(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        /** @var Tag $tag */
        $tagForUpdate = factory(Tag::class)->create();

        $attributes = [
            'name' => $tag->name,
            'slug' => $tag->slug
        ];

        $response = $this->put(
            route('dashboard.blog.tags.update', ['tag' => $tagForUpdate->id]),
            $attributes
        );

        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function a_user_can_delete_a_tag(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        $this->assertDatabaseHas('blog_tags', $tag->toArray());

        $this->delete(route('dashboard.blog.tags.destroy', ['tag' => $tag->id]))
            ->assertRedirect(route('dashboard.blog.tags.index'));

        $this->assertDatabaseMissing('blog_tags', $tag->toArray());
    }

    /** @test */
    public function a_user_can_delete_tag_by_get_http_method(): void
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();

        $this->assertDatabaseHas('blog_tags', $tag->toArray());

        $this->get(route('dashboard.blog.tags.get-destroy', ['tag' => $tag->id]))
            ->assertRedirect(route('dashboard.blog.tags.index'));

        $this->assertDatabaseMissing('blog_tags', $tag->toArray());
    }
}
