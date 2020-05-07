<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class StudentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            # `user_id` and `student_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `user_id` will reference the `users` table and `student_id` will reference the `student` table.

            //user information via foreign key
            $table->foreignId('user_id')->unsigned();

            //student information via foreign key
            $table->foreignId('student_id')->unsigned();

            //Make foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');

            # (Optional) Add additional columns for data you want to associate with this relationship

            //Volunteer Time stored in minutes
            $table->integer('timeVolunteered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_user');
    }
}
