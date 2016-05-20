<?php



function select()
{
	
	try{
	include("database_connection.php");
	//this is where the query is actually executed
	$results = $db->query("Select * from packages");
	echo "retrieved results";
} catch (Exception $e ){
	
	echo "unable to view results";
	exit;
}
//this returns the value of the query in an array , then shows it on the screen
$query_result = $results->fetchAll(PDO::FETCH_ASSOC);
return $query_result;
}

?>