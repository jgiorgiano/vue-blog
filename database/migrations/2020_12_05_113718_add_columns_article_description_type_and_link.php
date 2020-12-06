<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsArticleDescriptionTypeAndLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('description', 200)->nullable();
            $table->tinyInteger('type')->default(1);
            $table->string('external_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->dropColumn(['description', 'type', 'external_link']);
        });
    }
}
