<?php session_start() ?>
<div class="container-fluid">
	<form action="save.php" id="complaint-frm" method="POST">
		<input type="hidden" name="id" value="">
		<div class="form-group">
			<label for="" class="control-label">Report Case</label>
			<textarea cols="30" rows="3" name="message" required="" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Incident Address</label>
			<textarea cols="30" rows="3" name="address" required="" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Date of Incident (YYYY-MM-DD)</label>
			<input type="date" name="dateincident" required="" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Time of Incident (HH:MM)</label>
			<input type="time" name="timeincident" required="" class="form-control" pattern="[0-9]{2}:[0-9]{2}">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Status</label>
			<select id="status-select" name="statusincident" required="" class="form-control">
				<option value="">Select Status</option>
				<option value="active">Investigation Needed </option>
				<option value="inactive">Immediate Alert(Police would be assigned right away )</option>
				<option value="pending"></option>
  			</select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Tracking Case ID</label>
			<?php
				$length = 8; // set the desired length of the generated string
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$generated_id = '';
				for ($i = 0; $i < $length; $i++) {
					$generated_id .= $characters[mt_rand(0, strlen($characters) - 1)];
				}
				$generated_id .= mt_rand(100, 999); // append a random number between 100 and 999
			?>
			<input type="text" name="tracking" value="<?php echo $generated_id; ?>" readonly class="form-control">
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
<!-- <script>
	$('#complaint-frm').submit(function(e){
		e.preventDefault()
		start_load()
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=complaint',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#complaint-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
					location.reload();
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}else{
					end_load()
				}
			}
		})
	})
</script> -->