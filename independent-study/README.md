# Importing Excel Data  

### How to import an Excel spreadsheet into a MySQL database utilizing a Laravel tool called Maatwebsite 

Up until now, all our data has come from user input, a seeder file, or just recently the testing tool Dusk.<img src='images/0.png' align="right"> In my 3rd and final project, I am building out the administrative side of a Volunteer Hour Tracking application that will allow Excel files to be submitted via an html form and then populate the corresponding table. Thus, the birth of my indenpendent project and my search for the best way to import an Excel spreadsheet into a MySQL database.

What I found was that there are several ways to import an Excel spreadsheet into a MySQL database. 

- **manually** import excel data 
- use the **Excel Import to MySQL** option in Excel
- write **raw php code** using a **spreadsheet-reader library** to import the data 
- utilize **Laravel** and the **Maatwebsite** package

This tutorial covers the later and we are going to walk through the creation of an entire Laravel application that will utilize the Maatwebsite package to import an Excel spreadsheet via an html form.  You have access to the code in the **vhours** directory and the Excel spreadsheet **studentData.xlsx**.

Let&#39;s get started. We have a lot of ground to cover.

![]()


## 1. Create a new Laravel application

Go ahead and create a new Laravel application and point the local server to your new app called **vhours**. If you don&#39;t remember how to do this follow the instructions at the link below.  Be sure to install the most recent version of Laravel and check to make sure that you are using PHP 7 or higher.  To do this you can type **php -v** into the command line.

