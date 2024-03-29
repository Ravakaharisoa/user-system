<?php
	session_start();
	if (isset($_SESSION['user'])) {
		header('location:home.php');
	}

	include_once 'assets/php/config.php';
	$db = new Database();

	$sql = "UPDATE visitors SET hits = hits+1 WHERE id = 0";
	$stmt = $db->conn->prepare($sql);
	$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Shahil Kumar">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/milonga.css">
</head>
<body>
	<div class="container">
		<!---Login Form Start-->
		<div class="row justify-content-center wrapper" id="login-box">
			<div class="col-md-10 m-auto">
				<div class="card-group myShadow">
					<div class="card rounded-left p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Sign in to Account</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3" id="login-form">
							<div id="loginAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-envelope"></i>
									</span>
								</div>
								<input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-mail" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email'];} ?>" required>
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-key"></i>
									</span>
								</div>
								<input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>" required>
							</div>

							<div class="form-group">
								<div class="custom-control custom-checkbox float-left">
									<input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])){ ?> checked <?php } ?>>
									<label for="customCheck" class="custom-control-label">Remember me</label>
								</div>
								<div class="forgot float-right">
									<a href="#" id="forgot-link">Forgot Password?</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<input type="submit"  value="Sign In" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>

					<div class="card justufy-content-center rounded-right myColor">
						<h1 class="text-center font-weight-bold text-white">Hello Friends!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bold text-light">Enter your personnal details and start your journey with us!</p>
						<button class="btn btn-outline-light btn-lg text-center font-weight-bold mt-4 myLinkBtn" id="register-link">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
		<!--Login Form End-->

		<!--Register Form Start-->
		<div class="row justufy-content-center wrapper" id="register-box" style="display: none;">
			<div class="col-md-10 m-auto">
				<div class="card-group myShadow">
					<div class="card justufy-content-center rounded-left myColor">
						<h1 class="text-center font-weight-bold text-white">Welcome Back!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bold text-light">To keep connected with us please login with your personnal info!</p>
						<button class="btn btn-outline-light btn-lg text-center font-weight-bold mt-4 myLinkBtn" id="login-link">Sign In</button>
					</div>
					<div class="card rounded-right p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Create Account</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3" id="register-form">
							<div id="regAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-user"></i>
									</span>
								</div>
								<input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-envelope"></i>
									</span>
								</div>
								<input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-mail" required>
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-key"></i>
									</span>
								</div>
								<input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" minlength="5" required>
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-key"></i>
									</span>
								</div>
								<input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" minlength="5" required>
							</div>

							<div class="form-group">
								<div id="passError" class="text-danger font-weight-bold"></div>	
							</div>

							<div class="form-group">
								<input type="submit" value="Sign Up" id="register-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--Register Form End-->

		<!--Forgot password form start-->
		<div class="row justufy-content-center wrapper" id="forgot-box" style="display: none;">
			<div class="col-md-10 m-auto">
				<div class="card-group myShadow">
					<div class="card justufy-content-center rounded-right myColor">
						<h2 class="text-center font-weight-bold text-white">Reset Password!</h2>
						<hr class="my-3 bg-light myHr">
						<button class="btn btn-outline-light btn-lg text-center font-weight-bold mt-4 myLinkBtn" id="back-link">Back</button>
					</div>
					<div class="card rounded-left p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Forgot your Pasword</h1>
						<hr class="my-3">
						<p class="lead text-secondary text-center">To reset your password, enter the registered e-mail adress and we will send you yhe rest instructions on your e-mail</p>
						<form action="#" method="post" class="px-3" id="forgot-form">
							<div id="forgotAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fa fa-envelope"></i>
									</span>
								</div>
								<input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-mail" required>
							</div>

							<div class="form-group">
								<input type="submit" value="Register Password" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--Forgot password form End--->
	</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#register-link").click(function(){
		$("#login-box").hide();
		$("#register-box").show();
	});

	$("#login-link").click(function(){
		$("#login-box").show();
		$("#register-box").hide();
	});

	$("#forgot-link").click(function(){
		$("#login-box").hide();
		$("#forgot-box").show();
	});

	$("#back-link").click(function(){
		$("#forgot-box").hide();
		$("#login-box").show();
	});

	//Register Ajax Request
	$("#register-btn").click(function(event){
		if ($("#register-form")[0].checkValidity()){
			event.preventDefault();
			$("#register-btn").val('Please Wait...');
			if ($("#rpassword").val() != $("#cpassword").val()){
				$("#passError").text("* Password did not matched!");
				$("#register-btn").val('Sign Up');
			}
			else{
				$("#passError").text();
				$.ajax({
					url: 'assets/php/action.php',
					method:'post',
					data : $("#register-form").serialize()+'&action=register',
					success:function(response){
						$("#register-btn").val('Sign Up');
						if (response === 'register'){
							window.location = 'home.php';
						}else{
							$("#regAlert").html(response);
						}
					}
				});
			}
		}
	});

	//Login Ajax Request
	$("#login-btn").click(function(e){
		if($("#login-form")[0].checkValidity()){
			e.preventDefault();

			$("#login-btn").val('Please Wait...');
			$.ajax({
				url : 'assets/php/action.php',
				method : 'post',
				data : $("#login-form").serialize()+'&action=login',
				success:function(response){
					//console.log(response);
					$("#login-btn").val('Sign In');
					if (response === 'login'){
						window.location = 'home.php';
					}else{
						$("#loginAlert").html(response);
					}
				}
			});
		}
	});

	//Forgot Password Ajax Request
	$("#forgot-btn").click(function(e){
		if ($("#forgot-form")[0].checkValidity()){
			e.preventDefault();

			$("#forgot-btn").val('Please Wait...');

			$.ajax({
				url : 'assets/php/action.php',
				method : 'post',
				data : $("#forgot-form").serialize()+'&action=forgot',
				success:function(response){
					$("#forgot-btn").val('Reset Password');
					$("#forgot-form")[0].reset();
					$("#forgotAlert").html(response);
				}
			});
		}
	});
});
</script>
</body>
</html>
