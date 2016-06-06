<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="text-align:center">Insert the name of the package here</h4>
      </div>
      <div class="modal-body">
            <div class="modal-body">
            <table class='table table-responsive table-striped table-bordered table-header'>
             <tr>
                <th>Package Name</th>
                <th>Billing Code</th>
                <!-- This is where I am testing the popup Page--> 
             </tr>
             <?php
                        
                        $query = "SELECT * FROM total_units";
                        //$query->bindparam(":filter",$_GET['modal']);
                        $records_per_page=10;
                        $newquery = $packages->paging($query,$records_per_page);
                        $packages->modal_dataview($newquery);
                 ?>
            </table>
            </div>
       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
         
    </div>
  </div>
</div>



