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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('PageName');
            $table->string('Description')->nullable();
            $table->string('Route');
            $table->unsignedBigInteger('LayoutId')->nullable();
            $table->unsignedBigInteger('HeaderId')->nullable();
            $table->unsignedBigInteger('FooterId')->nullable();
            $table->foreign('LayoutId')->references('id')->on('layouts');
            $table->foreign('LayoutId')->references('id')->on('headers');
            $table->foreign('LayoutId')->references('id')->on('footers');
            $table->longText('Script')->nullable();
            $table->string('Location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
