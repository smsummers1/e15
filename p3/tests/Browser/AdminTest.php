<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use tests\Browser\AuthTest;

class AdminTest extends DuskTestCase
{
    /**
     * The Report main menu page is working
     *
     * @group testReportPage
     */
    public function testReportPage()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('Jill')
                ->click('@reports-link')
                ->assertSee('Generate Reports');
        });
    }


    /**
     * List All Volunteers Report is working
     *
     * @group testListAllVolunteers
     */
    public function testListAllVolunteers()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('Jill')
                ->click('@reports-link')
                ->assertSee('Generate Reports')
                ->select('report', '/reports/listVolunteers')
                ->assertPresent('@listVolunteer-heading');
        });
    }

    /**
     * Hours Per Student Report is working
     *
     * @group testHoursPerStudent
     */
    public function testHoursPerStudent()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('Jill')
                ->click('@reports-link')
                ->assertSee('Generate Reports')
                ->select('report', '/reports/studentHours')
                ->assertPresent('@student-hours-heading');
        });
    }


    /**
     * Edit Information main menu page is working
     *
     * @group testEditInfoPage
     */
    public function testEditInfoPage()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('Jill')
                ->click('@edit-info-link')
                ->assertSee('Edit Information');
        });
    }


    /**
     * Edit Student is working - Student id = 1
     *
     * @group testEditStudent
     */
    public function testEditStudent()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->click('@edit-info-link')
                ->click('@edit-student-link')
                ->assertPresent('@choose-student-to-edit-heading')
                ->select('selectStudent', '/editStudent/1')
                ->assertPresent('@edit-student-information-heading');
        });
    }

    /**
     * Remove Student is working - Student id = 1
     *
     * @group testRemoveStudent
     */
    public function testRemoveStudent()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->click('@edit-info-link')
                ->click('@remove-student-link')
                ->assertPresent('@choose-student-to-remove-heading')
                ->select('selectStudent', '/deleteStudent/1/remove')
                //->pause(3000)
                ->assertPresent('@remove-student-link');
        });
    }
}
