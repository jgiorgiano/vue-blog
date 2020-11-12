<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->default(1);

            $table->tinyInteger('terms_agreement');
            $table->ipAddress('terms_agreement_ip');
            $table->string('terms_agreement_agent');
            $table->dateTime('terms_agreement_date');
            $table->tinyInteger('subscribe')->nullable();
            $table->ipAddress('subscribe_ip')->nullable();
            $table->string('subscribe_agent')->nullable();
            $table->dateTime('subscribe_date')->nullable();


            $table->string('profile_image')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
