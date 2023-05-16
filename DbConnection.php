<?php
/* DbConnection.php
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_php/DbConnection.php
*/
/* mysql */
	$dbhost ="localhost:3306";
	$dbuser = "root"; // usuario de mysql
	$dbpass = "blaumond"; // contraseña de mysql
	$dbname = "sakila";  // nombre de la base de datos

    //variable que guarda la conexión de la base de datos
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Test if connection occurred.
	if (mysqli_connect_errno()){
		die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
		);
	}
?>
