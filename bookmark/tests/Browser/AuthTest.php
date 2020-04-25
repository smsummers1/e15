<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        #user enters correct information for registration
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('@register-link')
                ->assertSee('Register')
                ->assertVisible('@register-heading')
                ->type('@name-input', 'Joe Smith')
                ->type('@email-input', 'joe@gmail.com')
                ->type('@password-input', 'helloworld')
                ->type('@password-confirm-input', 'helloworld')
                ->click('@register-button')
                ->assertSee('Joe Smith');
        });
    }

    public function testFailedRegistration()
    {
        #registration fails upon incorrect data entry
        #testing the validation
        $this->browse(function (Browser $browser) {
            $browser->logout()
                ->visit('/register')
                ->type('@name-input', 'Joe Smith')
                ->type('@email-input', 'joe@gmail.com')
                ->type('@password-input', 'hello')
                ->type('@password-confirm-input', 'hello')
                ->click('@register-button')
                ->assertSee('The password must be at least 8 characters');
        });
    }

    public function testLogin()
    {
        #seed the database
        $this->seed();

        #testing that login page is working properly with correct data
        $this->browse(function (Browser $browser) {
            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('LOGOUT JILL HARVARD');
        });
    }
}
