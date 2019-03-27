<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsAndEntityTagTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function($t){
            $t->increments('id');
            $t->integer('topic_id');
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('entity_tag', function($t){
            $t->integer('entity_id');
            $t->integer('tag_id');
            $t->integer('user_id');

            $t->primary(['entity_id', 'tag_id', 'user_id']);

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
        Schema::drop('tags');

        Schema::drop('entity_tag');
    }
}
