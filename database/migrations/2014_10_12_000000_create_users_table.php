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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('city');
            $table->string('district');
            $table->string('post_code');
            $table->string('division');
            $table->string('company');
            $table->string('work_phone');
            $table->string('home_phone');
            $table->string('other_phone');
            $table->char('role', 1)->comment('1=admin, 2=client, 3=employee');
            $table->string('verification_code');
            $table->char('status', 1)->comment('0=inactive, 1=active, 2=suspend');
            $table->softDeletes();
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
