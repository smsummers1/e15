<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MiscTest extends DuskTestCase
{
    /**
     * Support link works - logged in
     *
     * @group testSupportLoggedIn
     */
    public function testSupportLoggedIn()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->click('@support-link')
                ->assertPresent('@volunteer-support-staff-heading');
        });
    }

    /**
     * Support link works - Not Logged In
     *
     * @group testSupportNotLoggedIn
     */
    public function testSupportNotLoggedIn()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/support')
                ->assertPresent('@volunteer-support-staff-heading');
        });
    }
}
