<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;


class AuthTest extends DuskTestCase
{

    use withFaker;

    /**
     * Test that user is required to login
     *
     * @group testAuthorizationRequired
     */
    public function testAuthorizationRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/editInfo')
                ->assertPresent('@login-heading')
                ->visit('/deleteStudent')
                ->assertPresent('@login-heading');
        });
    }

    /**
     * Test for successful registration
     *
     * @group testSuccessfulRegistration
     */
    public function testSuccessfulRegistration()
    {
        $this->browse(function (Browser $browser) {

            $firstName = $this->faker->firstName;

            //test both register links go to the registration page
            //register
            $browser->visit('/')
                ->click('@register-link1')
                ->assertVisible('@register-heading')
                ->click('@homepage-link')
                ->assertVisible('@welcome-heading')
                ->click('@register-link2')
                ->assertPresent('@register-heading')
                ->type('@email-input', $this->faker->safeEmail())
                ->type('@password-input', 'helloworld')
                ->type('@confirm-password-input', 'helloworld')
                ->type('@first-name-input', $firstName)
                ->type('@last-name-input', $this->faker->lastName)
                ->type('@phone-input', '123-234-3456')
                ->type('@street-address-input', $this->faker->streetAddress)
                ->click('@register-submit-button')
                ->assertPresent('@welcome-administrator-heading');
        });
    }

    /**
     * test registering user with existing email
     * emails are required to be unique for each
     * registrant
     * 
     * @group testRegisteringWithExistingEmail
     * 
     */
    public function testRegisteringWithExistingEmail()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/register')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->type('@confirm-password-input', 'helloworld')
                ->type('@first-name-input', 'Jillian')
                ->type('@last-name-input', 'Johnson')
                ->type('@phone-input', '123-234-3456')
                ->type('@street-address-input', $this->faker->streetAddress)
                ->click('@register-submit-button')
                ->assertSee('The email has already been taken.');
        });
    }

    /**
     * test for successful login
     * 
     * @group testSuccessfulLogin
     */
    public function testSuccesfulLogin()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard.edu')
                ->type('@password-input', 'helloworld')
                ->click('@login-button')
                ->assertSee('Jill');
        });
    }

    /**
     *Test that the login form is validating
     *users entries properly
     *
     * @group testLoginValidation
     */
    public function testLoginValidation()
    {
        $this->browse(function (Browser $browser) {

            $browser->logout()
                ->visit('/login')
                ->type('@email-input', 'jill@harvard')
                ->type('@password-input', 'this-is-the-wrong-password')
                ->click('@login-button')
                ->assertSee('These credentials do not match our records.');
        });
    }
}
