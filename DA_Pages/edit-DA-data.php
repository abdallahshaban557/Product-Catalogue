<?php
include_once 'InitiateClass.php';
$Page_Title="Edit DA";
$DA_ID = 0;
if(isset($_POST['btn-update']))
{
	$DA_ID = $_POST['DA_ID'];
	$DA_Arabic_Description = $_POST['DA_Arabic_Description'];
	$DA_English_Description = $_POST['DA_English_Description'];
        $Old_ID = $_GET['edit_id'];
	
	if($da->update($DA_ID,$DA_Arabic_Description,$DA_English_Description,$Old_ID))
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
    //Needed to add this if Statement in order to view the correct ID after the update is successful
    if(isset($_POST['DA_ID']))
    {
        $id = $DA_ID;
        extract($da->getID($id));
    }
    else
    {
	$id = $_GET['edit_id'];
	extract($da->getID($id));
    }
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
	 
    <form method='post' action ="edit-DA-data.php?edit_id=<?php if(isset($_POST['DA_ID']))  print($_POST['DA_ID']); else print($_GET['edit_id']); ?>">
 
    <table class='table table-bordered'>
 
        <tr>
            <td>DA ID</td>
            <td><input type='text' name='DA_ID' class='form-control' value="<?php echo $DA_ID; ?>" required></td>
        </tr>
 
        <tr>
            <td>DA Arabic Description</td>
            <td><input type='text' name='DA_Arabic_Description' class='form-control' value="<?php echo $DA_Arabic_Description; ?>" required></td>
        </tr>
 
        <tr>
            <td>DA English Description</td>
            <td><input type='text' name='DA_English_Description' class='form-control' value="<?php echo $DA_English_Description; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update this Record
				</button>
                <a href="DA.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once '../inc/footer.php'; ?>