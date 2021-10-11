<?php
// set up database connection, and load functions
include('db_connection.php');
include('db_functions.php');

// this gets data from the database
$query = "SELECT * FROM suicide_data";



if (isset($_GET['search_areaname'])) {
	$name = $_GET['search_areaname'];

	// Check if a name is input
	if (!empty($name)) {
		$nameSelected = true;
	} else {
		$nameSelected = false;
	}
}


if ($nameSelected) { 
	
	// add a search; not safe from sql injection attacks
	$query .= " WHERE areaname ILIKE '%".pg_escape_string($_GET['search_areaname'])."%'"; 
	// a case insensitive, wildcarded search

	// this captures all the results as an array in PHP...
	
	echo "<script type='text/JavaScript'>";
	echo "var condition = true;"; // this variable is to check a name is input
	echo "</script>";

}

$results = db_assocArrayAll($dbh,$query);

// this creates a JavaScript array 
echo "<script>";
echo "var suicideData = ".json_encode($results,JSON_NUMERIC_CHECK).";";
echo "</script>";


?>