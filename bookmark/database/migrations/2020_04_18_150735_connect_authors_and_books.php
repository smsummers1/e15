<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConnectAuthorsAndBooks extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {

            # Remove the field associated with the old way we were storing authors
            # Can do this here, or update the original migration that creates the `books` table
            # $table->dropColumn('author');

            # Add a new bigint field called `author_id` 
            # has to be unsigned (i.e. positive)
            # nullable so it's possible to have a book without an author
            //1st - create foreign key field
            $table->bigInteger('author_id')->unsigned()->nullable();

            # This field `author_id` is a foreign key that connects to the `id` field in the `authors` table
            //2nd - assign foreign key field
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {


            # ref: http://laravel.com/docs/migrations#dropping-indexes
            # combine tablename_fk field name_the word "foreign"
            //1st - undo the foreign key
            $table->dropForeign('books_author_id_foreign');
            //2nd - drop Column
            $table->dropColumn('author_id');
        });
    }
}
