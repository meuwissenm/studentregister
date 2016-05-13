# studentregister
A class registration site project made with a team for my Capstone Class
Deployment of SILC program to new host:
Required files; SILC_TABLES.sql, SILC.zip

Login to new server using ftp client
Create new folder SILC under public_html directory on new server
Unzip contents of SILC.zip into new SILC folder
Download and Edit one file in SILC folder; db_functions.php to change connection string to new database username and password: 
For example change $result = new mysqli('localhost', 'ics499sp160107', '659492', 'ics499sp160107'); to new host $result = new mysqli('localhost', ' = ics499sp160115 ', '229499 ', = ics499sp160115 ');
Upload new db_functions.php back to new SILC folder on new server

Log onto new database to create SILC tables using SSH; example Original database db Servername = ics499sp160115 and password= yrmcwyqb
Connect to sql server
mysql -u ics499sp160115 –p
password=229499
Set database to new database for example 
Use u ics499sp160115
Run all the scripts in SILC_Tables.sql

SILC application now running on new host and new database.  
Example: 
http://sp-cfsics.metrostate.edu/~ics499sp160115/SILC/index.php
