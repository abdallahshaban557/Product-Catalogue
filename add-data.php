<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
	$Package_Description = $_POST['Package_Description'];
	$Billing_Code = $_POST['Billing_Code'];
	$Service_Class = $_POST['Service_Class'];
	$SOB = $_POST['SOB'];
        $Unit_Type_English = $_POST['Unit_Type_English'];
        $Unit_Type_Arabic = $_POST['Unit_Type_Arabic'];
        $Total_Units = $_POST['Total_Units'];
	
	if($crud->create($Package_Description,$Billing_Code,$Service_Class,$SOB,$Unit_Type_English,$Unit_Type_Arabic,$Total_Units))
	{
		header("Location: add-data.php?inserted");
	}
	else
	{
		header("Location: add-data.php?failure");
	}
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>WOW!</strong> Record was inserted successfully <a href="index.php">HOME</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while inserting record !
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Package Description</td>
            <td><input type='text' name='Package_Description' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Billing Code</td>
            <td><input type='text' name='Billing_Code' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Service_Class</td>
            <td><input type='text' name='Service_Class' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>SOB</td>
            <td><input type='text' name='SOB' class='form-control' required></td>
        </tr>
 
          <tr>
            <td>Unit Type English</td>
            <td><input type='text' name='Unit_Type_English' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Unit Type Arabic</td>
            <td><input type='text' name='Unit_Type_Arabic' class='form-control' required></td>
        </tr>
        
         <tr>
            <td>Total Units</td>
            <td><input type='text' name='Total_Units' class='form-control' required></td>
        </tr>
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Create New Record
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>