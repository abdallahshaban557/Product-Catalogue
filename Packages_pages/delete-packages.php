<?php
include_once 'InitiateClass.php';
$Page_Title="Delete Packages";
if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$packages->delete($id);
	header("Location: delete-packages.php?deleted");	
}

?>

<?php include_once '../inc/header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Success!</strong> record was deleted... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Sure !</strong> to remove the following record ? 
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
            <th>Package Name</th>
             <th>Billing Code</th>
             <th>Service Class</th>
             <th>SOB</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * from packages WHERE Package_ID=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['Package_Name']); ?></td>
             <td><?php print($row['Billing_Code']); ?></td>
             <td><?php print($row['SC']); ?></td>
             <td><?php print($row['SOB']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="DA.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
<a href="Packages.Mainpage.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Packages</a>
    <?php
}
?>
</p>
</div>	
<?php include_once '../inc/footer.php'; ?>