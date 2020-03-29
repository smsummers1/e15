# Importing Excel data files into a MySQL database

This tutorial covers several techniques to import an excel data file into a MySQL database.  We discuss how to manually import excel data, how to utilize the Excel Import to MySQL option in Excel, how to write raw php code using a spreadsheet-reader library to import the data, to finally utilizing the PHP Framework Laravel and a Maatwebsite package to import the data.

![Excel to MySQL](/images/excel-mysql-s.png){:style="float: right;margin-right: 7px;margin-top: 7px;"}


Depending on what your application needs will help you decide how to implement the import of the excel spreadsheet.  ***put examples of when you might use each of these different options***



### How to manually import excel data files into a MySQL database

1. Open Excel file
2. Select the worksheet you want to import (you can only import one worksheet at a time)
3. Save the worksheet as a comma separated values (.csv) file
4. Repeat this for each worksheet you want to import into the database
5. Open up phpMyAdmin at localhost/phpMyAdmin
6. Create a new database
7. Create tables for your database.  Name the table after the worksheet.
8. Enter the number of fields for your table which will be the same number of columns you have in your Excel worksheet.  If you need more fields later, you can add them so no worries if you don’t get it exactly right.   You can also delete fields if you put too many.
9. Now you will enter the field names for the table.  Again, these are the columns in your Excel worksheet.  You also need to enter the data type required for the type of data.  We will go over an example after this overview.  Then save.
10.	Select the table you just created and click the Import tab
11.	Choose the Browse button and select the .csv file that corresponds to the table you just created.
12.	Select CSV in the Format of imported file.
13.	Select comma (,) for the Fields terminated by option.
14.	Now click Go
15.	To make sure the data was imported properly you need to click the Browse tab.  You should see all the records or rows of data that were in your worksheet.
16.	If you have more worksheets to import you just repeat steps 7 through 15.


### How to import Excel spreadsheets using the Import MySQL Data option

1. Open the Excel file you want to import.
2. Select the Data tab.
3. Select the “MySQL for Excel” Database icon.  
4. Open a MySQL connection by double clicking.
5. Enter password for connection with the MySQL server.
6. Double click the database and the table you want to import.
7. Select “Import MySQL Data
8. By default, all columns are selected and will be imported, but you can specify which columns you would like imported.
9. Click import
10.	Now all data is imported and you should check your MySQL database to make sure that it imported the way you expected.

### PHP to import an Excel spreadsheet into a MySQL database

1. Create an html form for user to choose the excel file they want to import
2. Download and deploy PHP spreadsheet-reader library
3. Parse the excel data sheet by sheet
4. Insert data into database


### Utilizing Laravel to import an Excel spreadsheet into a MySQL database

1. Create a new Laravel application
2. Set database credentials in .env file
3. Install Maatwebsite package
4. Add fake records In database
5. Create controller
6. Add routes
7. Create import export classes
8. Create blade view
9. Start development server




### Resources
 
- <https://dev.mysql.com/doc/mysql-for-excel/en/mysql-for-excel-export.html>
- <http://talkerscode.com/webtricks/export-mysql-data-to-excel-using-php-and-html.php>
- <https://chartio.com/resources/tutorials/excel-to-mysql/>
- <https://www.w3resource.com/mysql/exporting-and-importing-data-between-mysql-and-microsoft-excel.php>
- <https://blogs.oracle.com/mysql/how-to-guide-to-exporting-data-from-excel-to-a-new-mysql-table>
- <https://davalign.com/articles/import-excel-data-into-mysql-using-phpmyadmin/>
- <https://www.databasejournal.com/features/mysql/importing-xml-csv-text-and-ms-excel-files-into-mysql.html>
- <https://www.itsolutionstuff.com/post/laravel-57-import-export-excel-to-database-exampleexample.html>
- <https://www.tutsmake.com/laravel-6-import-export-excel-csv-to-database-example/>
- <https://phppot.com/php/import-excel-file-into-mysql-database-using-php/>
- <https://medium.com/@haseeb.basil/how-can-php-import-excel-to-mysql-using-an-php-xlsx-reader-and-excel-xlsx-converter-b013c31ba2cf>

