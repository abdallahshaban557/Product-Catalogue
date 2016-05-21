<?php
include_once 'InitiateClass.php';

?>
<?php include_once '../inc/header.php'; ?>
<div class="clearfix"></div>

<div class="container">
<a href="add-DA-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>DA ID</th>
     <th>DA Arabic Description</th>
     <th>DA English Description</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT * FROM DA";       
		$records_per_page=10;
		$newquery = $da->paging($query,$records_per_page);
		$da->dataview($newquery);
	 ?>
    <tr>
        <td colspan="10" align="center">
 			<div class="pagination-wrap">
            <?php $da->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once '../inc/footer.php'; ?>