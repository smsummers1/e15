# Project 3
+ By: Shawna Summers
+ Production URL: <http://e15p3.shawnasummers.xyz>

## Feature summary

adminWelcome.blade.php - '/admin/adminWelcome'

Administrators Portal Welcome page with Main Menu

Here administrators can choose to:

Upload New Data Files - Each year they upload new excel files to quickly populate the student table (this may need to change in that when  new file is loaded old students get marked as 'Moved' or 'Graduated' in the database rather than just deleted.) [CRUD - Creating]

Generage Reports - Under Hours, reports to send home to parents via email or paper printed (would like to move away from paper printed reports), [CRUD - Read Database]

Edit Student & Volunteer Information - Edit student information, Edit volunteer Information, Add hours, Remove hours,  - [CRUD - Create, Update, Delete]

Get Support - Give contact information to the assistant principal, Jen Rimes, Me, and anyone else who might need assistance.  There will be a form they can submit that will email the correct person with their issue.  Or they can just call the numbers listed on the site.  Might put a map and directions to school for those who may not have that info.


This is the admin side of my volunteer hours application
+ Administrators can log in
+ Users can add/update/delete student, and user data (firstName, lastName, streetAddress, HoursCompleted, etc.)
+ Upload files that populates the database with student, parent and volunteer information (3 different sources)
+ Reports can be generated (under volunteer hours, etc.)

  
## Database summary
*Describe the tables and relationships used in your database. Delete the examples below and replace with your own info.*

+ My application has 3 tables in total (`users`, `movies`, `categories`)
+ There's a many-to-many relationship between `movies` and `categories`
+ There's a one-to-many relationship between `movies` and `users`

## Outside resources
+ https://getbootstrap.com/docs/4.1/utilities/spacing/#horizontal-centering
+ https://www.macmillandictionary.com/us/thesaurus-category/american/the-process-of-changing-or-making-changes
+ https://www.w3schools.com/tags/tag_select.asp
+ https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
+ https://laracasts.com/discuss/channels/laravel/excel-file-validation-in-laravel-dose-not-work?page=1
+ https://laravel-tricks.com/tricks/excel-file-validation
+ https://www.calculator.net/time-calculator.html?tcday1=0&tchour1=14&tcminute1=42&tcsecond1=0&Op=-&tcday2=0&tchour2=8&tcminute2=38&tcsecond2=0&tcday3=&tchour3=3&tcminute3=9&tcsecond3=&ctype=1&x=107&y=20
+ https://medium.com/zestgeek/customize-laravel-registration-form-with-additional-fields-de2c1e294a37
+ https://laravel.com/docs/7.x/authorization - GATES
+ 

## Notes for instructor

