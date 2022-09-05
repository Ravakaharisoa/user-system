<?php
	require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Shahil Kumar">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?> | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-md bg-info navbar-info">
		<a class="navbar-brand text-white" href="index.php"><i class="fas fa-dove fa-lg"></i>&nbsp;Admin Panel</a>
		<button class="navbar-toggler bg-light text-info" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="fas fa-angle-down"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == "home.php") ?"active": ""; ?>" href="home.php"><i class="fa fa-home"></i>&nbsp; Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == "home.php") ?"active": ""; ?>" href="profile.php"><i class="fa fa-user-circle"></i>&nbsp;Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == "home.php") ?"active": ""; ?>" href="feedback.php"><i class="fa fa-comment-dots"></i>&nbsp;Feedback</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white <?= (basename($_SERVER['PHP_SELF']) == "home.php") ?"active": ""; ?>" href="notification.php"><i class="fa fa-bell"></i>&nbsp;Notification<span class="ml-1" id="checkNotification"></span></a>
				</li>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle text-white" id="navbardrop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user-cog"></i>&nbsp;Hi!<?= $fname ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="userDropdown">
						<a href="#" class="dropdown-item"><i class="fa fa-cog"></i>&nbsp;Setting</a>
						<a href="assets/php/logout.php" class="dropdown-item"><i class="fa fa-sign-out-alt"></i>&nbsp;Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>