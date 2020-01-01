<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticleCategoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('blog_article_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_article_category');
    }
}
