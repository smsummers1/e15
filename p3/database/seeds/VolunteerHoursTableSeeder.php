<?php

use Illuminate\Database\Seeder;
use App\VolunteerHour;

class VolunteerHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        /* Note:  Data comes from three different datasets each a bit different 
        My hope is to slowly fix this issue.

        - IDK 
        data doesn't have timestamp, volunteeredForWho, or volunteeredForEmail values.

        - OFFSITE 
        data doesn't have checkin, or checkout.  Timestamp is when the google form was submitted not when the task was completed

        - PTA 
        data doesn't have checkout or timestamp.  The checkIn time is the date when the task was completed but no specific time is given so I put 00:00:00

        */


        #Adding Volunteer Data

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '1';
        $volunteerHour->user_id = '1';
        $volunteerHour->volunteerCheckIn = '2020-02-01 10:50:00';
        $volunteerHour->volunteerCheckOut = '2020-02-01 11:53:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '63';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();


        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '2';
        $volunteerHour->user_id = '2';
        $volunteerHour->volunteerCheckIn = '2020-02-02 07:05:00';
        $volunteerHour->volunteerCheckOut = '2020-02-02 08:22:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '77';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '2';
        $volunteerHour->user_id = '3';
        $volunteerHour->volunteerCheckIn = '2020-02-03 08:24:00';
        $volunteerHour->volunteerCheckOut = '2020-02-03 08:46:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '22';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '1';
        $volunteerHour->user_id = '1';
        $volunteerHour->volunteerCheckIn = '2020-02-04 15:02:00';
        $volunteerHour->volunteerCheckOut = '2020-02-04 15:35:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '33';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '4';
        $volunteerHour->user_id = '6';
        $volunteerHour->volunteerCheckIn = '2020-02-04 08:37:00';
        $volunteerHour->volunteerCheckOut = '2020-02-04 09:22:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '45';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '7';
        $volunteerHour->user_id = '10';
        $volunteerHour->volunteerCheckIn = '2020-02-04 08:08:00';
        $volunteerHour->volunteerCheckOut = '2020-02-04 08:50:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '42';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '12';
        $volunteerHour->user_id = '1';
        $volunteerHour->volunteerCheckIn = '2020-02-05 08:09:00';
        $volunteerHour->volunteerCheckOut = '2020-02-05 17:46:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '576';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '11';
        $volunteerHour->user_id = '13';
        $volunteerHour->volunteerCheckIn = '2020-02-05 07:54:00';
        $volunteerHour->volunteerCheckOut = '2020-02-05 14:34:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '400';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '1';
        $volunteerHour->user_id = '1';
        $volunteerHour->volunteerCheckIn = '2020-02-05 15:05:00';
        $volunteerHour->volunteerCheckOut = '2020-02-05 16:19:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '73';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '2';
        $volunteerHour->user_id = '4';
        $volunteerHour->volunteerCheckIn = '2020-02-06 10:55:00';
        $volunteerHour->volunteerCheckOut = '2020-02-06 12:30:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '94';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '2';
        $volunteerHour->user_id = '5';
        $volunteerHour->volunteerCheckIn = '2020-02-06 08:15:00';
        $volunteerHour->volunteerCheckOut = '2020-02-06 09:16:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '61';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '5';
        $volunteerHour->user_id = '5';
        $volunteerHour->volunteerCheckIn = '2020-02-06 07:01:00';
        $volunteerHour->volunteerCheckOut = '2020-02-06 08:43:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '101';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '9';
        $volunteerHour->user_id = '12';
        $volunteerHour->volunteerCheckIn = '2020-02-07 07:02:00';
        $volunteerHour->volunteerCheckOut = '2020-02-07 09:42:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '119';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();

        //IDK HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '3';
        $volunteerHour->user_id = '8';
        $volunteerHour->volunteerCheckIn = '2020-02-07 14:35:00';
        $volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        //$volunteerHour->timestampOffSite = '';
        //$volunteerHour->tasksCompleted = '';
        $volunteerHour->timeVolunteered = '109';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'Ident-a-Kid';
        $volunteerHour->save();



        //PTA HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '6';
        $volunteerHour->user_id = '16';
        $volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        //$volunteerHour->timestampOffSite = '';
        $volunteerHour->tasksCompleted = 'PTA Audit - coordination, audit, reporting';
        $volunteerHour->timeVolunteered = '150';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'PTA';
        $volunteerHour->save();

        //PTA HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '10';
        $volunteerHour->user_id = '13';
        $volunteerHour->volunteerCheckIn = '2020-02-12 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        //$volunteerHour->timestampOffSite = '';
        $volunteerHour->tasksCompleted = 'ice cream social - coordination, shopping, set-up, event, clean-up';
        $volunteerHour->timeVolunteered = '360';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'PTA';
        $volunteerHour->save();

        //PTA HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '11';
        $volunteerHour->user_id = '13';
        $volunteerHour->volunteerCheckIn = '2020-02-14 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        //$volunteerHour->timestampOffSite = '';
        $volunteerHour->tasksCompleted = 'spirit wear campaign, research, voting form creation';
        $volunteerHour->timeVolunteered = '240';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'PTA';
        $volunteerHour->save();

        //PTA HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '3';
        $volunteerHour->user_id = '7';
        $volunteerHour->volunteerCheckIn = '2020-02-15 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        //$volunteerHour->timestampOffSite = '';
        $volunteerHour->tasksCompleted = 'PTA audit, Meetings, Budget, Bank Runs, Reimbursements';
        $volunteerHour->timeVolunteered = '600';
        //$volunteerHour->volunteeredForWho = '';
        //$volunteerHour->volunteeredForEmail = '';
        $volunteerHour->submittedVia = 'PTA';
        $volunteerHour->save();



        //OFFSITE HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '4';
        $volunteerHour->user_id = '6';
        //$volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        $volunteerHour->timestampOffSite = '2020-02-02 16:48:50';
        $volunteerHour->tasksCompleted = 'Playpark volunteer training';
        $volunteerHour->timeVolunteered = '270';
        $volunteerHour->volunteeredForWho = 'S Taylor';
        $volunteerHour->volunteeredForEmail = 'setaylor@k12.nc.us';
        $volunteerHour->submittedVia = 'Offsite';
        $volunteerHour->save();

        //OFFSITE HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '7';
        $volunteerHour->user_id = '10';
        //$volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        $volunteerHour->timestampOffSite = '2020-02-06 12:07:20';
        $volunteerHour->tasksCompleted = 'Greenhouse project on June 18; weeded flower beds';
        $volunteerHour->timeVolunteered = '75';
        $volunteerHour->volunteeredForWho = 'K Hall';
        $volunteerHour->volunteeredForEmail = 'kchall@k12.nc.us';
        $volunteerHour->submittedVia = 'Offsite';
        $volunteerHour->save();

        //OFFSITE HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '9';
        $volunteerHour->user_id = '12';
        //$volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        $volunteerHour->timestampOffSite = '2020-02-09 16:40:22';
        $volunteerHour->tasksCompleted = 'Making books';
        $volunteerHour->timeVolunteered = '60';
        $volunteerHour->volunteeredForWho = 'K Larmour';
        $volunteerHour->volunteeredForEmail = 'klarmour@k12.nc.us';
        $volunteerHour->submittedVia = 'Offsite';
        $volunteerHour->save();

        //OFFSITE HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '8';
        $volunteerHour->user_id = '11';
        //$volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        $volunteerHour->timestampOffSite = '2020-02-10 12:22:23';
        $volunteerHour->tasksCompleted = 'Proctor Training';
        $volunteerHour->timeVolunteered = '60';
        $volunteerHour->volunteeredForWho = 'L Hewitt';
        $volunteerHour->volunteeredForEmail = 'lhewitt@k12.nc.us';
        $volunteerHour->submittedVia = 'Offsite';
        $volunteerHour->save();

        //OFFSITE HOURS
        $volunteerHour = new VolunteerHour();
        $volunteerHour->student_id = '10';
        $volunteerHour->user_id = '13';
        //$volunteerHour->volunteerCheckIn = '2020-02-09 00:00:00';
        //$volunteerHour->volunteerCheckOut = '2020-02-07 16:25:00';
        $volunteerHour->timestampOffSite = '2020-02-11 12:03:33';
        $volunteerHour->tasksCompleted = 'Collect, Pack, transport school supplies - donations';
        $volunteerHour->timeVolunteered = '120';
        $volunteerHour->volunteeredForWho = 'A Barham';
        $volunteerHour->volunteeredForEmail = 'abarham@k12.nc.us';
        $volunteerHour->submittedVia = 'Offsite';
        $volunteerHour->save();
    }
}
