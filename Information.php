<?php
/* Information.php
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_p2p/Information.php
*/
?>
<?php
/*
	$dbhost ="localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "prod_p2p";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Test if connection occurred.
	if (mysqli_connect_errno()){
		die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
		);
	}
*/
//var_dump($_POST);
if (isset($_POST["submit1"]) && !empty($_POST["choice"])) 
{
	require_once "DbConnection.php";
	$choice = $_POST["choice"];
	//echo ($choice);
}

if (isset($_POST['submit1']) && empty($_POST['choice'])) 
	
	{
		$error_message = 'Por favor escoja una opción';
	}


?>
<?php
// use a stored procedure to get the data from db
if(!empty($connection))
{
	$query = 'call sp_128(' . '"' . $choice . '")';
	//echo $query."<br/>";
	$result = mysqli_query($connection, $query);
	if (!$result)
	{
		die("Database query failed.");
	}

}		
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        Information.php
    </title>
    <link rel="stylesheet" type="text/css" HREF="Style.css" >
</head>
<body background= "./images/cinemaClassic.avif"  alt="example website" style="width:1400px;height:800px;"
<h1>
    Use prod_p2p Database
</h1>
<br>
<hr>
<form name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<p> Select one of the information you'd like to see: </p>
<p> 	
	 <input type="radio" name="choice" value="1" style ="margin-left:20px"
	 <?php	
		if(!empty($connection) && $choice == 1)
		{
			echo " checked";
		}
	  ?>
	 /> Details of protein, the disease search term it's associated with and the person who collected the data<br>
	<input type="radio" name="choice" value="2" style ="margin-left:20px"
	<?php	
		if(!empty($connection) && $choice == "2")
		{
			echo " checked";
		}
	 ?>	  
	/> Data of Protein, related Disease Ontology ID along with the DO Disease Name and its relationship &nbsp;<br> 
	<input type="radio" name="choice" value="3" style ="margin-left:20px" 
	<?php	
		if(!empty($connection) && $choice == "3")
		{
			echo " checked";
		}
	 ?>
	 /> Information about Names of the diseases, their phenotype mim numbers and the proteins involved &nbsp;<br> 
	<input type="radio" name="choice" value="4" style ="margin-left:20px" 
	<?php	
		if(!empty($connection) && $choice == "4")
		{
			echo " checked";
		}
	 ?>
	 /> Show the statistics of the database. 
</p>

<input type="submit" name="submit1" value="Get Information" class="button" />
<input Type="button" value="Go Back to Report Search Page" onclick="window.location.href='Index.php'" class="button"> 
</form>
<hr>
<br>
	<?php
	
	if (isset($_POST['submit1']) && empty($_POST['choice'])) 
	
	{
		echo $error_message;
	}
	
	
	
	if (!empty($connection))
	{	
			$NumOfRows = mysqli_num_rows($result);
			$Index = 0;
			//echo "Number of rows = $NumOfRows"."<br/>";
			//echo "check row count <br/>";
			//echo (false);
			//echo ($NumOfRows);

			if ($NumOfRows == 0)
			{
				echo "No data was found";
			} else
			{
				echo '<table class="table1">';
				echo '<caption>
					Here is the information you requested';
		
				echo "</caption>";
				echo "<thead>
						<tr>";
				$row = mysqli_fetch_assoc($result);
				//print_r ($row);
				
				foreach($row as $k => $v ) 
				{       
					echo "<th>".$k."</th>";
				}
			
				echo "	</tr>
					</thead>
					<tbody>";

				$check = mysqli_data_seek($result, 0);
				
				 while ($rownew = mysqli_fetch_assoc($result))
				 {
					echo "<tr>";
					foreach($rownew as $k => $v)
					{
					echo "<td>".$v."</td>";
					}
					echo "</tr>";	
				 }
				 
				echo "	</tbody>
					</table>";
			}
	}
	?>
	
	<?php
		if(!empty($connection))
		{
			mysqli_free_result($result);
		}
	?>

</body>
</html>

<?php
	// close database connection
	if(!empty($connection))
	{
		mysqli_close($connection);
	}
?>