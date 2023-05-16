<!DOCTYPE html>
<!-- HowToDeployMyWebsite.php 
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_p2p/HowToDeployMyWebsite.php
-->
<html>
<head>
    <title>
        HowToDeployMyWebsite.php
    </title>
	<link rel="stylesheet" type="text/css" HREF="Style.css" >
</head>
<body background= "./images/cinemaClassic.avif" alt="Bioinformatics website" style="width:1400px;height:800px;">

<h1>
    Instructions to deploy my web application
	<br>
	
</h1>
<hr>
<ol>
	<li> <b>What are the system requirements?</b>
	<p> The user must be an administrator
		<br/><br/>The system should have the following:
		<br/><b>Browser: </b> <a href="https://www.google.com/chrome/browser/desktop/" target="_blank" >Chrome</a>
		<br/><b>Servers: </b> Web server, database server, PHP server --> XAMPP
		<br/><a href="https://www.apachefriends.org/download.html" target="_blank" >XAMPP file: 5.6.32/PHP 5.6.32 or better</a>
		<br/><br/><b>MySQL: </b><a href="https://dev.mysql.com/downloads/workbench/" target="_blank" >MySQL Workbench</a>
		<br/><b> Text Editor: </b><a href="https://code.visualstudio.com/download" target="_blank" >VS Code</a>
	</p></li>
	<li> <b>What is the name of the database?</b>
	<p> prod_p2p
	</p></li>
	<li> <b>What are the steps to restore your database?</b>
	<p> -  Unzip the file webapp_p2p
	<br/> -  Open MySQL Workbench and open the script prod_p2p_bk from the contents of the unzipped folder
	<br/> -  Run the script to restore database
	</p></li>
	<li> <b>Where are the files that support your website??</b>
	<p> All the files are included in the downloadable zip file <a href="webapp_p2p.zip">webapp_p2p</a>.
	<br/>The zip file contains database backup file (prod_p2p_bk) and all other files related to the website.
	</p></li>
	<li> <b>How to test the website to ensure a successful deployment?</b>
	<p> -  Unzip the file webapp_p2p
	<br/> -  Open MySQL Workbench and open the script prod_p2p_bk from the contents of the unzipped folder
	<br/> -  Run the script to import database
	<br/> -  The restored database does not have any unused views, functions and stored procedures...
    <br>....and has the stored procedures required to generate reports
	<br/> -  Open the DbConnection.php file from the contents of the unzipped folder.
	<br/> -  Click the website in the comments at the top of the file.
	 <br/> -  A successful deployment of the database would show a blank screen.
	</p></li>
</ol>
<br>
<br>
</body>
</html>
