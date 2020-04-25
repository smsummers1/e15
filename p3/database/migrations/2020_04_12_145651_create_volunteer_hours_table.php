<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteerHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_hours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //student information via foreign key
            $table->foreignId('student_id');

            //volunteer information via foreign key
            $table->foreignId('user_id');

            //checkIn date and time (IDK and PTA)
            //PTA is the Volunteer Date with 00:00:00 for the time
            $table->dateTime('volunteerCheckIn')->nullable();

            //checkOut date and time (IDK)
            $table->dateTime('volunteerCheckOut')->nullable();

            //timestamp when volunteer submitted os form
            $table->time('timestampOffSite')->nullable();

            //Volunteer Time stored in minutes
            $table->integer('timeVolunteered');

            //Task/s Completed (PTA and OS)
            $table->text('tasksCompleted')->nullable();

            //Who you volunteered for...teacher, staff, PTA, principal, etc.
            $table->string('volunteeredForWho')->nullable();

            //email to who you volunteered for
            $table->string('volunteeredForEmail')->nullable();

            //way hours were submitted
            $table->string('submittedVia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_hours');
    }
}
