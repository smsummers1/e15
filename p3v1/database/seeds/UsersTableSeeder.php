<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            [
                'email' => 'shawnamariesummers@gmail.com',
                'firstName' => 'Shawna',
                'lastName' => 'Summers',
                'phone' => '333-333-4444',
                'streetAddress' => '645 Juliet Dr',
                'accountType' => 'administrator'
            ],
            ['password' => Hash::make('helloworld')]
        );

        $user = User::updateOrCreate(
            [
                'email' => 'jill@harvard.edu',
                'firstName' => 'Jill',
                'lastName' => 'Jones',
                'phone' => '222-333-4444',
                'streetAddress' => '123 Hello Dr',
                'accountType' => 'administrator'
            ],
            ['password' => Hash::make('helloworld')]
        );

        $user = User::updateOrCreate(
            [
                'email' => 'jamal@harvard.edu',
                'firstName' => 'Jamal',
                'lastName' => 'Riley',
                'phone' => '333-222-4444',
                'streetAddress' => '7657 Pine Valley Rd',
                'accountType' => 'administrator'
            ],
            ['password' => Hash::make('helloworld')]
        );
    }
}
