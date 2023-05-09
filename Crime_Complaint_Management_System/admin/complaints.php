<?php
include 'db_connect.php';
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<b>List of Reports of Complaints</b>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover" id="complaint-tbl">
			        <thead>
			          <tr>
			            <th width="15%">Date of Report</th>
			            <th width="20%">Case Report</th>
			            <th width="15%">Incident Address</th>
			            <th width="10%">Status</th>
						<th width=15%>Date Incident Occured</th>
						<th width=10%>Time the Incident Occured</th>
						<th width=20%> Alert of Incident</th>
						<th width=20%> Evidence</th>
						<th width=10%> Tracking case Id</th>
			            <th width="10%">Action</th>
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          $status = array("","Pending","Received","Action Made");
			          $qry = $conn->query("SELECT * FROM complaints order by unix_timestamp(date_created) desc ");
			          while($row = $qry->fetch_array()):
			          ?>
			          <tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
			            <td><?php echo date('M d, Y h:i A',strtotime($row['date_created'])) ?></td>
			            <td><?php echo $row['message'] ?></td>
			            <td><?php echo $row['address'] ?></td>
			            <td><?php echo $status[$row['status']] ?></td>
						<td><?php echo $row['dateincident'] ?></td>
						<td><?php echo $row['timeincident'] ?></td>
						<td><?php echo $row['statusincident'] ?></td>
						<td><a href="download.php?file=<?php echo $row['file_upload'] ?>">Download</a></td>
						<td><?php echo $row['tracking'] ?></td>
			            <td class="text-center">
			            	<button class="btn btn-primary btn-sm m-0 view_btn" type="button" data-id="<?php echo $row['id'] ?>">View</button>
			            </td>
			          </tr>
			        <?php endwhile; ?>
			        </tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
<style>
	
	.border-gradien-alert{
		border-image: linear-gradient(to right, red , yellow) !important;
	}
	.border-alert th, 
	.border-alert td {
	  animation: blink 200ms infinite alternate;
	}

	@keyframes blink {
	  from {
	    border-color: white;
	  }
	  to {
	    border-color: red;
		background: #ff00002b;
	  }
	}
</style>
<script>
	$('#complaint-tbl').dataTable();
	$('.view_btn').click(function(){
		uni_modal("View Details","manage_complaint.php?id="+$(this).attr('data-id'),"mid-large")
	})
</script>