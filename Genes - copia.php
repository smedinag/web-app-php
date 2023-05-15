<?php
/* Genes.php 
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_php/Genes.php
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
//echo "$gene_id".'<br/>';
// Llamado al archivo de conexion con la base de datos sakila
if (isset($_POST['submit1']) && !empty($_POST['gene_id'])) 
{
	require_once "DbConnection.php";
	$gene_id = mysqli_real_escape_string($connection, htmlentities($_POST["gene_id"]));
	
	}

if (isset($_POST['submit1']) && empty($_POST['gene_id'])) 
	
	{
		$error_message = 'please enter gene id';
	}

//echo "$gene_id".'<br/>';
?>

<?php
/*
// use the select statement to get the data from db
		$query = "select distinct gene.`HGNC ID`, gene.`Gene Name`, gene.`Gene Symbol`, gene.`Gene Synonyms`, gene.`Chromosomal Location`, protein.`Protein ID`
        
					from (
							select gene_table.hgnc_id, HtmlLink(gene_table.hgnc_id, site_url.url) as `HGNC ID`,
							gene_table.approved_symbol as `Gene Symbol`, gene_table.approved_name as `Gene Name`,
							gene_table.gene_synonyms as `Gene Synonyms`, gene_table.chromosomal_location as `Chromosomal Location`
							from gene gene_table, (select site.url from external_site site where site.site_id=2) site_url
						) gene

			join 
				(
    
					select protein_table.hgnc_id, HtmlLink(protein_table.uniprotkb_entry, site_url.url) as `Protein ID`
					from protein protein_table, (select site.url from external_site site where site.site_id=1) site_url
				) protein
    
			on gene.hgnc_id = protein.hgnc_id
	
			where gene.hgnc_id = " . '"' . $gene_id . '"';
		echo $query;
		$result = mysqli_query($connection, $query);
		if (!$result)
		{
			die("Database query failed.");
		}
*/		
?>

<?php
// use a stored procedure to get the data from db
if(!empty($connection))
{		
		$query = "call sp_126(" . '"' . $gene_id . '")';
		//echo $query."<br/>";
		$result = mysqli_query($connection, $query);
		if (!$result)
		{
			die("Database query failed.");
		}
		
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        Genes.php
    </title>
    <link rel="stylesheet" type="text/css" HREF="Style.css" >

</head>
<body background= "geneticsdark.jpg" alt="Ejemplo de website" style="width:1400px;height:800px;" >
<h1>
    Use sakila Database
</h1>
<br>
<hr>

<form name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

<p>Get a details by entering a Gene ID:
<input type="text"  name="actor_id" placeholder="1" class="textbox"
	<?php
		if(!empty($connection))
		{			
			echo 'value="' . $gene_id .'"'; 
		}
		
?>
/>
Ex.:1101, 7456 etc.
</p>
<input type="submit" name="submit1" value="Submit" class="button"/>
<input Type="button" value="Volver al Report Search Page" onclick="window.location.href='Index.php'"class="button" />
</form>

<!--  preformatted tag 
<pre> 
<?php

if ($_GET){
	echo 'Contents of the $_GET array: <br>';
	print_r($_GET);
} elseif ($_POST) {
	echo 'Contents of the $_POST array: <br>';
	print_r($_POST);
}

?>
</pre>
-->
<hr>
<?php


if (isset($_POST['submit1']) && empty($_POST['gene_id'])) 
	
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
				echo "No hay actores para el ID ingresado! <u>$gene_id</u>.";
			} else
			{
				echo '<table class="table1">';
				echo '<caption>
					 Actores registrados en la base de datos';
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