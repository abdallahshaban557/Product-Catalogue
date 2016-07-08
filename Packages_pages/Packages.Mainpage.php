<?php
include_once 'InitiateClass.php';
$Page_Title = "Packages Main Page";
?>

<?php include_once '../inc/header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-packages-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<!--Search menu-->
<div class = "container search">
    <table class = "search-table">
        <tr>
            <td class = "search-padding">
                <label class = "label-pill label-danger">
                    Search
                </label>
            </td>
            <td class = "search-padding">
                <select name="Package_Or_Service_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from package_or_service');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['id']; ?>"><?= $data['service_or_offer']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
            <td class = "search-padding">
                <select name="Eligible_Packages_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from Eligible_Packages_Lookup');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['Eligible_Packages_ID']; ?>"><?= $data['Eligible_Packages_Name']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
            <td>
                <select name="Market_Lookup" class='form-control' required>
                    <?php $row = $DB_con->query('Select * from Market_Type');?>
                    <?php foreach($row as $data) : ?>   
                    <option value="<?= $data['Market_ID']; ?>"><?= $data['Market_Name']; ?></option>  
                    <?php endforeach ?>  
                </select>
            </td>
        </tr>
    </table>
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
        <th colspan="2" class="center-cell">Actions</th>
        <!-- This is where I am testing the popup Page--> 
     </tr>
     <?php
		$query = "SELECT * FROM Packages";       
		$records_per_page=10;
		$newquery = $packages->paging($query,$records_per_page);
		$packages->dataview($newquery);
	 ?>
    <tr>
        <td colspan="10" class = "center-cell">
 			<div class="pagination-wrap">
            <?php $packages->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
    </table>
</div>

<!-- Units modal box-->
<?php include_once 'Modal Box.php';?>



<?php include_once '../inc/footer.php'; ?>