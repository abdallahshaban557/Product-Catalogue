<?php
include_once 'InitiateClass.php';
if(isset($_POST['btn-update']))
{
	$Package_Name = $_POST['Package_Name'];
	$Billing_Code = $_POST['Billing_Code'];
	$Service_Class = $_POST['Service_Class'];
	$SOB = $_POST['SOB'];
	$Package_Or_Service_Lookup = $_POST['Package_Or_Service_Lookup'];
        $Eligible_Packages_Lookup = $_POST['Eligible_Packages_Lookup'];
        $Market_Lookup = $_POST['Market_Lookup'];
        $Package_ID = $_GET['edit_id'];
	
	if($packages->update($Package_ID,$Package_Name,$Billing_Code,$Service_Class,$SOB,$Package_Or_Service_Lookup,$Eligible_Packages_Lookup,$Market_Lookup))
	{
		$msg = "<div class='alert alert-info'>
				<strong>WOW!</strong> Record was updated successfully <a href='DA.Mainpage.php'>HOME</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($packages->getID($id));
}

?>
<?php include_once '../inc/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
    <form method='post'>
 
    <table class='table table-bordered'>
        
        <tr>
            <td>Package Name</td>
            <td><input type='text' name='Package_Name' class='form-control' value="<?php echo $Package_Name; ?>" required></td>
        </tr>
 
        <tr>
            <td>Billing Code</td>
            <td><input type='text' name='Billing_Code' class='form-control' value="<?php echo $Billing_Code; ?>" required></td>
        </tr>
 
        <tr>
            <td>Service Class</td>
            <td><input type='text' name='Service_Class' class='form-control' value="<?php echo $SC; ?>" required></td>
        </tr>
        
          <tr>
            <td>SOB</td>
            <td><input type='text' name='SOB' class='form-control' value="<?php echo $SOB; ?>" required></td>
        </tr>
        <tr>
        <td>Package/Service</td>
        <td><select name="Package_Or_Service_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from package_or_service');?>
                    <?php foreach($row as $data) : ?>
                <?php
              //  Need to check the errors here !!!!
                ?>
                    <option value="<?= $data['id'];?>" 
                  <?php  
                    if ($data['id'] == $Package_or_service_Lookup)
                    {
                        echo 'selected="selected"';
                    }
                    ?>><?= $data['service_or_offer']; ?></option>  
                    <?php endforeach ?>  
        </select>
        </td>
        </tr>
        
           <tr>
        <td>Eligible Packages</td>
        <td><select name="Eligible_Packages_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from Eligible_Packages_Lookup');?>
                    <?php foreach($row as $data) : ?>
                <?php
              //  Need to check the errors here !!!!
                ?>
                    <option value="<?= $data['Eligible_Packages_ID'];?>" 
                  <?php  
                    if ($data['Eligible_Packages_ID'] == $Eligible_Packages_Lookup)
                    {
                        echo 'selected="selected"';
                    }
                    ?>><?= $data['Eligible_Packages_Name']; ?></option>  
                    <?php endforeach ?>  
        </select>
        </td>
        </tr>
        
        <tr>
        <td>Market</td>
        <td><select name="Market_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from market_type');?>
                    <?php foreach($row as $data) : ?>
                <?php
              //  Need to check the errors here !!!!
                ?>
                    <option value="<?= $data['Market_ID'];?>" 
                  <?php  
                    if ($data['Market_ID'] == $Market_Lookup)
                    {
                        echo 'selected="selected"';
                    }
                    ?>><?= $data['Market_Name']; ?></option>  
                    <?php endforeach ?>  
        </select>
        </td>
        </tr>
        
        
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update this Record
				</button>
                <a href="Packages.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../inc/footer.php'; ?>