[https://hesweb.dev/e15/notes/laravel/new-laravel-app](https://hesweb.dev/e15/notes/laravel/new-laravel-app)

I named my new Laravel application **vhours**

<img src='images/1.png' width='700' height='auto'>

![]()


## 2. Install Maatwebsite package

To get our applications to import Excel files to our database we are going to use an additional Laravel package called Maatwebsite that doesn&#39;t come standard with the framework. We need to install the Maatwebsite package and check that our dependencies are set up correctly for this new package.

**Note:** Maatwebsite is built on another tool called PhpSpreadsheet so you will see this package come in with Maatwebsite when you install it.

To install the Maatwebsite package we will use our PHP dependency manager tool [Composer](https://getcomposer.org/).

```
$ composer require maatwebsite/excel
```
<img src='images/2.png' width='700' height='auto'>

![]()

Once the package has generated successfully, check the **composer.json** file to make sure you see the **maatwebsite/excel** line that you see in the image below. It should be listed under the **&quot;require&quot;** area of the file.

```
$ cat composer.json
```
<img src='images/3.png' width='300' height='auto'>
You should see &quot;maatwebsite/excel&quot;: &quot;^3.1&quot;

![]()

## 3. Add Maatwebsite to the Service Provider 

The service provider is the central place of all Laravel application bootstrapping.  When you add this new package to the service provider, you can utilize it throughout the application.  Basically you are plugging in the new tool so you can start using it.  While the documentation states that Maatwebite\Excel\ExcelServiceProvider is auto-discovered and registered by default, we are going to be on the safe side and register it ourselves. 

Open the **config/app.php** file and add the line you see below in the **providers section** of the file.  (You can copy and paste the lines below).

```php
'providers' => [

    Maatwebsite\Excel\ExcelServiceProvider::class,

],
```

<img src='images/4.png' width='500' height='auto'>


## 4. Assign Maatwebsite an alias

Laravel comes with a feature called, Class Alias, where you can create an alias for any class you want to work with.  It is much easier to remember an alias than the entire Namespaced Class.  Facades utilize these aliases when we want to utilize a method from our Maatwebsite\Excel\Facades\Excel Namespace class we will just use the alias 'Excel' rather than typing that long Namespace.

The Excel facade is auto-discovered, but again we will go ahead and add the alias just in case.

While you are still in the **config/app.php** file add the **alias** line in the **aliases section**.
(You can copy and paste the lines below)

**Note** : Notice that the aliases are in alphabetical order, so be sure to put the **Excel** alias after the **Event** alias.

```php
'aliases' => [

    'Excel' => Maatwebsite\Excel\Facades\Excel::class,

],
```

<img src='images/5.png' width='500' height='auto'>

![]()


## 5. Publish Maatwebsite's configuration file

Publishing Maatwebsite's configuration file will copy it to the specified publish location allowing you to easily access the configuration values if needed.  When we publish Maatwebsite's config file, a new file will be created in the config directory called excel.php.  Then the Maatwebsite's config file will be copied over to the new config/excel.php file.

Use the command below to start the publishing process.  You will be prompted to choose the provider from a list to publish. Be sure to choose the **Provider: Maatwebsite\Excel\ExcelServiceProvider**

```
$ php artisan vendor:publish
```

<img src='images/6.png' width='700' height='auto'>

![]()

Check to make sure that the **config/excel.php** file was created

<img src='images/7.png' width='700' height='auto'>

**Note:**  There is a quicker way to publish the config file with the following command.  This will skip the part where you are prompted to select the service provider.

```
$ php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

![]()


## 6. Create the vhours database

Create the database via phpMyAdmin

Turn on your XAMPP web server and then click the **start all** button.

**Note:** Feel free to only start the MySQL database and the Apache web server if you want. I just prefer to start them all since it is just one click and it won&#39;t hurt or noticeably slow anything down to have the ProFTPD running along-side the others even though we aren&#39;t going to use it.

Open a browser and type in the URL [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

You should see a screen that looks like what you see below. You might not have all the same databases I have shown on the left-hand side of the page, but it should look very similar. Right now, we do **not** have a database for our application.

<img src='images/8.png' width='700' height='auto'>

![]()

We need to create a new database. For consistency, we will name our database the same as our application.

Click on the **Databases** tab at the top just above the heading General settings shown below.

<img src='images/9.png' width='500' height='auto'>

![]()

Then type in the name of your database. Set the database name is to **vhours** and the collation to **utf8mb4\_general\_ci.** Then click the **create** button.

<img src='images/10.png' width='500' height='auto'>

![]()

You should now see the **vhours** database listed on the left-hand side of the phpMyAdmin screen as you see highlighted below.

And again, you may not have as many databases as I have. Just be sure that you have the **vhours** database listed.

<img src='images/11.png' width='200' height='auto'>

![]()


## 7. Connect vhours database to the application

Now that we have our **vhours** database we need to update the database configuration variables in the .env file at the root of the application so that we can connect our application to the database. Open the **vhours/.env** file.

Go ahead and set the following database configurations as you see below. Notice that the **DB\_PASSWORD** is **empty**. There isn&#39;t anything there because I didn&#39;t set a password. Once you set this file up the way you see below, save and close.

<img src='images/12.png' width='200' height='auto'>

![]()


## 8. Test the connection

Put the following code in your **routes/web.php** file.

```php
Route::get('/debug', function () {

        $debug = ['Environment' => App::environment(),
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you&#39;re facing difficulties connecting to the
    database and you need to confirm your credentials. When you&#39;re done
    debugging, comment it back out so you don&#39;t accidentally leave it
    running on your production server, making your credentials public.
    */

    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED:' . $e->getMessage();
    }

    dump($debug);

});
```

Now run the following URL in your browser

[http://vhours.loc/debug](http://vhours.loc/debug)

You should see **vhours** in the array of databases. This means you are connected successfully to the database and ready to move forward.

<img src='images/13.png' width='325' height='400'>

![]()

Now that the database has been created and we are connected, we need to create a table in our database that will line up with our Excel spreadsheet.

![]()


## 9. Create database table via migrations

While we could manually create our table via phpMyAdmin, we are going to opt to utilize [migrations](https://medium.com/@rakshithvasudev/laravel-migrations-what-are-they-why-use-them-how-to-use-203769a917c3). They are a necessity when creating a database driven app. Check out the notes to remind yourself just how powerful migrations are and why they are a necessity.

[https://hesweb.dev/e15/notes/laravel/db-migrations](https://hesweb.dev/e15/notes/laravel/db-migrations)

To start this process we will use the [Artisan](https://laravel.com/docs/7.x/artisan) tool to generate our migration file called create\_students\_table.

```
$ php artisan make:migration create\_students\_table --create=students
```

<img src='images/14.png' width='550' height='auto'>

![]()

Let&#39;s go check and make sure it was created. The new migration file will be in **vhours/database/migrations** directory.

<img src='images/15.png' width='700' height='auto'>

![]()

To code our new migration file correctly we need to check out the data we want to import into our table first. Below is an example Excel file that we will be practicing with for our application. Notice the column headings and the content in each column.

<img src='images/16.png' width='700' height='auto'>

![]()

We need to set up the migration file to create the fields/columns in the database table **students** to correlate with the columns in the Excel spreadsheet called **studentData.xlsx** above.  You **must** delete the heading row 1 before you import the file.  I left it there for you to see how each column matches up to the field/column in the database.

Now that you have looked over the above Excel file, open the **create\_students\_table.php** migration file.

**FYI:** Notice that there is a timestamp and a number prefixing the migration filename. I will usually leave that prefix off when referring to a migration file.

Below are the changes that need to be made to the file so that the fields/columns in the studentData.xlsx file line up with the fields/columns in the students table.

**Note:** The id() and the timestamps() functions listed in the code below will auto generate values and will not cause an issue when we do our import. Also, a database tool that we utilize in our Laravel applications called [Eloquent](https://laravel.com/docs/7.x/eloquent#introduction) is expecting to see these fields in the table. If they are not there, Eloquent will not work properly.

```php
public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('student_name', 100);
        $table->smallInteger('volunteer_hours')->nullable();
        $table->string('homeroom', 100)->nullable();
        $table->string('street_address', 100)->nullable();
    });
}
```

Now we are going to set up our tables in our **vhours** database by running our migrations.

```
$ php artisan migrate:fresh
```

Let&#39;s go check phpMyAdmin to see if we have our new tables. You should have 4 tables; failed_jobs, migrations, students, and users.  We are going to focus our attention on the students table.

<img src='images/18.png' width='600' height='auto'>

![]()

Click on the **vhours** database in the left-hand column and you should see 4 tables appear in the center of the screen one of which is our **students** table. Now let&#39;s check to see if it is set up the way we expected. Click on the **students** table and you should see this:

<img src='images/19.png' width='600' height='auto'>

![]()

and then if we click on the **Structure** tab you should see this:

<img src='images/20.png' width='700' height='auto'>

![]()

## 10. Set up a Model

All database tables in Laravel have a corresponding class, known as a **Model**, that will allow us to interact with the specified table.  Models give us the ability to execute CRUD operations.  The Model we are building is for the only table we will have....**students**.

The main thing we are trying to accomplish is importing our Excel spreadsheet into our students table in the vhours database.  To do this we will build an **import** model to have the ability to import our Excel spreadsheet. Maatwebsite package provides a way to build an import class. We will need to use this in our controller which we will set up next. For now run the following command to create the **StudentsImport.php** file in the **app/Imports** directory.

```
$ php artisan make:import StudentsImport –-model=Student
```

Let&#39;s go make sure the **app/Imports/StudentsImport.php** file was generated. 

Go ahead and open it up.  We need to edit this file so we can import the data from the Excel spreadsheet properly.

```php
public function model(array $row)
{
    return new Student([
        'student_name' => $row[0],
        'volunteer_hours' => $row[1],
        'homeroom' => $row[2],
        'street_address' => $row[3],
    ]);
}
```

Now we need to generate the **App\Student** use file listed at the top of the **StudentsImport.php** file.

Navigate to the **app** directory and manually create a **Student.php** file. Then open the **User.php** file and copy the contents and paste them into the **Student.php** file. Be sure to change the class name to **Student** instead of **User**. You also need to change the $fillable array to correspond with the fields in the database.

Your Student.php file should look like this…..

```php
<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{

    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @vararray
    */

    protected $fillable = [
        'student_name', 'volunteer_hours', 'homeroom', 'street_address'
    ];

}
```

![]()


## 11. Create the Controller and the import method

Now that we have the Model set up we can create our Controller.  We are going to set up a Controller class with an import method that will call the import method in the Maatwebsite class (alias is Excel) and send it our Model and the Excel spreadsheet file submitted by the user.  Basically, this controller will have a method that will import the Excel spreadsheet data into our student database table and then return our view back to the form.  

Let's go ahead and manually create the **MyController.php** file in the **app\HTTP\Controllers directory** and write the following code in the file. Feel free to copy and paste the code below.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{

    /*
    * @return \Illuminate\Support\Collection
    */
    public function importView()
    {
        return view('import');
    }

    /*
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new StudentsImport,request()->file('file'));
        return back();
    }

}
```

