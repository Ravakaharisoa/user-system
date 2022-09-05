<?php require_once 'assets/php/header.php'; ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 mt-3">
				<?php if ($verified == 'Verified!') :?>
					<div class="card border-primary">
						<div class="card-header lead text-center bg-primary text-white">Send Feedback to Admin!</div>
						<div class="card-body">
							<form action="#" method="post" class="px-4" id="feedback-form">
								
								<div class="form-group">
									<input type="text" name="subject" placeholder="Write Your Subject" class="form-control rounded-0" required>
								</div>

								<div class="form-group">
									<textarea name="feedback" class="form-control rounded-0" placeholder="Write Your Feedback Here..." rows="8" required></textarea>
								</div>

								<div class="form-group">
									<input type="submit" name="feedbackBtn" id="feedbackBtn" class="btn btn-primary btn-block rounded-0" value="Send Feedback">
								</div>
							</form>
						</div>
					</div>
				<?php else: ?>
					<h1 class="text-center text-secondary mt-5">Verify Your E-Mail First to send Feedback to Admin!</h1>
				<?php endif; ?>
			</div>
		</div>
	</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/all.js"></script>
<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//Send Feedback to Admin Ajax Request
		$("#feedbackBtn").click(function(e){
			if ($("#feedback-form")[0].checkValidity()){
				e.preventDefault();

				$(this).val('Please Wait...');

				$.ajax({
					url:'assets/php/process.php',
					method: 'post',
					data: $("#feedback-form").serialize()+'&action=feedback',
					success:function(response){
						$("#feedback-form")[0].reset();
						$("#feedbackBtn").val('Send Feedback');
						swal("Success","Feedback Successfully sent to the Admin!",{
							icon : "success",
							buttons: {
								confirm: {
									className : 'btn btn-success'
								}
							},
						});
					}
				});
			}
		});

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

	});
</script>
</body>
</html>