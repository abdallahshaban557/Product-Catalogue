<?php


try{
	//creates class that is used to connect to mysql
	$db = new PDO('mysql:host=localhost;dbname=product-catalogue;charset=utf8mb4', 'abdullahshaaban', 'Whatyousaid@1');
	//This code will ensure that any error will be shown - and that execution pauses. The attributes have all been taken from the PDO Documentation
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} 	//catches an exception in case the connection fails
	catch (Exception $e){
	echo "Unable to connect";
	
	//shows actual message error
	echo $e->getMessage();
	exit;
}

?>
