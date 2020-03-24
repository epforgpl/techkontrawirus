<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at')->default(new Expression('NOW()'));
            // VARCHAR column sizes: I'm giving it with large overhead, so that there's no need to change them
            // if we decide to go for longer texts.
            $table->string('title', 500);
            $table->string('description', 3000);
            $table->string('problem', 3000);
            $table->string('recipients', 3000);
            $table->string('solution', 3000);
            $table->boolean('is_hidden')->default(false);
            $table->integer('plus')->default(0);
            $table->integer('minus')->default(0);
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at')->default(new Expression('NOW()'));
            $table->foreignId('idea_id');
            $table->string('content', 3000);
            $table->boolean('is_hidden')->default(false);
            $table->integer('plus')->default(0);
            $table->integer('minus')->default(0);
            $table->foreign('idea_id')->references('id')->on('ideas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('ideas');
    }
}
