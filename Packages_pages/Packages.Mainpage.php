<?php
include_once 'InitiateClass.php';
$Page_Title = "Packages Main Page";
?>

<?php include_once '../inc/header.php'; ?>
<!--My modal Box-->
<div class="clearfix"></div>

<div class="container">
<a href="add-packages-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <table class='table table-bordered table-responsive table-header'>
     <tr>
        <th>Package Name</th>
        <th>Billing Code</th>
        <th>Service Class</th>
        <th>SOB</th>
        <th>Package/Service</th>
        <th>Eligible Packages</th>
        <th>Market</th> 
        <th>Units info</th>
        <th colspan="2" align="center">Actions</th>
        <!-- This is where I am testing the popup Page--> 
     </tr>
     <?php
		$query = "SELECT * FROM Packages";       
		$records_per_page=10;
		$newquery = $packages->paging($query,$records_per_page);
		$packages->dataview($newquery);
	 ?>
    <tr>
        <td colspan="10" align="center">
 			<div class="pagination-wrap">
            <?php $packages->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
    </table>
</div>

<?php include_once 'Modal Box.php';?>



<?php include_once '../inc/footer.php'; ?>