![]()


## 12. Set up a Route

Now that we have everything set up we need to set up a route in our **routes/web.php** file.  Our route will allow the user to get to our web page where they will be able to import the excel file. This route will also trigger the import function in our MyController so the excel data will populate our students table in our vhours database.

Add the following line to **routes/web.php** under the **debug** route at the end of the file.

```php
Route::post('/import','MyController@import')->name('import');
```

![]()



## 13. Create a View

Finally, we need to create a web page that has an html form that will allow users to import a file. This new web page file will be called **import.blade.php** and will be placed in the **vhours/resources/views** directory. Go ahead and navigate to the **views** directory and manually create the **import.blade.php** file. Then put the following code in the file.

```html
<!DOCTYPEhtml>

<html>

<head>
    <title>Laravel 7 Import Excel to MySQL database</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css"/>

</head>

<body>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Laravel 7 Import Excel to MySQL database
        </div>
    
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            {{ csrf\_field() }}
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import User Data</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>
```

![]()


## 14. Run the app

After all that work we are now at that exciting moment of seeing if our application will work.  Don't be surprised if there are issues or errors in your code.  When I ran this the first time I had 4 different errors.  As soon as I fixed one, then there was another one, and then another, etc.  If you do run into errors, I have a few of the ones I ran into listed below the recap section with solutions.

