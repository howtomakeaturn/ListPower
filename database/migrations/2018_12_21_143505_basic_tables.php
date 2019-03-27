<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function ($t) {
            $t->increments('id');
            $t->string('name');
            $t->text('description');
            $t->timestamps();
        });

        Schema::create('review_columns', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('topic_id');
            $t->string('meta_key');
            $t->string('meta_label');
            $t->timestamps();

            $t->unique(['topic_id', 'meta_key']);
        });

        Schema::create('info_sections', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('topic_id');
            $t->string('meta_key');
            $t->string('meta_label');
            $t->timestamps();

            $t->unique(['topic_id', 'meta_key']);
        });

        Schema::create('info_columns', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('info_section_id');
            $t->string('meta_key');
            $t->string('meta_type');
            $t->string('meta_label');
            $t->timestamps();

            $t->unique(['info_section_id', 'meta_key']);
        });

        Schema::create('entities', function ($t) {
            $t->increments('id');
            $t->integer('topic_id');
            $t->integer('user_id');
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('review_fields', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('entity_id');
            $t->string('meta_key');
            $t->integer('meta_value');
            $t->timestamps();

            $t->unique(['entity_id', 'meta_key']);
        });

        Schema::create('info_fields', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('entity_id');
            $t->string('meta_key');
            $t->string('meta_value');
            $t->timestamps();

            $t->unique(['entity_id', 'meta_key']);
        });

        Schema::create('comments', function ($t) {
            $t->increments('id');
            $t->integer('entity_id');
            $t->integer('user_id');
            $t->text('content');
            $t->timestamps();
        });

        Schema::create('reviews', function ($t) {
            $t->increments('id');
            $t->integer('entity_id');
            $t->integer('user_id');
            $t->timestamps();
        });

        Schema::create('review_cells', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('review_id');
            $t->string('meta_key');
            $t->integer('meta_value');
            $t->timestamps();

            $t->unique(['review_id', 'meta_key']);
        });

        Schema::create('editings', function ($t) {
            $t->increments('id');
            $t->integer('entity_id');
            $t->integer('user_id');
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('editing_cells', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('editing_id');
            $t->string('meta_key');
            $t->string('meta_value');
            $t->timestamps();

            $t->unique(['editing_id', 'meta_key']);
        });

        Schema::create('topic_user', function($t){
            $t->integer('topic_id');
            $t->integer('user_id');

            $t->primary(['topic_id', 'user_id']);

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');

        Schema::drop('review_columns');

        Schema::drop('info_sections');

        Schema::drop('info_columns');

        Schema::drop('entities');

        Schema::drop('review_fields');

        Schema::drop('info_fields');

        Schema::drop('comments');

        Schema::drop('reviews');

        Schema::drop('review_cells');

        Schema::drop('editings');

        Schema::drop('editing_cells');

        Schema::drop('topic_user');
    }
}
