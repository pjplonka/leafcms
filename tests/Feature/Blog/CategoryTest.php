<?php declare(strict_types=1);

namespace Tests\Feature\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_see_categories_list(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $response = $this->get(route('dashboard.blog.categories.index'));

        $response->assertSee($category->name);
    }

    /** @test */
    public function a_user_can_create_a_category(): void
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);

        $attributes = [
            'name' => $name,
        ];

        $this->post(route('dashboard.blog.categories.store'), $attributes)
            ->assertRedirect(route('dashboard.blog.categories.index'));

        $expectedDataInDb = array_merge($attributes, ['slug' => $slug]);

        $this->assertDatabaseHas('blog_categories', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_create_a_category_without_name(): void
    {
        $response = $this->post(route('dashboard.blog.categories.store'));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_not_create_a_category_with_not_unique_name(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $attributes = [
            'name' => $category->name
        ];

        $response = $this->post(route('dashboard.blog.categories.store', $attributes));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_category(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $this->assertDatabaseHas('blog_categories', $category->toArray());

        $attributes = [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
        ];

        $this->put(route('dashboard.blog.categories.update', ['category' => $category->id]), $attributes)
            ->assertRedirect(route('dashboard.blog.categories.index'));

        $expectedDataInDb = array_merge($attributes, ['id' => $category->id]);

        $this->assertDatabaseMissing('blog_categories', $category->toArray());
        $this->assertDatabaseHas('blog_categories', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_update_a_category_with_not_unique_name_and_slug(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        /** @var Category $category */
        $categoryForUpdate = factory(Category::class)->create();

        $attributes = [
            'name' => $category->name,
            'slug' => $category->slug
        ];

        $response = $this->put(
            route('dashboard.blog.categories.update', ['category' => $categoryForUpdate->id]),
            $attributes
        );

        $response->assertSessionHasErrors(['name', 'slug']);
    }

    /** @test */
    public function a_user_can_delete_a_category(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $this->assertDatabaseHas('blog_categories', $category->toArray());

        $this->delete(route('dashboard.blog.categories.destroy', ['category' => $category->id]))
            ->assertRedirect(route('dashboard.blog.categories.index'));

        $this->assertDatabaseMissing('blog_categories', $category->toArray());
    }

    /** @test */
    public function a_user_can_delete_category_by_get_http_method(): void
    {
        /** @var Category $category */
        $category = factory(Category::class)->create();

        $this->assertDatabaseHas('blog_categories', $category->toArray());

        $this->get(route('dashboard.blog.categories.get-destroy', ['category' => $category->id]))
            ->assertRedirect(route('dashboard.blog.categories.index'));

        $this->assertDatabaseMissing('blog_categories', $category->toArray());
    }
}
