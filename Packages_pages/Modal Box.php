<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" name="recipient-name">
<div class="container">
    <table class='table table-bordered table-responsive'>
     <tr>
        <th>Package Name</th>
        <th>Billing Code</th>
        <!-- This is where I am testing the popup Page--> 
     </tr>
     <?php
		$query = "SELECT * FROM total_units";       
		$records_per_page=10;
		$newquery = $packages->paging($query,$records_per_page);
		$packages->modal_dataview($newquery);
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
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="../Javascript/Modal Box Javascript.js"></script>

