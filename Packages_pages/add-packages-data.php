<?php
include_once 'initiateClass.php';
if(isset($_POST['btn-save']))
{
	$Package_Name = $_POST['Package_Name'];
	$Billing_Code = $_POST['Billing_Code'];
	$Service_Class = $_POST['Service_Class'];
	$Package_Or_Service_Lookup = $_POST['Package_Or_Service_Lookup'];
        $Eligible_Packages_Lookup = $_POST['Eligible_Packages_Lookup'];
        $Market_Lookup = $_POST['Market_Lookup'];
	if($packages->create($Package_Name,$Billing_Code,$Service_Class,$Package_Or_Service_Lookup,$Eligible_Packages_Lookup,$Market_Lookup))
	{
		header("Location: add-packages-data.php?inserted");
	}
	else
	{
		header("Location: add-packages-data.php?failure");
	}
}
?>
<?php include_once '../inc/header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
            <strong>WOW!</strong> Record was inserted successfully <a href="Packages.Mainpage.php">HOME</a>!
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
            <td>Package Name</td>
            <td><input type='text' name='Package_Name' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Billing Code</td>
            <td><input type='text' name='Billing_Code' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Service Class</td>
            <td><input type='text' name='Service_Class' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>Package/Service</td>
            <td>
                <select name="Package_Or_Service_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from package_or_service');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['id']; ?>"><?= $data['service_or_offer']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
        </tr>
        <tr>
            <td>Eligible Packages</td>
            <td>
                <select name="Eligible_Packages_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from Eligible_Packages_Lookup');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['Eligible_Packages_ID']; ?>"><?= $data['Eligible_Packages_Name']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
        </tr>
        <tr>
            <td>Market</td>
            <td>
                <select name="Market_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from Market_Type');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['Market_ID']; ?>"><?= $data['Market_Name']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Create New Record
			</button>  
                <a href="packages.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to DA Main page</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../inc/footer.php'; ?>