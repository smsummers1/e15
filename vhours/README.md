# Importing Excel Data

### How to import an Excel data file into a MySQL database utilizing a Laravel tool called Maatwebsite

Up until now, all our data has come from user input, a seeder file, or just recently the testing tool Dusk. My final project is the beginning of a volunteer hour tracking software application that will have data entered via excel files. I wanted to learn how to allow a user to input a file via an html form that would then populate the database. Thus, my search for the best way to import an Excel data file into a MySQL database.

What I found was that there are several ways to import an Excel spreadsheet into a MySQL database.

- **manually** import excel data
- use the **Excel Import to MySQL** option in Excel,
- write **raw php code** using a **spreadsheet-reader library** to import the data
- utilize **Laravel** and the **Maatwebsite** package

This tutorial covers the later and we will be walking through the creation of an entire Laravel application that will utilize the Maatwebsite package to import an Excel spreadsheet via an html form.  You have access to the code and the Excel spreadsheet here in Github.

Let&#39;s get started. We have a lot of ground to cover.

## 1. Create a new Laravel application

Go ahead and create a new Laravel application and point the local server to your new app called **vhours**. If you don&#39;t remember how to do this follow the instructions at the link below.

[https://hesweb.dev/e15/notes/laravel/new-laravel-app](https://hesweb.dev/e15/notes/laravel/new-laravel-app)

I named my new Laravel application **vhours**

![](RackMultipart20200425-4-1tqgdeb_html_8b09b34cafb52ee5.png)

## 2. Install Maatwebsite package

To get our applications to import Excel files to our database we are going to need an additional Laravel package called Maatwebsite that doesn&#39;t come standard with the framework. We need to install the Maatwebsite package and check that our dependencies are set up correctly for this new package.

To install the Maatwebsite package we will use our PHP dependency manager tool [Composer](https://getcomposer.org/).

$ composer require maatwebsite/excel

![](RackMultipart20200425-4-1tqgdeb_html_1fc5aa1a9d6feebd.png) ![](RackMultipart20200425-4-1tqgdeb_html_ff31f92b40313be9.gif)

Once the package has generated successfully, check the **composer.json** file to make sure you see the **maatwebsite/excel** line that is highlighted below. It should be listed under the **&quot;require&quot;** area of the file.

$ cat composer.json

![](RackMultipart20200425-4-1tqgdeb_html_b0d517f50d4d83a7.png) ![](RackMultipart20200425-4-1tqgdeb_html_17d832186f4bbefb.gif)

_File Snippet 1 - You should see &quot;maatwebsite/excel&quot;: &quot;^3.1&quot;_

## 3. Add service provider and alias to your config/app.php file

Open the **config/app.php** file and add the line you see below in the **providers section** of the file. Then add the **alias** line in the **aliases section** of the file. (You can copy and paste the lines in the grey boxes below).

**Note** : Notice that the aliases are in alphabetical order, so be sure to put the **Excel** alias after the **Event** alias.

**Aside** : If you are working in Nano you need to do the following commands after you have finished making all of the changes and are ready to save and close the file: **ctrl+x** to exit, then **y** to save and then finally **enter** to finalize your changes to the current file. You will be prompted for all these responses.

```
$ nano app.php
```

```
&#39;providers&#39; =\&gt; [

....

Maatwebsite\Excel\ExcelServiceProvider::class,

],
```

```

&#39;aliases&#39; =\&gt; [

....

&#39;Excel&#39; =\&gt; Maatwebsite\Excel\Facades\Excel::class,

],
```

## 4. Now we Publish the configuration file with the following command

Use the command below to create a new file named **config/excel.php**. You will be prompted to choose the provider from a list to publish. Be sure to choose the **Provider: Maatwebsite\Excel\ExcelServiceProvider**

$ php artisan vendor:publish

![](RackMultipart20200425-4-1tqgdeb_html_f8fbbdcfb1de4513.png)

Check to make sure that the **config/excel.php** file was created

![](RackMultipart20200425-4-1tqgdeb_html_90609fb25283932e.png)

## 5. Prepare the database

Create the database via phpMyAdmin

Turn on your XAMPP web server and then click the **start all** button.

**Note** : Feel free to only start the MySQL database and the Apache web server if you want. I just prefer to start them all since it is just one click and it won&#39;t hurt or noticeably slow anything down to have the ProFTPD running along-side the others even though we aren&#39;t going to use it.

Open a browser and type in the URL [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

You should see a screen that looks like what you see below. You might not have all the same databases I have shown on the left-hand side of the page, but it should look very similar. Right now, we do **not** have a database for our application.

![](RackMultipart20200425-4-1tqgdeb_html_f2240975acb5c54.png)

We need to create a new database. For consistency, we will name our database the same as our application.

Click on the **Databases** tab at the top just above the heading General settings shown below.

![](RackMultipart20200425-4-1tqgdeb_html_c80e4f0b41a204.png)

Then type in the name of your database. Set the database name is to **vhours** and the collation to **utf8mb4\_general\_ci.** Then click the **create** button.

![](RackMultipart20200425-4-1tqgdeb_html_dd8328ccde62fa10.png)

Y ![](RackMultipart20200425-4-1tqgdeb_html_f66aeaf59fd75fba.png) ou should now see the **vhours** database listed on the left-hand side of the phpMyAdmin screen as you see highlighted below.

And again, you may not have as many databases as I have. Just be sure that you have the **vhours** database listed.

## 6. Configure Database Environment

Now that we have our **vhours** database we need to update the database configuration in the .env file at the root of the application so that we can connect our application to the database. Open the **vhours/.env** file.

Go ahead and set the following database configurations as you see below. Notice that the **DB\_PASSWORD** is **empty**. There isn&#39;t anything there because I didn&#39;t set a password. Once you set this file up the way you see below, save and close.

![](RackMultipart20200425-4-1tqgdeb_html_ae819880d5e3a9a9.png)

## 7. Test our connection

Put the following code in your **routes/web.php** file.

```
Route::get(&#39;/debug&#39;, function () {

$debug = [

&#39;Environment&#39; =\&gt; App::environment(),

];

/\*

The following commented out line will print your MySQL credentials.

Uncomment this line only if you&#39;re facing difficulties connecting to the

database and you need to confirm your credentials. When you&#39;re done

debugging, comment it back out so you don&#39;t accidentally leave it

running on your production server, making your credentials public.

\*/

#$debug[&#39;MySQL connection config&#39;] = config(&#39;database.connections.mysql&#39;);

try {

$databases = DB::select(&#39;SHOW DATABASES;&#39;);

$debug[&#39;Database connection test&#39;] = &#39;PASSED&#39;;

$debug[&#39;Databases&#39;] = array\_column($databases, &#39;Database&#39;);

} catch (Exception $e) {

$debug[&#39;Database connection test&#39;] = &#39;FAILED: &#39; . $e-\&gt;getMessage();

}

dump($debug);

});
```

Now run the following URL in your browser

[http://vhours.loc/debug](http://vhours.loc/debug)

You should see **vhours** in the array of databases. This means you are connected successfully to the database and ready to move forward.

![](RackMultipart20200425-4-1tqgdeb_html_905129c85ce26769.png)

Now that the database has been created and we are connected, we need to create a table in our database that will line up with our Excel data file.

## 8. Creating a table in our database via migrations

While we could manually create our table via phpMyAdmin, we are going to opt to utilize [migrations](https://medium.com/@rakshithvasudev/laravel-migrations-what-are-they-why-use-them-how-to-use-203769a917c3). They are a necessity when creating a database driven app. Check out the notes to remind yourself just how powerful migrations are and why they are a necessity.

[https://hesweb.dev/e15/notes/laravel/db-migrations](https://hesweb.dev/e15/notes/laravel/db-migrations)

To start this process we will use the [Artisan](https://laravel.com/docs/7.x/artisan) tool to generate our migration file called create\_students\_table.

```
$ php artisan make:migration create\_students\_table --create=students
```

![](RackMultipart20200425-4-1tqgdeb_html_1c4e5995e11f2d86.png)

Let&#39;s go check and make sure it was created. The new migration file will be in **vhours/database/migrations** directory.

![](RackMultipart20200425-4-1tqgdeb_html_e702f5a759aea14b.png) ![](RackMultipart20200425-4-1tqgdeb_html_cd5ac38297186de1.gif)

To code our new migration file correctly we need to check out the data we want to import into our table first. Below is an example Excel file that we will be practicing with for our application. Notice the column headings and the content in each column.

![](RackMultipart20200425-4-1tqgdeb_html_2334f618f45df8c1.png)

We need to code the migration to create the fields/columns in the database table **students** to correlate to the columns in the Excel data file called **studentData.xlsx** above.

**Note** : You must delete the heading row 1 before you import the file, but I left it there for you to see how each column matches up to the field/column in the database.

Now that you have looked over the above Excel file, open the **create\_students\_table.php** migration file.

**FYI** : Notice that there is a timestamp and a number prefixing the migration filename. I will usually leave that prefix off when referring to a migration file.

Below are the changes that need to be made to the file so that the fields/columns in the studentData.xlsx file line up with the fields/columns in the students table.

**Note** : The id() and the timestamps() functions listed in the code below will auto generate values and will not cause an issue when we do our import. Also, a database tool that we utilize in our Laravel applications called [Eloquent](https://laravel.com/docs/7.x/eloquent#introduction) is expecting to see these fields in the table. If they are not there, Eloquent will not work properly.

```
publicfunction up()

{

Schema::create(&#39;students&#39;, function (Blueprint $table) {

$table-\&gt;id();

$table-\&gt;timestamps();

$table-\&gt;string(&#39;student\_name&#39;, 100);

$table-\&gt;smallInteger(&#39;volunteer\_hours&#39;)-\&gt;nullable();

$table-\&gt;string(&#39;homeroom&#39;, 100)-\&gt;nullable();

$table-\&gt;string(&#39;street\_address&#39;, 100)-\&gt;nullable();

});

}
```

Now we are going to set up our tables in our **vhours** database by running our migrations.

```
$ php artisan migrate:fresh
```

![](RackMultipart20200425-4-1tqgdeb_html_9553587631451459.png)

Let&#39;s go check phpMyAdmin to see if we have our new tables. You should have the same tables I have listed below. We are going to focus our attention on the students table.

![](RackMultipart20200425-4-1tqgdeb_html_6b714d0e7955e975.png)

Click on the **vhours** database in the left-hand column and you should see 4 tables appear in the center of the screen one of which is our **students** table. Now let&#39;s check to see if it is set up the way we expected. Click on the **students** table and you should see this:

![](RackMultipart20200425-4-1tqgdeb_html_f2f95ae39570c056.png)

and then if we click on the **Structure** tab you should see this:

![](RackMultipart20200425-4-1tqgdeb_html_90d358f049784e34.png)

## 9. Set up Route

Now we need to set up a resource route in our **routes/web.php** file for our crud application, which means that we want to have a route to allow users to get to our import web page where they will be able to import the excel file. We will create that page soon. For now we will set up the route.

Add the following line to the **routes/web.php** file under the **debug** route at the end of the file.

![](RackMultipart20200425-4-1tqgdeb_html_d37d0bbaa68a6bc8.png)

## 10. Set up Model

Now we need to create an **import** class so we can start creating the ability to import our Excel data file. Maatwebsite package provides a way to build an import class. We will need to use this in our controller. Run the following command.

$ php artisan make:import StudentsImport –-model=Student

![](RackMultipart20200425-4-1tqgdeb_html_d9ecb8ad29f6bf02.png)

This should create a **StudentsImport.php** file in the **app/Imports** directory. Let&#39;s go make sure this file was generated. Go ahead and open the **StudentsImport.php file**.

Now we need to edit this file to reflect the data that will be imported from the Excel data file.

```
publicfunction model(array $row)

{

returnnew Student([

&#39;student\_name&#39; =\&gt; $row[0],

&#39;volunteer\_hours&#39; =\&gt; $row[1],

&#39;homeroom&#39; =\&gt; $row[2],

&#39;street\_address&#39; =\&gt; $row[3],

]);

}
```

Now we need to generate the App\Student use file listed at the top of the StudentImport.php file.

Navigate to the app directory and manually create a Student.php file. Then open the User.php file and copy the contents and paste them into the Student.php file. Be sure the change the class name to Student instead of User. You also need to change the $fillable array to correspond with the fields in the database.

Your Student.php file should look like this…..

```
\&lt;?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable

{

use Notifiable;

/\*\*

\* The attributes that are mass assignable.

\*

\* @vararray

\*/

protected $fillable = [

&#39;student\_name&#39;, &#39;volunteer\_hours&#39;, &#39;homeroom&#39;, &#39;street\_address&#39;

];

}
```

## 11. Create MyController

Now we need to create **MyController** by extending the **controller** class in **vhours/app/Http/Controllers/MyController.php**.

We will create the import request logic and return response here. Go ahead and manually create the **MyController.php** file in the **Controllers directory** and write the following code in the file. Feel free to copy and paste the code below.

```
\&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\StudentsImport;

use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller

{

/\*\*

\* @return \Illuminate\Support\Collection

\*/

publicfunction importView()

{

return view(&#39;import&#39;);

}

/\*\*

\* @return \Illuminate\Support\Collection

\*/

publicfunction import()

{

Excel::import(new StudentsImport,request()-\&gt;file(&#39;file&#39;));

return back();

}

}
```

## 12. Create the View

And finally, we need to create our html form to allow users to import a file. This new file will be called **import.blade.php** and will be placed in the **vhours/resources/views** directory. Go ahead and navigate to the **views** directory and manually create the **import.blade.php** file. Then put the following code in the file.

```
\&lt;!DOCTYPEhtml\&gt;

\&lt;html\&gt;

\&lt;head\&gt;

\&lt;title\&gt;Laravel 7 Import Excel to MySQL database\&lt;/title\&gt;

\&lt;linkrel=&quot;stylesheet&quot;href=&quot;https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css&quot;/\&gt;

\&lt;/head\&gt;

\&lt;body\&gt;

\&lt;divclass=&quot;container&quot;\&gt;

\&lt;divclass=&quot;card bg-light mt-3&quot;\&gt;

\&lt;divclass=&quot;card-header&quot;\&gt;

Laravel 7 Import Excel to MySQL database

\&lt;/div\&gt;

\&lt;divclass=&quot;card-body&quot;\&gt;

\&lt;formaction=&quot;{{ route(&#39;import&#39;) }}&quot;method=&quot;POST&quot;enctype=&quot;multipart/form-data&quot;\&gt;

{{ csrf\_field() }}

\&lt;inputtype=&quot;file&quot;name=&quot;file&quot;class=&quot;form-control&quot;\&gt;

\&lt;br\&gt;

\&lt;buttonclass=&quot;btn btn-success&quot;\&gt;Import User Data\&lt;/button\&gt;

\&lt;/form\&gt;

\&lt;/div\&gt;

\&lt;/div\&gt;

\&lt;/div\&gt;

\&lt;/body\&gt;

\&lt;/html\&gt;
```

## 13. Run the app

Go to your **vhours.loc/** page. The import form should look like what you see below.

![](RackMultipart20200425-4-1tqgdeb_html_e12d6846b930c5ff.png)

Let&#39;s see if it works. Go ahead and choose the studentData.xlsx file provided with this tutorial. Then click **Import User Data**.

![](RackMultipart20200425-4-1tqgdeb_html_af8fc248086de6c1.png)

After you click the Import User Data button, you should return to the form again. Check the database to see the newly imported data in the students&#39; table.

![](RackMultipart20200425-4-1tqgdeb_html_f71dde573c2d92e2.png)

**The import is complete! Congratulations!!!**

You have now officially created a Laravel 7 application that will import an Excel file and populate the respective database table.

**Recap:**

1. Create a new Laravel 7 application
2. Install Maatwebsite package
3. Update the config file
4. Publish the config file
5. Prepare the database
6. Configure the database environment
7. Test Connection
8. Add Migration to create table
9. Setup Route and Model
10. Create the Controller
11. Create the View
12. Run the app

Some of the errors that may come up when you run your app and their solutions are below.

**Error: Permission Denied**

![](RackMultipart20200425-4-1tqgdeb_html_32d6cc7ba507d616.png)

If you get this error it means that you forgot to set your permissions or there are new permissions that need to be set.

Go back to the notes and double check to make sure you set up your permissions correctly.

[https://hesweb.dev/e15/notes/laravel/new-laravel-app](https://hesweb.dev/e15/notes/laravel/new-laravel-app)

Once you double check this and make sure that your permissions are set properly, if everything works then excellent.

If you end up with the chmod errors like you see below you may need to use the administrative command to change the file permissions.

Notice my example below is for a Mac. If you have a windows machine you may not have these issues since there extensive read and write acess to local paths.

![](RackMultipart20200425-4-1tqgdeb_html_970e01d17ede92bb.png)

**Error: Unable to create file**

\ ![](RackMultipart20200425-4-1tqgdeb_html_3336b72be46c44f9.png)

Went into **config/excel.php** and change the path for temporary storage from **sys\_get\_temp\_dir()** to **storage\_path().** This sets the temporary folder to your storage path which has the proper permissions. Notice in the image below I commented out the first local\_path so the only local\_path that is being executed is the second one.

![](RackMultipart20200425-4-1tqgdeb_html_94785e580477f5ae.png)

## Resources

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
- [https://github.com/Maatwebsite/Laravel-Excel/blob/3.1/.github/SUPPORT.md](https://github.com/Maatwebsite/Laravel-Excel/blob/3.1/.github/SUPPORT.md)
- [https://docs.laravel-excel.com/3.1/getting-started/support.html](https://docs.laravel-excel.com/3.1/getting-started/support.html)
- [https://docs.laravel-excel.com/3.1/getting-started/installation.html](https://docs.laravel-excel.com/3.1/getting-started/installation.html)
- [http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/](http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/)
- [https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html](https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html)
- [https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel](https://ourcodeworld.com/articles/read/234/how-to-create-an-excel-file-using-php-office-in-laravel)
- [https://laravel.com/docs/5.8/migrations](https://laravel.com/docs/5.8/migrations)
- [http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/](http://www.phpzone.in/laravel-5-import-export-data-csv-excel-using-maatwebsite/)

### Style and Formatting:

- [https://cdnjs.com/libraries/twitter-bootstrap](https://cdnjs.com/libraries/twitter-bootstrap)
- [https://stackoverflow.com/questions/19075023/flow-text-around-an-image-in-github-markdown](https://stackoverflow.com/questions/19075023/flow-text-around-an-image-in-github-markdown)
- [https://www.markdownguide.org](https://www.markdownguide.org/basic-syntax/#paragraphs-1)

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



# How to manually import excel data into a MySQL database

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

# How to import Excel spreadsheets using the Excel Import MySQL Data option

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

# Raw PHP to import an Excel spreadsheet into a MySQL database

1. Create an html form for user to choose the excel file they want to import
2. Download and deploy PHP spreadsheet-reader library
3. Parse the excel data sheet by sheet
4. Insert data into database