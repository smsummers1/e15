<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;

class StudentUserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Jamal with one child and 5 volunteer entries
        $user = User::where('email', '=', 'jamal@harvard.edu')->first();

        $student = Student::where('streetAddress', '=', '7657 Pine Valley Rd')->first();

        $user->students()->save($student, ['timeVolunteered' => 63]);
        $user->students()->save($student, ['timeVolunteered' => 120]);
        $user->students()->save($student, ['timeVolunteered' => 20]);
        $user->students()->save($student, ['timeVolunteered' => 110]);
        $user->students()->save($student, ['timeVolunteered' => 420]);

        //Jill with zero children

        //Shawna Summers with 2 childen and 6 volunteer entries
        $user = User::where('email', '=', 'shawnamariesummers@gmail.com')->first();

        //Emory Summers
        $student = Student::where('firstName', '=', 'Emory')->first();

        $user->students()->save($student, ['timeVolunteered' => 90]);
        $user->students()->save($student, ['timeVolunteered' => 89]);
        $user->students()->save($student, ['timeVolunteered' => 56]);

        //Janie Summers
        $student = Student::where('firstName', '=', 'Janie')->first();

        $user->students()->save($student, ['timeVolunteered' => 110]);
        $user->students()->save($student, ['timeVolunteered' => 420]);
        $user->students()->save($student, ['timeVolunteered' => 86]);
    }
}