No time like the present, let's see if this application will work.  Go to your **vhours.loc/** page. The import form should look like what you see below.

<img src='images/23.png' width='700' height='auto'>

![]()

Let's see if it works. Go ahead and choose the **studentData.xlsx** file provided with this tutorial. Then click **Import User Data**.

<img src='images/24.png' width='700' height='auto'>

![]()

After you click the Import User Data button, you should return to the form again. Now, check the database to see the newly imported data is in the students table.

<img src='images/25.png' width='700' height='auto'>

![]()

If you see what is in the image above your application is working!

### **The import is complete! Congratulations!!!**

You have now officially created a Laravel 7 application that will import an Excel file and populate the respective database table. Amazing work!

![]()


## A few things to consider as you move forward with this application
**1. Validation** - we want to make sure the user is submitting an Excel file and not an SQL injection or other malicious file.  

**2. Duplicate Data** - It might be important to make sure duplicate data is not being entered.  Right now you can import the same file over and over again and it will keep importing the data into the table.

**3. Notification** - Right now when you import the file you just return to the form without any notification that your data was imported into the database table.  It would be nice to give the user some sort of information that the data has been imported successfully.

![]()


## **Recap:**

1. Create the vhours Laravel 7 application
2. Install Maatwebsite package
3. Add Maatwebsite to the Service Provider
4. Assign Maatwebsite an alias
5. Publish Maatwebsite's configuration file
6. Create the vhours database
7. Connet the database to the application
8. Test the connection
9. Create database table via migrations
10. Setup a Model
11. Create MyController and the import method
12. Set up a Route
13. Create the View
14. Run the app

![]()


# ERRORS
#### Below are some of the errors that may come up when you run your app and their solutions.

![]()


## **Error: Permission Denied**

<img src='images/26.png' width='750' height='auto'>

![]()

If you get this error it means that you forgot to set your permissions or there are new permissions that need to be set.

