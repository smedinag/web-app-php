<!DOCTYPE html>
<!-- DescribeData.php 
This is a comment. Comments are not displayed in the browser.
To run it as a php file:
http://localhost/webapp_p2p/DescribeData.php
-->

<html lang='es'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        DescribeData.php
    </title>
    <link rel="stylesheet" type="text/css" HREF="Style.css" >
</head>
<body background= "./images/cinemaClassic.avif"  alt="example website" style="width:1400px;height:800px;">
<h1>
    My bioinformatics data set
	
</h1>
<br>
	<input Type="button" class="button" value="Go Back to Website Documentations Page" onclick="window.location.href='WebsiteDocumentation.php'"> 
<br>
<hr>

<ul>
	<li> <b>What is my data set?</b>
	<p> My dataset is the information about genes, proteins and the diseases they're involved in.
		<br/>However, the genes and proteins in the database are related to only a few select diseases as there was a time frame for the project.
		<br/>So, data collection could only be given limited time. 
	</p></li>
	
	<li> <b>Why did I select this data set?</b>
	<p> As part of the project, I wanted to work on real world data which I'm totally unfamiliar with.
		<br/>Considering I had no knowledge of the domain, working on such a dataset would be challenging.
		<br/>It'll also best prepare me for any work I'll do in building a database from the scratch in the future.
	</p></li>

	
	<li> <b>Where and how did I collect this data set?</b>
	<p> 
	The data was obtained from these data sources:
		<br/> -  The Universal Protein Resource (UniProt)
		<br/> -  HUGO Gene Nomenclature Committee at the European Bioinformatics Institute (HGNC)
		<br/> -  Online Mendelian Inheritance in Man (OMIM)
		<br/> -  Disease Ontology (DO)

	</p></li>

	<li> <b>What are the business rules or specifications of my data set?</b>
	<p> <b>Business statement:</b>
		<br/>My system is a website which provides protein-to-phenotype information by collecting functional information on proteins, genes and related diseases.
		<br/>Mendelian disorder data along with ontology (set of concepts in a domain) associated with various human diseases caused by these proteins are also provided.
		
		<br/>
		<br/>
		<b>Business rules:</b>
		<br/> -  A protein is part of a Gene.
		<br/> -  Each protein must have a Gene.
		<br/> -  A protein can be involved in many diseases.
		<br/> -  Each protein can be involved in up to four diseases since only four repeating groups are allowed in each row in the Universal Table.
		<br/> -  Each protein can have a maximum of eight Disease Ontology entries as each disease can have up to two Disease Ontology entries.
		<br/> -  Each disease can have more than one Disease Ontology entry.
		<br/> -  A protein should be involved in at least one disease related to the Disease search term.
		<br/> -  Disease in the Universal Table must have at least one Disease Ontology entry.
		<br/> -  A disease should have a unique Phenotype MIM number.


	</p></li>
</ul>

</body>
</html>