<?php session_start() ?>
<div class="container-fluid">
	<form action="retrieve.php" id="complaint-frm" method="POST">
		<input type="hidden" name="id" value="">
		<div class="form-group">
			<label for="" class="control-label">Please Enter Your Case Tracking ID</label>
			<input type="text" name="trackingid" value="" class="form-control">
		</div>
		
		<button class="button btn btn-primary btn-sm">Submit</button>
		<button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>

	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
	
</style>