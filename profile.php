<?php require_once 'assets/php/header.php'; ?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card rounded-0 mt-3 border-primary">
				<div class="card-header border-primary">
					<ul class="nav nav-tabs class-header-tabs">
						<li class="nav-item">
							<a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
						</li>
						<li class="nav-item">
							<a href="#editprofile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
						</li>
						<li class="nav-item">
							<a href="#changePassword" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<!--- Profile Tab Content Start--->
						<div class="tab-pane container active" id="profile">
							<div class="card-deck">
								<div class="card border-primary">
									<div class="card-header bg-primary text-light text-center lead">
										<b>User ID : <?= $cid; ?></b>
									</div>
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Name : </b><?= $cname; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>E-mail : </b><?= $cemail; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Gender : </b><?= $cgender; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Date of Birth : </b><?= $cdob; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Phone : </b><?= $cphone; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>Registered On : </b><?= $reg_on; ?></p>
										<p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;"><b>E-mail Verified  : </b><?= $verified; ?>
										<?php if ($verified == 'Not Verified!'): ?>
											<a href="#" id="verify-email" class="float-right">Verify Now</a>
										<?php endif; ?>
										</p>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="card border-primary align-self-center">
									<?php if (!$cphoto): ?>
										<img src="assets/Img/userDefault.jpg" class="img-thumbnail img-fluid" width="408px">
									<?php else: ?>
										<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid" width="408px">
									<?php endif; ?>
								</div>
							</div>
						</div>
						<!--- Profile Tab Content End--->

						<!---Edit Profile Tab Content Start--->
						<div class="tab-pane container fade" id="editprofile">
							<div id="verifyEmailAlert"></div>
							<div class="card-deck">
								<div class="card border-danger align-self-center">
									<?php if (!$cphoto): ?>
										<img src="assets/Img/userDefault.jpg" class="img-thumbnail img-fluid" width="408px">
									<?php else: ?>
										<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid" width="408px" height="300px">
									<?php endif; ?>
								</div>
								<div class="card border-danger">
									<form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="profile-update-form">
										<input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
										<div class="form-group m-0">
											<label for="profilePhoto" class="m-1">Upload Profile Image</label>
											<input type="file" name="image" id="profilePhoto" class="form-control">
										</div>
										<div class="form-group m-0">
											<label for="name" class="m-1">Name</label>
											<input type="text" name="name" id="name" class="form-control" value="<?= $cname; ?>">
										</div>
										<div class="form-group m-0">
											<label for="gender" class="m-1">Gender</label>
											<select name="gender" id="gender" class="form-control">
												<!--<option value="" hidden="" selected>Select</option>-->
												<option value="" disabled <?php if ($cgender == null) {
													echo 'selected';
												} ?>>Select</option>
												<option value="Male" <?php if ($cgender == 'Male') {
													echo 'selected';
												} ?>>Male</option>
												<option value="Female" <?php if ($cgender == 'Female') {
													echo 'selected';
												} ?>>Female</option>
											</select>
										</div>
										<div class="form-group m-0">
											<label for="dob" class="m-1">Date of Birth</label>
											<input type="date" name="dob" id="dob" class="form-control" value="<?= $cdob; ?>">
										</div>
										<div class="form-group m-0">
											<label for="phone" class="m-1">Phone</label>
											<input type="tel" name="phone" id="phone" minlength="10" maxlength="10" class="form-control" value="<?= $cphone; ?>" placeholder="Phone">
										</div>
										<div class="form-group mt-2">
											<input type="submit" name="profile_update" value="Update Profile" class="btn btn-danger btn-block" id="profileUpdateBtn">
										</div>
									</form>
								</div>
							</div>
						</div>
						<!---Edit Profile Tab Content End--->

						<!---Change Password Tab Content Start--->
						<div class="tab-pane container fade" id="changePassword">
							<div id="changepassAlert"></div>
							<div class="card-deck">
								<div class="card border-success">
									<div class="card-header bg-success text-white text-center lead">Change Password</div>
									<form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
										<div class="form-group">
											<label for="curpass">Enter Your Current Password</label>
											<input type="password" name="curpass" placeholder="Current Password" class="form-control" id="curpass" required minlength="5">
										</div>
										<div class="form-group">
											<label for="newpass">Enter New Password</label>
											<input type="password" name="newpass" placeholder="New Password" class="form-control" id="newpass" required minlength="5">
										</div>
										<div class="form-group">
											<label for="cnewpass">Confirm New Password</label>
											<input type="password" name="cnewpass" placeholder="New Password" class="form-control" id="cnewpass" required minlength="5">
										</div>
										<div class="form-group">
											<p id="changepassError" class="text-danger"></p>
										</div>

										<div class="form-group">
											<input type="submit" name="changepass" value="Change Password" class="btn btn-success btn-block" id="changePassBtn">
										</div>
									</form>
								</div>
								<div class="card border-success align-self-center">
									<img src="assets/Img/téléch.jpg" class="img-thumbnail img-fluid" width="408px" height="408px">
								</div>
							</div>
						</div>
						<!---Change Password Tab Content End--->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/all.js"></script>
<script>
	$(document).ready(function(){
		//Profile Update Ajax Request
		$("#profile-update-form").submit(function(e){
			e.preventDefault();

			$.ajax({
				url: 'assets/php/process.php',
				method: 'post',
				processData :false,
				contentType:false,
				cache:false,
				data: new FormData(this),
				success:function(response){
					location.reload();
				}
			});
		});

		//Change Password Ajax Request
		$("#changePassBtn").click(function(e){
			if($("#change-pass-form")[0].checkValidity()){
				e.preventDefault();
				$("#changePassBtn").val('Please Wait...');

				if ($("#newpass").val() != $("#cnewpass").val()){
					$("#changepassError").text('* Password did not matched!');
					$("#changePassBtn").val('Change Password');
				}
				else{
					$.ajax({
						url: 'assets/php/process.php',
						method: 'post',
						data: $("#change-pass-form").serialize()+'&action=change_pass',
						success:function(response){
							$("#changepassAlert").html(response);
							$("#changePassBtn").val('Change Password');
							$("#changepassError").text('');
							$("#change-pass-form")[0].reset();
						}
					});
				}
			}
		});

		//Verify E-mail Ajax Request
		$("#verify-email").click(function(e){
			e.preventDefault();
			$(this).text('Please Wait...');

			$.ajax({
				url: 'assets/php/process.php',
				method:'post',
				data: { action : 'verify_email'},
				success:function(response){
					console.log(response);
					$("#verifyEmailAlert").html(response);
					$("#verify-email").text('Verify Now');
				}
			});
		});
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
</script>
</body>
</html>