Go back to the notes and double check to make sure you set up your permissions correctly.

[https://hesweb.dev/e15/notes/laravel/new-laravel-app](https://hesweb.dev/e15/notes/laravel/new-laravel-app)

Once you double check this and make sure that your permissions are set properly, if everything works then excellent.

If you end up with the chmod errors like you see below you may need to use the administrative command to change the file permissions.

Notice my example below is for a Mac. If you have a windows machine you may not have these issues since there is extensive read and write access to local paths.

<img src='images/27.png' width='700' height='auto'>

![]()

## **Error: Unable to create file**

<img src='images/28.png' width='700' height='auto'>

![]()

Went into **config/excel.php** and change the path for temporary storage from **sys\_get\_temp\_dir()** to **storage\_path().** This sets the temporary folder to your storage path which has the proper permissions. Notice in the image below I commented out the first local\_path so the only local\_path that is being executed is the second one.

<img src='images/29.png' width='600' height='auto'>

![]()


# Resources

### Import Excel to MySQL:

- [https://chartio.com/resources/tutorials/excel-to-mysql/](https://chartio.com/resources/tutorials/excel-to-mysql/)
- [https://www.w3resource.com/mysql/exporting-and-importing-data-between-mysql-and-microsoft-excel.php](https://www.w3resource.com/mysql/exporting-and-importing-data-between-mysql-and-microsoft-excel.php)
- [https://davalign.com/articles/import-excel-data-into-mysql-using-phpmyadmin/](https://davalign.com/articles/import-excel-data-into-mysql-using-phpmyadmin/)
- [https://www.tutsmake.com/laravel-6-import-export-excel-csv-to-database-example/](https://www.tutsmake.com/laravel-6-import-export-excel-csv-to-database-example/)
- [https://phppot.com/php/import-excel-file-into-mysql-database-using-php/](https://phppot.com/php/import-excel-file-into-mysql-database-using-php/)
- [https://medium.com/@haseeb.basil/how-can-php-import-excel-to-mysql-using-an-php-xlsx-reader-and-excel-xlsx-converter-b013c31ba2cf](https://medium.com/@haseeb.basil/how-can-php-import-excel-to-mysql-using-an-php-xlsx-reader-and-excel-xlsx-converter-b013c31ba2cf)
- [https://webtoolsplus.com/how-to-import-excel-into-mysql-using-php/](https://webtoolsplus.com/how-to-import-excel-into-mysql-using-php/)
- [https://webtoolsplus.com/excel-to-mysql/](https://webtoolsplus.com/excel-to-mysql/)
- [https://github.com/Maatwebsite/Laravel-Excel](https://github.com/Maatwebsite/Laravel-Excel)
- [https://docs.laravel-excel.com/3.1/imports/](https://docs.laravel-excel.com/3.1/imports/)
- [https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html](https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html)
- [https://medium.com/maatwebsite/introducing-laravel-excel-3-1-e478502bf92e](https://medium.com/maatwebsite/introducing-laravel-excel-3-1-e478502bf92e)
- [https://docs.laravel-excel.com/3.1/getting-started/support.html](https://docs.laravel-excel.com/3.1/getting-started/support.html)
- [https://docs.laravel-excel.com/3.1/getting-started/installation.html](https://docs.laravel-excel.com/3.1/getting-started/installation.html)
- [http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/](http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/)
- [https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html](https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html)
- [https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel](https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel)
- [https://laravel.com/docs/5.8/migrations](https://laravel.com/docs/5.8/migrations)
- [http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/](http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/)

### Understanding Laravel Better

- [https://medium.com/@basantbesra/create-aliases-for-your-classes-in-laravel-6814c349d3af](https://medium.com/@basantbesra/create-aliases-for-your-classes-in-laravel-6814c349d3af)
- [https://medium.com/grevo-techblog/service-provider-in-laravel-3b7267b0576e] (https://medium.com/grevo-techblog/service-provider-in-laravel-3b7267b0576e)
- [https://laravel.com/docs/7.x/packages](https://laravel.com/docs/7.x/packages)

### Style and Formatting:

- [https://cdnjs.com/libraries/twitter-bootstrap](https://cdnjs.com/libraries/twitter-bootstrap)
- [https://stackoverflow.com/questions/19075023/flow-text-around-an-image-in-github-markdown](https://stackoverflow.com/questions/19075023/flow-text-around-an-image-in-github-markdown)
- [https://www.markdownguide.org](https://www.markdownguide.org/basic-syntax/#paragraphs-1)
- [https://gist.github.com/uupaa/f77d2bcf4dc7a294d109](https://gist.github.com/uupaa/f77d2bcf4dc7a294d109)

### PhpSpreadsheet:

- [https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/](https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/)
- [https://www.htmlgoodies.com/beyond/making-the-switch-from-phpexcel-to-phpspreadsheet.html](https://www.htmlgoodies.com/beyond/making-the-switch-from-phpexcel-to-phpspreadsheet.html)

### Image Resources:

- [https://www.eggslab.net/export-mysql-table-data-into-excel-sheet/](https://www.eggslab.net/export-mysql-table-data-into-excel-sheet/)
- [https://webtoolsplus.com/how-to-import-excel-into-mysql-using-php/](https://webtoolsplus.com/how-to-import-excel-into-mysql-using-php/)
- [https://www.techddi.com/techddi/msexcel-mysql-converter.html](https://www.techddi.com/techddi/msexcel-mysql-converter.html)
- [https://www.youtube.com/watch?v=2FH72e6OjeQ](https://www.youtube.com/watch?v=2FH72e6OjeQ)
- [http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/](http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/)
- [https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel](https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel)

### Fixing Errors:

- [https://stackoverflow.com/questions/54500990/could-not-open-var-folders-n-laravel-excel-maatwebsite](https://stackoverflow.com/questions/54500990/could-not-open-var-folders-n-laravel-excel-maatwebsite)

![]()

![]()


# BONUS MATERIAL:

![]()

## How to manually import excel data into a MySQL database

1. Open Excel file
2. Select the worksheet you want to import (you can only import one worksheet at a time)
3. Save the worksheet as a comma separated values (.csv) file
4. Repeat this for each worksheet you want to import into the database
5. Open up phpMyAdmin at localhost/phpMyAdmin
6. Create a new database
7. Create tables for your database. Name the table after the worksheet.
8. Enter the number of fields for your table which will be the same number of columns you have in your Excel worksheet. If you need more fields later, you can add them so no worries if you don&#39;t get it exactly right. You can also delete fields if you put too many.
9. Now you will enter the field names for the table. Again, these are the columns in your Excel worksheet. You also need to enter the data type required for the type of data. We will go over an example after this overview. Then save.
10. Select the table you just created and click the **Import** tab
11. Choose the Browse button and select the .csv file that corresponds to the table you just created.
12. Select **CSV** in the **Format of imported**** file.**
13. Select **comma (,)** for the **Fields terminated**** by** option.
14. Now click Go
15. To make sure the data was imported properly you need to click the Browse tab. You should see all the records or rows of data that were in your worksheet.
16. If you have more worksheets to import you just repeat steps 7 through 15.

![]()

## How to import Excel spreadsheets using the Excel Import MySQL Data option

1. Open the Excel file you want to import.
2. Select the Data tab.
3. Select the &quot;MySQL for Excel&quot; Database icon.
4. Open a MySQL connection by double clicking.
5. Enter password for connection with the MySQL server.
6. Double click the database and the table you want to import.
7. Select &quot;Import MySQL Data
8. By default, all columns are selected and will be imported, but you can specify which columns you would like imported.
9. Click import
10. Now all data is imported, and you should check your MySQL database to make sure that it imported the way you expected.

![]()

## Raw PHP to import an Excel spreadsheet into a MySQL database

1. Create an html form for user to choose the excel file they want to import
2. Download and deploy PHP spreadsheet-reader library
3. Parse the excel data sheet by sheet
4. Insert data into database