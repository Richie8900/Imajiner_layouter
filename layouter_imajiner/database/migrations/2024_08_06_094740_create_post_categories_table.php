<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('code');

            $table->string('route');
            $table->string('description')->nullable();

            $table->longText('viewScript')->nullable();
            $table->longText('jsScript')->nullable();
            $table->longText('cssScript')->nullable();

            $table->string('viewLocation');
            $table->string('resourceLocation');
            $table->string('migrationPath');

            $table->unsignedBigInteger('layoutId')->nullable();
            $table->unsignedBigInteger('headerId')->nullable();
            $table->unsignedBigInteger('footerId')->nullable();
            $table->foreign('layoutId')->references('id')->on('layouts');
            $table->foreign('headerId')->references('id')->on('headers');
            $table->foreign('footerId')->references('id')->on('footers');

            $table->longText('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
