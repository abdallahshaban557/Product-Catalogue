<?php
include_once 'initiateClass.php';
$Page_Title="Add DA";
if(isset($_POST['btn-save']))
{
	$DA_ID = $_POST['DA_ID'];
	$DA_Arabic_Description = $_POST['DA_Arabic_Description'];
	$DA_English_Description = $_POST['DA_English_Description'];
	
	if($da->create($DA_ID,$DA_Arabic_Description,$DA_English_Description))
	{
		header("Location: add-DA-data.php?inserted");
	}
	else
	{
		header("Location: add-DA-data.php?failure");
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
            <strong>WOW!</strong> Record was inserted successfully <a href="DA.Mainpage.php">HOME</a>!
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
            <td>DA ID</td>
            <td><input type='text' name='DA_ID' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>DA Arabic Description</td>
            <td><input type='text' name='DA_Arabic_Description' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>DA English Description</td>
            <td><input type='text' name='DA_English_Description' class='form-control' required></td>
        </tr>
        
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Create New Record
			</button>  
                <a href="DA.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to DA Main page</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../inc/footer.php'; ?>