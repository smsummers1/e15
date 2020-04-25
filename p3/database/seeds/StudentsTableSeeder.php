<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentsTableSeeder extends Seeder
{


    public function run()
    {

        #Add a new student

        //id=1
        $student = new Student();
        $student->firstName = 'Porsha';
        $student->lastName = 'Key';
        $student->homeroom = '31_BarhamA_Rm 31';
        $student->streetAddress = '22 Jonestown Rd';
        $student->save();

        //id=2
        $student = new Student();
        $student->firstName = 'Julie';
        $student->lastName = 'Jones';
        $student->homeroom = '3_FloresR_Rm 3';
        $student->streetAddress = '645 Juliet Dr';
        $student->save();

        //id=3
        $student = new Student();
        $student->firstName = 'Jack';
        $student->lastName = 'Turner';
        $student->homeroom = '23_Richards_Rm 23';
        $student->streetAddress = '132 Lion Ln';
        $student->save();

        //id=4
        $student = new Student();
        $student->firstName = 'Audrey';
        $student->lastName = 'Hamilton';
        $student->homeroom = '71_DishnerK_Rm 71';
        $student->streetAddress = '5 Jonathan Creek Pkwy';
        $student->save();

        //id=5
        $student = new Student();
        $student->firstName = 'John';
        $student->lastName = 'Jones';
        $student->homeroom = '92_MayhewM_Rm 203';
        $student->streetAddress = '645 Juliet Dr';
        $student->save();

        //id=6
        $student = new Student();
        $student->firstName = 'Kelly';
        $student->lastName = 'Farley';
        $student->homeroom = '62_HallK_Rm 62';
        $student->streetAddress = '8909 Melrose Ave';
        $student->save();

        //id=7
        $student = new Student();
        $student->firstName = 'Grace';
        $student->lastName = 'Riley';
        $student->homeroom = '32_EvanS_Rm 32';
        $student->streetAddress = '7657 Pine Valley Rd';
        $student->save();

        //id=8
        $student = new Student();
        $student->firstName = 'Lea';
        $student->lastName = 'Baldwin';
        $student->homeroom = '12_FalgoutM_Rm 12';
        $student->streetAddress = '786 Foxglove Pkwy';
        $student->save();

        //id=9
        $student = new Student();
        $student->firstName = 'Carter';
        $student->lastName = 'Bowles';
        $student->homeroom = '33_WilliamsD_Rm 33';
        $student->streetAddress = '109 Middleton Way';
        $student->save();

        //id=10
        $student = new Student();
        $student->firstName = 'Elizabeth';
        $student->lastName = 'Hudson';
        $student->homeroom = '31_BarhamA_Rm 31';
        $student->streetAddress = '446 Westfield Dr';
        $student->save();

        //id=11
        $student = new Student();
        $student->firstName = 'Ryan';
        $student->lastName = 'Hudson';
        $student->homeroom = '31_BarhamA_Rm 31';
        $student->streetAddress = '446 Westfield Dr';
        $student->save();

        //id=12
        $student = new Student();
        $student->firstName = 'Miles';
        $student->lastName = 'Key';
        $student->homeroom = '12_FalgoutM_Rm 12';
        $student->streetAddress = '22 Jonestown Rd';
        $student->save();

        /**
         * Run the database seeds.
         *
         * @return void

        public function run()
        {
            //Faker data for now
            //Want to use my excel sheets as seeders instead in 
            //I have time

            $faker = Faker\Factory::create();

            for ($i=0; $i<100; $1++){
                $student = new Student();

                $student->name = $faker->lastName.', '.$faker->firstName;

                $student->homeroom = $faker->randomDigit.$faker->randomDigit.'_'.$faker->lastName.$faker->randomLetter.'_Rm'.$faker->randomDigit.$faker->randomDigit;

                $student->address = $faker->streetAddress;

                $student->save();
            }
   }*/
    }
}
