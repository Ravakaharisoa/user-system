<?php require_once 'assets/php/header.php'; ?>

<div class="container">
	<div class="row justify-content-center my-2">
		<div class="col-md-6 mt-4" id="showAllNotification">
			
		</div>
	</div>
</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/all.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//Fetch Notification of an User
			fetchNotification();
		function fetchNotification(){
			$.ajax({
				url:'assets/php/process.php',
				method:'post',
				data: { action : 'fetchNotification'},
				success:function(response){
					$("#showAllNotification").html(response);
				}
			});
		}
		//Check Notification
		checkNotification();
		function checkNotification(){
			$.ajax({
				url:'assets/php/process.php',
				method :'post',
				data :{ action : 'checkNotification'},
				success:function(response){
					$("#checkNotification").html(response);
				}
			});
		}

		//Remove Notification
		$("body").on("click",".close",function(e){
			e.preventDefault();

			notification_id = $(this).attr('id');
			$.ajax({
				url : 'assets/php/process.php',
				method:'post',
				data: {notification_id :notification_id},
				success:function(response){
					checkNotification();
					fetchNotification();
				}
			});
		});
	});
</script>
</body>
</html>