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
                'streetAddress' => '123 Hello Dr.',
                'city' => 'HappyTown',
                'state' => 'North Carolina',
                'zipcode' => 12345,
                'accountType' => 'admin'
            ],
            ['password' => Hash::make('helloworld')]
        );

        $user = User::updateOrCreate(
            [
                'email' => 'jill@harvard.edu',
                'firstName' => 'Jill',
                'lastName' => 'Jones',
                'phone' => '222-333-4444',
                'streetAddress' => '123 Tuesday Ave.',
                'city' => 'Laughing',
                'state' => 'Ohio',
                'zipcode' => 23456,
                'accountType' => 'admin'
            ],
            ['password' => Hash::make('helloworld')]
        );

        $user = User::updateOrCreate(
            [
                'email' => 'jamal@harvard.edu',
                'firstName' => 'Jamal',
                'lastName' => 'Jamison',
                'phone' => '333-222-4444',
                'streetAddress' => '456 Jonestown Rd.',
                'city' => 'July',
                'state' => 'Utah',
                'zipcode' => 34567,
                'accountType' => 'admin'
            ],
            ['password' => Hash::make('helloworld')]
        );

        //#Add a new school user
        $user = new User();
        $user->firstName = 'Mercedes';
        $user->lastName = 'Key';
        $user->email = 'mkey@gmail.com';
        $user->phone = '336-321-1234';
        $user->streetAddress = '22 Jonestown Rd';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27101';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();


        $user = new User();
        $user->firstName = 'Stacey';
        $user->lastName = 'Jones';
        $user->email = 'jjones@gmail.com';
        $user->phone = '336-333-1234';
        $user->streetAddress = '645 Juliet Dr';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27105';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();



        $user = new User();
        $user->firstName = 'Kevin';
        $user->lastName = 'Taylor';
        $user->email = 'ktay@hotmail.com';
        $user->phone = '336-331-1334';
        $user->streetAddress = '77 Kimmey Dr';
        $user->city = 'Pine Hills';
        $user->state = 'NC';
        $user->zipcode = '23456';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();


        $user = new User();
        $user->firstName = 'Cassie';
        $user->lastName = 'Jones';
        $user->email = 'Catty@gmail.com';
        $user->phone = '336-444-1234';
        $user->streetAddress = '645 Juliet Dr';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27105';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Henry';
        $user->lastName = 'Jones';
        $user->email = 'Henry33@gmail.com';
        $user->phone = '336-444-1234';
        $user->streetAddress = '645 Juliet Dr';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27105';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Jackie';
        $user->lastName = 'Hamilton';
        $user->email = 'HamJ@gmail.com';
        $user->phone = '336-555-1234';
        $user->streetAddress = '5 Jonathan Creek Pkwy';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27103';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Mike';
        $user->lastName = 'Turner';
        $user->email = 'TurnerM3@gmail.com';
        $user->phone = '336-333-1234';
        $user->streetAddress = '132 Lion Ln';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27101';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();


        $user = new User();
        $user->firstName = 'Lily';
        $user->lastName = 'Turner';
        $user->email = 'TurnerL3@gmail.com';
        $user->phone = '336-333-1234';
        $user->streetAddress = '132 Lion Ln';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27101';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Kevin';
        $user->lastName = 'Farley';
        $user->email = 'KFarley33@hotmail.com';
        $user->phone = '336-222-1234';
        $user->streetAddress = '8909 Melrose Ave';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27103';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Susan';
        $user->lastName = 'Riley';
        $user->email = 'Susan.Riley@us.edu';
        $user->phone = '336-909-1234';
        $user->streetAddress = '7657 Pine Valley Rd';
        $user->city = 'Jonestown';
        $user->state = 'NC';
        $user->zipcode = '27990';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'June';
        $user->lastName = 'Baldwin';
        $user->email = 'JBaldwin99@gmail.com';
        $user->phone = '909-333-1234';
        $user->streetAddress = '786 Foxglove Pkwy';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27101';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Katherine';
        $user->lastName = 'Lonnie';
        $user->email = 'KL3676@gmail.com';
        $user->phone = '336-098-0034';
        $user->streetAddress = '555 PillowTop Dr';
        $user->city = 'Portland';
        $user->state = 'OR';
        $user->zipcode = '78667';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();

        $user = new User();
        $user->firstName = 'Ryan';
        $user->lastName = 'Hudson';
        $user->email = 'RHudson@hotmail.com';
        $user->phone = '336-368-1034';
        $user->streetAddress = '446 Westfield Dr';
        $user->city = 'Winston Salem';
        $user->state = 'NC';
        $user->zipcode = '27103';
        $user->accountType = 'admin';
        $user->password = Hash::make('helloworld');
        $user->save();
    }
}
