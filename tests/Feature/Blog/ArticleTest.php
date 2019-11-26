<?php declare(strict_types=1);

namespace Tests\Feature\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_see_articles_list(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $response = $this->get(route('dashboard.blog.articles.index'));

        $response->assertSee($article->id);
        $response->assertSee($article->title);
    }

    /** @test */
    public function a_user_can_create_an_article(): void
    {
        $title = $this->faker->name;
        $slug = Str::slug($title);
        $content = [
            [
                'type' => 'header',
                'level' => 'h2',
                'value' => $this->faker->title
            ],
            [
                'type' => 'paragraph',
                'value' => '<p>' . $this->faker->paragraph . '</p>'
            ],
        ];

        $attributes = [
            'title'   => $title,
            'content' => $content,
        ];

        $this->post(route('dashboard.blog.articles.store'), $attributes)
            ->assertRedirect(route('dashboard.blog.articles.index'));

        $expectedDataInDb = array_merge($attributes, [
            'slug' => $slug,
            'content' => json_encode($content)
        ]);

        $this->assertDatabaseHas('blog_articles', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_create_an_article_without_name(): void
    {
        $response = $this->post(route('dashboard.blog.articles.store'));

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_user_can_not_create_an_article_with_not_unique_name(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $attributes = [
            'title' => $article->title
        ];

        $response = $this->post(route('dashboard.blog.articles.store', $attributes));

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_user_can_update_an_article(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $this->assertDatabaseHas('blog_articles', $article->toArray());

        $content = [
            [
                'type' => 'header',
                'level' => 'h2',
                'value' => $this->faker->title
            ],
            [
                'type' => 'paragraph',
                'value' => '<p>' . $this->faker->paragraph . '</p>'
            ],
        ];

        $attributes = [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'content' => $content,
        ];

        $this->put(route('dashboard.blog.articles.update', ['article' => $article->id]), $attributes)
            ->assertRedirect(route('dashboard.blog.articles.index'));

        $expectedDataInDb = array_merge($attributes, [
            'id' => $article->id,
            'content' => json_encode($content)
        ]);

        $this->assertDatabaseMissing('blog_articles', $article->toArray());
        $this->assertDatabaseHas('blog_articles', $expectedDataInDb);
    }

    /** @test */
    public function a_user_can_not_update_an_article_with_not_unique_title_and_slug(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        /** @var Article $article */
        $articleForUpdate = factory(Article::class)->create();

        $attributes = [
            'title' => $article->title,
            'slug' => $article->slug
        ];

        $response = $this->put(
            route('dashboard.blog.articles.update', ['article' => $articleForUpdate->id]),
            $attributes
        );

        $response->assertSessionHasErrors(['title', 'slug']);
    }

    /** @test */
    public function a_user_can_delete_an_article(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $this->assertDatabaseHas('blog_articles', $article->toArray());

        $this->delete(route('dashboard.blog.articles.destroy', ['article' => $article->id]))
            ->assertRedirect(route('dashboard.blog.articles.index'));

        $this->assertDatabaseMissing('blog_articles', $article->toArray());
    }

    /** @test */
    public function a_user_can_delete_an_article_by_get_http_method(): void
    {
        /** @var Article $article */
        $article = factory(Article::class)->create();

        $this->assertDatabaseHas('blog_articles', $article->toArray());

        $this->get(route('dashboard.blog.articles.get-destroy', ['article' => $article->id]))
            ->assertRedirect(route('dashboard.blog.articles.index'));

        $this->assertDatabaseMissing('blog_articles', $article->toArray());
    }
}
