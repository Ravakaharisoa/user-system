<?php
	session_start();
	if (!isset($_SESSION['username'])){
		header('location:index.php');
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
	<?php 

		$title = basename($_SERVER['PHP_SELF'],'.php');
		$title = explode('-', $title);
		$title =ucfirst($title[1]);
	?>
	<title><?= $title; ?> | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<!--<link rel="stylesheet" type="text/css" href="assets/dataTables.bootstrap4.min.css">-->

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="assets/js/datatables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#open-nav").click(function(){
				$(".admin-nav").toggleClass('animate');
			});

		});
	</script>
	
	<style type="text/css">
		.admin-nav{
			width: 220px;
			min-height: 100vh;
			overflow: hidden;
			background-color:#343a40;
			transition: 0.3s all ease-in-out;
		}
		.admin-link{
			background-color: #343a40;
		}
		.admin-link:hover, .nav-active{
			background-color: #212529;
			text-decoration: none;
		}
		.animate{
			width: 0;
			transition: 0.3s all ease-in-out;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="admin-nav p-0">
				<h4 class="text-light text-center p-2">Admin Panel</h4>
				<div class="list-group list-group-flush">
					<a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php')?"nav-active":""; ?>"><i class="fa fa-dashboard"></i><span class="ml-2">Dashboard</span></a>

					<a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php')?"nav-active":""; ?>"><i class="fa fa-users"></i><span class="ml-2">Users</span></a>

					<a href="admin-notes.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notes.php')?"nav-active":""; ?>"><i class="fa fa-clipboard"></i><span class="ml-2">Notes</span></a>

					<a href="admin-feedback.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php')?"nav-active":""; ?>"><i class="fa fa-commenting"></i><span class="ml-2">Feedback</span></a>

					<a href="admin-notification.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php')?"nav-active":""; ?>"><i class="fa fa-bell"></i><span class="ml-2">Notification</span><span class="ml-2" id="checkNotification"></span></a>

					<a href="admin-deleteduser.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php')?"nav-active":""; ?>"><i class="fa fa-user-times"></i><span class="ml-2">Deleted Users</span></a>

					<a href="assets/php/admin-action.php?export=excel" class="list-group-item text-light admin-link"><i class="fa fa-table"></i><span class="ml-2">Export Users</span></a>

					<a href="#" class="list-group-item text-light admin-link"><i class="fa fa-address-card"></i><span class="ml-2">Profile</span></a>

					<a href="#" class="list-group-item text-light admin-link"><i class="fa fa-cog"></i><span class="ml-2">Setting</span></a>
				</div>
			</div>

			<div class="col">
				<div class="row">
					<div class="col-md-12 bg-primary pt-2 justify-content-between d-flex">
						<a href="#" class="text-white" id="open-nav">
							<h3><i class="fa fa-bars"></i></h3>
						</a>
						<h4 class="text-light"><?= $title; ?></h4>
						<a href="assets/php/logout.php" class="text-light mt-1"><i class="fa fa-sign-out"></i><span class="ml-2">Logout</span></a>
					</div>
				</div>