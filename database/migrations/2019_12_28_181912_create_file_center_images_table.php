<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileCenterImagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('file_center_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path');
            $table->string('filename');
            $table->string('extension');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_center_images');
    }
}
