<?php

$DB_host = "localhost";
$DB_user = "abdullahshaaban";
$DB_pass = "Whatyousaid@1";
$DB_name = "product-catalogue";


try
{
    //creates class that is used to connect to mysql
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        //This code will ensure that any error will be shown - and that execution pauses. The attributes have all been taken from the PDO Documentation
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    
	echo $e->getMessage();
}

//May need to uncomment this
//include_once 'class.crud.php';

//$crud = new crud($DB_con);

?>