<?php
	
	session_start();
	if (isset($_SESSION['username'])){
		header('location:admin-dashboard.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Shahil Kumar">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
	<title>Login | Admin</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<style type="text/css">
		html,body{
			height:100%;
		}
	</style>
</head>
<body class="bg-dark">
	<div class="container h-100">
		<div class="row h-100 align-items-center justify-content-center">
			<div class="col-md-5">
				<div class="card border-danger shadow-lg">
					<div class="card-header bg-danger">
						<h3 class="m-0 text-white"><i class="fa fa-user-cog"></i>&nbsp;Admin Panel Login</h3>
					</div>
					<div class="card-body">
						<form action="#" method="post" class="px-3" id="admin-login-form">
							<div id="adminLoginAlert"></div>
							<div class="form-group">
								<input type="text" name="username" class="form-control rounded-0" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control rounded-0" placeholder="Password" required>
							</div>
							<div class="form-group">
								<input type="submit" name="admin-login" class="btn btn-danger btn-block rounded-0" value="Login" id="adminLoginBtn">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/all.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#adminLoginBtn").click(function(e){
			if ($("#admin-login-form")[0].checkValidity()){
				e.preventDefault();

				$(this).val('Please Wait...');
				$.ajax({
					url : 'assets/php/admin-action.php',
					method :'post',
					data : $("#admin-login-form").serialize()+'&action=adminLogin',
					success:function(response){
						if (response === 'admin_login'){
							window.location = 'admin-dashboard.php';
						}
						else{
							$("#adminLoginAlert").html(response);
						}
						$("#adminLoginBtn").val('Login');
					}
				});
			}
		});
	});
</script>
</body>
</html>
