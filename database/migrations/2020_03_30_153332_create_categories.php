<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('background_color', 7);
            $table->char('text_color', 7);
        });

        Schema::create('categories_ideas', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('idea_id')->constrained();
            $table->dateTime('created_at')->default(new Expression('NOW()'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_ideas');
        Schema::dropIfExists('categories');
    }
}
