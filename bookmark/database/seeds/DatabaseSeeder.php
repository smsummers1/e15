<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BookUserTableSeeder::class);
    }
}
