STAR Virtual Company
=====================

INTRODCUTION:
-------------
a. Background: this web application is developed to facilitate a NSF project's needs (Project Title:
Seamless Transcition from Acamdemia to Real-world. For a short introduction, this project is to implant 
the real-world projects from big companies, the current partner: GE, into classroom education. The projects had been tailored 
to be fitted to course's currciulumn. To simulate the real-world working environment, students of this new education system 
are asked to work for these projects as engineers of a virtual company.)

b. Web application (Virtual Company): the mission of this web application is to delivery: 1)the distribution of projects'
multi-media materials to the "engineers"; 2)text communication among engineers, directors and consultants; 3) submitting of
solution documents; 4) commenting and grading about solutions and etc.

c. Techniques Summary:  JavaScript, PHP, MySQL, HTML, CSS, Twitter's bootstrap
(The initiation of system is triggered by a PHP file, in which a MySQL scripts for creating the database and PHP functions 
are included. Suggested Server OS is Ubuntu Server 12.04 64bit with LAMP; There are a number of dependent open source library had been utilized.)

d. a living intance can be visited at url: http://uc-star.info/v1.9.uc-star.info/

FEATURE LIST:
-------------
a. **A complete portfolio:**
	* Home Page
	![Home Page](/README/home_page)

	* Department Page/Project Portfolio
	![project_portfolio](/README/Project Portfolio)

	* 

b. **Multi-role User System: Engineer, Director and Consultant**
  *According to setting of web application, a user have to be created with a specific role and associated with a particular collection of resouce access, authorization, interfrace layout and etc.*
  []

b. **Centralized information hub**
	*all parties, engineer, director and consultant, can send real-time messages and other resource (project files) via dedicated channel.*

c. 





INSTALLATION:
--------------

STEP 01: Install Apache, MySQL and PHP. <br /> 
a. Make your the folder (assume your install it in "/etc/www/vc/") for Virtual Company is accessible through client internet brower.<br /> 
b. Create a database for virtual company in mysql, creating a user with write rights to the virtual comapny database.<br /> 

STEP 02: Use text editor to fill the database information in "/etc/www/vc/php/db/db_connection.php" for MySQL connection.
The code looks like below:

```
<?php
// MySQL database connection
session_start();

$db_hostname = "localhost"; // for local database on the server
$db_username = "username"; // database user name, mysql default username is root
$db_password = "password"; // password
$db_database = "database"; // database for virtual company

$db = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($db->connect_errno > 0) die("Unable to connect to database: ". $db->connect_error);

?>
```

STEP 03: Initiate your database for Virtual Company by excuting the file "etc/www/vc/php/db/create_db.php".
This operation is conducted by visiting this page via a client brower: "http(s)://URL/php/db/create_db.php".
(NOTE: The IP should be directed to the "/etc/www/vc/" by Apache configuration.) 
