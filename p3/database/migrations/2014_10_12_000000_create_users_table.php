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
            //$table->string('name');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            //best user phone 
            $table->string('phone', 12);

            //street address
            $table->string('streetAddress');

            //city
            $table->string('city');

            //state
            $table->string('state');

            //zipcode
            $table->integer('zipcode');

            //account Type
            $table->string('accountType')->nullable();

            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
