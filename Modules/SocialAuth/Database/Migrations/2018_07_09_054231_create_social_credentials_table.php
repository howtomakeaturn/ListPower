<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('social_credentials', function($t){
            $t->increments('id');
            $t->integer('user_id');
            $t->string('social_id');
            $t->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('social_credentials');
    }
}
