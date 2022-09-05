<?php
	require_once 'assets/php/admin-header.php';	
	require_once 'assets/php/admin-db.php';	

	$count = new Admin();
?>

<div class="row">
	<div class="col-md-12">
		<div class="card-deck mt-3 text-light text-center font-weight-bold">
			<div class="card bg-primary">
				<div class="card-header">Total Users</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->totalCount('users'); ?></h3>
				</div>
			</div>
			<div class="card bg-warning">
				<div class="card-header">Verify Users</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->verified_users(1); ?></h3>
				</div>
			</div>
			<div class="card bg-success">
				<div class="card-header">Unverified Users</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->verified_users(0); ?></h3>
				</div>
			</div>
			<div class="card bg-danger">
				<div class="card-header">Website Hits</div>
				<div class="card-body">
					<h3 class="display-4"><?php $data = $count->site_hits();
					echo $data['hits']; ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card-deck mt-3 text-light text-center font-weight-bold">
			<div class="card bg-danger">
				<div class="card-header">Total Notes</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->totalCount('notes'); ?></h3>
				</div>
			</div>
			<div class="card bg-success">
				<div class="card-header">Total Feedback</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->totalCount('feedback'); ?></h3>
				</div>
			</div>
			<div class="card bg-info">
				<div class="card-header">Total Notifications</div>
				<div class="card-body">
					<h3 class="display-4"><?= $count->totalCount('notification'); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card-deck my-3">
			<div class="card border-success">
				<div class="card-header bg-success text-center text-white lead">
					Male/Female User's Percentage
				</div>
				<div id="chartOne" style="width: 99%;height: 400px;"></div>
			</div>
			<div class="card border-info">
				<div class="card-header bg-info text-center text-white lead">
					Verified/Unverified User's Percent
				</div>
				<div id="chartTwo" style="width: 99%;height: 400px;"></div>
			</div>
		</div>
	</div>
</div>

	<!--- Footer -->
		</div>
	</div>
</div>
<script type="text/javascript" src="admin/assets/js/chart.min.js"></script>
<script type="text/javascript" src="admin/assets/js/circles.min.js"></script>
<script type="text/javascript" src="admin/assets/js/loader.js"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--->
<script type="text/javascript">
	$(document).ready(function(){
		//Check Notification
		checkNotification();
		function checkNotification(){
			$.ajax({
				url : 'assets/php/admin-action.php',
				method: 'post',
				data: {action : 'checkNotification'},
				success:function(response){
					$("#checkNotification").html(response);
				}
			});
		}

		pieChart();
		google.charts.load("current", {packages :["corechart"]});
		google.charts.setOnLoadCallback(pieChart);
		function pieChart(){
			var data = google.visualization.arrayToDataTable([
				['Gender','Number'],
				<?php 
					$gender = $count->genderPer();
					foreach ($gender as $row) {
						echo '["'.$row['gender'].'",'.$row['number'].'],';
					}
				?>
				]);
			var options = {
				is3D: false
			};
			var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
			chart.draw(data,options);
		}

			colChart();
		google.charts.load("current", {packages :["corechart"]});
		google.charts.setOnLoadCallback(colChart);
		function colChart(){
			var data = google.visualization.arrayToDataTable([
				['verified','Number'],
				<?php 
					$verified = $count->genderPer();
					foreach ($verified as $row){
					if ($row['verified'] == 0){
							$row['verified'] = "Unverified";
						}else{
							$row['verified'] = "Verified";
						}
						echo '["'.$row['verified'].'",'.$row['number'].'],';
					}
				?>
				]);
			var options = {
				pieHole:0.4,
			};
			var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
			chart.draw(data,options);
		}
	});
</script>
</body>
</html>
