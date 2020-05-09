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
     * Remove Student successfully deletes student with 
     * id equal to 1
     * 
     * If this student is not present in the database it 
     * will fail---in this case just reseed the database.
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
                ->assertPresent('@remove-student-link');
        });
    }

    /**
     * Test that the import form is working 
     *
     * @group testImportSuccessful
     */
    public function testImportSuccessful()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->click('@import-new-students-link')
                ->assertPresent('@import-new-students-heading')
                ->attach('file', storage_path('app/public/testing/students.xlsx'))
                ->click('@import-button')
                ->assertPresent('@welcome-administrator-heading');
        });
    }

    /**
     * Test that only excel files will be
     * allowed to be submitted
     *
     * @group testImportWithNonExcelFile
     */
    public function testImportWithNonExcelFile()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->click('@import-new-students-link')
                ->assertPresent('@import-new-students-heading')
                ->attach('file', storage_path('app/public/testing/students.docx'))
                ->click('@import-button')
                ->assertSee('Import New Students');
        });
    }
}
