<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagsTable extends Migration
{
    public function up(): void
    {
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
    }
}
