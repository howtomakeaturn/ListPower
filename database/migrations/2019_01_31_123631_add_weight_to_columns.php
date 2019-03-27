<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightToColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_columns', function (Blueprint $t) {
            $t->integer('weight')->after('meta_label');
        });

        Schema::table('info_columns', function (Blueprint $t) {
            $t->integer('weight')->after('meta_label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_columns', function (Blueprint $t) {
            $t->dropColumn('weight');
        });

        Schema::table('info_columns', function (Blueprint $t) {
            $t->dropColumn('weight');
        });
    }
}
