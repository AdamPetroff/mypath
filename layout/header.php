<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $page_title ?></title>
		<link rel="stylesheet" type="text/css" href="/stranka3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/stranka3/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="/stranka3/css/style.css">
	</head>
	<body>
	<div class="container" style="background-color:#f4f4f4">
		<div class="row">
			<nav id="navbar" class="navbar navbar-inverse navbar-fixed-top col-12">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">MyPath</a>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-content">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar-content" class="navbar-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="plan.php">Plan</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
						<?php
						if($login = $user->check_login()){
						?>
						<li>
							<a href="profile.php">Logged in as <?php echo($login->user_name); ?></a>
						</li>
						<li>
							<a href="index.php?action=logout">Logout</a>
						</li>
						<?php
							}else{
						?>
						<li>
							<a href="login.php">Login</a>
						</li>
						<li>
							<a href="register.php">Register</a>
						</li>
						<?php
							}
						?>
					</ul>
				</div>
			</nav>
		</div>
		<div class="row">
			<div class="alert" id="flashMessage" role="alert">
				<strong></strong>  <span></span>
			</div>
		</div>