<?php
/* ProteinsDiseases.php 
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_p2p/ProteinsDiseases.php
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
if (isset($_POST["submit1"]) && !empty($_POST["protein_id"]) && !empty($_POST["disease_name"])) 
{
	require_once "DbConnection.php";
	$protein_id = $_POST["protein_id"];
	$disease_name = $_POST["disease_name"];
	}
	
if (isset($_POST['submit1']) && empty($_POST['protein_id'])&& !empty($_POST['disease_name'])) 
	
	{
		$error_message1 = 'please enter protein id';
	}
	
	
if (isset($_POST['submit1']) && !empty($_POST['protein_id']) && empty($_POST['disease_name'])) 
	
	{
		$error_message2 = 'please enter disease name';
	}


if (isset($_POST['submit1']) && empty($_POST['protein_id']) && empty($_POST['disease_name']))
	
	{
		$error_message3 = 'please enter both protein id and disease name';
	}
	
	
?>
<?php
// use a stored procedure to get the data from db
if(!empty($connection))
{
		$query = "call sp_127(" . '"' . $protein_id . '", "' . $disease_name . '")';
		//echo $query."<br/>";
		$result = mysqli_query($connection, $query);
		if (!$result)
		{
			die("Database query failed.");
		}
}		
?>
<!DOCTYPE html>
<!-- Films.php 
This is a comment. Comments are not displayed in the browser
-->

<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        ProteinsDiseases.php
    </title>
    <link rel="stylesheet" type="text/css" HREF="Style.css">
</head>
<body background= "./images/cinemaClassic.avif"  alt="example website" style="width:1400px;height:800px;" >
<h1>
    Use prod_p2p Database
</h1>
<br>
<hr>

<form name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<p>Enter the ID of the protein that you are looking for:
<select  name="protein_id" class="textbox">
  <!--option value="" selected disabled>Select a disease_name</option--> 
  <option 
  	<?php
		if(!empty($connection))
		{
			echo 'value="' . $protein_id .'"'; 
		} else
		{
			echo 'value="" selected disabled';
		}
	?>
  >
  	<?php
		if(!empty($connection))
		{
			echo ($protein_id); 
		} else
		{
			echo 'Select a Protein ID';
		}
	 ?> 
  </option>
  
  <option value="P02545">P02545</option>
  <option value="P49768">P49768</option>
  <option value="O60733">O60733</option>
</select>
Ex.: P02545 - Lipodystrophy, P49768 - Alzheimer disease, O60733 - Parkinson disease.
</p>
<p>Select the associated disease name of the protein to get a list of its synonyms:
<!--select style="margin-left:280px" name="disease_name"-->
<select  name="disease_name" class="textbox">
  <!--option value="" selected disabled>Select a disease name</option--> 
  <option 
  	<?php
		if(!empty($connection))
		{
			echo 'value="' . $disease_name .'"'; 
		} else
		{
			echo 'value="" selected disabled';
		}
	?>
  >
  	<?php
		if(!empty($connection))
		{
			echo ($disease_name); 
		} else
		{
			echo 'Select the associated Disease Name';
		}
	 ?> 
  </option>
  
  <option value="Alzheimer disease 3 " >Alzheimer disease 3</option>
  <option value="Parkinson disease 14 ">Parkinson disease 14</option>
  <option value="Lipodystrophy, familial partial, 2 ">Lipodystrophy, familial partial, 2</option>
  </select>
</p>

<input type="submit" name="submit1" value="Go" class="button"/>
<input Type="button" value="Go Back to Report Search Page" onclick="window.location.href='Index.php'" class="button"> 
</form>
<hr>
	<?php
	
	if (isset($_POST['submit1']) && empty($_POST['protein_id'])&& !empty($_POST['disease_name'])) 
	
	{
		echo $error_message1;
	}
	
	
if (isset($_POST['submit1']) && !empty($_POST['protein_id']) && empty($_POST['disease_name'])) 
	
	{
		echo $error_message2;
	}


if (isset($_POST['submit1']) && empty($_POST['protein_id']) && empty($_POST['disease_name']))
	
	{
		echo $error_message3;
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
				echo "The selected protein is not associated with the disease: <u>$disease_name</u>.";
			} else
			{
				echo '<table class="table1">';
				echo '<caption>
					The synonyms of the protein associated with the selected disease ';
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