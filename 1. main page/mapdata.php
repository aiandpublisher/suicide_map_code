<?php
// set up database connection, and load functions
include('db_connection.php');
include('db_functions.php');

// this gets data from the database
$query = "SELECT * FROM suicide_data";

if (isset($_GET['filter_change'])) { // if the user submits a selection
	$change = (int)$_GET['filter_change'];
	// this looks for the value user selects

	switch($change) {
	case 1:
	    $query .= " WHERE rate > 964.716561"; //average rate * 10000000 calculated by sql
		break; 
	case 2:
	    $query .= " WHERE rate <= 964.716561"; 
		break;
	case 3:
        $query .= " ORDER BY rate DESC LIMIT 40"; //40 districts with highest suiide rate
		break;
	case 4:
	    $query .= " ORDER BY rate ASC LIMIT 40";  //40 districts with highest suiide rate
		break;
	case 5:
	    $query .= " ORDER BY population_totals DESC LIMIT 40"; //with highest population
		break;
	case 6:
		$query .= " ORDER BY population_totals ASC LIMIT 40"; //with lowest population
		break;
	case 7:
		$query .= " WHERE data19 > data18"; //districts with an increase in suicide number
		break;
	case 8:
		$query .= " WHERE data19 = data18"; //districts with no change in suiide number
		break;
	case 9:
		$query .= " WHERE data19 < data18"; //districts with a decrease in suiide number
		break;
	case 10:
	    $query .= " WHERE satisfy > 0 ORDER BY satisfy DESC LIMIT 40"; 
		break;
	case 11:
	    $query .= " WHERE anxiety > 0 ORDER BY anxiety DESC LIMIT 40";
		break;
	case 12:
	    $query .= " WHERE happy > 0 ORDER BY happy DESC LIMIT 40";
		break;
	case 13:
	    $query .= " WHERE worthwhile > 0 ORDER BY worthwhile DESC LIMIT 40";
		break;
		/* the value of wellbeing measures of some districts are missing in the orginal dataset, and these is recorded as 0 */

	default:
	}
}	


// this captures all the results as an array in PHP...
$results = db_assocArrayAll($dbh,$query);

// this creates a JavaScript array
echo "<script>";
echo "var suicideData = ".json_encode($results,JSON_NUMERIC_CHECK).";";
echo "</script>";


?>