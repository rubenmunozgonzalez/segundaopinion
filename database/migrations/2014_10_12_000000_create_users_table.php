<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('l_name_1')->nullable();
            $table->string('l_name_2')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('nid');
            $table->string('doctor_reg_id');
            $table->integer('mobile');
            $table->text('biography')->nullable();
            $table->string('role',60);
            $table->boolean('status');
            $table->boolean('mailconfiorm');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
